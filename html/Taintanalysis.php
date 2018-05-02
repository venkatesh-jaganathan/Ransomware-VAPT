<html>
  <head>
    <title>Ransomware[Phase2]</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../js/script.js"></script>
    <script src="../index.js"></script>
    <link href="../css/style.css" rel="stylesheet">
  </head>
  <body>
    <div class="fixed-top">
      <nav class="navbar navbar-expand-lg navbar-dark mx-background-top-linear">
    <div class="container">
      <a class="navbar-brand" href="index.php" style="text-transform: uppercase;color:white"> VAPT of Ransomware</a>
      <span style="font-size:20px;margin-top:8px;color:white;float:right">CEG,Anna University,Chennai</span>
    </div>
  </nav>
    </div>
    <div class="row">
      <div class="col-md-1">
      </div>
      <div class="col-md-5">
          <div class="panel panel-default">
          <div class="panel-heading text-center panel-relative"><b>File</b></div>
          <div class="panel-body">
          <pre data-lang='Source Code' class='prettyprint'>
             <?php
              $newfile = 'php_filecheck.txt';
                    echo "<xmp>".file_get_contents($newfile)."</xmp>";
              ?>
          </pre>
          </div>
          </div>
      </div>
          <div class="col-md-5">
          <div class="panel panel-default">
          <div class="panel-heading text-center panel-relative"><b>Static Code Analysis</b></div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                <ol class="breadcrumb breadcrumb-arrow">
                <li><a href="#" class="active_log">Sitemap</a></li>
                <li><a href="#"  id="active_link">Static</a></li>
                <li><a href="#">Dyanmic</a></li>
                <li><a href="#">Ransomware</a></li>
                <li><a href="#">Report</a></li>
                <!--<li class="active"><span>Data</span></li>-->
                </ol>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                  <p><b>Taint Analysis</b></p>
                  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Tainted Symbol Table</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body">
                <?php
        $json = json_decode(file_get_contents("../html/ast.json"));
        $count = 1;
         echo " <table class='table table-striped'>
                <thead>
                  <tr>
                  <th>No</th>
                    <th>Kind</th>
                    <th>Name</th>
                    <th>Line</th>
                  </tr>
                </thead><tbody>";
foreach($json->children as $item)
{
    if($item->kind == "assign" && $item->operator == "=" && $item->right->kind == "offsetlookup")
    {
            echo "<tr><td>".$count."</td><td>".$item->left->kind."</td><td>".$item->left->name."</td><td>".$item->loc->start->line."</td></tr>";
            echo "<tr><td></td><td>".$item->right->kind."</td><td>".$item->right->what->name."</td><td>".$item->right->loc->start->line."</td></tr>";
            //print_r($item->left->name);
            $count++;
    }
    
}
echo "</tbody></table>"
      ?>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Tainted Execution Path Tree(TEPT)</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">
                          <?php
        $json = json_decode(file_get_contents("../html/ast.json"));
        $count = 1;
         echo " <table class='table table-striped'>
                <thead>
                  <tr>
                  <th>No</th>
                    <th>Kind</th>
                    <th>Name</th>
                    <th>Line</th>
                    <th>Tainted</th>
                  </tr>
                </thead><tbody>";
foreach($json->children as $item)
{
    if($item->kind == "assign" && $item->operator == "=" && $item->right->kind == "offsetlookup")
    {
            echo "<tr><td>".$count."</td><td>".$item->left->kind."</td><td>".$item->left->name."</td><td>".$item->loc->start->line."</td><td></td></tr>";
            echo "<tr><td></td><td>".$item->right->kind."</td><td>".$item->right->what->name."</td><td>".$item->right->loc->start->line."</td><td></td></tr>";
            foreach($json->children as $child_item)
            {
              if($child_item->kind == "assign" && $child_item->operator == "=" && $child_item->right->kind == "encapsed")
              {
                  $count_var = 1;
                  $tainted = 0;
                  $left_var = $child_item->left->name;
                  foreach($child_item->right->value as $child1_item)
                  {
                    if($child1_item->kind == "string")
                    {
                      $count_var++;
                      if(strpos($child1_item->value,"mysql_real_escape_string"))
                      {
                        $tainted++;
                      }
                    }
                    if($child1_item->kind == "variable" && $child1_item->name == $item->left->name)
                    {
                        echo "<tr><td></td><td>".$child1_item->kind."</td><td>".$left_var."</td><td>".$child1_item->loc->start->line."</td><td>";
                        if($tainted)
                          {
                            echo "<span class='glyphicon glyphicon-remove'></span></td></tr>";
                          }
                          else
                          {
                            echo "<span class='glyphicon glyphicon-ok'></span></td></tr>";
                          }
                        $count_var++;
                    }
                    if($count_var == 3)
                    {
                      $tainted = 0;
                      break;
                    }
                  }
              }
            }
            //print_r($item->left->name);
            $count++;
    }
    
}
echo "</tbody></table>"
      ?>

        </div>
      </div>
    </div>

  </div>
              </div>
            </div>
<div class="row">
  <a href="dynamicanalysis.php"><button type="button" style="float:right" class="btn btn-primary">Dynamic Analysis</button></a>
</div>
          </div>
          </div>
      </div>
      <div class="col-md-1">
      </div>
    </div>
        <div class="fixed-bottom">
      <nav class="navbar navbar-expand-lg navbar-dark mx-background-bottom-linear">
    <div class="container">
      <a class="navbar-brand" href="index.php" style="text-transform: uppercase;"> 2018 @CEG</a>
    </div>
  </nav>
    </div>
  </body>
</html>