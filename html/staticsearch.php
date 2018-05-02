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
              $file = $_GET['file'];
              $newfile = 'php_filecheck.txt';
              if (!copy($file, $newfile)) {
                 echo "<b>failed to copy get the file</b>";
                }
                else
                {
                    echo "<xmp>".file_get_contents($file)."</xmp>";

                }
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

            <?php
             if(isset($_GET['ast'])) { ?>
                           <div class="row">
                  <pre data-lang='AST' class='prettyprint'>
                      <?php
                        echo "<xmp>".file_get_contents("../ast_file.txt")."</xmp>";
                      ?>
                  </pre>
  <a href="http://127.0.0.1:8080/" target="_blank"><button type="button" class="btn btn-primary" style="float: left;"><b>JSON/AST</b></button></a>
  <a href="Taintanalysis.php"><button type="button" class="btn btn-primary" style="float: right;">Taint Analysis</button></a>
              </div>
        <?php } else { ?>
           <div class="row">
              <div class="col-md-9">
                  <div class="alert alert-info" role="alert">Note: Run the Nodejs Server <span class="label label-default">cmd</span></div>
              </div>
              <div class="col-md-2">
                  <button type="button" id="btn" onclick="reload()" class="btn btn-success navbar-btn"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
              </div>
              <div class="col-md-1">
              </div>
            </div>
            <div class="row"> 
                  <div class="embed-responsive embed-responsive-16by9">
                    <iframe id="iframeid" class="embed-responsive-item" src="http://localhost:8080/<?php echo $_GET['file']; ?>"></iframe>
                  </div> 
            </div>
          
            <?php } ?>
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