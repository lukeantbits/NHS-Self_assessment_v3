<?php
//require_once("../includes/session.php");
$root = "";
$page = "index.php";
//require_once("../NHS-Self_assessments_CMS/includes/dbconnect.php");
if(isset($_REQUEST['asid'])){
	$tmp = explode("|",$_REQUEST['asid']);
	$asname = $tmp[0];
	$asid = $tmp[1];
}else{
	$asname = 'vte_assessment';
	$asid = '42';
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>

<title>Self-assessment</title>

<meta name="description" content="Questionnaire designed to check your mood with questions on depression, anxiety and panic."/>
<meta name="keywords" content="National Health Service (NHS),mood,moodzone,mood self-assessment,check your mood,anxiety,dperession,panic,PHQ-9,GAD-7"/>
<meta name="DC.title" content="Mood self-assessment"/>
<meta name="DC.description" content="Questionnaire designed to check your mood with questions on depression, anxiety and panic."/>
<meta name="DC.subject" scheme="eGMS.IPSV" content="National Health Service (NHS),mood,moodzone,mood self-assessment,check your mood,anxiety,dperession,panic,PHQ-9,GAD-7"/> 
<meta name="DC.Subject" scheme="NHSC.Ontology" content="Anxiety-related conditions, Depression, Panic disorder and panic attacks, Stress"/>
<meta name="DC.Subject" scheme="NHSC.Ontology" content="ID519 ID521 ID526 ID529"/>
<meta name="DC.date.issued" scheme="W3CDTF" content="2012-31-08"/>
<meta name="DC.coverage" content="England"/>
<meta name="DC.creator" content="NHS Choices"/>
<meta name="DC.format" scheme="IMT" content="text/html"/>
<meta name="DC.language" scheme="ISO 639-2/T" content="eng"/>
<meta name="DC.identifier" scheme="URI" content="http://www.nhs.uk"/>
<meta name="DC.publisher" content="Department of Health"/>
<meta name="DC.rights" content="http://www.nhs.uk/termsandconditions/Pages/TermsConditions.aspx"/>
<meta name="eGMS.accessibility" scheme="eGMS.WCAG10" content="Double-A"/>
<meta name="WT.ti" content="Mood self-assessment"/>
<meta http-equiv="pics-Label" content='(pics-1.1 "http://www.icra.org/pics/vocabularyv03/" l gen true for "http://www.nhs.uk" r (n 2 s 1 v 0 l 0 oa 0 ob 0 oc 0 od 0 oe 0 of 0 og 0 oh 0 c 1) gen true for "http://www.nhs.uk" r (n 2 s 1 v 0 l 0 oa 0 ob 0 oc 0 od 0 oe 0 of 0 og 0 oh 0 c 1))'/>

		<meta http-equiv="X-UA-Compatible" content="IE=8"/>
    
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<link rel="meta" href="http://www.nhs.uk/includes/labels.rdf" type="application/rdf+xml" title="ICRA labels"/><!-- ICRA Labels link -->
<link rel="shortcut icon" href="http://www.nhs.uk/img/favicon.ico" type="image/vnd.microsoft.icon"/>
<script type="text/javascript" src="http://www.nhs.uk/includes/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="http://www.nhs.uk/includes/jquery.bgiframe.min.js"></script>
<script type="text/javascript" src="http://www.nhs.uk/includes/jquery.cookie.js"></script>
<script type="text/javascript" src="http://www.nhs.uk/includes/jquery-ui-1.8.22.custom.min.js"></script>
<script type="text/javascript" src="http://www.nhs.uk/includes/swfobject.js"></script>
<script type="text/javascript" src="http://www.nhs.uk/includes/AC_RunActiveContent.js"></script>
<script type="text/javascript" src="http://www.nhs.uk//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script type="text/javascript" src="http://www.nhs.uk/includes/translate.js"></script>


<?php
if(isset($_REQUEST['asid'])){
	$tmp = explode("|",$_REQUEST['asid']);
	$asname = $tmp[0];
	$asid = $tmp[1];
}else{
	$asname = 'test_quiz';
	$asid = '42';
}

?>

<link  rel="stylesheet" type="text/css" href="http://www.nhs.uk/css/base.css" media=""/>
<link  rel="stylesheet" type="text/css" href="http://www.nhs.uk/css/print.css" media="print"/>
<!--[if !IE]>-->
<style type ="text/css">
@import url('http://www.nhs.uk/css/reset.css') screen;
@import url('http://www.nhs.uk/css/screen.css') screen;
@import url('http://www.nhs.uk/css/tools.css')screen;
</style>
<!--<![endif]-->
<!--[if IE 6]>
<link  rel="stylesheet" type="text/css" href="http://www.nhs.uk/css/reset-ie6.css" media="screen"/>
<link  rel="stylesheet" type="text/css" href="http://www.nhs.uk/css/screen.css" media="screen"/>
<link  rel="stylesheet" type="text/css" href="http://www.nhs.uk/css/tools.css" media="screen"/>
<link  rel="stylesheet" type="text/css" href="http://www.nhs.uk/css/if-ie6.css" media="screen"/>
<![endif]-->
<!--[if IE 7]>
<link  rel="stylesheet" type="text/css" href="http://www.nhs.uk/css/reset-ie7.css" media="screen"/>
<link  rel="stylesheet" type="text/css" href="http://www.nhs.uk/css/screen.css" media="screen"/>
<link  rel="stylesheet" type="text/css" href="http://www.nhs.uk/css/tools.css" media="screen"/>
<link  rel="stylesheet" type="text/css" href="http://www.nhs.uk/css/if-ie7.css" media="screen"/>
<![endif]-->
<!--[if IE 8]>
<link  rel="stylesheet" type="text/css" href="http://www.nhs.uk/css/reset-ie8.css" media="screen"/>
<link  rel="stylesheet" type="text/css" href="http://www.nhs.uk/css/screen.css" media="screen"/>
<link  rel="stylesheet" type="text/css" href="http://www.nhs.uk/css/tools.css" media="screen"/>
<link  rel="stylesheet" type="text/css" href="http://www.nhs.uk/css/if-ie8.css" media="screen"/>
<![endif]-->




<script type="text/javascript">
//<![CDATA[
function NhsUk_OnSubmit()
{
    var q=document.getElementById("q").value;
    return q!="" && q!="Place, postcode or organisation";
}
//]]>
</script>


    <script type="text/javascript" src="http://www.nhs.uk/includes/choices.js"></script>
    
<meta name="DCSext.RealUrl" content="http://www.nhs.uk/tools/Pages/Mood-self-assessment.aspx"></meta>
<meta name="WT.cg_n" content="Tools"></meta>
<meta name="WT.cg_s" content="Mood self-assessment"></meta>
<meta name="DCSext.Server" content="NHC10WEB15PRP"></meta>
<meta name="WT.sv" content="NHC10WEB15PRP"></meta>
<!-- Webtrends Javascript tag -->
<script type="text/javascript" src="http://www.nhs.uk/includes/sdc.js"></script>
<script type="text/javascript" src="http://www.nhs.uk/includes/jquery.webtrendslinkstracking.js"></script>
<script type="text/javascript">try{var _tag=new WebTrends();_tag.dcsGetId();}catch(e){}</script>
<script type="text/javascript">try{_tag.dcsCollect();}catch(e){}</script>



<script type="text/javascript"   src="http://www.nhs.uk/_layouts/1033/init.js?rev=w7H9f6YxfzEXRgXKUMfiTg%3D%3D"></script>
<script type="text/javascript"   src="http://www.nhs.uk/_layouts/1033/msstring.js?rev=fcpiBo%2BQtJqYMECz%2BNiH7Q%3D%3D"></script>
<script type="text/javascript"   src="http://www.nhs.uk/_layouts/1033/non_ie.js?rev=yfNry4hY0Gwa%2FPDNGrqXVg%3D%3D"></script>




</head>
<body>



<div class="wrap">

    


    <!-- Header starts here.... -->
    
<!--googleoff: all-->
<ul>
    <li class="skip-link"><a href="#mainContent" accesskey="S"><span>Skip to main content</span></a></li>
    <li class="skip-link"><a href="#main-navigation" accesskey="N"><span>Skip to main navigation</span></a></li>
    <li class="skip-link"><a href="http://www.nhs.uk/accessibility/Pages/Accessibility.aspx"><span>Help with accessibility</span></a></li>
</ul>


<ul class="info-nav">	
    
            <li class="first">
                <a href="http://www.nhs.uk/Pages/HomePage.aspx" accesskey="1" onclick="dcsMultiTrack('DCSext.HeaderClickUrl','http://www.nhs.uk/Pages/HomePage.aspx','WT.dl','121')">Home</a>
            </li>
        
            <li>
                <a href="http://www.nhs.uk/aboutNHSChoices/Pages/AboutNHSChoices.aspx" onclick="dcsMultiTrack('DCSext.HeaderClickUrl','http://www.nhs.uk/aboutNHSChoices/Pages/AboutNHSChoices.aspx','WT.dl','121')">About</a>
            </li>
        
            <li>
                <a href="http://www.nhs.uk/aboutNHSChoices/Pages/ContactUs.aspx" accesskey="9" onclick="dcsMultiTrack('DCSext.HeaderClickUrl','http://www.nhs.uk/aboutNHSChoices/Pages/ContactUs.aspx','WT.dl','121')">Contact</a>
            </li>
        
            <li>
                <a href="http://www.nhs.uk/tools/pages/toolslibrary.aspx" onclick="dcsMultiTrack('DCSext.HeaderClickUrl','http://www.nhs.uk/tools/pages/toolslibrary.aspx','WT.dl','121')">Tools</a>
            </li>
        
            <li>
                <a href="http://www.nhs.uk/video/pages/MediaLibrary.aspx" onclick="dcsMultiTrack('DCSext.HeaderClickUrl','http://www.nhs.uk/video/pages/MediaLibrary.aspx','WT.dl','121')">Video</a>
            </li>
        
            <li>
                <a href="http://www.chooseandbook.nhs.uk/" onclick="dcsMultiTrack('DCSext.HeaderClickUrl','http://www.chooseandbook.nhs.uk/','WT.dl','121')">Choose and Book</a>
            </li>
        
            <li>
                <a href="http://www.healthunlocked.com/nhschoices/" onclick="dcsMultiTrack('DCSext.HeaderClickUrl','http://www.healthunlocked.com/nhschoices/','WT.dl','121')">Communities</a>
            </li>
        
            <li class="last">
                <a href="http://www.nhs.uk/ipg/Pages/IPStart.aspx" onclick="dcsMultiTrack('DCSext.HeaderClickUrl','http://www.nhs.uk/ipg/Pages/IPStart.aspx','WT.dl','121')">IPS</a>
            </li>
        	    
</ul>


        <div class="tab-login anonymous-login"> 
        <ul class="translate"> 
            <li class="translate-item"><a href="http://www.nhs.uk/pages/languagehub.aspx" class="translate-text">Translate</a></li>
        </ul>
    <ul class="personal-header clear">
        <li class="logged-out"><span class="crnr tl"></span><a onclick="dcsMultiTrack('DCSext.HeaderClickUrl','http://www.nhs.uk/Personalisation/Login.aspx','WT.dl','121')" href="http://www.nhs.uk/Personalisation/Login.aspx">Log in</a>&nbsp;or</li>
        <li class="create-account"><a href="http://www.nhs.uk/Personalisation/Registration.aspx?ReturnUrl=http%3a%2f%2fwww.nhs.uk%2fTools%2fPages%2fMood-self-assessment.aspx" id="ctl00_Header_ucPersonalisationHeader_CreateAccount" onclick="dcsMultiTrack('DCSext.HeaderClickUrl',this.text,'WT.dl','121')">create an account</a><span class="crnr tr"></span></li>
    </ul>
  </div>
    




<div class="header">
  <span class="crnr tl"></span>
  <div class="heading">
    
      <p class="choices-logo"><a href="http://www.nhs.uk/" title="Go to NHS Choices homepage"><img src="http://www.nhs.uk/img/header/choices-logo.gif" alt="Go to NHS Choices homepage" width="212" height="35"/></a><span>Your health, your choices</span></p>
     
  </div>
  
  <p class="hidden"><strong>Information navigation</strong></p>
  <div class="searchbar">
    <form id="gs" method="get" action="http://www.nhs.uk/Search/Pages/Results.aspx" onsubmit="return NhsUk_OnSubmit();">
      <fieldset>
        <legend class="hidden">Search entire site</legend>	
          <div class="search-inner" id="IdSearchBoxContainer">
              <div><span class="crnr tl"></span><span class="crnr tr"></span></div>
              <div id="search-results-container">
                  <label for="q"><span class="hidden">Enter a search term: </span><input id="q" name="q" type="text" value="Enter a search term" accesskey="4" maxlength="500"/></label>
              </div>
              <div class="submit-container">
                  <div><span class="crnr tl"></span><span class="crnr tr"></span></div>
                  <div class="submit">
                      <div><span class="crnr tl"></span><span class="crnr tr"></span></div>
                      <input type="submit" value="Search"/>
                      <div><span class="crnr bl"></span><span class="crnr br"></span></div>
                  </div>
                  <div><span class="crnr bl"></span><span class="crnr br"></span></div>
              </div>
              <span class="crnr bl"></span><span class="crnr br"></span>
          </div>
      </fieldset>
    </form>
    <script type="text/javascript" src="http://www.nhs.uk/includes/PredictiveTextSearch.js"></script>
    <script type="text/javascript">
    //<![CDATA[
    //<!--
    $(document).ready(function() {
    $.ajaxSetup({cache: false});
    SetupPredictiveSearch("http://www.nhs.uk/NHSChoices/Handlers/Search.ashx", $("#q"), $("#search-results-container"),10)});
    // -->
    //]]>
    </script> 
  </div>

  <div class="main-nav clear" id="main-navigation">
    <p class="hidden"><strong>Main navigation</strong></p>    
    <div id="ctl00_Header_mainNavigation">
	<ul><li class="health-az" id="health-az-topnav"><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Conditions/Pages/hub.aspx','WT.dl','121')" href="http://www.nhs.uk/Conditions/Pages/hub.aspx"> Health A-Z</a><div><ul><li class="first"><span>Hundreds of conditions explained</span></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Conditions/Arthritis','WT.dl','121')" href="http://www.nhs.uk/Conditions/Arthritis">Arthritis<span class="hidden"> information</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/conditions/asthma','WT.dl','121')" href="http://www.nhs.uk/conditions/asthma">Asthma<span class="hidden"> information</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Conditions/Back-pain','WT.dl','121')" href="http://www.nhs.uk/Conditions/Back-pain">Back pain<span class="hidden"> information</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Conditions/stress-anxiety-depression/Pages/low-mood-stress-anxiety.aspx','WT.dl','121')" href="http://www.nhs.uk/Conditions/stress-anxiety-depression/Pages/low-mood-stress-anxiety.aspx">Stress&#44; anxiety&#44; depression<span class="hidden"> information</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Conditions/Cancer-of-the-breast-female','WT.dl','121')" href="http://www.nhs.uk/Conditions/Cancer-of-the-breast-female">Breast cancer<span class="hidden"> information</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Conditions/pregnancy-and-baby/Pages/Babies-parents-videos.aspx','WT.dl','121')" href="http://www.nhs.uk/Conditions/pregnancy-and-baby/Pages/Babies-parents-videos.aspx">Pregnancy and baby<span class="hidden"> information</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Conditions/Diabetes-type2','WT.dl','121')" href="http://www.nhs.uk/Conditions/Diabetes-type2">Diabetes<span class="hidden"> information</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Conditions/eczema-(atopic)','WT.dl','121')" href="http://www.nhs.uk/Conditions/eczema-(atopic)">Eczema<span class="hidden"> information</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Conditions/Coronary-heart-disease','WT.dl','121')" href="http://www.nhs.uk/Conditions/Coronary-heart-disease">Heart disease<span class="hidden"> information</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/conditions/measles','WT.dl','121')" href="http://www.nhs.uk/conditions/measles">Measles<span class="hidden"> information</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/conditions/flu/Pages/Introduction.aspx','WT.dl','121')" href="http://www.nhs.uk/conditions/flu/Pages/Introduction.aspx">Flu<span class="hidden"> information</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/conditions/whooping-cough/pages/introduction.aspx','WT.dl','121')" href="http://www.nhs.uk/conditions/whooping-cough/pages/introduction.aspx">Whooping cough<span class="hidden"> information</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/conditions/online-clinics/Pages/Online-clinics-introduction.aspx','WT.dl','121')" href="http://www.nhs.uk/conditions/online-clinics/Pages/Online-clinics-introduction.aspx">Online clinics<span class="hidden"> information</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/CHQ/Pages/home.aspx','WT.dl','121')" href="http://www.nhs.uk/CHQ/Pages/home.aspx"> Common health questions</a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/nhsdirect/pages/symptoms.aspx','WT.dl','121')" href="http://www.nhs.uk/nhsdirect/pages/symptoms.aspx"> Symptom checkers</a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/medicine-guides/pages/default.aspx','WT.dl','121')" href="http://www.nhs.uk/medicine-guides/pages/default.aspx"> Medicines A-Z</a></li><li class="last bold"><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Conditions/Pages/BodyMap.aspx?Index=A','WT.dl','121')" href="http://www.nhs.uk/Conditions/Pages/BodyMap.aspx?Index=A"> All A-Z topics</a></li></ul></div></li><li class="livewell" id="livewell-topnav"><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/livewell/Pages/Livewellhub.aspx','WT.dl','121')" href="http://www.nhs.uk/livewell/Pages/Livewellhub.aspx"> Live Well</a><div><ul><li class="first"><span>Over 100 topics on healthy living</span></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Livewell/alcohol','WT.dl','121')" href="http://www.nhs.uk/Livewell/alcohol">Alcohol<span class="hidden"> articles</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/LiveWell/c25k/Pages/couch-to-5k.aspx','WT.dl','121')" href="http://www.nhs.uk/LiveWell/c25k/Pages/couch-to-5k.aspx">Couch to 5K<span class="hidden"> articles</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/livewell/fitness','WT.dl','121')" href="http://www.nhs.uk/livewell/fitness">Fitness<span class="hidden"> articles</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/livewell/winterhealth/pages/fluandthefluvaccine.aspx','WT.dl','121')" href="http://www.nhs.uk/livewell/winterhealth/pages/fluandthefluvaccine.aspx">The flu jab<span class="hidden"> articles</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/livewell/healthy-eating','WT.dl','121')" href="http://www.nhs.uk/livewell/healthy-eating">Healthy eating<span class="hidden"> articles</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/livewell/loseweight','WT.dl','121')" href="http://www.nhs.uk/livewell/loseweight">Lose weight<span class="hidden"> articles</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/livewell/mentalhealth','WT.dl','121')" href="http://www.nhs.uk/livewell/mentalhealth">Mental health<span class="hidden"> articles</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/livewell/sexualhealth','WT.dl','121')" href="http://www.nhs.uk/livewell/sexualhealth">Sexual health<span class="hidden"> articles</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/livewell/smoking','WT.dl','121')" href="http://www.nhs.uk/livewell/smoking">Stop smoking<span class="hidden"> articles</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/livewell/winterhealth','WT.dl','121')" href="http://www.nhs.uk/livewell/winterhealth">Winter health<span class="hidden"> articles</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/livewell/tiredness-and-fatigue','WT.dl','121')" href="http://www.nhs.uk/livewell/tiredness-and-fatigue">Tiredness<span class="hidden"> articles</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Planners/vaccinations/Pages/Landing.aspx','WT.dl','121')" href="http://www.nhs.uk/Planners/vaccinations/Pages/Landing.aspx">Vaccinations<span class="hidden"> articles</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/tools/pages/toolslibrary.aspx','WT.dl','121')" href="http://www.nhs.uk/tools/pages/toolslibrary.aspx"> Health check tools</a></li><li class="last bold"><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/livewell/pages/topics.aspx','WT.dl','121')" href="http://www.nhs.uk/livewell/pages/topics.aspx"> All Live Well topics</a></li></ul></div></li><li class="carers" id="carers-topnav"><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/carersdirect','WT.dl','121')" href="http://www.nhs.uk/carersdirect"> Carers Direct</a><div><ul><li class="first"><span>Help for those looking after others </span></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/CarersDirect/guide','WT.dl','121')" href="http://www.nhs.uk/CarersDirect/guide"> Guide to caring</a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/CarersDirect/moneyandlegal','WT.dl','121')" href="http://www.nhs.uk/CarersDirect/moneyandlegal"> Money and legal</a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/CarersDirect/workandlearning','WT.dl','121')" href="http://www.nhs.uk/CarersDirect/workandlearning"> Work and learning</a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/CarersDirect/yourself','WT.dl','121')" href="http://www.nhs.uk/CarersDirect/yourself"> Your own wellbeing</a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/CarersDirect/moneyandlegal/carersbenefits/Pages/Overview.aspx','WT.dl','121')" href="http://www.nhs.uk/CarersDirect/moneyandlegal/carersbenefits/Pages/Overview.aspx"> Carers' benefits</a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/CarersDirect/guide/assessments/Pages/Carersassessments.aspx','WT.dl','121')" href="http://www.nhs.uk/CarersDirect/guide/assessments/Pages/Carersassessments.aspx"> Carers' assessments</a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/CarersDirect/guide/rights/Pages/carers-rights.aspx','WT.dl','121')" href="http://www.nhs.uk/CarersDirect/guide/rights/Pages/carers-rights.aspx"> Carers' rights</a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/CarersDirect/guide/practicalsupport/Pages/Carehomes.aspx','WT.dl','121')" href="http://www.nhs.uk/CarersDirect/guide/practicalsupport/Pages/Carehomes.aspx"> Care homes</a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/CarersDirect/yourself/timeoff/Pages/Accessingrespitecare.aspx','WT.dl','121')" href="http://www.nhs.uk/CarersDirect/yourself/timeoff/Pages/Accessingrespitecare.aspx"> Breaks from caring</a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/CarersDirect/young','WT.dl','121')" href="http://www.nhs.uk/CarersDirect/young"> Young carers</a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/CarersDirect/carers-learning-online/Pages/Welcome.aspx','WT.dl','121')" href="http://www.nhs.uk/CarersDirect/carers-learning-online/Pages/Welcome.aspx"> Caring with confidence</a></li><li class="bold"><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/carersdirect','WT.dl','121')" href="http://www.nhs.uk/carersdirect"> All Carers Direct topics</a></li></ul></div></li><li class="news" id="news-topnav"><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/News/Pages/NewsIndex.aspx','WT.dl','121')" href="http://www.nhs.uk/News/Pages/NewsIndex.aspx"> Health news</a><div><ul><li class="first"><span>Health news stories unspun</span></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Food%2fdiet','WT.dl','121')" href="http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Food%2fdiet">Diet and nutrition<span class="hidden"> news reports</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Obesity','WT.dl','121')" href="http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Obesity">Obesity and weight loss<span class="hidden"> news reports</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Neurology','WT.dl','121')" href="http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Neurology">Neurology and dementia<span class="hidden"> news reports</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Lifestyle%2fexercise','WT.dl','121')" href="http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Lifestyle%2fexercise">Lifestyle and environment<span class="hidden"> news reports</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Pregnancy%2fchild','WT.dl','121')" href="http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Pregnancy%2fchild">Pregnancy and children<span class="hidden"> news reports</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Cancer','WT.dl','121')" href="http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Cancer">Cancer<span class="hidden"> news reports</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Medication','WT.dl','121')" href="http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Medication">Drugs and vaccines<span class="hidden"> news reports</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Heart%2flungs','WT.dl','121')" href="http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Heart%2flungs">Heart and lungs<span class="hidden"> news reports</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Medical+practice','WT.dl','121')" href="http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Medical+practice">Medical practice<span class="hidden"> news reports</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Older+people','WT.dl','121')" href="http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Older+people">Older people and ageing<span class="hidden"> news reports</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Genetics%2fstem+cells','WT.dl','121')" href="http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Genetics%2fstem+cells">Genetics and stem cells<span class="hidden">  news reports</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Mental+health','WT.dl','121')" href="http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Mental+health">Mental health<span class="hidden"> news reports</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Diabetes','WT.dl','121')" href="http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Diabetes">Diabetes<span class="hidden"> news reports</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/news/pages/newsarticles.aspx?TopicID=QA+articles','WT.dl','121')" href="http://www.nhs.uk/news/pages/newsarticles.aspx?TopicID=QA+articles"> Topical questions and answers</a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Special+reports','WT.dl','121')" href="http://www.nhs.uk/news/pages/newsarticles.aspx?TopicId=Special+reports"> Special reports</a></li><li class="bold"><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/news','WT.dl','121')" href="http://www.nhs.uk/news"> All Behind the Headlines news</a></li></ul></div></li><li class="find-services" id="find-services-topnav"><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/service-search','WT.dl','121')" href="http://www.nhs.uk/service-search"> Health services near you</a><div><ul><li class="topnav-first"><p class="topnav-image"><img src="http://www.nhs.uk/img/header/its-your-choice.gif" alt=" its your choice"/></p><p class="topnav-heading">Don't miss out ...</p><p>Exercise your right to choice in the NHS</p>
<p class="topnav-link"><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/choiceinthenhs/Pages/choicehome.aspx','WT.dl','121')" href="http://www.nhs.uk/choiceinthenhs/Pages/choicehome.aspx"> Learn about patient choice now</a></p></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Service-Search/Accident-and-emergency-services/LocationSearch/428','WT.dl','121')" href="http://www.nhs.uk/Service-Search/Accident-and-emergency-services/LocationSearch/428">A&amp;E<span class="hidden"> search</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Service-Search/Hospital/LocationSearch/7/Hospitals','WT.dl','121')" href="http://www.nhs.uk/Service-Search/Hospital/LocationSearch/7/Hospitals">Hospitals<span class="hidden"> search</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Service-Search/GP/LocationSearch/4','WT.dl','121')" href="http://www.nhs.uk/Service-Search/GP/LocationSearch/4">GPs<span class="hidden"> search</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Service-Search/Dentist/LocationSearch/3','WT.dl','121')" href="http://www.nhs.uk/Service-Search/Dentist/LocationSearch/3">Dentists<span class="hidden">search</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Service-Search/Pharmacy/LocationSearch/10','WT.dl','121')" href="http://www.nhs.uk/Service-Search/Pharmacy/LocationSearch/10">Pharmacies<span class="hidden"> search</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Service-Search/Maternity-service/LocationSearch/1802','WT.dl','121')" href="http://www.nhs.uk/Service-Search/Maternity-service/LocationSearch/1802">Maternity<span class="hidden"> search</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Service-Search/Alcohol-addiction/LocationSearch/1805','WT.dl','121')" href="http://www.nhs.uk/Service-Search/Alcohol-addiction/LocationSearch/1805">Alcohol<span class="hidden"> search</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Service-Search/Hospital/LocationSearch/7/Consultants','WT.dl','121')" href="http://www.nhs.uk/Service-Search/Hospital/LocationSearch/7/Consultants">Consultants<span class="hidden"> search</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Service-Search/Optician/LocationSearch/9','WT.dl','121')" href="http://www.nhs.uk/Service-Search/Optician/LocationSearch/9">Opticians<span class="hidden"> search</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Service-Search/Sexual-health-information-and-support/LocationSearch/734','WT.dl','121')" href="http://www.nhs.uk/Service-Search/Sexual-health-information-and-support/LocationSearch/734">Sexual health<span class="hidden"> search</span></a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Service-Search/Smoking-cessation-clinic/LocationSearch/636','WT.dl','121')" href="http://www.nhs.uk/Service-Search/Smoking-cessation-clinic/LocationSearch/636">Stop smoking</a></li><li><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Service-Search/Urgent-Care/LocationSearch/0','WT.dl','121')" href="http://www.nhs.uk/Service-Search/Urgent-Care/LocationSearch/0">Urgent care services</a></li><li class="last bold"><a onclick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','http://www.nhs.uk/Service-Search/Services','WT.dl','121')" href="http://www.nhs.uk/Service-Search/Services"> All directories</a></li></ul></div></li></ul>
</div><div id="ctl00_Header_onlineSurveyInjector">

</div>
  </div>
  
</div>
<div id="mainContent"></div>


    <!-- Header ends here.... -->

    <form method="post" action="Mood-self-assessment.aspx" onsubmit="javascript:return WebForm_OnSubmit();" id="aspnetForm">
<div>
<input type="hidden" name="__SPSCEditMenu" id="__SPSCEditMenu" value="true"/>
<input type="hidden" name="MSOWebPartPage_PostbackSource" id="MSOWebPartPage_PostbackSource" value=""/>
<input type="hidden" name="MSOTlPn_SelectedWpId" id="MSOTlPn_SelectedWpId" value=""/>
<input type="hidden" name="MSOTlPn_View" id="MSOTlPn_View" value="0"/>
<input type="hidden" name="MSOTlPn_ShowSettings" id="MSOTlPn_ShowSettings" value="False"/>
<input type="hidden" name="MSOGallery_SelectedLibrary" id="MSOGallery_SelectedLibrary" value=""/>
<input type="hidden" name="MSOGallery_FilterString" id="MSOGallery_FilterString" value=""/>
<input type="hidden" name="MSOTlPn_Button" id="MSOTlPn_Button" value="none"/>
<input type="hidden" name="MSOAuthoringConsole_FormContext" id="MSOAuthoringConsole_FormContext" value=""/>
<input type="hidden" name="MSOAC_EditDuringWorkflow" id="MSOAC_EditDuringWorkflow" value=""/>
<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value=""/>
<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value=""/>
<input type="hidden" name="__REQUESTDIGEST" id="__REQUESTDIGEST" value="0x0886148BD60DB07652E7B73AA88EF3FA4D897072AD58501D51FB0B7A1B678192F59480E7BCBBA87EB75B70FC29A177AB9A7426E2F5A51C703D7CF43D75BFEC0D,10 Jan 2013 12:32:45 -0000"/>
<input type="hidden" name="MSOSPWebPartManager_DisplayModeName" id="MSOSPWebPartManager_DisplayModeName" value="Browse"/>
<input type="hidden" name="MSOWebPartPage_Shared" id="MSOWebPartPage_Shared" value=""/>
<input type="hidden" name="MSOLayout_LayoutChanges" id="MSOLayout_LayoutChanges" value=""/>
<input type="hidden" name="MSOLayout_InDesignMode" id="MSOLayout_InDesignMode" value=""/>
<input type="hidden" name="MSOSPWebPartManager_OldDisplayModeName" id="MSOSPWebPartManager_OldDisplayModeName" value="Browse"/>
<input type="hidden" name="MSOSPWebPartManager_StartWebPartEditingName" id="MSOSPWebPartManager_StartWebPartEditingName" value="false"/>
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="http://www.nhs.uk/wEPDwUBMBBkZBYCZg9kFgYCBw9kFgQCAQ9kFgICAg8PFgIeB1Zpc2libGVnFgIeBXN0eWxlBQ5kaXNwbGF5OmJsb2NrO2QCAw9kFgQCAQ8PFgIfAGhkFgICAQ8WAh8AaBYCZg9kFgQCAg9kFgICAw8WAh8AaGQCAw8PFgIeCUFjY2Vzc0tleQUBL2RkAgMPDxYCHwBoZBYEAgEPDxYCHwBoZGQCAw8PFgIfAGhkFgICAQ8PFgIfAGdkFgQCAQ8PFgIfAGhkFhwCAQ8PFgIfAGhkZAIDDxYCHwBoZAIFDw8WAh8AaGRkAgcPFgIfAGhkAgkPDxYCHwBoZGQCCw8PFgIfAGhkZAINDw8WAh8AaGRkAg8PDxYEHgdFbmFibGVkaB8AaGRkAhEPDxYCHwBoZGQCEw8PFgQfA2gfAGhkZAIVDw8WAh8AaGRkAhcPFgIfAGhkAhkPFgIfAGhkAhsPDxYCHwBnZGQCAw8PFgIfAGdkFgYCAQ8PFgIfAGdkZAIDDw8WAh8AZ2RkAgUPDxYCHwBnZGQCCA9kFgJmD2QWAmYPZBYGZg9kFgICAQ8WAh4LXyFJdGVtQ291bnQCCBYQZg9kFgJmDxUFDiBjbGFzcz0iZmlyc3QiFC9QYWdlcy9Ib21lUGFnZS5hc3B4DiBhY2Nlc3NrZXk9IjEiFC9QYWdlcy9Ib21lUGFnZS5hc3B4BEhvbWVkAgEPZBYCZg8VBQArL2Fib3V0TkhTQ2hvaWNlcy9QYWdlcy9BYm91dE5IU0Nob2ljZXMuYXNweAArL2Fib3V0TkhTQ2hvaWNlcy9QYWdlcy9BYm91dE5IU0Nob2ljZXMuYXNweAVBYm91dGQCAg9kFgJmDxUFACUvYWJvdXROSFNDaG9pY2VzL1BhZ2VzL0NvbnRhY3RVcy5hc3B4DiBhY2Nlc3NrZXk9IjkiJS9hYm91dE5IU0Nob2ljZXMvUGFnZXMvQ29udGFjdFVzLmFzcHgHQ29udGFjdGQCAw9kFgJmDxUFAB4vdG9vbHMvcGFnZXMvdG9vbHNsaWJyYXJ5LmFzcHgAHi90b29scy9wYWdlcy90b29sc2xpYnJhcnkuYXNweAVUb29sc2QCBA9kFgJmDxUFAB4vdmlkZW8vcGFnZXMvTWVkaWFMaWJyYXJ5LmFzcHgAHi92aWRlby9wYWdlcy9NZWRpYUxpYnJhcnkuYXNweAVWaWRlb2QCBQ9kFgJmDxUFACBodHRwOi8vd3d3LmNob29zZWFuZGJvb2submhzLnVrLwAgaHR0cDovL3d3dy5jaG9vc2VhbmRib29rLm5ocy51ay8PQ2hvb3NlIGFuZCBCb29rZAIGD2QWAmYPFQUAKWh0dHA6Ly93d3cuaGVhbHRodW5sb2NrZWQuY29tL25oc2Nob2ljZXMvAClodHRwOi8vd3d3LmhlYWx0aHVubG9ja2VkLmNvbS9uaHNjaG9pY2VzLwtDb21tdW5pdGllc2QCBw9kFgJmDxUFDSBjbGFzcz0ibGFzdCIXL2lwZy9QYWdlcy9JUFN0YXJ0LmFzcHgAFy9pcGcvUGFnZXMvSVBTdGFydC5hc3B4A0lQU2QCAg9kFgICAg8WAh4EaHJlZgVwL1BlcnNvbmFsaXNhdGlvbi9SZWdpc3RyYXRpb24uYXNweD9SZXR1cm5Vcmw9aHR0cCUzYSUyZiUyZnd3dy5uaHMudWslMmZUb29scyUyZlBhZ2VzJTJmTW9vZC1zZWxmLWFzc2Vzc21lbnQuYXNweGQCBA8WAh8AaGQCCQ9kFgYCBQ9kFgICAQ9kFgZmDxYCHwBnZAIBD2QWBGYPFgIeE1ByZXZpb3VzQ29udHJvbE1vZGULKYgBTWljcm9zb2Z0LlNoYXJlUG9pbnQuV2ViQ29udHJvbHMuU1BDb250cm9sTW9kZSwgTWljcm9zb2Z0LlNoYXJlUG9pbnQsIFZlcnNpb249MTIuMC4wLjAsIEN1bHR1cmU9bmV1dHJhbCwgUHVibGljS2V5VG9rZW49NzFlOWJjZTExMWU5NDI5YwFkAgEPZBYEZg9kFggCAQ8WAh8FBeUBbWFpbHRvOj9zdWJqZWN0PU1vb2Qgc2VsZi1hc3Nlc3NtZW50JmFtcDtib2R5PUkgcmVhZCB0aGlzIG9uIHRoZSBOSFMgQ2hvaWNlcyAoaHR0cDovL3d3dy5uaHMudWspIHdlYnNpdGUgYW5kIHRob3VnaHQgeW91IHNob3VsZCByZWFkIGl0IHRvbzoNCiBodHRwJTNhJTJmJTJmd3d3Lm5ocy51ayUyZlRvb2xzJTJmUGFnZXMlMmZNb29kLXNlbGYtYXNzZXNzbWVudC5hc3B4JmFtcDtXVC5tY19pZD0yMDQxMWQCAg8VBhRNb29kK3NlbGYtYXNzZXNzbWVudENodHRwJTNhJTJmJTJmd3d3Lm5ocy51ayUyZlRvb2xzJTJmUGFnZXMlMmZNb29kLXNlbGYtYXNzZXNzbWVudC5hc3B4Q2h0dHAlM2ElMmYlMmZ3d3cubmhzLnVrJTJmVG9vbHMlMmZQYWdlcyUyZk1vb2Qtc2VsZi1hc3Nlc3NtZW50LmFzcHgUTW9vZCtzZWxmLWFzc2Vzc21lbnRDaHR0cCUzYSUyZiUyZnd3dy5uaHMudWslMmZUb29scyUyZlBhZ2VzJTJmTW9vZC1zZWxmLWFzc2Vzc21lbnQuYXNweBRNb29kK3NlbGYtYXNzZXNzbWVudGQCAw9kFgYCAQ8WAh8AaBYCAgEPDxYCHwBoZGQCAg8VAkNodHRwJTNhJTJmJTJmd3d3Lm5ocy51ayUyZlRvb2xzJTJmUGFnZXMlMmZNb29kLXNlbGYtYXNzZXNzbWVudC5hc3B4FE1vb2Qrc2VsZi1hc3Nlc3NtZW50ZAIDD2QWAgIBDxYCHwUFOS9Ub29scy9QYWdlcy9Nb29kLXNlbGYtYXNzZXNzbWVudC5hc3B4P3NhdmVmYXZvdXJpdGU9dHJ1ZWQCBw8WAh8AaBYCAgEPZBYWAgEPZBYCAgEPZBYCZg9kFgJmDxUBCUJhc2VkIG9uIGQCAw9kFgJmD2QWBGYPFQGCAWN0bDAwX1BsYWNlSG9sZGVySGVhZGVyX0hlYWRlcl9tZWRpYUxpYnJhcnlIZWFkZXJCb29rbWFya1dyYXBwZXIxX21lZGlhTGlicmFyeUhlYWRlckJvb2ttYXJrX1JhdGluZ3NfT25lU3RhclJhdGluZ19SYXRpbmdTZWxlY3RvcnNkAgEPEBYEHghkaXNhYmxlZAUIZGlzYWJsZWQeC18hRGF0YUJvdW5kZ2QUKwEBZmQCBQ9kFgJmD2QWBGYPFQGCAWN0bDAwX1BsYWNlSG9sZGVySGVhZGVyX0hlYWRlcl9tZWRpYUxpYnJhcnlIZWFkZXJCb29rbWFya1dyYXBwZXIxX21lZGlhTGlicmFyeUhlYWRlckJvb2ttYXJrX1JhdGluZ3NfVHdvU3RhclJhdGluZ19SYXRpbmdTZWxlY3RvcnNkAgEPEBYEHwcFCGRpc2FibGVkHwhnZBQrAQECAWQCBw9kFgJmD2QWBGYPFQGEAWN0bDAwX1BsYWNlSG9sZGVySGVhZGVyX0hlYWRlcl9tZWRpYUxpYnJhcnlIZWFkZXJCb29rbWFya1dyYXBwZXIxX21lZGlhTGlicmFyeUhlYWRlckJvb2ttYXJrX1JhdGluZ3NfVGhyZWVTdGFyUmF0aW5nX1JhdGluZ1NlbGVjdG9yc2QCAQ8QFgQfBwUIZGlzYWJsZWQfCGdkFCsBAQICZAIJD2QWAmYPZBYEZg8VAYMBY3RsMDBfUGxhY2VIb2xkZXJIZWFkZXJfSGVhZGVyX21lZGlhTGlicmFyeUhlYWRlckJvb2ttYXJrV3JhcHBlcjFfbWVkaWFMaWJyYXJ5SGVhZGVyQm9va21hcmtfUmF0aW5nc19Gb3VyU3RhclJhdGluZ19SYXRpbmdTZWxlY3RvcnNkAgEPEBYEHwcFCGRpc2FibGVkHwhnZBQrAQECA2QCCw9kFgJmD2QWBGYPFQGDAWN0bDAwX1BsYWNlSG9sZGVySGVhZGVyX0hlYWRlcl9tZWRpYUxpYnJhcnlIZWFkZXJCb29rbWFya1dyYXBwZXIxX21lZGlhTGlicmFyeUhlYWRlckJvb2ttYXJrX1JhdGluZ3NfRml2ZVN0YXJSYXRpbmdfUmF0aW5nU2VsZWN0b3JzZAIBDxAWBB8HBQhkaXNhYmxlZB8IZ2QUKwEBAgRkAg0PZBYCZg9kFgRmDxUBf2N0bDAwX1BsYWNlSG9sZGVySGVhZGVyX0hlYWRlcl9tZWRpYUxpYnJhcnlIZWFkZXJCb29rbWFya1dyYXBwZXIxX21lZGlhTGlicmFyeUhlYWRlckJvb2ttYXJrX1JhdGluZ3NfVXNlclJhdGluZ19SYXRpbmdTZWxlY3RvcnNkAgEPEBYEHwdkHwhnZBQrAQECBGQCDw8WAh8AaBYCAgEPZBYGZg8PFgIeCEltYWdlVXJsBRxIYW5kbGVycy9DYXB0Y2hhSGFuZGxlci5hc2h4ZGQCBA8PFgQeBFRleHQFA1RyeR8AaGRkAggPDxYCHwoFFENoYW5nZSBDYXB0Y2hhIEltYWdlZGQCEQ8WAh8AaGQCFQ8PFgIeC05hdmlnYXRlVXJsBTZodHRwOi8vd3d3Lm5ocy51ay9hYm91dE5IU0Nob2ljZXMvUGFnZXMvQ29udGFjdFVzLmFzcHhkZAIXDw8WAh8AZ2RkAgIPFgIfAGgWAmYPZBYEZg8PFgIfAGhkFgICAQ8QDxYCHwhnZGQWAGQCAQ9kFgQCAw8PFggeDkNvbW1lbnRMaW5rVXJsZB4VQ29tbWVudENvdW50SW5jcmVhc2VkaB4MQ29tbWVudENvdW50Zh4MSGlkZUNvbW1lbnRzaGQWAgICDxYCHwRmZAIHDxYCHwBnZAICDxYCHwBnFgJmD2QWBGYPZBYKAgEPFgIfBQXlAW1haWx0bzo/c3ViamVjdD1Nb29kIHNlbGYtYXNzZXNzbWVudCZhbXA7Ym9keT1JIHJlYWQgdGhpcyBvbiB0aGUgTkhTIENob2ljZXMgKGh0dHA6Ly93d3cubmhzLnVrKSB3ZWJzaXRlIGFuZCB0aG91Z2h0IHlvdSBzaG91bGQgcmVhZCBpdCB0b286DQogaHR0cCUzYSUyZiUyZnd3dy5uaHMudWslMmZUb29scyUyZlBhZ2VzJTJmTW9vZC1zZWxmLWFzc2Vzc21lbnQuYXNweCZhbXA7V1QubWNfaWQ9MjA0MTFkAgIPFQYUTW9vZCtzZWxmLWFzc2Vzc21lbnRDaHR0cCUzYSUyZiUyZnd3dy5uaHMudWslMmZUb29scyUyZlBhZ2VzJTJmTW9vZC1zZWxmLWFzc2Vzc21lbnQuYXNweENodHRwJTNhJTJmJTJmd3d3Lm5ocy51ayUyZlRvb2xzJTJmUGFnZXMlMmZNb29kLXNlbGYtYXNzZXNzbWVudC5hc3B4FE1vb2Qrc2VsZi1hc3Nlc3NtZW50Q2h0dHAlM2ElMmYlMmZ3d3cubmhzLnVrJTJmVG9vbHMlMmZQYWdlcyUyZk1vb2Qtc2VsZi1hc3Nlc3NtZW50LmFzcHgUTW9vZCtzZWxmLWFzc2Vzc21lbnRkAgMPZBYGAgEPFgIfAGgWAgIBDw8WAh8AaGRkAgIPFQJDaHR0cCUzYSUyZiUyZnd3dy5uaHMudWslMmZUb29scyUyZlBhZ2VzJTJmTW9vZC1zZWxmLWFzc2Vzc21lbnQuYXNweBRNb29kK3NlbGYtYXNzZXNzbWVudGQCAw9kFgICAQ8WAh8FBTkvVG9vbHMvUGFnZXMvTW9vZC1zZWxmLWFzc2Vzc21lbnQuYXNweD9zYXZlZmF2b3VyaXRlPXRydWVkAgUPZBYCAgEPFgQfBQU7L05IU0Nob2ljZXMvc2hhcmVkL1JTU0ZlZWRHZW5lcmF0b3IvUlNTRmVlZC5hc3B4P3NpdGU9dG9vbHMeB29uY2xpY2sFTmRjc011bHRpVHJhY2soJ0RDU2V4dC5yc3Nfc2lnbnVwJywnMScsJ0RDU2V4dC5yc3NfZmVlZCcsJ3Rvb2xzJywnV1QuZGwnLCcxMTAnKWQCBw8WAh8AaBYCAgEPZBYWAgEPZBYCAgEPZBYCZg9kFgJmDxUBCUJhc2VkIG9uIGQCAw9kFgJmD2QWBGYPFQGCAWN0bDAwX1BsYWNlSG9sZGVySGVhZGVyX0hlYWRlcl9tZWRpYUxpYnJhcnlIZWFkZXJCb29rbWFya1dyYXBwZXIyX21lZGlhTGlicmFyeUhlYWRlckJvb2ttYXJrX1JhdGluZ3NfT25lU3RhclJhdGluZ19SYXRpbmdTZWxlY3RvcnNkAgEPEBYEHwcFCGRpc2FibGVkHwhnZBQrAQFmZAIFD2QWAmYPZBYEZg8VAYIBY3RsMDBfUGxhY2VIb2xkZXJIZWFkZXJfSGVhZGVyX21lZGlhTGlicmFyeUhlYWRlckJvb2ttYXJrV3JhcHBlcjJfbWVkaWFMaWJyYXJ5SGVhZGVyQm9va21hcmtfUmF0aW5nc19Ud29TdGFyUmF0aW5nX1JhdGluZ1NlbGVjdG9yc2QCAQ8QFgQfBwUIZGlzYWJsZWQfCGdkFCsBAQIBZAIHD2QWAmYPZBYEZg8VAYQBY3RsMDBfUGxhY2VIb2xkZXJIZWFkZXJfSGVhZGVyX21lZGlhTGlicmFyeUhlYWRlckJvb2ttYXJrV3JhcHBlcjJfbWVkaWFMaWJyYXJ5SGVhZGVyQm9va21hcmtfUmF0aW5nc19UaHJlZVN0YXJSYXRpbmdfUmF0aW5nU2VsZWN0b3JzZAIBDxAWBB8HBQhkaXNhYmxlZB8IZ2QUKwEBAgJkAgkPZBYCZg9kFgRmDxUBgwFjdGwwMF9QbGFjZUhvbGRlckhlYWRlcl9IZWFkZXJfbWVkaWFMaWJyYXJ5SGVhZGVyQm9va21hcmtXcmFwcGVyMl9tZWRpYUxpYnJhcnlIZWFkZXJCb29rbWFya19SYXRpbmdzX0ZvdXJTdGFyUmF0aW5nX1JhdGluZ1NlbGVjdG9yc2QCAQ8QFgQfBwUIZGlzYWJsZWQfCGdkFCsBAQIDZAILD2QWAmYPZBYEZg8VAYMBY3RsMDBfUGxhY2VIb2xkZXJIZWFkZXJfSGVhZGVyX21lZGlhTGlicmFyeUhlYWRlckJvb2ttYXJrV3JhcHBlcjJfbWVkaWFMaWJyYXJ5SGVhZGVyQm9va21hcmtfUmF0aW5nc19GaXZlU3RhclJhdGluZ19SYXRpbmdTZWxlY3RvcnNkAgEPEBYEHwcFCGRpc2FibGVkHwhnZBQrAQECBGQCDQ9kFgJmD2QWBGYPFQF/Y3RsMDBfUGxhY2VIb2xkZXJIZWFkZXJfSGVhZGVyX21lZGlhTGlicmFyeUhlYWRlckJvb2ttYXJrV3JhcHBlcjJfbWVkaWFMaWJyYXJ5SGVhZGVyQm9va21hcmtfUmF0aW5nc19Vc2VyUmF0aW5nX1JhdGluZ1NlbGVjdG9yc2QCAQ8QFgQfB2QfCGdkFCsBAQIEZAIPDxYCHwBoFgICAQ9kFgZmDw8WAh8JBRxIYW5kbGVycy9DYXB0Y2hhSGFuZGxlci5hc2h4ZGQCBA8PFgQfCgUDVHJ5HwBoZGQCCA8PFgIfCgUUQ2hhbmdlIENhcHRjaGEgSW1hZ2VkZAIRDxYCHwBoZAIVDw8WAh8LBTZodHRwOi8vd3d3Lm5ocy51ay9hYm91dE5IU0Nob2ljZXMvUGFnZXMvQ29udGFjdFVzLmFzcHhkZAIXDw8WAh8AZ2RkAgIPFgIfAGgWAmYPZBYEZg8PFgIfAGhkFgICAQ8QDxYCHwhnZGQWAGQCAQ9kFgQCAw8PFggfDGQfDWgfDmYfD2hkFgICAg8WAh8EZmQCBw8WAh8AZ2QCCw9kFgICAQ9kFhBmD2QWAmYPFgIfBAIXFjBmD2QWBGYPFQERIGNsYXNzPSJzZWxlY3RlZCJkAgEPFQEDMTIzZAIBD2QWBGYPFQEAZAIBDxUEB0FsY29ob2wqL1Rvb2xzL1BhZ2VzL1Rvb2xzbGlicmFyeS5hc3B4P1RhZz1BbGNvaG9sB0FsY29ob2wBNWQCAg9kFgRmDxUBAGQCAQ8VBAZDYXJlcnMpL1Rvb2xzL1BhZ2VzL1Rvb2xzbGlicmFyeS5hc3B4P1RhZz1DYXJlcnMGQ2FyZXJzATdkAgMPZBYEZg8VAQBkAgEPFQQMQ2hpbGQgaGVhbHRoLy9Ub29scy9QYWdlcy9Ub29sc2xpYnJhcnkuYXNweD9UYWc9Q2hpbGQraGVhbHRoDENoaWxkIGhlYWx0aAIxM2QCBA9kFgRmDxUBAGQCAQ8VBBVEb3dubG9hZHMgYW5kIHdpZGdldHM4L1Rvb2xzL1BhZ2VzL1Rvb2xzbGlicmFyeS5hc3B4P1RhZz1Eb3dubG9hZHMrYW5kK3dpZGdldHMVRG93bmxvYWRzIGFuZCB3aWRnZXRzATlkAgUPZBYEZg8VAQBkAgEPFQQNRmFtaWx5IGhlYWx0aDAvVG9vbHMvUGFnZXMvVG9vbHNsaWJyYXJ5LmFzcHg/VGFnPUZhbWlseStoZWFsdGgNRmFtaWx5IGhlYWx0aAE4ZAIGD2QWBGYPFQEAZAIBDxUEDUZlbWFsZSBoZWFsdGgwL1Rvb2xzL1BhZ2VzL1Rvb2xzbGlicmFyeS5hc3B4P1RhZz1GZW1hbGUraGVhbHRoDUZlbWFsZSBoZWFsdGgBN2QCBw9kFgRmDxUBAGQCAQ8VBAdGaXRuZXNzKi9Ub29scy9QYWdlcy9Ub29sc2xpYnJhcnkuYXNweD9UYWc9Rml0bmVzcwdGaXRuZXNzAjEwZAIID2QWBGYPFQEAZAIBDxUEEkhlYWx0aCBhbmQgc2FmZXR5IDUvVG9vbHMvUGFnZXMvVG9vbHNsaWJyYXJ5LmFzcHg/VGFnPUhlYWx0aCthbmQrc2FmZXR5KxJIZWFsdGggYW5kIHNhZmV0eSABNmQCCQ9kFgRmDxUBAGQCAQ8VBA5IZWFsdGh5IGVhdGluZzEvVG9vbHMvUGFnZXMvVG9vbHNsaWJyYXJ5LmFzcHg/VGFnPUhlYWx0aHkrZWF0aW5nDkhlYWx0aHkgZWF0aW5nATZkAgoPZBYEZg8VAQBkAgEPFQQVSW50ZXJhY3RpdmUgdGltZWxpbmVzOC9Ub29scy9QYWdlcy9Ub29sc2xpYnJhcnkuYXNweD9UYWc9SW50ZXJhY3RpdmUrdGltZWxpbmVzFUludGVyYWN0aXZlIHRpbWVsaW5lcwE3ZAILD2QWBGYPFQEAZAIBDxUEC0xvc2Ugd2VpZ2h0Li9Ub29scy9QYWdlcy9Ub29sc2xpYnJhcnkuYXNweD9UYWc9TG9zZSt3ZWlnaHQLTG9zZSB3ZWlnaHQCMTBkAgwPZBYEZg8VAQBkAgEPFQQLTWFsZSBoZWFsdGguL1Rvb2xzL1BhZ2VzL1Rvb2xzbGlicmFyeS5hc3B4P1RhZz1NYWxlK2hlYWx0aAtNYWxlIGhlYWx0aAE0ZAIND2QWBGYPFQEAZAIBDxUEDU1lbnRhbCBoZWFsdGgwL1Rvb2xzL1BhZ2VzL1Rvb2xzbGlicmFyeS5hc3B4P1RhZz1NZW50YWwraGVhbHRoDU1lbnRhbCBoZWFsdGgBNmQCDg9kFgRmDxUBAGQCAQ8VBAxNeXRoIGJ1c3RlcnMvL1Rvb2xzL1BhZ2VzL1Rvb2xzbGlicmFyeS5hc3B4P1RhZz1NeXRoK2J1c3RlcnMMTXl0aCBidXN0ZXJzATRkAg8PZBYEZg8VAQBkAgEPFQQJUHJlZ25hbmN5LC9Ub29scy9QYWdlcy9Ub29sc2xpYnJhcnkuYXNweD9UYWc9UHJlZ25hbmN5CVByZWduYW5jeQIxMGQCEA9kFgRmDxUBAGQCAQ8VBBNTY3JlZW5pbmcgYW5kIHRlc3RzNi9Ub29scy9QYWdlcy9Ub29sc2xpYnJhcnkuYXNweD9UYWc9U2NyZWVuaW5nK2FuZCt0ZXN0cxNTY3JlZW5pbmcgYW5kIHRlc3RzATZkAhEPZBYEZg8VAQBkAgEPFQQQU2VsZiBhc3Nlc3NtZW50czMvVG9vbHMvUGFnZXMvVG9vbHNsaWJyYXJ5LmFzcHg/VGFnPVNlbGYrYXNzZXNzbWVudHMQU2VsZiBhc3Nlc3NtZW50cwIyMWQCEg9kFgRmDxUBAGQCAQ8VBA5TZXh1YWwgaGVhbHRoIDEvVG9vbHMvUGFnZXMvVG9vbHNsaWJyYXJ5LmFzcHg/VGFnPVNleHVhbCtoZWFsdGgrDlNleHVhbCBoZWFsdGggATdkAhMPZBYEZg8VAQBkAgEPFQQLU2tpbiBoZWFsdGguL1Rvb2xzL1BhZ2VzL1Rvb2xzbGlicmFyeS5hc3B4P1RhZz1Ta2luK2hlYWx0aAtTa2luIGhlYWx0aAE2ZAIUD2QWBGYPFQEAZAIBDxUEGFNsaWRlc2hvd3MgYW5kIGdhbGxlcmllczsvVG9vbHMvUGFnZXMvVG9vbHNsaWJyYXJ5LmFzcHg/VGFnPVNsaWRlc2hvd3MrYW5kK2dhbGxlcmllcxhTbGlkZXNob3dzIGFuZCBnYWxsZXJpZXMCMTNkAhUPZBYEZg8VAQBkAgEPFQQMU3RvcCBzbW9raW5nLy9Ub29scy9QYWdlcy9Ub29sc2xpYnJhcnkuYXNweD9UYWc9U3RvcCtzbW9raW5nDFN0b3Agc21va2luZwE0ZAIWD2QWBGYPFQEAZAIBDxUECFRoZSBOSFMgKy9Ub29scy9QYWdlcy9Ub29sc2xpYnJhcnkuYXNweD9UYWc9VGhlK05IUysIVGhlIE5IUyACMTFkAhcPZBYEZg8VAQBkAgEPFQQLVmlkZW8gd2FsbHMuL1Rvb2xzL1BhZ2VzL1Rvb2xzbGlicmFyeS5hc3B4P1RhZz1WaWRlbyt3YWxscwtWaWRlbyB3YWxscwI0MGQCAg8PFgIfAGhkZAIDD2QWBGYPFgIfBgsrBAFkAgEPFgIfBgsrBAFkAgUPZBYCAgoPFgIfAGdkAgYPZBYCAgoPFgIfAGdkAgcPZBYCAgoPFgIfAGdkAggPDxYCHwBoZGQCCQ8PFgIfAGhkZAIPD2QWAmYPZBYCZg9kFgJmD2QWBgIBDxYCHwoFF05IUyBDaG9pY2VzIGluZm9ybWF0aW9uZAIDDxYCHwoFFUNob2ljZXMgZS1uZXdzbGV0dGVyc2QCBQ8WAh8KBQpZb3VyIHBhZ2VzZGRk7XQlp4/s3tDtD76K08Mj1B+VyA=="/>
</div>

<script type="text/javascript">
//<![CDATA[
var theForm = document.forms['aspnetForm'];
function __doPostBack(eventTarget, eventArgument) {
    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
        theForm.__EVENTTARGET.value = eventTarget;
        theForm.__EVENTARGUMENT.value = eventArgument;
        theForm.submit();
    }
}
//]]>
</script>


<script src="http://www.nhs.uk/WebResource.axd?d=E-wYADGR95cKnlHmVJ7-E7S2iuY55NnlOW5Jh2aCtWrQTKIo89wBV30SKRlwy2airItEy6ABWWNdDqqVN-G7AHPVUmY1&amp;t=634604424479085897" type="text/javascript"></script>

<script type="text/javascript"> var MSOWebPartPageFormName = 'aspnetForm';</script><link href="http://www.nhs.uk/_layouts/1033/styles/Menu.css?rev=jQ88ZMCVEKRn%2FLeYuywntQ%3D%3D" rel="stylesheet"/>
<script type="text/JavaScript" >
<!--
var L_Menu_BaseUrl="http://www.nhs.uk/Tools";
var L_Menu_LCID="1033";
var L_Menu_SiteTheme="";
//-->
</script>
<script type="text/javascript">
//<![CDATA[
var feedbackurl = 'http://www.nhs.uk/aboutNHSChoices/Pages/ContactUs.aspx';$(document).ready(function() { 
                
                });
                var displayPrintLink = true;//]]>
</script>

<script src="http://www.nhs.uk/ScriptResource.axd?d=60BavXcg557IDlC8DH-JRmQ67EA7sWKpQ0S9jwEJIGWWYw9dVD53OwZCz5RxaUhq6LO71mq_w82ADgG8iEvebjfORzGSoPtfntCgghJONeyiZ5Vpa_nGuR6nKWq9n9CdGfQeJG5emeCKMpsPGgDmV4pr7G01&amp;t=ffffffffb868b5f4" type="text/javascript"></script>
<script src="http://www.nhs.uk/ScriptResource.axd?d=Ke7zvn9hXGNMdn-MFccv7GZU9ujX49EFKizEBV2KI8hScK0BA2GLTbYEGI1VEBGNBSeHcNWAlMO0Vi11hDFCz7xmeu2iMCnK2evNibtJebLg-XTxCx71J--ncPom7JemLXPO3OU7RtWAQoocm6P_abTmpqsXUBZud6l8xRNsMQf3vH6K0&amp;t=ffffffffb868b5f4" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
function WebForm_OnSubmit() {
UpdateFormDigest('\u002fTools', 1440000);
return true;
}
//]]>
</script>

    <script type="text/javascript">
//<![CDATA[
Sys.WebForms.PageRequestManager._initialize('ctl00$ScriptManager1', document.getElementById('aspnetForm'));
Sys.WebForms.PageRequestManager.getInstance()._updateControls([], [], [], 90);
//]]>
</script>

    
    
	
<div class="content-wrap tomedia tools clear">

    

    
       
            <div class="col five pad-tl">
	            <h1>Tools</h1>
                <p></p>
                
            

<div class="bookmark-wrap clear">
    
  <div class="clear">
 
     <div class="social-sharing clear">
		<p class="share">Share:</p>
        <ul class="share-list">

        	<li class="email"><a href="mailto:?subject=Mood self-assessment&amp;body=I read this on the NHS Choices (http://www.nhs.uk) website and thought you should read it too:
 http%3a%2f%2fwww.nhs.uk%2fTools%2fPages%2fMood-self-assessment.aspx&amp;WT.mc_id=20411" id="ctl00_PlaceHolderHeader_Header_mediaLibraryHeaderBookmarkWrapper2_mediaLibraryHeaderBookmark_btnEmail" title="Share this page via email"><img src="http://www.nhs.uk/img/social-sharing/email.jpg" alt="Email share" width="16" height="16"/></a></li>
            <li class="twitter"><a title="Share this page via Twitter" href="http://twitter.com/home?status=Mood+self-assessment%20-%20http%3a%2f%2fwww.nhs.uk%2fTools%2fPages%2fMood-self-assessment.aspx&amp;WT.mc_id=50411" target="_blank"><img src="http://www.nhs.uk/img/social-sharing/twitter.jpg" alt="Twitter share" width="16" height="16"/></a></li>
            <li class="facebook"><a title="Share this page via Facebook" href="http://www.facebook.com/sharer.php?u=http%3a%2f%2fwww.nhs.uk%2fTools%2fPages%2fMood-self-assessment.aspx&amp;t=Mood+self-assessment&amp;WT.mc_id=60411" target="_blank"><img src="http://www.nhs.uk/img/social-sharing/facebook.jpg" alt="Facebook share" width="16" height="16"/></a></li>
            <li class="windows-live"><a title="Share this page via Windows Live Messenger" href="http://profile.live.com/badge/?url=http%3a%2f%2fwww.nhs.uk%2fTools%2fPages%2fMood-self-assessment.aspx&amp;title=Mood+self-assessment&amp;screenshot=http://www.nhs.uk/img/social-sharing/nhsc-wl-icn.jpg&amp;WT.mc_id=40411" target="_blank"><img src="http://www.nhs.uk/img/social-sharing/windows-live.jpg" alt="Windows Live Messenger share" width="16" height="16"/></a></li>
        </ul>
        
            <p class="save">Save:</p>
            <ul class="save-list">
                
                <li class="google"><a title="Save this page to Google Bookmarks" href="https://www.google.com/bookmarks/mark?op=add&amp;bkmk=http%3a%2f%2fwww.nhs.uk%2fTools%2fPages%2fMood-self-assessment.aspx&amp;title=Mood+self-assessment&amp;WT.mc_id=30411" target="_blank"><img src="http://www.nhs.uk/img/social-sharing/google.jpg" alt="Google Bookmarks" width="16" height="16"/></a></li>
                
                    <li class="nhsc-save"><a href="http://www.nhs.uk/Tools/Pages/Mood-self-assessment.aspx?savefavourite=true" id="ctl00_PlaceHolderHeader_Header_mediaLibraryHeaderBookmarkWrapper2_mediaLibraryHeaderBookmark_btnSave" title="Save this page to your NHS Choices account"><img src="http://www.nhs.uk/img/social-sharing/nhsc-save.jpg" alt="NHS Choices Saved Pages" width="16" height="16"/></a></li>
                
		    </ul>
                
        
            <p class="subscribe">Subscribe:&nbsp;<a href="http://www.nhs.uk/NHSChoices/shared/RSSFeedGenerator/RSSFeed.aspx?site=tools" id="ctl00_PlaceHolderHeader_Header_mediaLibraryHeaderBookmarkWrapper2_mediaLibraryHeaderBookmark_lnkRssFeed" title="Subscribe to this section using RSS" onclick="dcsMultiTrack('DCSext.rss_signup','1','DCSext.rss_feed','tools','WT.dl','110')"><img src="http://www.nhs.uk/img/social-sharing/rss.jpg" alt="RSS feed" width="16" height="16"/></a></p>
        
	</div>
    
  </div>
  
  
    
</div>
       




            </div>
      
      
        <div class="row pad-tl clear">
    
    
    

	
    
    

    
    
	



<div class="col one media-categories">
        
        <h2>Categories</h2>
        <ul class="video-menu clear">
        <li class="selected"><a title="all tools" href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx">All tools (123)</a></li>
    
        <li><a title="tool: Alcohol" href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=Alcohol">Alcohol (5)</a></li>
    
        <li><a title="tool: Carers" href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=Carers">Carers (7)</a></li>
    
        <li><a title="tool: Child health" href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=Child+health">Child health (13)</a></li>
    
        <li><a title="tool: Downloads and widgets" href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=Downloads+and+widgets">Downloads and widgets (9)</a></li>
    
        <li><a title="tool: Family health" href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=Family+health">Family health (8)</a></li>
    
        <li><a title="tool: Female health" href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=Female+health">Female health (7)</a></li>
    
        <li><a title="tool: Fitness" href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=Fitness">Fitness (10)</a></li>
    
        <li><a title="tool: Health and safety " href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=Health+and+safety+">Health and safety  (6)</a></li>
    
        <li><a title="tool: Healthy eating" href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=Healthy+eating">Healthy eating (6)</a></li>
    
        <li><a title="tool: Interactive timelines" href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=Interactive+timelines">Interactive timelines (7)</a></li>
    
        <li><a title="tool: Lose weight" href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=Lose+weight">Lose weight (10)</a></li>
    
        <li><a title="tool: Male health" href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=Male+health">Male health (4)</a></li>
    
        <li><a title="tool: Mental health" href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=Mental+health">Mental health (6)</a></li>
    
        <li><a title="tool: Myth busters" href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=Myth+busters">Myth busters (4)</a></li>
    
        <li><a title="tool: Pregnancy" href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=Pregnancy">Pregnancy (10)</a></li>
    
        <li><a title="tool: Screening and tests" href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=Screening+and+tests">Screening and tests (6)</a></li>
    
        <li><a title="tool: Self assessments" href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=Self+assessments">Self assessments (21)</a></li>
    
        <li><a title="tool: Sexual health " href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=Sexual+health+">Sexual health  (7)</a></li>
    
        <li><a title="tool: Skin health" href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=Skin+health">Skin health (6)</a></li>
    
        <li><a title="tool: Slideshows and galleries" href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=Slideshows+and+galleries">Slideshows and galleries (13)</a></li>
    
        <li><a title="tool: Stop smoking" href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=Stop+smoking">Stop smoking (4)</a></li>
    
        <li><a title="tool: The NHS " href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=The+NHS+">The NHS  (11)</a></li>
    
        <li><a title="tool: Video walls" href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Tag=Video+walls">Video walls (40)</a></li>
    
        </ul>
    
<h2>Top Choices</h2>
<ul class="video-menu clear">
    <li>
        <a href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Filter=recent">5 most recent</a></li>
    <li>
        <a href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Filter=popular">5 most viewed</a></li>
    <li>
        <a href="http://www.nhs.uk/Tools/Pages/Toolslibrary.aspx?Filter=choice">Editor's choice</a></li>
</ul>
<div class="component rss">
    <ul>
        <li><a onclick = "dcsMultiTrack('DCSext.rss_signup','1','DCSext.rss_feed','tools','WT.dl','110')" href="http://www.nhs.uk/NHSChoices/shared/RSSFeedGenerator/RSSFeed.aspx?site=tools" title="RSS Feed for tools"><img src="http://www.nhs.uk/img/rss_feed.gif" alt="RSS Icon"/>Choices tools</a></li>
	    <li class="leftPad"><a href="http://www.nhs.uk/Pages/WhatisRss.aspx" title="Help on RSS">What is RSS?</a></li>
    </ul>
</div>
 
        <p></p>
</div>    

<div class="col three">
    <div class="pad border clear">
        <div class="thold">
                <h2>Mood self-assessment</h2>
                <p class="mtool">We can all feel low, anxious or panicky from time to time. Check your mood using this simple questionnaire and get advice on what might help.</p>
        
            </div>
           <div id="mediaTool">                                    
                
<div id="assessment_webpart_wrapper">
<script type="text/javascript">
$(document).ready(function() {
	var __assessment = document.createElement('script'); 
	var __assessment_obj = document.getElementsByTagName('script')[document.getElementsByTagName('script').length - 1]; 
	__assessment.id = 'assessment_webpart'; 
	__assessment.ASid = '<?php echo $asid;?>'; 
	__assessment.APPpath = '';
	__assessment.displaydate = false;
	__assessment.datekey = 'Wellbeing-self-assessment'
	__assessment.syndicate = false;
	__assessment.dimensions = Array(376,440);
	__assessment.XMLpath = 'data/';
	__assessment.type = 'text/javascript';
	__assessment.async = true;
	__assessment.src = __assessment.APPpath+'js/assessment.js';
	__assessment_obj.parentNode.insertBefore(__assessment, __assessment_obj); 
})
</script>


            </div>
            <div class="thold">
               <p><a class="printout" href="http://www.nhs.uk/Tools/Documents/Mood%20self-assessment.htm">Text only version of this tool</a></p>
               
               <br />
            </div>
            <div>
                
            </div> 
			
<div class="review-date">
  
    <p>Last reviewed: <span class="review-pad">31/08/2012</span></p>
  
    <p>Next review due: <span>31/08/2014</span></p>
 
 <div style="display:none">
   
 </div>
   
 <div style="display:block">
   
 </div>
   
</div>
	
            
    </div>
</div>

<div class="col one last media-teasers">
    









       
  <div class="panel">
    <span class="crnr tl"></span>
    <span class="crnr tr"></span>
    <div class="clear">
      <div class="image">
        <!-- article hub small teaser -->
        <img alt=""  src="http://www.nhs.uk/Conditions/stress-anxiety-depression/PublishingImages/J%20to%20O/landing-page-teaser_183x90_109718232.jpg"/>
      </div>
      <div class="panel-text">
        <h2><a href="http://www.nhs.uk/Conditions/stress-anxiety-depression/Pages/low-mood-stress-anxiety.aspx">Moodzone</a></h2>
        <p>Feeling stressed, anxious or depressed? The NHS Choices Moodzone can help you on your way to feeling better</p>
      </div>
    </div>
    <span class="crnr bl"></span> <span class="crnr br"></span>
  </div>












     
    









       
  <div class="panel">
    <span class="crnr tl"></span>
    <span class="crnr tr"></span>
    <div class="clear">
      <div class="image">
        <!-- article hub small teaser -->
        <img alt=""  src="http://www.nhs.uk/Conditions/stress-anxiety-depression/PublishingImages/E%20to%20I/five-steps-to-mental-wellbeing_183x90_103569148.jpg"/>
      </div>
      <div class="panel-text">
        <h2><a href="http://www.nhs.uk/Conditions/stress-anxiety-depression/Pages/improve-mental-wellbeing.aspx">Five steps to mental wellbeing</a></h2>
        <p>Good mental wellbeing means feeling good and functioning well. Improve your mental wellbeing</p>
      </div>
    </div>
    <span class="crnr bl"></span> <span class="crnr br"></span>
  </div>













    









       
  <div class="panel">
    <span class="crnr tl"></span>
    <span class="crnr tr"></span>
    <div class="clear">
      <div class="image">
        <!-- article hub small teaser -->
        <img alt=""  src="http://www.nhs.uk/Conditions/stress-anxiety-depression/PublishingImages/P%20to%20S/self-help-therapy_183x90_Untitled-8.jpg"/>
      </div>
      <div class="panel-text">
        <h2><a href="http://www.nhs.uk/Conditions/stress-anxiety-depression/Pages/Self-help-therapies.aspx">Self-help therapies</a></h2>
        <p>A guide to self-help therapy, including books, online courses, and phone and email counselling</p>
      </div>
    </div>
    <span class="crnr bl"></span> <span class="crnr br"></span>
  </div>













    
    
</div>


</div>
</div>

  
         

	

    
	



    <!-- Footer starts here.... -->
    
    <div class="footer clear">

        <ul class="footer-tabs clear">
            <li><a href="#footer-tab1"><span class="crnr tl"></span><span class="footer-title">NHS Choices information</span><span class="crnr tr"></span></a></li>
            <!-- <li><a href="#footer-tab2"><span class="crnr tl"></span><span class="footer-title">Choices e-newsletters</span><span class="crnr tr"></span></a></li> -->
            <li><a href="#footer-tab3"><span class="crnr tl"></span><span class="footer-title">Your pages</span><span class="crnr tr"></span></a></li>
        </ul>

        <div id="footer-tab1" class="footer-tab1 footer-tab-content clear">
            <div id="ctl00_Footer_ucPersonalisationFooter_SitePolicies" class="footer-list">
	
<h2>Site policies</h2>
<ul class="info">
<li><a href="http://www.nhs.uk/aboutNHSChoices/aboutnhschoices/termsandconditions/Pages/termsandconditions.aspx" 
    accesskey ="8"
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Site policies','DCSext.FooterClickUrl','http://www.nhs.uk/aboutNHSChoices/aboutnhschoices/termsandconditions/Pages/termsandconditions.aspx','WT.dl','121')" onkeypress="this.onclick()">Terms and conditions</a></li>
<li><a href="http://www.nhs.uk/aboutNHSChoices/aboutnhschoices/Aboutus/Pages/Editorialpolicy.aspx" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Site policies','DCSext.FooterClickUrl','http://www.nhs.uk/aboutNHSChoices/aboutnhschoices/Aboutus/Pages/Editorialpolicy.aspx','WT.dl','121')" onkeypress="this.onclick()">Editorial policy</a></li>
<li><a href="http://www.nhs.uk/aboutNHSChoices/aboutnhschoices/termsandconditions/Pages/commentspolicy.aspx" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Site policies','DCSext.FooterClickUrl','http://www.nhs.uk/aboutNHSChoices/aboutnhschoices/termsandconditions/Pages/commentspolicy.aspx','WT.dl','121')" onkeypress="this.onclick()">Comments policy</a></li>
<li><a href="http://www.nhs.uk/aboutNHSChoices/professionals/syndication/Pages/Webservices.aspx" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Site policies','DCSext.FooterClickUrl','http://www.nhs.uk/aboutNHSChoices/professionals/syndication/Pages/Webservices.aspx','WT.dl','121')" onkeypress="this.onclick()">Syndication</a></li>
<li><a href="http://www.nhs.uk/aboutNHSChoices/aboutnhschoices/termsandconditions/Pages/Privacypolicy.aspx" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Site policies','DCSext.FooterClickUrl','http://www.nhs.uk/aboutNHSChoices/aboutnhschoices/termsandconditions/Pages/Privacypolicy.aspx','WT.dl','121')" onkeypress="this.onclick()">Privacy policy</a></li>
<li><a href="http://www.nhs.uk/aboutNHSChoices/aboutnhschoices/termsandconditions/Pages/cookies-policy.aspx" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Site policies','DCSext.FooterClickUrl','http://www.nhs.uk/aboutNHSChoices/aboutnhschoices/termsandconditions/Pages/cookies-policy.aspx','WT.dl','121')" onkeypress="this.onclick()">Cookies policy</a></li>
<li><a href="http://www.nhs.uk/aboutNHSChoices/aboutnhschoices/Aboutus/Pages/LinkingtoChoices.aspx" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Site policies','DCSext.FooterClickUrl','http://www.nhs.uk/aboutNHSChoices/aboutnhschoices/Aboutus/Pages/LinkingtoChoices.aspx','WT.dl','121')" onkeypress="this.onclick()">Links policy</a></li>
<li><a href="http://www.nhs.uk/aboutNHSChoices/aboutnhschoices/Personalaccounts/Pages/NHSChoicesaccount.aspx" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Site policies','DCSext.FooterClickUrl','http://www.nhs.uk/aboutNHSChoices/aboutnhschoices/Personalaccounts/Pages/NHSChoicesaccount.aspx','WT.dl','121')" onkeypress="this.onclick()">Personal accounts</a></li>
<li><a href="http://www.nhs.uk/accessibility/Pages/Accessibility.aspx " 
    accesskey ="0"
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Site policies','DCSext.FooterClickUrl','http://www.nhs.uk/accessibility/Pages/Accessibility.aspx ','WT.dl','121')" onkeypress="this.onclick()">Accessibility </a></li>
<li><a href="http://www.nhs.uk/choices/pages/sitemap.aspx" 
    accesskey ="3"
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Site policies','DCSext.FooterClickUrl','http://www.nhs.uk/choices/pages/sitemap.aspx','WT.dl','121')" onkeypress="this.onclick()">Sitemap</a></li>
</ul>


</div><div id="ctl00_Footer_ucPersonalisationFooter_OtherNHSSites" class="footer-list">
	
<h2>Other NHS sites</h2>
<ul class="info">
<li><a href="http://www.chooseandbook.nhs.uk/" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Other NHS sites','DCSext.FooterClickUrl','http://www.chooseandbook.nhs.uk/','WT.dl','121')" onkeypress="this.onclick()">Choose and Book</a></li>
<li><a href="http://www.nhscarerecords.nhs.uk/" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Other NHS sites','DCSext.FooterClickUrl','http://www.nhscarerecords.nhs.uk/','WT.dl','121')" onkeypress="this.onclick()">Summary Care Records</a></li>
<li><a href="http://www.nhsdirect.nhs.uk/" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Other NHS sites','DCSext.FooterClickUrl','http://www.nhsdirect.nhs.uk/','WT.dl','121')" onkeypress="this.onclick()">NHS Direct</a></li>
<li><a href="http://www.show.scot.nhs.uk/ " 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Other NHS sites','DCSext.FooterClickUrl','http://www.show.scot.nhs.uk/ ','WT.dl','121')" onkeypress="this.onclick()">NHS Scotland</a></li>
<li><a href="http://www.hscni.net/  " 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Other NHS sites','DCSext.FooterClickUrl','http://www.hscni.net/  ','WT.dl','121')" onkeypress="this.onclick()">NHS Northern Ireland</a></li>
<li><a href="http://www.nhsdirect.wales.nhs.uk/" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Other NHS sites','DCSext.FooterClickUrl','http://www.nhsdirect.wales.nhs.uk/','WT.dl','121')" onkeypress="this.onclick()">NHS Wales</a></li>
<li><a href="http://www.nhscareers.nhs.uk/" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Other NHS sites','DCSext.FooterClickUrl','http://www.nhscareers.nhs.uk/','WT.dl','121')" onkeypress="this.onclick()">NHS Careers</a></li>
<li><a href="http://www.nhs.uk/aboutNHSChoices/professionals/innovationanddevelopment/Pages/training.aspx " 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Other NHS sites','DCSext.FooterClickUrl','http://www.nhs.uk/aboutNHSChoices/professionals/innovationanddevelopment/Pages/training.aspx ','WT.dl','121')" onkeypress="this.onclick()">NHS Choices Training</a></li>
<li><a href="http://www.dh.gov.uk/en/index.htm " 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Other NHS sites','DCSext.FooterClickUrl','http://www.dh.gov.uk/en/index.htm ','WT.dl','121')" onkeypress="this.onclick()">Department of Health</a></li>
</ul>


</div><div id="ctl00_Footer_ucPersonalisationFooter_AbouttheNHS" class="footer-list">
	
<h2>About the NHS</h2>
<ul class="info">
<li><a href="http://www.nhs.uk/NHSEngland/thenhs/nhshistory/Pages/NHShistory1948.aspx" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','About the NHS','DCSext.FooterClickUrl','http://www.nhs.uk/NHSEngland/thenhs/nhshistory/Pages/NHShistory1948.aspx','WT.dl','121')" onkeypress="this.onclick()">History of the NHS</a></li>
<li><a href="http://www.nhs.uk/NHSEngland/AboutNHSservices/Pages/NHSServices.aspx" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','About the NHS','DCSext.FooterClickUrl','http://www.nhs.uk/NHSEngland/AboutNHSservices/Pages/NHSServices.aspx','WT.dl','121')" onkeypress="this.onclick()">About NHS services</a></li>
<li><a href="http://www.nhs.uk/choiceinthenhs" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','About the NHS','DCSext.FooterClickUrl','http://www.nhs.uk/choiceinthenhs','WT.dl','121')" onkeypress="this.onclick()">Choice in the NHS</a></li>
<li><a href="http://www.nhs.uk/aboutNHSChoices/professionals/healthandcareprofessionals/quality-accounts/Pages/quality-accounts-2011-2012.aspx" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','About the NHS','DCSext.FooterClickUrl','http://www.nhs.uk/aboutNHSChoices/professionals/healthandcareprofessionals/quality-accounts/Pages/quality-accounts-2011-2012.aspx','WT.dl','121')" onkeypress="this.onclick()">Quality accounts</a></li>
<li><a href="http://www.nhs.uk/NHSEngland/thenhs/records/proms/Pages/aboutproms.aspx" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','About the NHS','DCSext.FooterClickUrl','http://www.nhs.uk/NHSEngland/thenhs/records/proms/Pages/aboutproms.aspx','WT.dl','121')" onkeypress="this.onclick()">PROMs</a></li>
<li><a href="http://www.nhs.uk/NHSEngland/links/Pages/links-make-it-happen.aspx" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','About the NHS','DCSext.FooterClickUrl','http://www.nhs.uk/NHSEngland/links/Pages/links-make-it-happen.aspx','WT.dl','121')" onkeypress="this.onclick()">Local Involvement Networks (LINks)</a></li>
<li><a href="http://www.nhs.uk/ServiceDirectories/Pages/AcuteTrustListing.aspx" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','About the NHS','DCSext.FooterClickUrl','http://www.nhs.uk/ServiceDirectories/Pages/AcuteTrustListing.aspx','WT.dl','121')" onkeypress="this.onclick()">Find authorities and trusts</a></li>
</ul>


</div><div id="ctl00_Footer_ucPersonalisationFooter_OtherChannels" class="footer-list">
	
<h2>Other channels</h2>
<ul class="info">
<li><a href="http://twitter.com/nhschoices" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Other channels','DCSext.FooterClickUrl','http://twitter.com/nhschoices','WT.dl','121')" onkeypress="this.onclick()">Follow us on Twitter</a></li>
<li><a href="http://www.facebook.com/nhschoices" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Other channels','DCSext.FooterClickUrl','http://www.facebook.com/nhschoices','WT.dl','121')" onkeypress="this.onclick()">Facebook</a></li>
<li><a href="http://www.youtube.com/nhschoices" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Other channels','DCSext.FooterClickUrl','http://www.youtube.com/nhschoices','WT.dl','121')" onkeypress="this.onclick()">YouTube</a></li>
<li><a href="http://www.nhs.uk/video/pages/MediaLibrary.aspx" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Other channels','DCSext.FooterClickUrl','http://www.nhs.uk/video/pages/MediaLibrary.aspx','WT.dl','121')" onkeypress="this.onclick()">Video library</a></li>
<li><a href="http://www.nhs.uk/Pages/LinkListing.aspx" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Other channels','DCSext.FooterClickUrl','http://www.nhs.uk/Pages/LinkListing.aspx','WT.dl','121')" onkeypress="this.onclick()">Links library</a></li>
</ul>


</div><div id="ctl00_Footer_ucPersonalisationFooter_Languages" class="footer-list">
	
<h2>Other Languages</h2>

<span class="language-intro">Visit our </span><span class="language-intro"><a href="http://www.nhs.uk/aboutNHSChoices/aboutnhschoices/Aboutus/Pages/languageshub.aspx " rel='nofollow' onkeypress="this.onclick()">language section</a> for more health websites in foreign languages.</span>

</div><div id="ctl00_Footer_ucPersonalisationFooter_Contact" class="footer-list">
	
<h2>Contact NHS Choices</h2>
<ul class="info">
<li><a href="http://www.nhs.uk/aboutNHSChoices/Pages/ContactUs.aspx" 
  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Contact NHS Choices','DCSext.FooterClickUrl','http://www.nhs.uk/aboutNHSChoices/Pages/ContactUs.aspx','WT.dl','121')" onkeypress="this.onclick()">Choices helpdesk</a></li>
</ul>


</div>
        </div>

        <!--
        <div id="footer-tab2" class="footer-tab2 footer-tab-content clear">
            <div id="ctl00_Footer_ucPersonalisationFooter_ChoicesENewsletters">
	
<div class="footer-wrap clear"><div class="footer-box-wrap">
<span class="crnr tl"></span><span class="crnr tr"></span>

<div class="footer-box-content clear">
<img src="http://www.nhs.uk/PublishingImages/PersonalisationModules/Modules/newsletterpromo.jpg" alt="$feature.FeatureMainImageAltText"/>
<h2>NHS Choices e-newsletters</h2>
<p>We're changing the sign-up process for our newsletters and can't accept new subscribers right now. The service will resume in the near future</p>
</div>

<div class="footer-box-button-wrap">
<div class="footer-box-button">
<span class="crnr tl"></span><span class="crnr tr"></span>
<p><span>NHS Choices e-newsletters</span> <a href="http://www.nhs.uk/aboutNHSChoices/aboutnhschoices/e-newsletters/Pages/newsletters-home.aspx"  rel='nofollow' onclick="dcsMultiTrack('DCSext.FooterClickSection','Choices e-newsletters','DCSext.FooterClickUrl','http://www.nhs.uk/aboutNHSChoices/aboutnhschoices/e-newsletters/Pages/newsletters-home.aspx','WT.dl','121')" onkeypress="this.onclick()"><span class="crnr tl"></span><span class="crnr tr"></span>NHS Choices e-newsletters<span class="crnr bl"></span><span class="crnr br"></span></a></p>
<span class="crnr bl"></span><span class="crnr br"></span>
</div>
</div>

<span class="crnr bl"></span><span class="crnr br"></span>
</div>

<div class="footer-col">
<h2>Emails from NHS Choices</h2>
<p>You can't sign up for our emails at the moment</p>

<ul>
</ul>
</div>

</div>


</div>
        </div>
        -->

        <div id="footer-tab3" class="footer-tab3 footer-tab-content clear">
            <div id="ctl00_Footer_ucPersonalisationFooter_PersonalisationFooterDefault1_YourPages">
	
<div class="footer-wrap your-pages clear">





<div class="footer-box-wrap">
<span class="crnr tl"></span><span class="crnr tr"></span>
<div class="footer-box-content clear">
<h2>Create an NHS Choices account</h2>
<p>With an account you can keep track of pages on the site and save them to this tab, which you can access on every page when you are logged in.</p>
<div class="footer-box-button-wrap clear">
<div class="footer-box-button clear">
<span class="crnr tl"></span><span class="crnr tr"></span>
<p><a href="http://www.nhs.uk/Personalisation/Registration.aspx?ReturnUrl=" onclick="dcsMultiTrack('DCSext.FooterClickSection','Your pages','DCSext.FooterClickUrl','http://www.nhs.uk/Personalisation/Registration.aspx?ReturnUrl=','WT.dl','121')" onkeypress="this.onclick()"><span class="crnr tl"></span><span class="crnr tr"></span>Create account<span class="crnr bl"></span><span class="crnr br"></span></a></p>
<span class="crnr bl"></span><span class="crnr br"></span>
</div>
</div>
<p class="footer-login">Already have an account? <a href="http://www.nhs.uk/Personalisation/Login.aspx">Log in</a></p>
</div>
<span class="crnr bl"></span><span class="crnr br"></span>
</div>









<div class="footer-col">
<ul>
<li>
<h3>Saved pages</h3>
<p>Keep track of important pages</p>
</li>
<li>
<h3>Recently visited pages</h3>
<p>Easily find again pages you have been reading</p>
</li>
<li class="last">
<h3>Pages you might like</h3>
<p>Have pages recommended to you</p>
</li>
</ul>
</div>


</div>
</div>
        </div>

        <div class="footer-logos clear">
            <ul>
                <li><span class="hidden">&ndash;</span><a href="http://www.gov.uk/"><img src="http://www.nhs.uk/img/gov-uk.gif" alt="Link to gov.uk &ndash; The new place to find government services and information" class="gov-uk"/></a></li>
                <li><span class="hidden">&ndash;</span><a href="http://www.nhs.uk/aboutNHSChoices/aboutnhschoices/Aboutus/Pages/the-information-standard.aspx"><img src="http://www.nhs.uk/img/information-standards.gif" alt="The Information Standard - Certified member"/></a></li>
            </ul>
        </div>

    </div>

<!--googleon: all-->
    <!-- Footer ends here.... -->

    <!-- Webtrends tracking link -->
    <noscript>
    <div><img style="border: 0; width: 1px; height: 1px;" alt="" src="http://statse.webtrendslive.com/dcss9yzisf9xjyg74mgbihg8p_8d2u/njs.gif?dcsuri=/nojavascript&amp;wt.js=no&amp;wt.tv=8.0.3"/></div>
    </noscript>
    







































































































<!-- Google Analytics testing in bau--> 
<script type="text/javascript">
    //<![CDATA[ 
    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    //]]>
</script> 
<script type="text/javascript">
    //<![CDATA[
    try {
        var pageTracker = _gat._getTracker("UA-9510975-1");
        pageTracker._trackPageview();
    }
    catch (err) { }
    //]]>
</script> 

        

    

<script type="text/javascript">
//<![CDATA[
var __wpmExportWarning='This Web Part Page has been personalized. As a result, one or more Web Part properties may contain confidential information. Make sure the properties contain information that is safe for others to read. After exporting this Web Part, view properties in the Web Part description file (.WebPart) by using a text editor such as Microsoft Notepad.';var __wpmCloseProviderWarning='You are about to close this Web Part.  It is currently providing data to other Web Parts, and these connections will be deleted if this Web Part is closed.  To close this Web Part, click OK.  To keep this Web Part, click Cancel.';var __wpmDeleteWarning='You are about to permanently delete this Web Part.  Are you sure you want to do this?  To delete this Web Part, click OK.  To keep this Web Part, click Cancel.';//]]>
</script>

<script type="text/javascript">
//<![CDATA[
Sys.Application.initialize();
//]]>
</script>
</form>
</div>
<?php require_once("nav.php");?>
</body>
</html><!-- Rendered using cache profile:NHS Choices Site Cache Profile at: 2013-01-10T12:32:49 -->