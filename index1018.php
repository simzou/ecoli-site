<?
//PHP init

$page_array = array(
10 => array('blast_navigation_tutorial','tutorialsSide1','Blast search'),
11 => array('tfermentation_tutorial','tutorialsSide2','Fermentation tutorial'),
12 => array('navigation_tutorial','tutorialsSide3','Navigation tutorial'),
13 => array('nutrient_transport','tutorialsSide4','Nutrient transport'),
'aerobic_respiration' => array('aerobic_respiration','contentSide1','Aerobic respiration'),
'anaerobic_respiration' => array('anaerobic_respiration','contentSide1','Anaerobic respiration'),
'fermentation' => array('fermentation','contentSide1','Fermentation'),
'nutrient_transport' => array('nutrient_transport','contentSide1','Nutrient transport')
);

$ps_array = array(
"aerobic_respiration" => array('exercises/aerobic_respiration/exercise','exercisesSide1','Exercise',''),
"aerobic_respiration_advanced" => array('exercises/aerobic_respiration/advanced_exercise','exercisesSide1','Advanced Exercise',''),
"anaerobic_respiration" => array('exercises/anaerobic_respiration/exercise','exercisesSide2','Exercise',''),
"anaerobic_respiration_advanced" => array('exercises/anaerobic_respiration/advanced_exercise','exercisesSide2','Advanced Exercise',''),
"blast" => array('exercises/blast/exercise','exercisesSide3','Exercise',''),
"blast_advanced" => array('exercises/blast/advanced_exercise','exercisesSide3','Advanced Exercise',''),
"nutrient_transport" => array('exercises/nutrient_transport/exercise','exercisesSide4','Exercise',''),
"nutrient_transport_advanced" => array('exercises/nutrient_transport/advanced_exercise','exercisesSide4','Advanced Exercise','')
);

$page_title = "";

if (isset($_GET['page'])) {
	$page_title = ' - '.$page_array[$_GET['page']][2];
}


?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>E. coli student portal<?=$page_title?></title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link rel="shortcut icon" href="favicon.ico">
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryMenuBarHorizontalHead.css" rel="stylesheet" type="text/css">
<link href="ecoli-styles.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
<!--[if IE 6]>
<link href="ecoli-styles-ie6.css" rel="stylesheet" type="text/css">
<![endif]-->
<!-- PHP
<?

function msidelink($pageid){
global $page_array;
if ($_GET['page'] == $pageid) print '<a href="article_'.$pageid.'" class="sidebgshift">'.$page_array[$pageid][2].'</a>';
else print '<a href="article_'.$pageid.'" >'.$page_array[$pageid][2].'</a>';
}

function mlinkseries($psid,$_first,$_last){
	global $ps_array;
	$_count = $_first;
	while ($_last>=$_count){
		$_page = $ps_array[$psid][0].$_count;
		if ($_GET['psid'] == $psid && $_GET['pid'] == $_count) {
			print '<li><a href="exercise_'.$psid.'-'.$_count.'" class="sidebgshift">'.$ps_array[$psid][2].' '.$_count.' '.$ps_array[$psid][3].'</a></li>
      ';
		} else {
			print '<li><a href="exercise_'.$psid.'-'.$_count.'">'.$ps_array[$psid][2].' '.$_count.' '.$ps_array[$psid][3].'</a></li>
      ';
		}
		$_count++;
	}
}

function mlinkdir($exercise_name,$num_advanced){
	$dir = 'sites/exercises/'.$exercise_name;
	$i = 0;
	$ai = 0;
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
			if ($file == "." || $file == "..") continue;
			if ($ai<$num_advanced) {
			$toprint = '<li><a href="sites/exercises/'.$exercise_name.'/'.$file.'" title="">Advanced Exercise '.++$ai.'</a></li>
			';
	 		continue;
			} 
			print '<li><a href="sites/exercises/'.$exercise_name.'/'.$file.'" title="">Exercise '.++$i.'</a></li>
			';
			}
			closedir($dh);
			print $toprint;
		}
	}
}

function selectedhid($pageid){
	if ($_GET['page'] == $pageid) print '<a href="article_'.$pageid.'" class="headbgshift">';
	else print '<a href="article_'.$pageid.'">';
}
function selectedhid_e($id){
	// ez lehet hogy nem kell ha a legvegen mukodik a SelectedSecondHead.addClass
	if ($_GET['psid'] == $id || $_GET['psid'] == $id."_advanced") print '<a href="#_" class="headbgshift">';
	else print '<a href="#_">';
}



// JavaScript Variables
if (isset($_GET['page'])) {
	$page_side = $page_array[$_GET['page']][1];
	$jSelectedHead = '$("#'.substr($page_side,0,-5).'MenuBar")';
	$jSelectedHeadLabel = '$("a#'.substr($page_side,0,-5).'")';
	$jSelectedSide = '$("#'.$page_side.'")';
	$jSelectedSecondHead = '$("ul#'.substr($page_side,0,-5).'MenuBar a:eq('.(substr($page_side,-1) - 1).')")';
	
	$jtoprint = "
var SelectedHead = $jSelectedHead;
var SelectedHeadLabel = $jSelectedHeadLabel;
var SelectedSide = $jSelectedSide;
var SelectedSecondHead = $jSelectedSecondHead;
";
}
else if (isset($_GET['psid']) && isset($_GET['pid'])) {
	$page_side = $ps_array[$_GET['psid']][1];
	$jSelectedHead = '$("#'.substr($page_side,0,-5).'MenuBar")';
	$jSelectedHeadLabel = '$("a#'.substr($page_side,0,-5).'")';
	$jSelectedSide = '$("#'.$page_side.'")';
	$jSelectedSecondHead = '$("ul#'.substr($page_side,0,-5).'MenuBar a:eq('.(substr($page_side,-1) - 1).')")';
	
	$jtoprint = "
var SelectedHead = $jSelectedHead;
var SelectedHeadLabel = $jSelectedHeadLabel;
var SelectedSide = $jSelectedSide;
var SelectedSecondHead = $jSelectedSecondHead;
";
}
else {
	$jSelectedHead = '';
	$jSelectedHeadLabel = '';
	$jSelectedSide = '';
	$jSelectedSecondHead = '';
	
	$jtoprint = '
var SelectedHead = $("#homeMenuBar");
var SelectedHeadLabel = $("a#home");
var SelectedSide = $("#sample");
var SelectedSecondHead = "";
';
}
// JavaScript Variables END


?>
<?

 $trackerfile = "visits.txt";
 if (file_exists($trackerfile) && filesize($trackerfile)>0 && $trackerfile == 'test') {
	 $file_data = file_get_contents($trackerfile);
	 $visitorhost = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	 if (strstr($visitorhost, "tfbnw.net") || isset($_GET["Testing"]) || strpos($visitorhost,"hdsnet.hu") || strpos($visitorhost,"googlebot.com")) $visitorhost = "Testing";
	 else {
		 
		 
		if (isset($_GET['page'])) {
			$sites_checked = ' @'.$_GET['page'];
		} 
		
		if (isset($_GET["qr"])) {
			$sites_checked .= "*** QR";
		} 

		 
		 $file_data = $_SERVER['REMOTE_ADDR']."\t".$visitorhost."\t".$_SERVER['HTTP_USER_AGENT']."\t".date("F j, Y, g:i a").$sites_checked."\n".$file_data;
		 $fp = fopen($trackerfile,"w");
		 fwrite($fp,$file_data);
		 fclose($fp);
	 }
 }
?>
-->
</head>

<body>
<div class="container">
  <div class="innerContainer">
    <div class="header">
      <div style="position: absolute; padding:0px; margin:0px 0px 0px 600px; width:290px; height:63px; text-align:center; font-size:12px;"><!-- Search Google -->
        
        <div id="cse-search-form" style="width: 100%;
margin-top: 23px;
margin-left: 10px;">Loading</div>
        <script src="//www.google.com/jsapi" type="text/javascript"></script> 
        <script type="text/javascript"> 
function toggleCse(){
		var searchResultsDiv = document.getElementById("cse");
		searchResultsDiv.style.display="block";
		}

  google.load('search', '1', {language : 'en'});
  google.setOnLoadCallback(function() {
    var customSearchControl = new google.search.CustomSearchControl('003842293719158004767:WMX-913000041');
    customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
    var options = new google.search.DrawOptions();
    options.setSearchFormRoot('cse-search-form');
    customSearchControl.draw('cse', options);
	customSearchControl.setLinkTarget(google.search.Search.LINK_TARGET_SELF);
	
	customSearchControl.setSearchStartingCallback(this, toggleCse);
//	customSearchControl.setSearchCompleteCallback(this, toggleCse); setOnSubmitCallback
  }, true);
</script>
        <link rel="stylesheet" href="//www.google.com/cse/style/look/default.css" type="text/css" />
        <style type="text/css">
		div#cse {
			border: 1px dashed #E2AA5A;
			width:80%;
			margin: 0 auto;
			display:none;
		}
.gsc-wrapper{
	background-color:white;
	word-break: break-all;
}
  .gsc-control-cse {
    font-family: Arial, sans-serif;
    border-color: transparent;
    background-color: transparent;
  }
  input.gsc-input {
    border-color: #BCCDF0;
  }
  input.gsc-search-button {
    border-color: #CECECE;
    background-color: #E9E9E9;
  }
  .gsc-tabHeader.gsc-tabhInactive {
    border-color: #E9E9E9;
    background-color: #E9E9E9;
  }
  .gsc-tabHeader.gsc-tabhActive {
    border-top-color: #FF9900;
    border-left-color: #E9E9E9;
    border-right-color: #E9E9E9;
    background-color: #FFFFFF;
  }
  .gsc-tabsArea {
    border-color: #E9E9E9;
  }
  .gsc-webResult.gsc-result,
  .gsc-results .gsc-imageResult {
    border-color: #FFFFFF;
    background-color: #FFFFFF;
  }
  .gsc-webResult.gsc-result:hover,
  .gsc-imageResult:hover {
    border-color: #FFFFFF;
    background-color: #FFFFFF;
  }
  .gs-webResult.gs-result a.gs-title:link,
  .gs-webResult.gs-result a.gs-title:link b,
  .gs-imageResult a.gs-title:link,
  .gs-imageResult a.gs-title:link b {
    color: #0000CC;
  }
  .gs-webResult.gs-result a.gs-title:visited,
  .gs-webResult.gs-result a.gs-title:visited b,
  .gs-imageResult a.gs-title:visited,
  .gs-imageResult a.gs-title:visited b {
    color: #0000CC;
  }
  .gs-webResult.gs-result a.gs-title:hover,
  .gs-webResult.gs-result a.gs-title:hover b,
  .gs-imageResult a.gs-title:hover,
  .gs-imageResult a.gs-title:hover b {
    color: #0000CC;
  }
  .gs-webResult.gs-result a.gs-title:active,
  .gs-webResult.gs-result a.gs-title:active b,
  .gs-imageResult a.gs-title:active,
  .gs-imageResult a.gs-title:active b {
    color: #0000CC;
  }
  .gsc-cursor-page {
    color: #0000CC;
  }
  a.gsc-trailing-more-results:link {
    color: #0000CC;
  }
  .gs-webResult .gs-snippet,
  .gs-imageResult .gs-snippet {
    color: #000000;
  }
  .gs-webResult div.gs-visibleUrl,
  .gs-imageResult div.gs-visibleUrl {
    color: #008000;
  }
  .gs-webResult div.gs-visibleUrl-short {
    color: #008000;
  }
  .gs-webResult div.gs-visibleUrl-short {
    display: none;
  }
  .gs-webResult div.gs-visibleUrl-long {
    display: block;
  }
  .gsc-cursor-box {
    border-color: #FFFFFF;
  }
  .gsc-results .gsc-cursor-box .gsc-cursor-page {
    border-color: #E9E9E9;
    background-color: #FFFFFF;
    color: #0000CC;
  }
  .gsc-results .gsc-cursor-box .gsc-cursor-current-page {
    border-color: #FF9900;
    background-color: #FFFFFF;
    color: #0000CC;
  }
  .gs-promotion {
    border-color: #336699;
    background-color: #FFFFFF;
  }
  .gs-promotion a.gs-title:link,
  .gs-promotion a.gs-title:link *,
  .gs-promotion .gs-snippet a:link {
    color: #0000CC;
  }
  .gs-promotion a.gs-title:visited,
  .gs-promotion a.gs-title:visited *,
  .gs-promotion .gs-snippet a:visited {
    color: #0000CC;
  }
  .gs-promotion a.gs-title:hover,
  .gs-promotion a.gs-title:hover *,
  .gs-promotion .gs-snippet a:hover {
    color: #0000CC;
  }
  .gs-promotion a.gs-title:active,
  .gs-promotion a.gs-title:active *,
  .gs-promotion .gs-snippet a:active {
    color: #0000CC;
  }
  .gs-promotion .gs-snippet,
  .gs-promotion .gs-title .gs-promotion-title-right,
  .gs-promotion .gs-title .gs-promotion-title-right *  {
    color: #000000;
  }
  .gs-promotion .gs-visibleUrl,
  .gs-promotion .gs-visibleUrl-short {
    color: #008000;
  }
</style>
        
        <!--    
<form action="./" id="cse-search-box" style="padding:23px 0px 0px 0px;">
    <input type="hidden" name="cx" value="003842293719158004767:3g7rfpdcxp8" /> 003842293719158004767:7xl0fevxkps
    <input type="hidden" name="cof" value="FORID:11" />
    <input type="hidden" name="ie" value="UTF-8" />
    <input type="hidden" name="page" value="searchresults" />
    <input type="hidden" name="widecontent" value="yes" />
    <input type="text" name="q" size="22" />
    <input type="submit" name="sa" value="Search" />
</form>
<script type="text/javascript" src="http://www.google.com/cse/brand?form=cse-search-box&lang=en"></script>
--> 
        
        <!-- Search Google --></div>
      <a href="/"><img src="images/header1s.jpg" id="header" width="900" height="100" alt=""></a>
      <div style="margin: 0 0 10px 0; padding: 0; display:block;">
        <ul id="headMenuBar" class="MenuBarHorizontalHead" style="width:900px; margin:0; padding:0;">
          <li><a href="#" id="home">HOME</a></li>
          <li><a href="#" id="content">THE MICROBE</a></li>
          <li><a href="#" id="tutorials">TUTORIALS</a></li>
          <li><a href="#" id="exercises">EXERCISES</a></li>
          <li style="display:none"><a href="#" id="glossary">GLOSSARY</a></li>
          <li style="display:none"><a href="#" id="tools">TOOLS</a></li>
        </ul>
        <ul id="homeMenuBar" class="MenuBarHorizontal" style="width:900px; margin:0; padding:0; <? $curr_Menu="homeMenuBar";
		if (strpos($jSelectedHead,$curr_Menu) === FALSE)  print"display:none;"?>">
          <!--<li><a href="#">THE STUDENT PORTAL</a></li>
      <li><a href="#">ABOUT EcoCyc</a></li>
      <li><a href="#">INSTRUCTOR RESOURCES</a></li>-->
        </ul>
        <ul id="contentMenuBar" class="MenuBarHorizontal" style="width:900px; margin:0; <? $curr_Menu="contentMenuBar";
		if (strpos($jSelectedHead,$curr_Menu) === FALSE)  print"display:none;"?>">
          <li><a href="#">CELL PROCESSES</a></li>
        </ul>
        <ul id="tutorialsMenuBar" class="MenuBarHorizontal" style="width:900px; margin:0; <? $curr_Menu="tutorialsMenuBar";
		if (strpos($jSelectedHead,$curr_Menu) === FALSE)  print"display:none;"?>;">
          <li>
            <? selectedhid(10) ?>
            BLAST SEARCH</a></li>
          <li>
            <? selectedhid(11) ?>
            FERMENTATION TUTORIAL</a></li>
          <li>
            <? selectedhid(12) ?>
            NAVIGATION EcoCyc</a></li>
          <li>
            <? selectedhid(13) ?>
            NUTRIENT TRANSPORT</a></li>
        </ul>
        <ul id="exercisesMenuBar" class="MenuBarHorizontal" style="width:900px; margin:0; <? $curr_Menu="exercisesMenuBar";
		if (strpos($jSelectedHead,$curr_Menu) === FALSE)  print"display:none;"?>">
          <li>
            <? selectedhid_e('aerobic_respiration'); ?>
            AEROBIC RESPIRATION</a></li>
          <li>
            <? selectedhid_e('anaerobic_respiration'); ?>
            ANAEROBIC RESPIRATION</a></li>
          <li>
            <? selectedhid_e('blast'); ?>
            BLAST</a></li>
          <li>
            <? selectedhid_e('nutrient_transport'); ?>
            NUTRIENT TRANSPORT</a></li>
        </ul>
        <ul id="glossaryMenuBar" class="MenuBarHorizontal" style="width:900px; margin:0; <? $curr_Menu="glossaryMenuBar";
		if (strpos($jSelectedHead,$curr_Menu) === FALSE)  print"display:none;"?>">
          <li><a href="#">Coming soon</a></li>
        </ul>
        <ul id="toolsMenuBar" class="MenuBarHorizontal" style="width:900px; margin:0; <? $curr_Menu="toolsMenuBar";
		if (strpos($jSelectedHead,$curr_Menu) === FALSE)  print"display:none;"?>">
          <li><a href="#">Coming soon</a></li>
        </ul>
      </div>
      <!-- end .header --></div>
    <div class="sidebar1" style="clear:left">
      <ul class="nav" id="sample">
      </ul>
      <!--
    <ul class="nav" id="homeSide1">
      <li><a href="#">About us N/A</a></li>
      <li><a href="#">Starting to use it N/A</a></li>
      <li><a href="#">Credits N/A</a></li>
      <li><a href="#">Links N/A</a></li>
      <li><a href="#">Recent user apps N/A</a></li>
      <li><a href="#">Contact us N/A</a></li>
    </ul>
    <ul class="nav" id="homeSide2">
      <li><a href="#">What is it? N/A</a></li>
      <li><a href="#">How to use it? N/A</a></li>
      <li><a href="#">Typical users N/A</a></li>
      <li><a href="#">Applications N/A</a></li>
      <li><a href="#">Resources N/A</a></li>
      <li><a href="#">Statistics N/A</a></li>
    </ul>
    <ul class="nav" id="homeSide3">
      <li><a href="#">What we offer N/A</a></li>
      <li><a href="#">Resources N/A</a></li>
      <li><a href="#">Sample exercises N/A</a></li>
      <li><a href="#">Student exercises N/A</a></li>
      <li><a href="#">Forum N/A</a></li>
      <li><a href="#">User applications N/A</a></li>
      <li><a href="#">User suggestions N/A</a></li>
    </ul>-->
      
      <ul class="nav" id="contentSide1">
        <div id="submenu-img"> </div>
        <li>
          <? msidelink('aerobic_respiration') ?>
        </li>
        <li>
          <? msidelink('anaerobic_respiration') ?>
        </li>
        <li>
          <? msidelink('fermentation') ?>
        </li>
        <li>
          <? msidelink('nutrient_transport') ?>
        </li>
      </ul>
      <ul class="nav" id="tutorialsSide1" style="border-top: 0px;">
        <!--      <li><a href="#">Gene product page</a></li>
      <li><a href="#">Reaction pages</a></li>
      <li><a href="#">Pathway pages</a></li>
      <li><a href="#">Compund pages</a></li>
      <li><a href="#">Transporter pages</a></li>
-->
      </ul>
      <ul class="nav" id="tutorialsSide2" style="border-top: 0px;">
        <!--      <li><a href="#">N/A</a></li>
-->
      </ul>
      <ul class="nav" id="tutorialsSide3" style="border-top: 0px;">
        <!--      <li><a href="#">N/A</a></li>
-->
      </ul>
      <ul class="nav" id="tutorialsSide4" style="border-top: 0px;">
        <!--      <li><a href="#">N/A</a></li>
-->
      </ul>
      <ul class="nav" id="exercisesSide1">
        <div id="submenu-img"> </div>
        <?
      //mlinkdir('aerobic_respiration',1);
	  mlinkseries('aerobic_respiration',1,6);
	  mlinkseries('aerobic_respiration_advanced',1,1) ?>
      </ul>
      <ul class="nav" id="exercisesSide2">
        <div id="submenu-img"> </div>
        <?
	  mlinkseries('anaerobic_respiration',1,3);
	  mlinkseries('anaerobic_respiration_advanced',1,1) ?>
      </ul>
      <ul class="nav" id="exercisesSide3">
        <div id="submenu-img"> </div>
        <?
	  mlinkseries('blast',1,12);
	  mlinkseries('blast_advanced',1,2) ?>
      </ul>
      <ul class="nav" id="exercisesSide4">
        <div id="submenu-img"> </div>
        <?
	  mlinkseries('nutrient_transport',1,12);
	  mlinkseries('nutrient_transport_advanced',1,3) ?>
      </ul>
      <ul class="nav" id="glossarySide1">
        <li><a href="#">N/A</a></li>
      </ul>
      <ul class="nav" id="glossarySide2">
        <li><a href="#">N/A</a></li>
      </ul>
      <ul class="nav" id="glossarySide3">
        <li><a href="#">N/A</a></li>
      </ul>
      <ul class="nav" id="toolsSide1">
        <li><a href="#">N/A</a></li>
      </ul>
      <ul class="nav" id="toolsSide2">
        <li><a href="#">N/A</a></li>
      </ul>
      <ul class="nav" id="toolsSide3">
        <li><a href="#">N/A</a></li>
      </ul>
      
      <!--    <ul class="nav" id="">
      <li><a href="#"></a></li>
    </ul>
    <ul class="nav" id="">
      <li><a href="#"></a></li>
    </ul>
    <ul class="nav" id="">
      <li><a href="#"></a></li>
    </ul>-->
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <div style="width:30px; height:300px;"><!--spacer--></div>
      <img src="images/quicklinks.gif" width="215" height="30" alt="">
      <div style="text-align:right"> <a href="http://www.ecocyc.org"><img src="images/ecocycicon.gif" width="157" height="48" alt=""></a> <a href="http://www.biocyc.org"><img src="images/biocycicon.gif" width="157" height="48" alt=""></a> <a href="http://www.metacyc.org"><img src="images/metacyc.gif" width="157" height="48" alt=""></a> </div>
    </div>
    <div class="content">
      <div id="cse"></div>
      <?
if (isset($_GET['widecontent'])) print '    <div class="contentClassWide">';
else print '    <div class="contentClass">';
?>
      <?
if (isset($_GET['page'])) {
	$site = 'sites/'.$page_array[$_GET['page']][0].'.html';
	if (file_exists($site)) {
		include($site);
	} else {
		print "<p>Coming soon</p>";
	}
} else if (isset($_GET['psid']) && isset($_GET['pid'])) {
	$site = 'sites/'.$ps_array[$_GET['psid']][0].$_GET['pid'].'.html';
	if (file_exists($site)) {
		include($site);
	} else {
		print "<p>Coming soon</p>";
	}
} else {
	include('sites/home.html');
}

// TEMP
print "<!--";
//print_r($page_array);
print "-->";
// TEMP

?>
      <!-- end .contentClass --></div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div style="width:30px; height:30px;"><!--spacer--></div>
    
    <!-- end .content --></div>
  <div class="footer">
    <p>&nbsp;</p>
<img src="images/footer_title.jpg" title="DEPARTMENT OF MICROBIOLOGY, IMMUNOLOGY AND MOLECULAR GENETICS
609 Charles E. Young Dr. East, 1602 Molecular Science Building, Los Angeles, CA  90095-1489
©Robert P. Gunsalus 2011" alt="DEPARTMENT OF MICROBIOLOGY, IMMUNOLOGY AND MOLECULAR GENETICS
609 Charles E. Young Dr. East, 1602 Molecular Science Building, Los Angeles, CA  90095-1489
©Robert P. Gunsalus 2011">
    <p>&nbsp;</p>
    <p><!-- end .footer --></p>
  </div>
  <!-- end .innerContainer --></div>
<!-- end .container -->
</div>
<script type="text/javascript">


<?

print $jtoprint;

?>

var lorum = '<p>&nbsp;</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer adipiscing facilisis velit a imperdiet. Cras feugiat, augue posuere hendrerit eleifend, ipsum nisi egestas augue, vitae sodales purus lectus ac ipsum. Donec ultricies adipiscing turpis, a sagittis nunc laoreet sagittis. Duis blandit tincidunt nisi, sit amet sollicitudin lectus ullamcorper sit amet. Morbi tincidunt viverra dapibus. Mauris consectetur, lacus ut malesuada laoreet, velit metus iaculis justo, in venenatis mi dolor et lectus. Phasellus enim dui, tincidunt vel viverra vitae, lacinia non nisl. Sed eget eros eu sem luctus rutrum. Fusce ut dapibus nisi. Sed ac risus quis nisl cursus rhoncus eget at magna. Quisque blandit dui et sem tempor quis suscipit nisi mattis. Morbi rhoncus rutrum convallis. Ut fringilla risus nec lacus imperdiet ut feugiat leo molestie.</p><p>Morbi purus ante, varius ac tristique vel, tincidunt et nisi. Donec ut metus diam. Nam bibendum suscipit rutrum. Pellentesque a lobortis elit. Aenean ultricies vehicula leo, eget suscipit erat dictum et. Integer sodales sem vel arcu ullamcorper adipiscing. Proin vulputate viverra nibh, consequat dignissim ligula dapibus ac. Cras eu lectus nibh, sit amet pellentesque lacus. Ut lacus nibh, placerat quis condimentum at, fringilla eu ligula. Integer et lectus sed tellus lacinia ultricies vel eu odio. Cras ac aliquam erat. Praesent in neque urna.</p><p>Cras placerat fringilla elit, et feugiat nunc molestie vel. Phasellus turpis tellus, egestas at eleifend sit amet, lobortis a purus. Aliquam ac urna arcu. Praesent sit amet sapien neque. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam fringilla nisi non odio feugiat eleifend. Quisque rhoncus feugiat urna, sit amet porta lectus ultrices non. Aenean sit amet libero ut enim euismod tristique. In hac habitasse platea dictumst. Maecenas nec metus eu diam imperdiet pellentesque ac eget massa. Phasellus at nunc vitae nulla ullamcorper adipiscing quis nec urna. Vivamus ac aliquam dui. Duis porttitor, dolor non dignissim laoreet, odio nisl porta urna, quis semper mauris nisl at dolor.</p>';
var homebody = '<p>&nbsp;</p><p><em>Escherichia  coli</em> K-12 strain  MG1655 has a fully sequenced genome. The genomic blueprint reveals insight into  all metabolic and catabolic aspects of this leading model organism. It also  provides a paradigm to understand other bacteria.</p><p>The <em>E. coli</em> Student Portal is learning and  teaching site, which leads students in understanding the metabolic capabilities  of <em>E. coli</em> by exploring the EcoCyc  database.</p><p>The <em>E. coli</em> Student Portal provides:</p><ul style="list-style-type: disc;">  <li>student-oriented, educational materials for learning       microbiology concepts <u></u></li>  <li>tutorials to understand and use EcoCyc <u></u></li>  <li>exercises to test understanding microbiology       concepts</li></ul><p><strong>What is <em>EcoCyc</em>?</strong> <em>EcoCyc</em> is a scientific  database for the bacterium <em>Escherichia coli</em> K-12 strain MG1655. It  contains information regarding the genome, all genes, proteins, metabolites,  metabolic pathways, and transcriptional regulators. </p><p>Enjoy the  Student Portal at you own pace or launch into <a href="http://ecocyc.org/">EcoCyc</a> directly.</p><p>&nbsp;</p><p><strong>Credits: </strong></p><p>Authored by  Robert Gunsalus and Imke Schröder<br />  &copy;The  Escherichia coli Student Portal</p><p>This  project acknowledges support from:<br />  NIH Grant Award GM077678 to SRI,  International<br />  Peter Karp and coworkers at EcoCyc.org<br />  The UCLA Department of MIMG</p>';

$("a#home").click(function(){
	SelectedSide.fadeOut(100);
	$("div.contentClass").html('<h2>Welcome to the <em>E. coli</em> Student Portal</h2>' + homebody);
	SelectedHead.fadeOut(100, function(){
		SelectedHead = $("#homeMenuBar");
		SelectedHead.fadeIn(350)}
	);
	SelectedHeadLabel.removeClass("bgshift");
	SelectedHeadLabel = $(this);
	SelectedHeadLabel.addClass("bgshift");
	if (SelectedSecondHead) SelectedSecondHead.removeClass("headbgshift");
});
$("a#content").click(function(){
	SelectedSide.fadeOut(100);
	$("div.contentClass").html('<h2>The Microbe</h2>' + lorum);
	SelectedHead.fadeOut(100, function(){
		SelectedHead = $("#contentMenuBar");
		SelectedHead.fadeIn(350)}
	);
	SelectedHeadLabel.removeClass("bgshift");
	SelectedHeadLabel = $(this);
	SelectedHeadLabel.addClass("bgshift");
	if (SelectedSecondHead) SelectedSecondHead.removeClass("headbgshift");
	
	// TEMPORARY UNTIL WE'LL HAVE MORE THAN ONE CONTENT LINK 
	$("ul#contentMenuBar a:eq(0)").click();
});
$("a#tutorials").click(function(){
	SelectedSide.fadeOut(100);
	$("div.contentClass").html('<h2>Tutorials</h2>' + lorum);
	SelectedHead.fadeOut(100, function(){
		SelectedHead = $("#tutorialsMenuBar");
		SelectedHead.fadeIn(350)}
	);
	SelectedHeadLabel.removeClass("bgshift");
	SelectedHeadLabel = $(this);
	SelectedHeadLabel.addClass("bgshift");
	if (SelectedSecondHead) SelectedSecondHead.removeClass("headbgshift");
});
$("a#exercises").click(function(){
	SelectedSide.fadeOut(100);
	$("div.contentClass").html('<h2>Loading</h2><img src="images/ajax-loader.gif">').load('sites/exercises/exercises_cover.html');
	if (SelectedHead.attr("id") != $("#exercisesMenuBar").attr("id")) {
		SelectedHead.fadeOut(100, function(){
			SelectedHead = $("#exercisesMenuBar");
			SelectedHead.fadeIn(350)}
		);
	}
	SelectedHeadLabel.removeClass("bgshift");
	SelectedHeadLabel = $(this);
	SelectedHeadLabel.addClass("bgshift");
	if (SelectedSecondHead) SelectedSecondHead.removeClass("headbgshift");
});
$("a#glossary").click(function(){
	SelectedSide.fadeOut(100);
	$("div.contentClass").html('<h2>Glossary</h2>' + lorum);
	SelectedHead.fadeOut(100, function(){
		SelectedHead = $("#glossaryMenuBar");
		SelectedHead.fadeIn(350)}
	);
	SelectedHeadLabel.removeClass("bgshift");
	SelectedHeadLabel = $(this);
	SelectedHeadLabel.addClass("bgshift");
	if (SelectedSecondHead) SelectedSecondHead.removeClass("headbgshift");
});
$("a#tools").click(function(){
	SelectedSide.fadeOut(100);
	$("div.contentClass").html('<h2>Tools</h2>' + lorum);
	SelectedHead.fadeOut(100, function(){
		SelectedHead = $("#toolsMenuBar");
		SelectedHead.fadeIn(350)}
	);
	SelectedHeadLabel.removeClass("bgshift");
	SelectedHeadLabel = $(this);
	SelectedHeadLabel.addClass("bgshift");
	if (SelectedSecondHead) SelectedSecondHead.removeClass("headbgshift");
});


//SideMenus
var stringItem = "";
var NewSideMenu = $("#homeSide1");
//homeSides
$("ul#homeMenuBar a").click(function(){
	stringItem = "#homeSide" + ($("ul#homeMenuBar a").index(this) + 1);
	NewSideMenu = $(stringItem);
	SelectedSide.fadeOut(100, function(){NewSideMenu.fadeIn(350)});
	SelectedSide = NewSideMenu;
	if (SelectedSecondHead) SelectedSecondHead.removeClass("headbgshift");
	$(this).addClass("headbgshift");
	SelectedSecondHead = $(this);
});
//contentSides
$("ul#contentMenuBar a").click(function(){
	stringItem = "#contentSide" + ($("ul#contentMenuBar a").index(this) + 1);
	NewSideMenu = $(stringItem);
	SelectedSide.fadeOut(100, function(){NewSideMenu.fadeIn(350)});
	SelectedSide = NewSideMenu;
	if (SelectedSecondHead) SelectedSecondHead.removeClass("headbgshift");
	$(this).addClass("headbgshift");
	SelectedSecondHead = $(this);
});
//tutorialsSides
$("ul#tutorialsMenuBar a").click(function(){
	stringItem = "#tutorialsSide" + ($("ul#tutorialsMenuBar a").index(this) + 1);
	NewSideMenu = $(stringItem);
//	SelectedSide.fadeOut(100, function(){NewSideMenu.fadeIn(350)});
	SelectedSide = NewSideMenu;
});
//exercisesSides
$("ul#exercisesMenuBar a").click(function(){
	stringItem = "#exercisesSide" + ($("ul#exercisesMenuBar a").index(this) + 1);
	NewSideMenu = $(stringItem);
	SelectedSide.fadeOut(100, function(){NewSideMenu.fadeIn(350)});
	SelectedSide = NewSideMenu;
	if (SelectedSecondHead) SelectedSecondHead.removeClass("headbgshift");
	$(this).addClass("headbgshift");
	SelectedSecondHead = $(this);
	$("div.contentClass").html('<h3 style="padding-top:23px; text-align:center">&lt;-- Choose from the list to see an example exercise for ' + $(this).text() + '</h3>')
});
//glossarySides
$("ul#glossaryMenuBar a").click(function(){
	stringItem = "#glossarySide" + ($("ul#glossaryMenuBar a").index(this) + 1);
	NewSideMenu = $(stringItem);
	SelectedSide.fadeOut(100, function(){NewSideMenu.fadeIn(350)});
	SelectedSide = NewSideMenu;
	if (SelectedSecondHead) SelectedSecondHead.removeClass("headbgshift");
	$(this).addClass("headbgshift");
	SelectedSecondHead = $(this);
});
//toolsSides
$("ul#toolsMenuBar a").click(function(){
	stringItem = "#toolsSide" + ($("ul#toolsMenuBar a").index(this) + 1);
	NewSideMenu = $(stringItem);
	SelectedSide.fadeOut(100, function(){NewSideMenu.fadeIn(350)});
	SelectedSide = NewSideMenu;
	if (SelectedSecondHead) SelectedSecondHead.removeClass("headbgshift");
	$(this).addClass("headbgshift");
	SelectedSecondHead = $(this);
});



//HeadMenus
var MenuBar1 = new Spry.Widget.MenuBar("headMenuBar", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
var MenuBar2 = new Spry.Widget.MenuBar("homeMenuBar", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
var MenuBar3 = new Spry.Widget.MenuBar("contentMenuBar", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
var MenuBar4 = new Spry.Widget.MenuBar("tutorialsMenuBar", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
var MenuBar5 = new Spry.Widget.MenuBar("exercisesMenuBar", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
var MenuBar6 = new Spry.Widget.MenuBar("glossaryMenuBar", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
var MenuBar7 = new Spry.Widget.MenuBar("toolsMenuBar", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});


//onload execution

$(window).load(function() {
	SelectedHead.show(); // PHP already does this
	SelectedHeadLabel.addClass("bgshift");
	SelectedSide.show();
	if (SelectedSecondHead) {
		if (!SelectedSecondHead.hasClass("headbgshift")) SelectedSecondHead.addClass("headbgshift");
	}
});

//MMpreload 
MM_preloadImages('images/sidemenuhover.jpg','images/submenu-items.jpg');

</script>
</body>
</html>
