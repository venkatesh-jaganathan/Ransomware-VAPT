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
                <li><a href="#" >Dyanmic</a></li>
                <li><a href="#" id="active_link">Ransomware</a></li>
                <li><a href="#">Report</a></li>
                <!--<li class="active"><span>Data</span></li>-->
                </ol>
              </div>
            </div>
<div class="row">
        <div class="col-md-12">
          <div class="well">
          <p style="font-size:23px;color:rgb(6,66,92)"><b>From NoMoreRansomware Repository</b></p>          
          <form action="https://www.nomoreransom.org/crypto-sheriff.php?lang=en" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-3">
              <label class="home_label">Upload the File:</label>          
            </div>
            <div class="col-md-9">
<div class="fileinput fileinput-new" data-provides="fileinput">
<input class="btn btn-default" type="file" value="Browse.." name="file_one" id="fileToUpload">
</div>  <br/>
<div class="fileinput fileinput-new" data-provides="fileinput">
 <input class="btn btn-default" type="file" value="Browse.." name="file_two" id="fileToUpload">
</div>            
            </div>
          </div><br/>
          <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-9">
              <input type="submit" name="submit" class="btn btn-default"  value="Perform check">            
            </div>
          </div><br/>
          </form>
          </div>
        </div>       
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="well">
          <p style="font-size:23px;color:rgb(6,66,92)"><b>From system analysis</b></p>
          <div class="alert alert-info alert-dismissible" id="show_alert" role="alert" style="display:none">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span             aria-hidden="true">&times;</span></button>
                <strong>Info!</strong><span>The File <span id="result"></span> has been uploaded.</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" target="blank" id="ajax_href"><b>Report</b></a>
            </div>
          <form id="fileUploadForm" method="post">
          <div class="row">
            <div class="col-md-3">
              <label class="home_label">Encrypted Text:</label>         
            </div>
            <div class="col-md-9">
<div class="fileinput fileinput-new" data-provides="fileinput">
    <input class="btn btn-default" type="text"  name="textanalysis" id="fileToUpload" required>
</div>            
            </div>
          </div><br/>
          <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-9">
              <input type="submit" name="submit" class="btn btn-default"  value="Perform check" id="btnSubmit">           
            </div>
          </div><br/>
          </form>
          </div>
        </div>       
      </div>
<div class="row">
<?php
if(isset($_POST["textanalysis"]))
{
  $data = "Hello World";
  $encrypt_algo = "Not Found";
  $post_val = $_POST["textanalysis"];
//for hash encoding
foreach (hash_algos() as $v) 
  {
        $r = hash($v, $data, false);
        if($r == $post_val)
        {
          $encrypt_algo = $v;
        }
  }
//for encryption standards
  if(crypt($data, 'rl') == $post_val)
  {
      $encrypt_algo = "Standard DES";
  }
  else if(crypt($data, '_J9..rasm') == $post_val )
  {
      $encrypt_algo = "Extended DES";
  }
  else if(crypt($data, '$1$rasmusle$') == $post_val)
  {
    $encrypt_algo = "MD5";
  }
  else if(crypt($data, '$2a$07$usesomesillystringforsalt$') == $post_val)
  {
    $encrypt_algo = "Blowfish";
  }
  else if(crypt($data, '$5$rounds=5000$usesomesillystringforsalt$') == $post_val)
  {
    $encrypt_algo = "SHA-256";
  }
  else if(crypt($data, '$6$rounds=5000$usesomesillystringforsalt$') == $post_val)
  {
    $encrypt_algo = "SHA-512";
  }
  else
  {
    $encrypt_algo = "Not Found";
  }

  if($encrypt_algo == "Blowfish")
  {
    $ransomware_algo = "FLRK Ransomware";
  }
  else if($encrypt_algo == "MD5")
  {
    $ransomware_algo = "CRYPTOWALL 4 Ransomware";
  }
  else if($encrypt_algo == "SHA-512")
  {
    $ransomware_algo = "Apocalypse Ransomware";
  }
  else if($encrypt_algo == "SHA-512")
  {
    $ransomware_algo = "Apocalypse Ransomware";
  }
  else
  {
    $ransomware_algo = "Anonymous Ransomware";
  }

?>
  <div class="row" id="ransomware_details">
  <div class="col-md-12">
  <div class="well">
  <p style="font-size:23px;color:rgb(6,66,92)"><b>File analysis</b></p>
  <div class="table-responsive">
   <table class="table">
   <tr class="info"><td><b>Encrypted Text</b></td><td><?php echo $post_val; ?></td></tr>
   <tr class="info"><td><b><b>Encoding Standard</b></td><td><?php echo mb_detect_encoding($post_val); ?></td></tr>
   <tr class="info"><td><b>Encrytion Algorithm</b></td><td><?php echo $encrypt_algo; ?></td></tr>
   <tr class="info"><td><b>Ransomware</b></td><td><?php echo $ransomware_algo; ?></td></tr>
   </table>
   </div>
   <div><a href="ransomware_report.php?encryp=<?php echo $post_val;?>" target="_blank"><button class="btn btn-primary" style="float:right">Report</button></a></div><br/>
   </div>
   </div>
   </div>
<?php
}
?>
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