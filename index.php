<html>
  <head>
    <title>Ransomware[Phase2]</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <link href="css/style.css" rel="stylesheet">
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
          <div class="panel-heading text-center panel-relative"><b>WEBSITE ADDRESS</b></div>
          <div class="panel-body">
          <form action="index.php" method="POST">
          <div class="row">
            <div class="col-md-4">
            <label class="home_label">Enter website URL:</label>
            </div>
            <div class="col-md-8">
            <div class="input-group input-group-md">
                <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-link"></span></span>
                <input type="text" name="url" class="form-control" id="url" placeholder="http://www.domain.com" aria-describedby="sizing-addon1" required>
            </div>            
            </div>          
          </div><br/>
          <div class="row">
            <div class="col-md-5">
            </div>
            <div class="col-md-7">
              <input type="submit" style="float:right" name="submit" class="btn btn-default"  value="Submit" id="redirect_submit"> 
            </div>
          </div>
          </form>
          <?php
            if(isset($_POST['submit']))
            {
              echo '<p>Website Address: <b>'.$_POST['url'].'</b></p>';
            }
          ?>
          </div>
          </div>
      </div>
          <div class="col-md-5">
          <div class="panel panel-default">
          <div class="panel-heading text-center panel-relative"><b>DETAILS</b></div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                <ol class="breadcrumb breadcrumb-arrow">
                <li><a href="#" class="active_log" id="active_link">Sitemap</a></li>
                <li><a href="#" disabled>Static</a></li>
                <li><a href="#">Dyanmic</a></li>
                <li><a href="#">Ransomware</a></li>
                <li><a href="#">Report</a></li>
                <!--<li class="active"><span>Data</span></li>-->
                </ol>
              </div>
            </div>
<?php
 $GLOBALS['url']= '';

   if(isset($_POST['submit'])){
    $url = $_POST['url'];
    if(filter_var($url, FILTER_VALIDATE_URL) === FALSE){
      echo '<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Warning!</strong> A valid URL please.
</div>';
    }else{
   include("html/simple_html_dom.php");
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
     $crawled_urls[$uen]=date("YmdHis");

     //to check for the forms action
     $form_links = 1;
     $form_action = NULL;
     $form_input = array();
     $i=1;

     $i=0;
     $count = 1;
     $other_links = 1;
      echo "<div class='row'><div class='col-md-12'><div style='overflow-x:auto; width:510px;height:300px;'><table class='table table-striped'><thead><tr><th>S.No</th><th style='text-align:center'>Links</th></tr></thead><tbody>";
     foreach($html->find("a") as $li){
      $url=perfect_url($li->href,$u);
      $enurl=urlencode($url);
      if($url!='' && substr($url,0,4)!="mail" && substr($url,0,4)!="java"){
       $found_urls[$enurl]=1;
       if(isset($domain_name))
       {
        echo "<tr><td>$other_links</td><td><a href='#' onclick='fileLocation("."\"".$url."\"".")'>$url</a></td></tr>";
        $other_links++;
       }
       if(isset($domain_name) && in_array(get_domain($url), $domain_name))
       {

       }
       else
       {
        $domain_name[$i] = get_domain($url);
        if($domain_name[$i] != "")
        {
           $i++; 
       $count++;   
       }         
       }

      }
     }
     echo "</tbody></table></div></div></div>";
}
}
crawl_site($url);
}
}
?>

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