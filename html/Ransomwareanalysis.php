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
          <form action="Ransomwareanalysis.php" method="POST">
          <div class="row">
            <div class="col-md-3">
              <label class="home_label">Enter website URL:</label>          
            </div>
            <div class="col-md-9">
              <div class="input-group input-group-lg">
                <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-link"></span></span>
                <input type="text" name="url" class="form-control" id="url" placeholder="http://www.domain.com" aria-describedby="sizing-addon1" value="<?php if(isset($_GET['url'])) { echo $_GET['url'];} ?>" required>
              </div>              
            </div>
          </div><br/>
          <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-9">
              <input type="submit" name="submit" class="btn btn-default"  value="Perform check" id="maliciousfile_submit">            
            </div>
          </div><br/>
          </form>


          <?php
   include("simple_html_dom.php");
   $crawled_urls=array();
   $found_urls=array();
   function rel2abs($rel, $base){
    if (parse_url($rel, PHP_URL_SCHEME) != '') return $rel;
    if ($rel[0]=='#' || $rel[0]=='?') return $base.$rel;
    extract(parse_url($base));
    $path = preg_replace('#/[^/]*$#', '', $path);
    if ($rel[0] == '/') $path = '';
    $abs = "$host$path/$rel";
    $re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
    for($n=1; $n>0;$abs=preg_replace($re,'/', $abs,-1,$n)){}
    $abs=str_replace("../","",$abs);
    return $scheme.'://'.$abs;
   }
   function perfect_url($u,$b){
    $bp=parse_url($b);
    if(($bp['path']!="/" && $bp['path']!="") || $bp['path']==''){
     if($bp['scheme']==""){$scheme="http";}else{$scheme=$bp['scheme'];}
     $b=$scheme."://".$bp['host']."/";
    }
    if(substr($u,0,2)=="//"){
     $u="http:".$u;
    }
    if(substr($u,0,4)!="http"){
     $u=rel2abs($u,$b);
    }
    return $u;
   }

//for domain address separation
   function get_domain($url)
{
  $pieces = parse_url($url);
  $domain = isset($pieces['host']) ? $pieces['host'] : '';
  if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
    return $pieces['scheme']."://".$pieces['host'];
  }
  return false;
}

//array declaration for storing domain names
$domain_name = array();

   function crawl_site($u){
    global $crawled_urls;
    $uen=urlencode($u);
    if((array_key_exists($uen,$crawled_urls)==0 || $crawled_urls[$uen] < date("YmdHis",strtotime('-25 seconds', time())))){
     $html = file_get_html($u);
     echo "<h4><b>Files</b></h4>";
     $i=0;
     $count = 1;
     $other_links = 1;
     echo "<div class='table-responsive'><table class='table table-striped'><thead><tr><th>S.No</th><th>File Link</th><th>Name</th><th>Extension</th><th>File Analysis</th></tr></thead><tbody>";    
     $crawled_urls[$uen]=date("YmdHis");

     $iframe_file = 1;
    foreach($html->find("a") as $li)
     {
      $a_link = $li->href;
    $info = new SplFileInfo($a_link);
    $file_extension = $info->getExtension();
    $file_name = $info->getBasename(".".$file_extension);
    if($file_extension == 'pdf' || $file_extension == 'exe' || $file_extension == 'crypto')
    {
      echo nl2br("<tr><td>$count</td><td><a href='#' data-toggle='modal' data-target='#$iframe_file'>$a_link</a></td><td>$file_name</td><td>$file_extension</td><td align='center'><a href='$a_link'><span class='glyphicon glyphicon-download-alt'></span></a></td></tr>");
      echo "  <!-- Modal -->
  <div class='modal fade' id='$iframe_file' role='dialog'>
    <div class='modal-dialog' style='width:1000px'> 
    
      <!-- Modal content-->
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 class='modal-title'>File Scanning Details</h4><a href='ransomwarecheck.php'><button type='button' class='btn btn-primary' style='float:right'>File Analysis</button></a>
        </div>
        <div class='modal-body'>
          <iframe src='virustotal_api.php?file_url=$a_link' width='960' height='500'></iframe>
        </div>
      </div>
      
    </div>
  </div>";
      $count++;
      $iframe_file++;
    }

     }
     if($count == 1)
     {
           echo '<tr><td colspan="5"><div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Info!</strong> No files found.
</div></tr></td>';      
     }
   echo "</tbody></table></div>";
}
}

if(isset($_POST['submit'])){
    $url=$_POST['url'];
    if(filter_var($url, FILTER_VALIDATE_URL) === FALSE){
      echo '<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Warning!</strong> A valid URL please.
</div>';
    }else{
     echo "<div class='row'><div id='div1'>";
     crawl_site($url);
     echo "</div></div>";
 }
}


?>
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