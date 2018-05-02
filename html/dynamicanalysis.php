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
                <li><a href="#"  >Static</a></li>
                <li><a href="#" id="active_link">Dyanmic</a></li>
                <li><a href="#">Ransomware</a></li>
                <li><a href="#">Report</a></li>
                <!--<li class="active"><span>Data</span></li>-->
                </ol>
              </div>
            </div>

            <div class="row">
<?php
        $json = json_decode(file_get_contents("../html/ast.json"));
        $count = 1;
//Variables for the IVS attributes

        $cookie_val = "NULL";
        $cookie_arr = 0;
        $database_val = "NULL";
        $database_arr = 0;
        $session_val = "NULL";
        $session_arr = 0;
        $variable_val = "NULL";
        $variable_arr = 0;
        $eval_val = "NULL";
        $eval_arr = 0;
        $numeric_val = "NULL";
        $numeric_arr = 0;
        $limtlen_val = "NULL";
        $limtlen_arr = 0;
        $path_val = "NULL";
        $path_arr = 0;
        $encode_val = "NULL";
        $encode_arr = 0;
        $null_val = "NULL";
        $null_arr = 0;



foreach($json->children as $item)
{
    if($item->kind == "call" && $item->what->name == "setcookie")
    {
          $cookie_val = "Cookies Found";
          $cookie_arr = 1;
    }
    if($item->kind == "assign")
    {
      if($item->right->value)
      {
        if(strpos($item->right->value,'SELECT') !== false)
        {
          $database_val = "Database Accessed";
          $database_arr = 1;
        }        
      }
      if($item->left->what->name)
      {
        if(strpos($item->left->what->name,'_SESSION') !== false)  
        {
          $session_val = "Session Used";
          $session_arr = 1;
        }  
      }
      if($item->right->what->name)
      {
        if($item->right->what->name == 'substr')
        {
          $limtlen_val = "String limiter Present";
          $limtlen_arr = 1;
        }
        if($item->right->what->name == 'scandir')
        {
          $path_val = "Path filter Present";
          $path_arr = 1;
        }
        if($item->right->what->name == 'utf8_encode')
        {
          $encode_val = "Encode using utf8_encode";
          $encode_arr = 1;
        }
        if($item->right->what->name == 'assertPurification')
        {
          $null_val = "Null filter present";
          $null_arr = 1;
        }
      }
      if($item->right->kind == "cast")
      {
        $numeric_val = "Int Cast";
        $numeric_arr = 1;
      }

    }
    
    if($item->kind == "variable")
    {
       if($item->right)
       {

       }
       else
       {
         $variable_val = "Present";
         $variable_arr = 1;
       }
    }

    if($item->kind == "eval")
    {
       $eval_val = "eval Present";
       $eval_arr = 1;
    }

}
      ?>

  <div class="table-responsive" style="height:400px">          
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Value</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>File</td>
        <td><?php echo $cookie_val; ?></td>
      </tr>
            <tr>
        <td>2</td>
        <td>Database</td>
        <td><?php echo $database_val; ?></td>
      </tr>
            <tr>
        <td>3</td>
        <td>Session</td>
        <td><?php echo $session_val; ?></td>
      </tr>
            <tr>
        <td>4</td>
        <td>Uninit</td>
        <td><?php echo $variable_val; ?></td>
      </tr>
            <tr>
        <td>5</td>
        <td>Known-vuln-std</td>
        <td><?php echo $eval_val; ?></td>
      </tr>
            <tr>
        <td>6</td>
        <td>Numeric</td>
        <td><?php echo $numeric_val; ?></td>
      </tr>

            <tr>
        <td>7</td>
        <td>Null-byte</td>
        <td><?php echo $null_val; ?></td>
      </tr>

            <tr>
        <td>8</td>
        <td>Encode</td>
        <td><?php echo $encode_val; ?></td>
      </tr>
            <tr>
        <td>9</td>
        <td>Path</td>
        <td><?php echo $path_val; ?></td>
      </tr>
            <tr>
        <td>10</td>
        <td>Limit-length</td>
        <td><?php echo $limtlen_val; ?></td>
      </tr>
    </tbody>
  </table>
  </div>
            </div>



<div class="row">
    <button type="button" class="btn btn-info" data-toggle="modal" style="float:left" data-target="#myModal">Vulnerability Analysis</button>
    <a href="ransomwareanalysis.php"><button type="button" style="float:right" class="btn btn-primary">Rasomware Behavior Analysis</button></a>
</div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Analysis using Python</h4>
        </div>
        <div class="modal-body">
          <p>Array of attributes : [<?php echo $cookie_arr.','.$database_arr.','.$session_arr.','.$variable_arr.','.$eval_arr.','.$numeric_arr.','.$null_arr.','.$encode_arr.','.$path_arr.','.$limtlen_arr.',1'; ?>]</p>

          <p style="color:red">Make the array copied to the script</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
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