<?php
//require_once("../includes/session.php");
$root = "";
$page = "index_mob.php";
require_once("../self_assessments/includes/dbconnect.php");
if(isset($_REQUEST['asid'])){
	$tmp = explode("|",$_REQUEST['asid']);
	$asname = $tmp[0];
	$asid = $tmp[1];
}else{
	$asname = 'vte_assessment';
	$asid = '42';
}


?><html xmlns="http://www.w3.org/1999/xhtml" lang="en" style="height: 100%;"><head>

<title>Asthma - symptoms - NHS Choices</title>

<meta name="description" content="The symptoms of asthma (breathless, tight chest) can be mild to severe. When asthma symptoms get significantly worse, this is known as an asthma attack. ">
<meta name="keywords" content="National Health Service (NHS),Asthma">
<meta name="DC.title" content="Asthma - symptoms - NHS Choices">
<meta name="DC.description" content="The symptoms of asthma (breathless, tight chest) can be mild to severe. When asthma symptoms get significantly worse, this is known as an asthma attack. ">
<meta name="DC.subject" scheme="eGMS.IPSV" content="National Health Service (NHS),Asthma"> 
<meta name="DC.Subject" scheme="NHSC.Ontology" content="Asthma">
<meta name="DC.Subject" scheme="NHSC.Ontology" content="ID634">
<meta name="DC.date.issued" scheme="W3CDTF" content="2014-17-04">
<meta name="DC.coverage" content="England">
<meta name="DC.creator" content="NHS Choices">
<meta name="DC.format" scheme="IMT" content="text/html">
<meta name="DC.language" scheme="ISO 639-2/T" content="eng">
<meta name="DC.identifier" scheme="URI" content="http://www.nhs.uk">
<meta name="DC.publisher" content="Department of Health">
<meta name="DC.rights" content="http://www.nhs.uk/termsandconditions/Pages/TermsConditions.aspx">
<meta name="eGMS.accessibility" scheme="eGMS.WCAG10" content="Double-A">
<meta name="WT.ti" content="Asthma - symptoms - NHS Choices">
<meta http-equiv="pics-Label" content="(pics-1.1 &quot;http://www.icra.org/pics/vocabularyv03/&quot; l gen true for &quot;http://nhs.uk&quot; r (n 2 s 1 v 0 l 0 oa 0 ob 0 oc 0 od 0 oe 0 of 0 og 0 oh 0 c 1) gen true for &quot;http://www.nhs.uk&quot; r (n 2 s 1 v 0 l 0 oa 0 ob 0 oc 0 od 0 oe 0 of 0 og 0 oh 0 c 1))">

		<meta http-equiv="X-UA-Compatible" content="IE=8">
    
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="meta" href="http://nhs.uk/includes/labels.rdf" type="application/rdf+xml" title="ICRA labels"><!-- ICRA Labels link -->
<link rel="shortcut icon" href="http://nhs.uk/img/favicon.ico" type="image/vnd.microsoft.icon">


    <link rel="canonical" href="http://www.nhs.uk/Conditions/Asthma/Pages/Symptoms.aspx">


<script id="oas_dx_x30" async type="text/javascript" src="http://oascentral.fabricww.com/jp/www.nhs.uk/conditions/asthma/pages/symptoms.aspx/284826437/@x30?_RM_HTML_CALLBACK_=oas_tag.displayAds&amp;segment=1a&amp;segment=2a&amp;segment=3a&amp;segment=4c&amp;seed=29&amp;"></script><script type="text/javascript" async defer src="http://nhs.uk/dmp/js/data.js"></script><script type="text/javascript" src="http://nhs.uk/includes/jquery-1.7.1.min.js"></script><style type="text/css"></style>
<script type="text/javascript" src="http://nhs.uk/includes/jquery.bgiframe.min.js"></script>
<script type="text/javascript" src="http://nhs.uk/includes/jquery.cookie.js"></script>
<script type="text/javascript" src="http://nhs.uk/includes/jquery-ui-1.8.22.custom.min.js"></script>
<script type="text/javascript" src="http://nhs.uk/includes/swfobject.js"></script>
<script type="text/javascript" src="http://nhs.uk/includes/AC_RunActiveContent.js"></script>
<script type="text/javascript" src="http://nhs.uk//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script><link type="text/css" rel="stylesheet" charset="UTF-8" href="https://translate.googleapis.com/translate_static/css/translateelement.css"><script type="text/javascript" charset="UTF-8" src="https://translate.googleapis.com/translate_static/js/element/main.js"></script>
<script type="text/javascript" src="http://nhs.uk/includes/translate.js"></script>




<link rel="stylesheet" type="text/css" href="http://nhs.uk/css/base.css" media=" screen">
<link rel="stylesheet" type="text/css" href="http://nhs.uk/css/print.css" media="print">
<!--[if !IE]>-->
<style type="text/css">
@import url('http://nhs.uk/css/reset.css') screen;
@import url('http://nhs.uk/css/screen.css') screen;
@import url('http://nhs.uk/css/healthaz.css')screen;
</style>
<!--<![endif]-->
<!--[if IE 6]>
<link  rel="stylesheet" type="text/css" href="http://nhs.uk/css/reset-ie6.css" media="screen" />
<link  rel="stylesheet" type="text/css" href="http://nhs.uk/css/screen.css" media="screen" />
<link  rel="stylesheet" type="text/css" href="http://nhs.uk/css/healthaz.css" media="screen" />
<link  rel="stylesheet" type="text/css" href="http://nhs.uk/css/if-ie6.css" media="screen" />
<![endif]-->
<!--[if IE 7]>
<link  rel="stylesheet" type="text/css" href="http://nhs.uk/css/reset-ie7.css" media="screen" />
<link  rel="stylesheet" type="text/css" href="http://nhs.uk/css/screen.css" media="screen" />
<link  rel="stylesheet" type="text/css" href="http://nhs.uk/css/healthaz.css" media="screen" />
<link  rel="stylesheet" type="text/css" href="http://nhs.uk/css/if-ie7.css" media="screen" />
<![endif]-->
<!--[if IE 8]>
<link  rel="stylesheet" type="text/css" href="http://nhs.uk/css/reset-ie8.css" media="screen" />
<link  rel="stylesheet" type="text/css" href="http://nhs.uk/css/screen.css" media="screen" />
<link  rel="stylesheet" type="text/css" href="http://nhs.uk/css/healthaz.css" media="screen" />
<link  rel="stylesheet" type="text/css" href="http://nhs.uk/css/if-ie8.css" media="screen" />
<![endif]-->




<script type="text/javascript">
//<![CDATA[
function NhsUk_OnSubmit()
{
    var q=document.getElementById("q").value;
    return q!="" && q!="Place, postcode or organisation";
}
//]]>
</script><script type="text/javascript" charset="UTF-8" src="https://translate.googleapis.com/translate_static/js/element/23/element_main.js"></script>


    <script type="text/javascript" src="http://nhs.uk/includes/choices.js"></script>
    
<meta name="DCSext.RealUrl" content="/conditions/asthma/Pages/Symptoms.aspx">
<meta name="WT.cg_n" content="Treatments and Conditions">
<meta name="WT.cg_s" content="Asthma">
<meta name="DCSext.Server" content="NHC10WEB11PRP">
<meta name="WT.sv" content="NHC10WEB11PRP">
<meta name="DCSext.BM_Section1" content="Treatments and Conditions">
<meta name="DCSext.BM_Section2" content="Asthma">
<meta name="DCSext.BM_Section3" content="Symptoms">
<!-- Webtrends Javascript tag -->
<script type="text/javascript" src="http://nhs.uk/includes/sdc.js"></script>
<script type="text/javascript" src="http://nhs.uk/includes/jquery.webtrendslinkstracking.js"></script>
<script type="text/javascript">try{var _tag=new WebTrends();_tag.dcsGetId();}catch(e){}</script><script type="text/javascript" src="http://statse.webtrendslive.com/dcss9yzisf9xjyg74mgbihg8p_8d2u/wtid.js"></script>
<script type="text/javascript">try{_tag.dcsCollect();}catch(e){}</script>



<script type="text/javascript" src="http://nhs.uk/_layouts/1033/init.js?rev=w7H9f6YxfzEXRgXKUMfiTg%3D%3D"></script>
<script type="text/javascript" src="http://nhs.uk/_layouts/1033/msstring.js?rev=fcpiBo%2BQtJqYMECz%2BNiH7Q%3D%3D"></script>
<script type="text/javascript" src="http://nhs.uk/_layouts/1033/ie55up.js?rev=Ni7%2Fj2ZV%2FzCvd09XYSSWvA%3D%3D"></script>




<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0"></head>
<body class="mobile" style="position: relative; min-height: 100%; top: 0px;">



<div class="wrap wrap-webkit"><p class="go-desktop"><a href="#" class="mobile-nothanks">Desktop site</a></p>

    


    <!-- Header starts here.... -->
    
<!--googleoff: all-->
<ul>
    <li class="skip-link"><a href="#mainContent" accesskey="S"><span>Skip to main content</span></a></li>
    <li class="skip-link"><a href="#main-navigation" accesskey="N"><span>Skip to main navigation</span></a></li>
    <li class="skip-link"><a href="http://nhs.uk/accessibility/Pages/Accessibility.aspx"><span>Help with accessibility</span></a></li>
</ul>


<ul class="info-nav">	
    
            <li class="first">
                <a href="http://nhs.uk/Pages/HomePage.aspx" accesskey="1" onClick="dcsMultiTrack('DCSext.HeaderClickUrl','/Pages/HomePage.aspx','WT.dl','121')">Home</a>
            </li>
        
            <li>
                <a href="http://nhs.uk/aboutNHSChoices/Pages/AboutNHSChoices.aspx" onClick="dcsMultiTrack('DCSext.HeaderClickUrl','/aboutNHSChoices/Pages/AboutNHSChoices.aspx','WT.dl','121')">About</a>
            </li>
        
            <li>
                <a href="http://nhs.uk/aboutNHSChoices/Pages/ContactUs.aspx" accesskey="9" onClick="dcsMultiTrack('DCSext.HeaderClickUrl','/aboutNHSChoices/Pages/ContactUs.aspx','WT.dl','121')">Contact</a>
            </li>
        
            <li>
                <a href="http://nhs.uk/tools/pages/toolslibrary.aspx" onClick="dcsMultiTrack('DCSext.HeaderClickUrl','/tools/pages/toolslibrary.aspx','WT.dl','121')">Tools</a>
            </li>
        
            <li>
                <a href="http://nhs.uk/video/pages/MediaLibrary.aspx" onClick="dcsMultiTrack('DCSext.HeaderClickUrl','/video/pages/MediaLibrary.aspx','WT.dl','121')">Video</a>
            </li>
        
            <li>
                <a href="http://www.chooseandbook.nhs.uk/" onClick="dcsMultiTrack('DCSext.HeaderClickUrl','http://www.chooseandbook.nhs.uk/','WT.dl','121')">Choose and Book</a>
            </li>
        
            <li>
                <a href="http://www.healthunlocked.com/nhschoices/" onClick="dcsMultiTrack('DCSext.HeaderClickUrl','http://www.healthunlocked.com/nhschoices/','WT.dl','121')">Communities</a>
            </li>
        
            <li class="last">
                <a href="http://nhs.uk/ipg/Pages/IPStart.aspx" onClick="dcsMultiTrack('DCSext.HeaderClickUrl','/ipg/Pages/IPStart.aspx','WT.dl','121')">IPS</a>
            </li>
        	    
</ul>


        <div class="tab-login anonymous-login"> 
        <ul class="translate"> 
            <li class="translate-item"><div id="google_translate_element"><div class="skiptranslate goog-te-gadget" dir="ltr"><div id=":0.targetLanguage" class="goog-te-gadget-simple" style="white-space: nowrap;"><span style="vertical-align: middle;"><a class="goog-te-menu-value" href="javascript:void(0)"><span onClick="amendLanguagesDisplay();return false;" class="translate-text">Translate</span></a></span></div></div></div></li>
        </ul>
    <ul class="personal-header clear">
        <li class="logged-out"><span class="crnr tl"></span><a onClick="dcsMultiTrack('DCSext.HeaderClickUrl','/Personalisation/Login.aspx','WT.dl','121')" href="http://nhs.uk/Personalisation/Login.aspx">Log in</a>&nbsp;or</li>
        <li class="create-account"><a href="http://nhs.uk/Personalisation/Registration.aspx?ReturnUrl=http%3a%2f%2fwww.nhs.uk%2fConditions%2fAsthma%2fPages%2fSymptoms.aspx" id="ctl00_Header_ucPersonalisationHeader_CreateAccount" onClick="dcsMultiTrack('DCSext.HeaderClickUrl',this.text,'WT.dl','121')">create an account</a><span class="crnr tr"></span></li>
    </ul>
  </div>
    




<div class="header">
  <span class="crnr tl"></span>
  <div class="heading">
    
      <p class="choices-logo"><a href="http://nhs.uk/" title="Go to NHS Choices homepage"><img src="http://nhs.uk/img/header/choices-logo.gif" alt="Go to NHS Choices homepage" width="212" height="35"></a><span>Your health, your choices</span></p>
     
  </div>
  
  <p class="hidden"><strong>Information navigation</strong></p>
  <div class="searchbar"><div class="mobile-nav"><span class="mobile-menu">MENU</span> <a href="#mobile-nav"><span class="mobile-bar"></span><span class="mobile-bar"></span><span class="mobile-bar"></span></a></div>
    <form id="gs" method="get" action="/Search/Pages/Results.aspx" onSubmit="return NhsUk_OnSubmit();"><input type="hidden" name="___JSSniffer" id="___JSSniffer" value="true">
      <fieldset>
        <legend class="hidden">Search entire site</legend>	
          <div class="search-inner" id="IdSearchBoxContainer">
              <div><span class="crnr tl"></span><span class="crnr tr"></span></div>
              <div id="search-results-container">
                  <label for="q"><span class="hidden">Enter a search term: </span><input id="q" name="q" type="text" value="Enter a search term" accesskey="4" maxlength="500" autocomplete="off"></label>
              </div>
              <div class="submit-container">
                  <div><span class="crnr tl"></span><span class="crnr tr"></span></div>
                  <div class="submit">
                      <div><span class="crnr tl"></span><span class="crnr tr"></span></div>
                      <input type="submit" value="Search">
                      <div><span class="crnr bl"></span><span class="crnr br"></span></div>
                  </div>
                  <div><span class="crnr bl"></span><span class="crnr br"></span></div>
              </div>
              <span class="crnr bl"></span><span class="crnr br"></span>
          </div>
      </fieldset>
    </form>
    <script type="text/javascript" src="http://nhs.uk/includes/PredictiveTextSearch.js"></script>
    <script type="text/javascript">
    //<![CDATA[
    //<!--
    $(document).ready(function() {
    $.ajaxSetup({cache: false});
    SetupPredictiveSearch("/NHSChoices/Handlers/Search.ashx", $("#q"), $("#search-results-container"),10)});
    // -->
    //]]>
    </script> 
  </div>

  <div class="main-nav clear" id="main-navigation">
    <p class="hidden"><strong>Main navigation</strong></p>    
    <div id="ctl00_Header_mainNavigation">
	<ul><li class="health-az active" id="health-az-topnav"><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Conditions/Pages/hub.aspx','WT.dl','121')" href="http://nhs.uk/Conditions/Pages/hub.aspx"> Health A-Z</a><div><ul><li class="first"><span>Hundreds of conditions explained</span></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Conditions/Arthritis','WT.dl','121')" href="http://nhs.uk/Conditions/Arthritis">Arthritis<span class="hidden"> information</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/conditions/asthma','WT.dl','121')" href="http://nhs.uk/conditions/asthma">Asthma<span class="hidden"> information</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Conditions/Back-pain','WT.dl','121')" href="http://nhs.uk/Conditions/Back-pain">Back pain<span class="hidden"> information</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Conditions/stress-anxiety-depression/Pages/low-mood-stress-anxiety.aspx','WT.dl','121')" href="http://nhs.uk/Conditions/stress-anxiety-depression/Pages/low-mood-stress-anxiety.aspx">Stress, anxiety, depression<span class="hidden"> information</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Conditions/Cancer-of-the-breast-female','WT.dl','121')" href="http://nhs.uk/Conditions/Cancer-of-the-breast-female">Breast cancer<span class="hidden"> information</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Conditions/pregnancy-and-baby/pages/pregnancy-and-baby-care.aspx','WT.dl','121')" href="http://nhs.uk/Conditions/pregnancy-and-baby/pages/pregnancy-and-baby-care.aspx">Pregnancy and baby<span class="hidden"> information</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Conditions/Diabetes-type2','WT.dl','121')" href="http://nhs.uk/Conditions/Diabetes-type2">Diabetes<span class="hidden"> information</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Conditions/dementia-guide/Pages/about-dementia.aspx','WT.dl','121')" href="http://nhs.uk/Conditions/dementia-guide/Pages/about-dementia.aspx">Dementia<span class="hidden"> information</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Conditions/Coronary-heart-disease','WT.dl','121')" href="http://nhs.uk/Conditions/Coronary-heart-disease">Heart disease<span class="hidden"> information</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/conditions/measles','WT.dl','121')" href="http://nhs.uk/conditions/measles">Measles<span class="hidden"> information</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/conditions/flu/Pages/Introduction.aspx','WT.dl','121')" href="http://nhs.uk/conditions/flu/Pages/Introduction.aspx">Flu<span class="hidden"> information</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Conditions/vaccinations/Pages/vaccination-schedule-age-checklist.aspx','WT.dl','121')" href="http://nhs.uk/Conditions/vaccinations/Pages/vaccination-schedule-age-checklist.aspx">Vaccinations<span class="hidden"> information</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/conditions/online-clinics/Pages/Online-clinics-introduction.aspx','WT.dl','121')" href="http://nhs.uk/conditions/online-clinics/Pages/Online-clinics-introduction.aspx">Online clinics<span class="hidden"> information</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/CHQ/Pages/home.aspx','WT.dl','121')" href="http://nhs.uk/CHQ/Pages/home.aspx"> Common health questions</a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/symptomcheckers/pages/symptoms.aspx','WT.dl','121')" href="http://nhs.uk/symptomcheckers/pages/symptoms.aspx"> Symptom checkers</a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/medicine-guides/pages/default.aspx','WT.dl','121')" href="http://nhs.uk/medicine-guides/pages/default.aspx"> Medicines A-Z</a></li><li class="last bold"><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Conditions/Pages/BodyMap.aspx?Index=A','WT.dl','121')" href="http://nhs.uk/Conditions/Pages/BodyMap.aspx?Index=A"> All A-Z topics</a></li></ul></div></li><li class="livewell" id="livewell-topnav"><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/livewell/Pages/Livewellhub.aspx','WT.dl','121')" href="http://nhs.uk/livewell/Pages/Livewellhub.aspx"> Live Well</a><div><ul><li class="first"><span>Over 100 topics on healthy living</span></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Livewell/alcohol','WT.dl','121')" href="http://nhs.uk/Livewell/alcohol">Alcohol<span class="hidden"> articles</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/LiveWell/c25k/Pages/couch-to-5k.aspx','WT.dl','121')" href="http://nhs.uk/LiveWell/c25k/Pages/couch-to-5k.aspx">Couch to 5K<span class="hidden"> articles</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/livewell/dentalhealth','WT.dl','121')" href="http://nhs.uk/livewell/dentalhealth">Teeth and dentistry<span class="hidden"> articles</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/livewell/fitness','WT.dl','121')" href="http://nhs.uk/livewell/fitness">Fitness<span class="hidden"> articles</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/livewell/winterhealth/pages/fluandthefluvaccine.aspx','WT.dl','121')" href="http://nhs.uk/livewell/winterhealth/pages/fluandthefluvaccine.aspx">The flu jab<span class="hidden"> articles</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/livewell/healthy-eating','WT.dl','121')" href="http://nhs.uk/livewell/healthy-eating">Healthy eating<span class="hidden"> articles</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/livewell/loseweight','WT.dl','121')" href="http://nhs.uk/livewell/loseweight">Lose weight<span class="hidden"> articles</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/livewell/mentalhealth','WT.dl','121')" href="http://nhs.uk/livewell/mentalhealth">Mental health<span class="hidden"> articles</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Livewell/Pain/Pages/Painhome.aspx','WT.dl','121')" href="http://nhs.uk/Livewell/Pain/Pages/Painhome.aspx">Pain<span class="hidden"> articles</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/livewell/sexualhealth','WT.dl','121')" href="http://nhs.uk/livewell/sexualhealth">Sexual health<span class="hidden"> articles</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/LiveWell/sleep/Pages/sleep-home.aspx','WT.dl','121')" href="http://nhs.uk/LiveWell/sleep/Pages/sleep-home.aspx">Sleep<span class="hidden"> articles</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/livewell/smoking','WT.dl','121')" href="http://nhs.uk/livewell/smoking">Stop smoking<span class="hidden"> articles</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/livewell/tiredness-and-fatigue','WT.dl','121')" href="http://nhs.uk/livewell/tiredness-and-fatigue">Tiredness<span class="hidden"> articles</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/tools/pages/toolslibrary.aspx','WT.dl','121')" href="http://nhs.uk/tools/pages/toolslibrary.aspx"> Health check tools</a></li><li class="last bold"><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/livewell/pages/topics.aspx','WT.dl','121')" href="http://nhs.uk/livewell/pages/topics.aspx"> All Live Well topics</a></li></ul></div></li><li class="carers" id="carers-topnav"><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/CarersDirect/Pages/CarersDirectHome.aspx','WT.dl','121')" href="http://nhs.uk/CarersDirect/Pages/CarersDirectHome.aspx"> Care and support</a><div><ul><li class="first"><span>Your essential guide to social care</span></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/CarersDirect/social-care/Pages/what-is-social-care.aspx','WT.dl','121')" href="http://nhs.uk/CarersDirect/social-care/Pages/what-is-social-care.aspx"> About social care</a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/CarersDirect/social-care/Pages/choosing-care.aspx','WT.dl','121')" href="http://nhs.uk/CarersDirect/social-care/Pages/choosing-care.aspx"> Choosing care services</a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/CarersDirect/guide/assessments/Pages/Overview.aspx','WT.dl','121')" href="http://nhs.uk/CarersDirect/guide/assessments/Pages/Overview.aspx"> Social care assessments</a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/CarersDirect/guide/practicalsupport/Pages/NHSContinuingCare.aspx','WT.dl','121')" href="http://nhs.uk/CarersDirect/guide/practicalsupport/Pages/NHSContinuingCare.aspx"> NHS continuing care</a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/CarersDirect/moneyandlegal/legal/Pages/MentalCapacityAct.aspx','WT.dl','121')" href="http://nhs.uk/CarersDirect/moneyandlegal/legal/Pages/MentalCapacityAct.aspx"> Mental capacity</a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/CarersDirect/yourself','WT.dl','121')" href="http://nhs.uk/CarersDirect/yourself"> Carers’ wellbeing</a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/CarersDirect/guide/practicalsupport/Pages/Homecare.aspx','WT.dl','121')" href="http://nhs.uk/CarersDirect/guide/practicalsupport/Pages/Homecare.aspx"> Home care</a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/CarersDirect/guide/practicalsupport/Pages/Carehomes.aspx','WT.dl','121')" href="http://nhs.uk/CarersDirect/guide/practicalsupport/Pages/Carehomes.aspx"> Care homes</a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/CarersDirect/yourself/timeoff/Pages/Accessingrespitecare.aspx','WT.dl','121')" href="http://nhs.uk/CarersDirect/yourself/timeoff/Pages/Accessingrespitecare.aspx"> Breaks from caring</a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/CarersDirect/guide/rights/Pages/carers-rights.aspx','WT.dl','121')" href="http://nhs.uk/CarersDirect/guide/rights/Pages/carers-rights.aspx"> Carers’ rights</a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/CarersDirect/young/young/Pages/Overview.aspx','WT.dl','121')" href="http://nhs.uk/CarersDirect/young/young/Pages/Overview.aspx"> Young carers</a></li><li class="bold"><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/carersdirect/','WT.dl','121')" href="http://nhs.uk/carersdirect/"> All care and support topics</a></li></ul></div></li><li class="news" id="news-topnav"><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/News/Pages/NewsIndex.aspx','WT.dl','121')" href="http://nhs.uk/News/Pages/NewsIndex.aspx"> Health news</a><div><ul><li class="first"><span>Health news stories unspun</span></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/news/pages/newsarticles.aspx?TopicId=Food%2fdiet','WT.dl','121')" href="http://nhs.uk/news/pages/newsarticles.aspx?TopicId=Food%2fdiet">Diet and nutrition<span class="hidden"> news reports</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/news/pages/newsarticles.aspx?TopicId=Obesity','WT.dl','121')" href="http://nhs.uk/news/pages/newsarticles.aspx?TopicId=Obesity">Obesity and weight loss<span class="hidden"> news reports</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/news/pages/newsarticles.aspx?TopicId=Neurology','WT.dl','121')" href="http://nhs.uk/news/pages/newsarticles.aspx?TopicId=Neurology">Neurology and dementia<span class="hidden"> news reports</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/news/pages/newsarticles.aspx?TopicId=Lifestyle%2fexercise','WT.dl','121')" href="http://nhs.uk/news/pages/newsarticles.aspx?TopicId=Lifestyle%2fexercise">Lifestyle and environment<span class="hidden"> news reports</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/news/pages/newsarticles.aspx?TopicId=Pregnancy%2fchild','WT.dl','121')" href="http://nhs.uk/news/pages/newsarticles.aspx?TopicId=Pregnancy%2fchild">Pregnancy and children<span class="hidden"> news reports</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/news/pages/newsarticles.aspx?TopicId=Cancer','WT.dl','121')" href="http://nhs.uk/news/pages/newsarticles.aspx?TopicId=Cancer">Cancer<span class="hidden"> news reports</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/news/pages/newsarticles.aspx?TopicId=Medication','WT.dl','121')" href="http://nhs.uk/news/pages/newsarticles.aspx?TopicId=Medication">Drugs and vaccines<span class="hidden"> news reports</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/news/pages/newsarticles.aspx?TopicId=Heart%2flungs','WT.dl','121')" href="http://nhs.uk/news/pages/newsarticles.aspx?TopicId=Heart%2flungs">Heart and lungs<span class="hidden"> news reports</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/news/pages/newsarticles.aspx?TopicId=Medical+practice','WT.dl','121')" href="http://nhs.uk/news/pages/newsarticles.aspx?TopicId=Medical+practice">Medical practice<span class="hidden"> news reports</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/news/pages/newsarticles.aspx?TopicId=Older+people','WT.dl','121')" href="http://nhs.uk/news/pages/newsarticles.aspx?TopicId=Older+people">Older people and ageing<span class="hidden"> news reports</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/news/pages/newsarticles.aspx?TopicId=Genetics%2fstem+cells','WT.dl','121')" href="http://nhs.uk/news/pages/newsarticles.aspx?TopicId=Genetics%2fstem+cells">Genetics and stem cells<span class="hidden">  news reports</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/news/pages/newsarticles.aspx?TopicId=Mental+health','WT.dl','121')" href="http://nhs.uk/news/pages/newsarticles.aspx?TopicId=Mental+health">Mental health<span class="hidden"> news reports</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/news/pages/newsarticles.aspx?TopicId=Diabetes','WT.dl','121')" href="http://nhs.uk/news/pages/newsarticles.aspx?TopicId=Diabetes">Diabetes<span class="hidden"> news reports</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/news/pages/newsarticles.aspx?TopicID=QA+articles','WT.dl','121')" href="http://nhs.uk/news/pages/newsarticles.aspx?TopicID=QA+articles"> Topical questions and answers</a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/news/pages/newsarticles.aspx?TopicId=Special+reports','WT.dl','121')" href="http://nhs.uk/news/pages/newsarticles.aspx?TopicId=Special+reports"> Special reports</a></li><li class="bold"><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/news','WT.dl','121')" href="http://nhs.uk/news"> All Behind the Headlines news</a></li></ul></div></li><li class="find-services" id="find-services-topnav"><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/service-search','WT.dl','121')" href="http://nhs.uk/service-search"> Services near you</a><div><ul><li class="topnav-first"><p class="topnav-image"><img src="http://nhs.uk/img/header/its-your-choice.gif" alt=" its your choice"></p><p class="topnav-heading">Don't miss out ...</p><p>Exercise your right to choice in the NHS</p>
<p class="topnav-link"><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/choiceinthenhs/Pages/choicehome.aspx','WT.dl','121')" href="http://nhs.uk/choiceinthenhs/Pages/choicehome.aspx"> Learn about patient choice now</a></p></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Service-Search/Accident-and-emergency-services/LocationSearch/428','WT.dl','121')" href="http://nhs.uk/Service-Search/Accident-and-emergency-services/LocationSearch/428">A&amp;E<span class="hidden"> search</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Service-Search/Hospital/LocationSearch/7/Hospitals','WT.dl','121')" href="http://nhs.uk/Service-Search/Hospital/LocationSearch/7/Hospitals">Hospitals<span class="hidden"> search</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Service-Search/GP/LocationSearch/4','WT.dl','121')" href="http://nhs.uk/Service-Search/GP/LocationSearch/4">GPs<span class="hidden"> search</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Service-Search/Dentist/LocationSearch/3','WT.dl','121')" href="http://nhs.uk/Service-Search/Dentist/LocationSearch/3">Dentists<span class="hidden">search</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Service-Search/Pharmacy/LocationSearch/10','WT.dl','121')" href="http://nhs.uk/Service-Search/Pharmacy/LocationSearch/10">Pharmacies<span class="hidden"> search</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Service-Search/Care-homes-and-care-at-home/LocationSearch/11','WT.dl','121')" href="http://nhs.uk/Service-Search/Care-homes-and-care-at-home/LocationSearch/11">Care homes and care at home<span class="hidden"> search</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Service-Search/Alcohol-addiction/LocationSearch/1805','WT.dl','121')" href="http://nhs.uk/Service-Search/Alcohol-addiction/LocationSearch/1805">Alcohol<span class="hidden"> search</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Service-Search/Maternity-service/LocationSearch/1802','WT.dl','121')" href="http://nhs.uk/Service-Search/Maternity-service/LocationSearch/1802">Maternity<span class="hidden"> search</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Service-Search/Hospital/LocationSearch/7/Consultants','WT.dl','121')" href="http://nhs.uk/Service-Search/Hospital/LocationSearch/7/Consultants">Consultants<span class="hidden"> search</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Service-Search/Optician/LocationSearch/9','WT.dl','121')" href="http://nhs.uk/Service-Search/Optician/LocationSearch/9">Opticians<span class="hidden"> search</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Service-Search/Sexual-health-services/LocationSearch/1847','WT.dl','121')" href="http://nhs.uk/Service-Search/Sexual-health-services/LocationSearch/1847">Sexual health<span class="hidden"> search</span></a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Service-Search/Stop-smoking-services/LocationSearch/1846','WT.dl','121')" href="http://nhs.uk/Service-Search/Stop-smoking-services/LocationSearch/1846">Stop smoking services</a></li><li><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Service-Search/Urgent-Care/LocationSearch/0','WT.dl','121')" href="http://nhs.uk/Service-Search/Urgent-Care/LocationSearch/0">Urgent care services</a></li><li class="last bold"><a onClick="dcsMultiTrack('DCSext.HeaderMenuUrlClicked','/Service-Search/Services','WT.dl','121')" href="http://nhs.uk/Service-Search/Services"> All directories</a></li></ul></div></li></ul>
</div><div id="ctl00_Header_onlineSurveyInjector" class="survey">

</div>

  </div>
  
</div>
<div id="mainContent"></div>


    <!-- Header ends here.... -->

    <form method="post" action="Symptoms.aspx" onSubmit="javascript:return WebForm_OnSubmit();" id="aspnetForm"><input type="hidden" name="___JSSniffer" id="___JSSniffer" value="true">
<div>
<input type="hidden" name="__SPSCEditMenu" id="__SPSCEditMenu" value="true">
<input type="hidden" name="MSOWebPartPage_PostbackSource" id="MSOWebPartPage_PostbackSource" value="">
<input type="hidden" name="MSOTlPn_SelectedWpId" id="MSOTlPn_SelectedWpId" value="">
<input type="hidden" name="MSOTlPn_View" id="MSOTlPn_View" value="0">
<input type="hidden" name="MSOTlPn_ShowSettings" id="MSOTlPn_ShowSettings" value="False">
<input type="hidden" name="MSOGallery_SelectedLibrary" id="MSOGallery_SelectedLibrary" value="">
<input type="hidden" name="MSOGallery_FilterString" id="MSOGallery_FilterString" value="">
<input type="hidden" name="MSOTlPn_Button" id="MSOTlPn_Button" value="none">
<input type="hidden" name="MSOAuthoringConsole_FormContext" id="MSOAuthoringConsole_FormContext" value="">
<input type="hidden" name="MSOAC_EditDuringWorkflow" id="MSOAC_EditDuringWorkflow" value="">
<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="">
<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="">
<input type="hidden" name="__REQUESTDIGEST" id="__REQUESTDIGEST" value="0x04C4A172075A07AD473355B05F21D20E702DC33E8892C92A0260CD7B8B0A8854982B2E1937155AB12D26D2B64CFEFBD7C2026F3226B866CD5747B932C0D6F4B8,23 Apr 2014 08:54:58 -0000">
<input type="hidden" name="MSOSPWebPartManager_DisplayModeName" id="MSOSPWebPartManager_DisplayModeName" value="Browse">
<input type="hidden" name="MSOWebPartPage_Shared" id="MSOWebPartPage_Shared" value="">
<input type="hidden" name="MSOLayout_LayoutChanges" id="MSOLayout_LayoutChanges" value="">
<input type="hidden" name="MSOLayout_InDesignMode" id="MSOLayout_InDesignMode" value="">
<input type="hidden" name="MSOSPWebPartManager_OldDisplayModeName" id="MSOSPWebPartManager_OldDisplayModeName" value="Browse">
<input type="hidden" name="MSOSPWebPartManager_StartWebPartEditingName" id="MSOSPWebPartManager_StartWebPartEditingName" value="false">
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUBMBBkZBYCZg9kFgYCBw9kFgQCAQ9kFgICAg8PFgIeB1Zpc2libGVnFgIeBXN0eWxlBQ5kaXNwbGF5OmJsb2NrO2QCAw9kFgQCAQ8PFgIfAGhkFgICAQ8WAh8AaBYCZg9kFgQCAg9kFgICAw8WAh8AaGQCAw8PFgIeCUFjY2Vzc0tleQUBL2RkAgMPDxYCHwBoZBYEAgEPDxYCHwBoZGQCAw8PFgIfAGhkFgICAQ8PFgIfAGdkFgQCAQ8PFgIfAGhkFhwCAQ8PFgIfAGhkZAIDDxYCHwBoZAIFDw8WAh8AaGRkAgcPFgIfAGhkAgkPDxYCHwBoZGQCCw8PFgIfAGhkZAINDw8WAh8AaGRkAg8PDxYEHgdFbmFibGVkaB8AaGRkAhEPDxYCHwBoZGQCEw8PFgQfA2gfAGhkZAIVDw8WAh8AaGRkAhcPFgIfAGhkAhkPFgIfAGhkAhsPDxYCHwBnZGQCAw8PFgIfAGdkFgYCAQ8PFgIfAGdkZAIDDw8WAh8AZ2RkAgUPDxYCHwBnZGQCCA9kFgJmD2QWAmYPZBYGZg9kFgICAQ8WAh4LXyFJdGVtQ291bnQCCBYQZg9kFgJmDxUFDiBjbGFzcz0iZmlyc3QiFC9QYWdlcy9Ib21lUGFnZS5hc3B4DiBhY2Nlc3NrZXk9IjEiFC9QYWdlcy9Ib21lUGFnZS5hc3B4BEhvbWVkAgEPZBYCZg8VBQArL2Fib3V0TkhTQ2hvaWNlcy9QYWdlcy9BYm91dE5IU0Nob2ljZXMuYXNweAArL2Fib3V0TkhTQ2hvaWNlcy9QYWdlcy9BYm91dE5IU0Nob2ljZXMuYXNweAVBYm91dGQCAg9kFgJmDxUFACUvYWJvdXROSFNDaG9pY2VzL1BhZ2VzL0NvbnRhY3RVcy5hc3B4DiBhY2Nlc3NrZXk9IjkiJS9hYm91dE5IU0Nob2ljZXMvUGFnZXMvQ29udGFjdFVzLmFzcHgHQ29udGFjdGQCAw9kFgJmDxUFAB4vdG9vbHMvcGFnZXMvdG9vbHNsaWJyYXJ5LmFzcHgAHi90b29scy9wYWdlcy90b29sc2xpYnJhcnkuYXNweAVUb29sc2QCBA9kFgJmDxUFAB4vdmlkZW8vcGFnZXMvTWVkaWFMaWJyYXJ5LmFzcHgAHi92aWRlby9wYWdlcy9NZWRpYUxpYnJhcnkuYXNweAVWaWRlb2QCBQ9kFgJmDxUFACBodHRwOi8vd3d3LmNob29zZWFuZGJvb2submhzLnVrLwAgaHR0cDovL3d3dy5jaG9vc2VhbmRib29rLm5ocy51ay8PQ2hvb3NlIGFuZCBCb29rZAIGD2QWAmYPFQUAKWh0dHA6Ly93d3cuaGVhbHRodW5sb2NrZWQuY29tL25oc2Nob2ljZXMvAClodHRwOi8vd3d3LmhlYWx0aHVubG9ja2VkLmNvbS9uaHNjaG9pY2VzLwtDb21tdW5pdGllc2QCBw9kFgJmDxUFDSBjbGFzcz0ibGFzdCIXL2lwZy9QYWdlcy9JUFN0YXJ0LmFzcHgAFy9pcGcvUGFnZXMvSVBTdGFydC5hc3B4A0lQU2QCAg9kFgICAg8WAh4EaHJlZgVyL1BlcnNvbmFsaXNhdGlvbi9SZWdpc3RyYXRpb24uYXNweD9SZXR1cm5Vcmw9aHR0cCUzYSUyZiUyZnd3dy5uaHMudWslMmZDb25kaXRpb25zJTJmQXN0aG1hJTJmUGFnZXMlMmZTeW1wdG9tcy5hc3B4ZAIEDxYCHwBoZAIJD2QWBAIMD2QWKgIBD2QWBgICDxYCHwBoZAIEDxYCHhNQcmV2aW91c0NvbnRyb2xNb2RlCymIAU1pY3Jvc29mdC5TaGFyZVBvaW50LldlYkNvbnRyb2xzLlNQQ29udHJvbE1vZGUsIE1pY3Jvc29mdC5TaGFyZVBvaW50LCBWZXJzaW9uPTEyLjAuMC4wLCBDdWx0dXJlPW5ldXRyYWwsIFB1YmxpY0tleVRva2VuPTcxZTliY2UxMTFlOTQyOWMBZAIGDxYCHwBnFgJmD2QWDgIBDxYCHwUF5AFtYWlsdG86P3N1YmplY3Q9QXN0aG1hIC0gU3ltcHRvbXMmYW1wO2JvZHk9SSByZWFkIHRoaXMgb24gdGhlIE5IUyBDaG9pY2VzIChodHRwOi8vd3d3Lm5ocy51aykgd2Vic2l0ZSBhbmQgdGhvdWdodCB5b3Ugc2hvdWxkIHJlYWQgaXQgdG9vOg0KIGh0dHAlM2ElMmYlMmZ3d3cubmhzLnVrJTJmQ29uZGl0aW9ucyUyZkFzdGhtYSUyZlBhZ2VzJTJmU3ltcHRvbXMuYXNweCZhbXA7V1QubWNfaWQ9MjA0MTFkAgIPFQQRQXN0aG1hKy0rU3ltcHRvbXNFaHR0cCUzYSUyZiUyZnd3dy5uaHMudWslMmZDb25kaXRpb25zJTJmQXN0aG1hJTJmUGFnZXMlMmZTeW1wdG9tcy5hc3B4RWh0dHAlM2ElMmYlMmZ3d3cubmhzLnVrJTJmQ29uZGl0aW9ucyUyZkFzdGhtYSUyZlBhZ2VzJTJmU3ltcHRvbXMuYXNweBFBc3RobWErLStTeW1wdG9tc2QCAw9kFgRmDxUCRWh0dHAlM2ElMmYlMmZ3d3cubmhzLnVrJTJmQ29uZGl0aW9ucyUyZkFzdGhtYSUyZlBhZ2VzJTJmU3ltcHRvbXMuYXNweBFBc3RobWErLStTeW1wdG9tc2QCAQ9kFgICAQ8WAh8FBTkvQ29uZGl0aW9ucy9Bc3RobWEvUGFnZXMvU3ltcHRvbXMuYXNweD9zYXZlZmF2b3VyaXRlPXRydWVkAgUPFgIfAGhkAgcPZBYCAgEPZBYCZg9kFgICAQ8WAh4FY2xhc3MFFHByaW50YWJsZS12ZXJzaW9uIGlwZAIJDxYCHwBoZAILDxYCHwBoFgICAQ9kFhYCAQ9kFgICAQ9kFgJmD2QWAmYPFQEJQmFzZWQgb24gZAIDD2QWAmYPZBYEZg8VAWFjdGwwMF9QbGFjZUhvbGRlck1haW5faGVhZGVyY29udHJvbF9oZWFsdGhBWkhlYWRlckJvb2ttYXJrX1JhdGluZ3NfRml2ZVN0YXJSYXRpbmdfUmF0aW5nU2VsZWN0b3JzZAIBDxAWBB4IZGlzYWJsZWQFCGRpc2FibGVkHgtfIURhdGFCb3VuZGdkFCsBAQIEZAIFD2QWAmYPZBYEZg8VAWFjdGwwMF9QbGFjZUhvbGRlck1haW5faGVhZGVyY29udHJvbF9oZWFsdGhBWkhlYWRlckJvb2ttYXJrX1JhdGluZ3NfRm91clN0YXJSYXRpbmdfUmF0aW5nU2VsZWN0b3JzZAIBDxAWBB8IBQhkaXNhYmxlZB8JZ2QUKwEBAgNkAgcPZBYCZg9kFgRmDxUBYmN0bDAwX1BsYWNlSG9sZGVyTWFpbl9oZWFkZXJjb250cm9sX2hlYWx0aEFaSGVhZGVyQm9va21hcmtfUmF0aW5nc19UaHJlZVN0YXJSYXRpbmdfUmF0aW5nU2VsZWN0b3JzZAIBDxAWBB8IBQhkaXNhYmxlZB8JZ2QUKwEBAgJkAgkPZBYCZg9kFgRmDxUBYGN0bDAwX1BsYWNlSG9sZGVyTWFpbl9oZWFkZXJjb250cm9sX2hlYWx0aEFaSGVhZGVyQm9va21hcmtfUmF0aW5nc19Ud29TdGFyUmF0aW5nX1JhdGluZ1NlbGVjdG9yc2QCAQ8QFgQfCAUIZGlzYWJsZWQfCWdkFCsBAQIBZAILD2QWAmYPZBYEZg8VAWBjdGwwMF9QbGFjZUhvbGRlck1haW5faGVhZGVyY29udHJvbF9oZWFsdGhBWkhlYWRlckJvb2ttYXJrX1JhdGluZ3NfT25lU3RhclJhdGluZ19SYXRpbmdTZWxlY3RvcnNkAgEPEBYEHwgFCGRpc2FibGVkHwlnZBQrAQFmZAIND2QWAmYPZBYEZg8VAV1jdGwwMF9QbGFjZUhvbGRlck1haW5faGVhZGVyY29udHJvbF9oZWFsdGhBWkhlYWRlckJvb2ttYXJrX1JhdGluZ3NfVXNlclJhdGluZ19SYXRpbmdTZWxlY3RvcnNkAgEPEBYEHwhkHwlnZBQrAQECBGQCDw8WAh8AaBYCAgEPZBYGZg8PFgIeCEltYWdlVXJsBRxIYW5kbGVycy9DYXB0Y2hhSGFuZGxlci5hc2h4ZGQCBA8PFgQeBFRleHQFA1RyeR8AaGRkAgYPDxYCHwsFFENoYW5nZSBDYXB0Y2hhIEltYWdlZGQCEQ8WAh8AaGQCFQ8PFgIeC05hdmlnYXRlVXJsBTZodHRwOi8vd3d3Lm5ocy51ay9hYm91dE5IU0Nob2ljZXMvUGFnZXMvQ29udGFjdFVzLmFzcHhkZAIXDw8WAh8AZ2RkAgcPFgIfBgsrBAFkAgkPZBYCZhBkZBYCZg8PFgIfAGhkZAILDxYCHwBoFgQCAQ8WAh8GCysEAWQCAw8WAh8AZxYCAgEPFgIfBgsrBAFkAg0PFgIfAGgWAgIBEBYCHwYLKwQBZGQCDw8WAh8AaBYCAgEQFgIfBgsrBAFkZAIREGRkFgJmDw8WAh8AaGRkAhMQFgIfBgsrBAFkZAIVEGRkFgJmDw8WAh8AaGRkAhcQFgIfBgsrBAFkZAIZEBYCHwYLKwQBZGQCGxAWAh8GCysEAWRkAh0PFgIfAGhkAh8QZGQWAmYPDxYCHwBoZGQCIQ9kFgRmDxYCHwYLKwQBZAIBDxYCHwYLKwQBZAIjD2QWDgIBDxYCHwUF5AFtYWlsdG86P3N1YmplY3Q9QXN0aG1hIC0gU3ltcHRvbXMmYW1wO2JvZHk9SSByZWFkIHRoaXMgb24gdGhlIE5IUyBDaG9pY2VzIChodHRwOi8vd3d3Lm5ocy51aykgd2Vic2l0ZSBhbmQgdGhvdWdodCB5b3Ugc2hvdWxkIHJlYWQgaXQgdG9vOg0KIGh0dHAlM2ElMmYlMmZ3d3cubmhzLnVrJTJmQ29uZGl0aW9ucyUyZkFzdGhtYSUyZlBhZ2VzJTJmU3ltcHRvbXMuYXNweCZhbXA7V1QubWNfaWQ9MjA0MTFkAgIPFQQRQXN0aG1hKy0rU3ltcHRvbXNFaHR0cCUzYSUyZiUyZnd3dy5uaHMudWslMmZDb25kaXRpb25zJTJmQXN0aG1hJTJmUGFnZXMlMmZTeW1wdG9tcy5hc3B4RWh0dHAlM2ElMmYlMmZ3d3cubmhzLnVrJTJmQ29uZGl0aW9ucyUyZkFzdGhtYSUyZlBhZ2VzJTJmU3ltcHRvbXMuYXNweBFBc3RobWErLStTeW1wdG9tc2QCAw9kFgRmDxUCRWh0dHAlM2ElMmYlMmZ3d3cubmhzLnVrJTJmQ29uZGl0aW9ucyUyZkFzdGhtYSUyZlBhZ2VzJTJmU3ltcHRvbXMuYXNweBFBc3RobWErLStTeW1wdG9tc2QCAQ9kFgICAQ8WAh8FBTkvQ29uZGl0aW9ucy9Bc3RobWEvUGFnZXMvU3ltcHRvbXMuYXNweD9zYXZlZmF2b3VyaXRlPXRydWVkAgUPFgIfAGhkAgcPZBYCAgEPZBYCZg9kFgICAQ8WAh8HBRRwcmludGFibGUtdmVyc2lvbiBpcGQCCQ8WAh8AaGQCCw9kFgICAQ9kFhYCAQ9kFgICAQ9kFgJmD2QWAmYPFQEJQmFzZWQgb24gZAIDD2QWAmYPZBYEZg8VAU5jdGwwMF9QbGFjZUhvbGRlck1haW5faGVhbHRoQVpBQm9va21hcmtfUmF0aW5nc19GaXZlU3RhclJhdGluZ19SYXRpbmdTZWxlY3RvcnNkAgEPEBYEHwgFCGRpc2FibGVkHwlnZBQrAQECBGQCBQ9kFgJmD2QWBGYPFQFOY3RsMDBfUGxhY2VIb2xkZXJNYWluX2hlYWx0aEFaQUJvb2ttYXJrX1JhdGluZ3NfRm91clN0YXJSYXRpbmdfUmF0aW5nU2VsZWN0b3JzZAIBDxAWBB8IBQhkaXNhYmxlZB8JZ2QUKwEBAgNkAgcPZBYCZg9kFgRmDxUBT2N0bDAwX1BsYWNlSG9sZGVyTWFpbl9oZWFsdGhBWkFCb29rbWFya19SYXRpbmdzX1RocmVlU3RhclJhdGluZ19SYXRpbmdTZWxlY3RvcnNkAgEPEBYEHwgFCGRpc2FibGVkHwlnZBQrAQECAmQCCQ9kFgJmD2QWBGYPFQFNY3RsMDBfUGxhY2VIb2xkZXJNYWluX2hlYWx0aEFaQUJvb2ttYXJrX1JhdGluZ3NfVHdvU3RhclJhdGluZ19SYXRpbmdTZWxlY3RvcnNkAgEPEBYEHwgFCGRpc2FibGVkHwlnZBQrAQECAWQCCw9kFgJmD2QWBGYPFQFNY3RsMDBfUGxhY2VIb2xkZXJNYWluX2hlYWx0aEFaQUJvb2ttYXJrX1JhdGluZ3NfT25lU3RhclJhdGluZ19SYXRpbmdTZWxlY3RvcnNkAgEPEBYEHwgFCGRpc2FibGVkHwlnZBQrAQFmZAIND2QWAmYPZBYEZg8VAUpjdGwwMF9QbGFjZUhvbGRlck1haW5faGVhbHRoQVpBQm9va21hcmtfUmF0aW5nc19Vc2VyUmF0aW5nX1JhdGluZ1NlbGVjdG9yc2QCAQ8QFgQfCGQfCWdkZGQCDw8WAh8AaBYCAgEPZBYGZg8PFgIfCgUcSGFuZGxlcnMvQ2FwdGNoYUhhbmRsZXIuYXNoeGRkAgQPDxYEHwsFA1RyeR8AaGRkAgYPDxYCHwsFFENoYW5nZSBDYXB0Y2hhIEltYWdlZGQCEQ8WAh8AaGQCFQ8PFgIfDAU2aHR0cDovL3d3dy5uaHMudWsvYWJvdXROSFNDaG9pY2VzL1BhZ2VzL0NvbnRhY3RVcy5hc3B4ZGQCFw8PFgIfAGdkZAIlD2QWBGYPDxYCHwBoZBYCAgEPEGRkFgBkAgEPZBYEAgUPFgIfAGcWAmYPFgIfAGdkAgcPDxYIHg5Db21tZW50TGlua1VybGQeFUNvbW1lbnRDb3VudEluY3JlYXNlZGceDENvbW1lbnRDb3VudAIBHgxIaWRlQ29tbWVudHNoZBYEAgIPFgIfAGdkAgQPFgIfBAIBFgICAQ9kFgICAQ9kFgQCAg8VBAQ1MDk0CnRoZWJveTk2OTAQMTMgTm92ZW1iZXIgMjAwOVZnb29kIHRvIGNoZWNrIGFib3V0IGJyb25jaXRpcyBhcyB3ZWxsIHRvIG1ha2Ugc3VyZSBhcyB0aGUgc3ltcHRvbXMgYXJlIGxpa2UgZWFjaCBvdGhlcmQCAw8PFgIfDAUtfi9QYWdlcy9jb21tZW50cy5hc3B4P2NvbnRlbnRJZD01MDk0JkFyZWFJZD0yZBYCZg8VAi5SZXBvcnQgdGhpcyBjb250ZW50IGFzIG9mZmVuc2l2ZSBvciB1bnN1aXRhYmxlBDUwOTRkAikQZGQWAmYPDxYCHwBoZGQCKxBkZBYCZg8PFgIfAGhkZAItEGRkFgJmDw8WAh8AaGRkAjEQZGQWAmYPDxYCHwBoZGQCEA9kFgJmD2QWAmYPZBYCZg9kFgYCAQ8WAh8LBRdOSFMgQ2hvaWNlcyBpbmZvcm1hdGlvbmQCAw8WAh8LBRVDaG9pY2VzIGUtbmV3c2xldHRlcnNkAgUPFgIfCwUKWW91ciBwYWdlc2Rk2e5OOs4cpRe5ugZJKodN3kRCYtU=">
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


<script src="http://nhs.uk/WebResource.axd?d=E-wYADGR95cKnlHmVJ7-E7S2iuY55NnlOW5Jh2aCtWrQTKIo89wBV30SKRlwy2airItEy6ABWWNdDqqVN-G7AHPVUmY1&amp;t=634604424479085897" type="text/javascript"></script>

<script type="text/javascript"> var MSOWebPartPageFormName = 'aspnetForm';</script><link href="http://nhs.uk/_layouts/1033/styles/Menu.css?rev=jQ88ZMCVEKRn%2FLeYuywntQ%3D%3D" rel="stylesheet">
<script type="text/JavaScript">
<!--
var L_Menu_BaseUrl="/Conditions/Asthma";
var L_Menu_LCID="1033";
var L_Menu_SiteTheme="";
//-->
</script>
<script type="text/javascript">
//<![CDATA[
var feedbackurl = 'http://www.nhs.uk/aboutNHSChoices/Pages/ContactUs.aspx';//]]>
</script>
<script language="JavaScript">
<!--
//-->
</script>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() { 
                
                });
                var displayPrintLink = false;//]]>
</script>

<script src="http://nhs.uk/ScriptResource.axd?d=60BavXcg557IDlC8DH-JRmQ67EA7sWKpQ0S9jwEJIGWWYw9dVD53OwZCz5RxaUhq6LO71mq_w82ADgG8iEvebjfORzGSoPtfntCgghJONeyiZ5Vpa_nGuR6nKWq9n9CdGfQeJG5emeCKMpsPGgDmV4pr7G01&amp;t=2e2045e2" type="text/javascript"></script>
<script src="http://nhs.uk/ScriptResource.axd?d=Ke7zvn9hXGNMdn-MFccv7GZU9ujX49EFKizEBV2KI8hScK0BA2GLTbYEGI1VEBGNBSeHcNWAlMO0Vi11hDFCz7xmeu2iMCnK2evNibtJebLg-XTxCx71J--ncPom7JemLXPO3OU7RtWAQoocm6P_abTmpqsXUBZud6l8xRNsMQf3vH6K0&amp;t=2e2045e2" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
function WebForm_OnSubmit() {
UpdateFormDigest('\u002fConditions\u002fAsthma', 1440000);
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

    
    
    	
	
    
    

    
    
  <div class="content-wrap clear healthaz temp-a">
    <div class="row pad-tbl clear healthaz-header">

      

    
    <h1>Asthma - Symptoms&nbsp;</h1><ul class="sub-nav clear">
  <li><span><a href="http://nhs.uk/Conditions/Asthma/Pages/Introduction.aspx">Asthma</a></span><span class="crnr tl"></span><span class="crnr tr"></span></li>
  <li class="active"><span class="active-text"><span class="hidden">Asthma </span>Symptoms</span></li>
  <li><span><a href="http://nhs.uk/Conditions/Asthma/Pages/Causes.aspx"><span class="hidden">Asthma </span>Causes</a></span><span class="crnr tl"></span><span class="crnr tr"></span></li>
  <li><span><a href="http://nhs.uk/Conditions/Asthma/Pages/Diagnosis.aspx"><span class="hidden">Asthma </span>Diagnosis</a></span><span class="crnr tl"></span><span class="crnr tr"></span></li>
  <li><span><a href="http://nhs.uk/Conditions/Asthma/Pages/Treatment.aspx"><span class="hidden">Asthma </span>Treatment</a></span><span class="crnr tl"></span><span class="crnr tr"></span></li>
  <li class="last"><span><a href="http://nhs.uk/Conditions/Asthma/Pages/living-with.aspx"><span class="hidden">Asthma </span>Living with</a></span><span class="crnr tl"></span><span class="crnr tr"></span></li>
</ul>
    

<div class="bookmark-wrap clear">
    
  <div class="clear">
 
     <div class="social-sharing clear">
		<p class="share">Share:</p>
        <ul class="share-list">

        	<li class="email"><a href="mailto:?subject=Asthma - Symptoms&amp;body=I read this on the NHS Choices (http://www.nhs.uk) website and thought you should read it too:
 http%3a%2f%2fwww.nhs.uk%2fConditions%2fAsthma%2fPages%2fSymptoms.aspx&amp;WT.mc_id=20411" id="ctl00_PlaceHolderMain_headercontrol_healthAZHeaderBookmark_btnEmail" title="Share this page via email"><img src="http://nhs.uk/img/social-sharing/email.jpg" alt="Email share" width="16" height="16"></a></li>
            <li class="twitter"><a title="Share this page via Twitter" href="http://twitter.com/home?status=Asthma+-+Symptoms%20-%20http%3a%2f%2fwww.nhs.uk%2fConditions%2fAsthma%2fPages%2fSymptoms.aspx&amp;WT.mc_id=50411" target="_blank"><img src="http://nhs.uk/img/social-sharing/twitter.jpg" alt="Twitter share" width="16" height="16"></a></li>
            <li class="facebook"><a title="Share this page via Facebook" href="http://www.facebook.com/sharer.php?u=http%3a%2f%2fwww.nhs.uk%2fConditions%2fAsthma%2fPages%2fSymptoms.aspx&amp;t=Asthma+-+Symptoms&amp;WT.mc_id=60411" target="_blank"><img src="http://nhs.uk/img/social-sharing/facebook.jpg" alt="Facebook share" width="16" height="16"></a></li>
            
        </ul>
        
            <p class="save">Save:</p>
            <ul class="save-list">
                <li class="google"><a title="Save this page to Google Bookmarks" href="https://www.google.com/bookmarks/mark?op=add&amp;bkmk=http%3a%2f%2fwww.nhs.uk%2fConditions%2fAsthma%2fPages%2fSymptoms.aspx&amp;title=Asthma+-+Symptoms&amp;WT.mc_id=30411" target="_blank"><img src="http://nhs.uk/img/social-sharing/google.jpg" alt="Google Bookmarks" width="16" height="16"></a></li>
                
                    <li class="nhsc-save"><a href="http://nhs.uk/Conditions/Asthma/Pages/Symptoms.aspx?savefavourite=true" id="ctl00_PlaceHolderMain_headercontrol_healthAZHeaderBookmark_btnSave" title="Save this page to your NHS Choices account"><img src="http://nhs.uk/img/social-sharing/nhsc-save.jpg" alt="NHS Choices Saved Pages" width="16" height="16"></a></li>
                
		    </ul>
                
        
        
			<p>Print:</p>
			<ul class="print-list">
			    <li class="print-ip">
			        <div id="ctl00_PlaceHolderMain_headercontrol_healthAZHeaderBookmark_EasyPrint_printLinkDiv">
     
    <p id="ctl00_PlaceHolderMain_headercontrol_healthAZHeaderBookmark_EasyPrint_ptagprintclass" class="printable-version ip" title="Easy print this page">
        <a href="http://nhs.uk/Pages/PrintPage.aspx?Site=Asthma&amp;URL=/Conditions/Asthma&amp;Current=Symptoms.aspx&amp;Title=Asthma&amp;print=635338400997456195"><span class="hidden">Print this page</span></a>
    </p>
    
     
</div>

                </li>
			</ul>
        
        
	</div>
    
  </div>
  
  
    
</div>
       




      
    </div>
    <div class="row pad-tbl clear">
      <div class="col four">
        
        <div id="ctl00_PlaceHolderMain_articles">
	
</div>
        <div class="pad border healthaz-content clear">
          <h2>Symptoms of asthma&nbsp;</h2>
          <div class="col two-sm">
            
		

            

            

            

            <div id="webZoneLeft" class="WebPartZone-Vertical" style="display: none;">

				</div>
			
          </div>

          <div class="col two-sm last">
            <div class="pad-rbl">

              <div class="article">
                <o:p>
<p><strong>The symptoms of asthma can range from mild to severe. When asthma symptoms get significantly worse, it is known as an asthma attack. </strong></p>
<p>The symptoms of asthma include: </p>
<ul>
    <li>feeling breathless (you may gasp for breath) </li>
    <li>a tight chest, like a band tightening around&nbsp;it&nbsp; </li>
    <li>wheezing, which&nbsp;makes&nbsp;a whistling sound when you breathe </li>
    <li><a href="http://nhs.uk/conditions/cough/pages/introduction.aspx">coughing</a>, particularly at night and early morning </li>
    <li>attacks triggered by exercise, exposure to allergens and other triggers </li>
</ul>
<p>You may&nbsp;experience one or more of these symptoms. Symptoms that are worse during the night or with exercise can mean your asthma is getting worse or is poorly controlled.&nbsp;Talk to your doctor or asthma nurse about this.</p>
<h3>Asthma attack</h3>
<p>A severe asthma attack usually develops slowly, taking&nbsp;6&nbsp;to 48 hours to become serious. However, for some people, asthma symptoms can get worse quickly. </p>
<p>As well as symptoms getting worse, signs of an asthma attack include: </p>
<ul>
    <li>you get more wheezy, tight-chested or breathless </li>
    <li>the reliever inhaler is not helping as much as usual </li>
    <li>there is a drop in your peak expiratory flow (see&nbsp;<a href="http://nhs.uk/Conditions/Asthma/Pages/Diagnosis.aspx">diagnosing asthma</a> for more information) </li>
</ul>
<p>If you notice these signs, do not ignore them. Contact your GP or asthma clinic or consult your asthma action plan, if you have one.</p>
<p>Signs of a severe asthma attack include:</p>
<ul>
    <li>the reliever inhaler, which is&nbsp;usually blue, does not help symptoms at all </li>
    <li>the symptoms of wheezing, coughing and tight chest&nbsp;are severe and constant </li>
    <li>you are too breathless to speak </li>
    <li>your&nbsp;pulse is racing </li>
    <li>you feel agitated or restless </li>
    <li>your lips or fingernails&nbsp;look blue </li>
</ul>
<p>Call 999 to seek immediate help if you or someone else has severe symptoms of asthma.</p>
</o:p>

              </div> 

              <div id="webZoneMiddleTop" class="WebPartZone-Vertical">

					</div>
				

              <div class="article">
                <br>

                <br>

                <br>
	
              </div>

              

              <div id="webZoneMiddleBottom" class="WebPartZone-Vertical">

						</div>
					

              <div id="webZoneMedia" class="WebPartZone-Vertical" style="display: block; margin: 20px 0px;">

			<div id="assessment_webpart_wrapper" style="margin-left: auto; margin-right: auto; width: 362px;"><iframe style="width:362px;height:420px;" title="self assessments" src="http://nhs.uk/tools/documents/self_assessments_js/assessment.html?XMLpath=/tools/documents/self_assessments_js/packages/&amp;ASid=52&amp;syndicate=undefined" frameborder="no" scrolling="no"></iframe><div id="assessment_webpart_date" class="review-date" style="padding:1em;line-height:13px;">Media last reviewed: <span class="review-pad">01/11/2012</span><br>Next review due: <span>01/11/2014</span></div></div>	
			</div><div class="review-dates">
                
<div class="review-date">
  
    <p>Page last reviewed: <span class="review-pad">23/07/2012</span></p>
  
    <p>Next review due: <span>23/07/2014</span></p>
 
 <div style="display:block">
   
 </div>
   
 <div style="display:none">
   
 </div>
   
</div>

              </div><div class="tabs-nav"><h2>Other sections</h2>
          <span class="crnr tl"></span><span class="crnr tr"></span>
          <div id="ctl00_PlaceHolderMain_topicHeadings">
	<ul class="tabs clear">
  <li class="active"><span class="active-text">Overview</span><span class="crnr tl"></span><span class="crnr tr"></span></li>
  <li><span><a href="http://nhs.uk/Conditions/Asthma/Pages/Olwensstory.aspx"><span class="hidden">Asthma </span>Real stories</a></span><span class="crnr tl"></span><span class="crnr tr"></span></li>
  <li><span><a href="http://nhs.uk/Conditions/Asthma/Pages/mapofmedicinepage.aspx"><span class="hidden">Asthma </span>Map of Medicine</a></span><span class="crnr tl"></span><span class="crnr tr"></span></li>
  <li><span><a href="http://nhs.uk/Conditions/Asthma/Pages/MedicineGuidePage.aspx"><span class="hidden">Asthma </span>Medicines info</a></span><span class="crnr tl"></span><span class="crnr tr"></span></li>
  <li><span><a href="http://nhs.uk/Conditions/Asthma/Pages/clinical-trial.aspx"><span class="hidden">Asthma </span>Clinical trials</a></span><span class="crnr tl"></span><span class="crnr tr"></span></li>
  <li><span style="border: none;"><a href="http://nhs.uk/Conditions/Asthma/Pages/Community.aspx"><span class="hidden" style="border: none;">Asthma </span>Community</a></span><span class="crnr tl" style="border: none;"></span><span class="crnr tr" style="border: none;"></span></li>
</ul>
</div>
        </div>

              

<div class="bookmark-wrap clear">
    
  <div class="clear">
 
     
    
  </div>
  
  
   <div id="ratings-header" class="ratings-header clear">
      <h3>Ratings</h3>
      <p>How helpful is this page?</p>
    </div>
    <div class="ratings-wrap clear ratings-js">
      



<script src="http://nhs.uk/includes/jquery-ui-1.8.1.custom.min.js" type="text/javascript"></script>
<script src="http://nhs.uk/includes/jquery.ui.stars.js" type="text/javascript"></script>
<script src="http://nhs.uk/includes/ratings.js" type="text/javascript"></script>

<div class="average-rating">
  <h4>Average rating</h4>
  

<div id="AverageRating" class="static-ratings clear">
    <div class="the-rating">
        
        <label for="RatingSelectors"></label>
    
    <div class="ui-stars-star ui-stars-star-on ui-stars-star-disabled"><a title="">1</a></div><div class="ui-stars-star ui-stars-star-on ui-stars-star-disabled"><a title="">2</a></div><div class="ui-stars-star ui-stars-star-on ui-stars-star-disabled"><a title="">3</a></div><div class="ui-stars-star ui-stars-star-on ui-stars-star-disabled"><a title="">4</a></div><div class="ui-stars-star ui-stars-star-disabled"><a title="">5</a></div><input type="hidden" name="RatingSelectors" value="4" disabled="disabled"></div>

        
      <p class="the-average">Based on  <span id="noOfRatings" class="no-of-ratings">
        304</span> ratings <a class="view-all">View all ratings</a></p>
    
    
</div>
</div>
  <div id="rating-breakdown" class="rating-breakdown clear" style="display: none;">
    <div class="star-ratings">
      
    
      

<div id="FiveStarRating" class="static-ratings">
    <div class="the-rating">
        
        <label for="ctl00_PlaceHolderMain_healthAZABookmark_Ratings_FiveStarRating_RatingSelectors">
            
        </label>
        
    <div class="ui-stars-star ui-stars-star-on ui-stars-star-disabled"><a title="">1</a></div><div class="ui-stars-star ui-stars-star-on ui-stars-star-disabled"><a title="">2</a></div><div class="ui-stars-star ui-stars-star-on ui-stars-star-disabled"><a title="">3</a></div><div class="ui-stars-star ui-stars-star-on ui-stars-star-disabled"><a title="">4</a></div><div class="ui-stars-star ui-stars-star-on ui-stars-star-disabled"><a title="">5</a></div><input type="hidden" name="ctl00$PlaceHolderMain$healthAZABookmark$Ratings$FiveStarRating$RatingSelectors" value="5" disabled="disabled"></div>

    
            <span class="ratings-caption">
                <label>
                    <span class="no-of-ratings">
                        174
                    </span>&nbsp;ratings
                    </label>
            </span>    
        
    
</div>
      

<div id="FourStarRating" class="static-ratings">
    <div class="the-rating">
        
        <label for="ctl00_PlaceHolderMain_healthAZABookmark_Ratings_FourStarRating_RatingSelectors">
            
        </label>
        
    <div class="ui-stars-star ui-stars-star-on ui-stars-star-disabled"><a title="">1</a></div><div class="ui-stars-star ui-stars-star-on ui-stars-star-disabled"><a title="">2</a></div><div class="ui-stars-star ui-stars-star-on ui-stars-star-disabled"><a title="">3</a></div><div class="ui-stars-star ui-stars-star-on ui-stars-star-disabled"><a title="">4</a></div><div class="ui-stars-star ui-stars-star-disabled"><a title="">5</a></div><input type="hidden" name="ctl00$PlaceHolderMain$healthAZABookmark$Ratings$FourStarRating$RatingSelectors" value="4" disabled="disabled"></div>

    
            <span class="ratings-caption">
                <label>
                    <span class="no-of-ratings">
                        69
                    </span>&nbsp;ratings
                    </label>
            </span>    
        
    
</div>  
      

<div id="ThreeStarRating" class="static-ratings">
    <div class="the-rating">
        
        <label for="ctl00_PlaceHolderMain_healthAZABookmark_Ratings_ThreeStarRating_RatingSelectors">
            
        </label>
        
    <div class="ui-stars-star ui-stars-star-on ui-stars-star-disabled"><a title="">1</a></div><div class="ui-stars-star ui-stars-star-on ui-stars-star-disabled"><a title="">2</a></div><div class="ui-stars-star ui-stars-star-on ui-stars-star-disabled"><a title="">3</a></div><div class="ui-stars-star ui-stars-star-disabled"><a title="">4</a></div><div class="ui-stars-star ui-stars-star-disabled"><a title="">5</a></div><input type="hidden" name="ctl00$PlaceHolderMain$healthAZABookmark$Ratings$ThreeStarRating$RatingSelectors" value="3" disabled="disabled"></div>

    
            <span class="ratings-caption">
                <label>
                    <span class="no-of-ratings">
                        17
                    </span>&nbsp;ratings
                    </label>
            </span>    
        
    
</div>
      

<div id="TwoStarRating" class="static-ratings">
    <div class="the-rating">
        
        <label for="ctl00_PlaceHolderMain_healthAZABookmark_Ratings_TwoStarRating_RatingSelectors">
            
        </label>
        
    <div class="ui-stars-star ui-stars-star-on ui-stars-star-disabled"><a title="">1</a></div><div class="ui-stars-star ui-stars-star-on ui-stars-star-disabled"><a title="">2</a></div><div class="ui-stars-star ui-stars-star-disabled"><a title="">3</a></div><div class="ui-stars-star ui-stars-star-disabled"><a title="">4</a></div><div class="ui-stars-star ui-stars-star-disabled"><a title="">5</a></div><input type="hidden" name="ctl00$PlaceHolderMain$healthAZABookmark$Ratings$TwoStarRating$RatingSelectors" value="2" disabled="disabled"></div>

    
            <span class="ratings-caption">
                <label>
                    <span class="no-of-ratings">
                        7
                    </span>&nbsp;ratings
                    </label>
            </span>    
        
    
</div>
      

<div id="OneStarRating" class="static-ratings">
    <div class="the-rating">
        
        <label for="ctl00_PlaceHolderMain_healthAZABookmark_Ratings_OneStarRating_RatingSelectors">
            
        </label>
        
    <div class="ui-stars-star ui-stars-star-on ui-stars-star-disabled"><a title="">1</a></div><div class="ui-stars-star ui-stars-star-disabled"><a title="">2</a></div><div class="ui-stars-star ui-stars-star-disabled"><a title="">3</a></div><div class="ui-stars-star ui-stars-star-disabled"><a title="">4</a></div><div class="ui-stars-star ui-stars-star-disabled"><a title="">5</a></div><input type="hidden" name="ctl00$PlaceHolderMain$healthAZABookmark$Ratings$OneStarRating$RatingSelectors" value="1" disabled="disabled"></div>

    
            <span class="ratings-caption">
                <label>
                    <span class="no-of-ratings">
                        37
                    </span>&nbsp;ratings
                    </label>
            </span>    
        
    
</div>
    </div>
  <p class="close"><a name="close">Close</a></p></div>


  <div class="user-rating">
    <h4>Add your rating</h4>
    

<div id="UserRating" class="clear">
    <div class="the-rating">
        
        <label for="ctl00_PlaceHolderMain_healthAZABookmark_Ratings_UserRating_RatingSelectors">
            
        </label>
        
    </div>

    
      
    
<div class="ui-stars-star"><a title="">1</a></div><div class="ui-stars-star"><a title="">2</a></div><div class="ui-stars-star"><a title="">3</a></div><div class="ui-stars-star"><a title="">4</a></div><div class="ui-stars-star"><a title="">5</a></div><input type="hidden" name="ctl00$PlaceHolderMain$healthAZABookmark$Ratings$UserRating$RatingSelectors" value="5" disabled="disabled"></div>
    
    

    
    
        
  <label id="leave-rating">Please leave your rating</label><span id="rating"></span></div>

  
  <p class="thanks-rating">
    
  </p>
    
  <p class="feedback-rating">
    
  </p>

  
    </div>
  
    
</div>
       


              




              

            </div>
          </div>

        <div class="social-sharing clear">
		<p class="share">Share:</p>
        <ul class="share-list">

        	<li class="email"><a href="mailto:?subject=Asthma - Symptoms&amp;body=I read this on the NHS Choices (http://www.nhs.uk) website and thought you should read it too:
 http%3a%2f%2fwww.nhs.uk%2fConditions%2fAsthma%2fPages%2fSymptoms.aspx&amp;WT.mc_id=20411" id="ctl00_PlaceHolderMain_healthAZABookmark_btnEmail" title="Share this page via email"><img src="http://nhs.uk/img/social-sharing/email.jpg" alt="Email share" width="16" height="16"></a></li>
            <li class="twitter"><a title="Share this page via Twitter" href="http://twitter.com/home?status=Asthma+-+Symptoms%20-%20http%3a%2f%2fwww.nhs.uk%2fConditions%2fAsthma%2fPages%2fSymptoms.aspx&amp;WT.mc_id=50411" target="_blank"><img src="http://nhs.uk/img/social-sharing/twitter.jpg" alt="Twitter share" width="16" height="16"></a></li>
            <li class="facebook"><a title="Share this page via Facebook" href="http://www.facebook.com/sharer.php?u=http%3a%2f%2fwww.nhs.uk%2fConditions%2fAsthma%2fPages%2fSymptoms.aspx&amp;t=Asthma+-+Symptoms&amp;WT.mc_id=60411" target="_blank"><img src="http://nhs.uk/img/social-sharing/facebook.jpg" alt="Facebook share" width="16" height="16"></a></li>
            
        </ul>
        
            <p class="save">Save:</p>
            <ul class="save-list">
                <li class="google"><a title="Save this page to Google Bookmarks" href="https://www.google.com/bookmarks/mark?op=add&amp;bkmk=http%3a%2f%2fwww.nhs.uk%2fConditions%2fAsthma%2fPages%2fSymptoms.aspx&amp;title=Asthma+-+Symptoms&amp;WT.mc_id=30411" target="_blank"><img src="http://nhs.uk/img/social-sharing/google.jpg" alt="Google Bookmarks" width="16" height="16"></a></li>
                
                    <li class="nhsc-save"><a href="http://nhs.uk/Conditions/Asthma/Pages/Symptoms.aspx?savefavourite=true" id="ctl00_PlaceHolderMain_healthAZABookmark_btnSave" title="Save this page to your NHS Choices account"><img src="http://nhs.uk/img/social-sharing/nhsc-save.jpg" alt="NHS Choices Saved Pages" width="16" height="16"></a></li>
                
		    </ul>
                
        
        
			<p style="display: none;">Print:</p>
			<ul class="print-list">
			    <li class="print-ip">
			        <div id="ctl00_PlaceHolderMain_healthAZABookmark_EasyPrint_printLinkDiv">
     
    <p id="ctl00_PlaceHolderMain_healthAZABookmark_EasyPrint_ptagprintclass" class="printable-version ip" title="Easy print this page">
        <a href="http://nhs.uk/Pages/PrintPage.aspx?Site=Asthma&amp;URL=/Conditions/Asthma&amp;Current=Symptoms.aspx&amp;Title=Asthma&amp;print=635338401001668222"><span class="hidden">Print this page</span></a>
    </p>
    
     
</div>

                </li>
			</ul>
        
        
	</div><div class="comments-wrap">
    
    
    
        <div class="login-comment">
        <h3>Leave your comment</h3>
        <p>
            <a href="http://nhs.uk/Personalisation/Login.aspx?ReturnUrl=http%3a%2f%2fwww.nhs.uk%2fConditions%2fAsthma%2fPages%2fSymptoms.aspx%23leavecomment" class="commentLogin">Login</a> or <a href="http://nhs.uk/Personalisation/Registration.aspx?ReturnUrl=http%3a%2f%2fwww.nhs.uk%2fConditions%2fAsthma%2fPages%2fSymptoms.aspx%23leavecomment">
                    Register</a>
        </p>
        </div>
        
            <div class="share-text">
                <p><strong><a href="http://nhs.uk/Personalisation/Login.aspx?ReturnUrl=http%3a%2f%2fwww.nhs.uk%2fConditions%2fAsthma%2fPages%2fSymptoms.aspx%23leavecomment">Share your views</a> and experiences with others.</strong></p>
                <p>If you want a response from an NHS professional or the website team, please <a href="http://www.nhs.uk/aboutNHSChoices/pages/ContactUs.aspx" title="Contact NHS Choices editors">contact us.</a></p>
            </div>
        
    
    

<!--googleoff: all-->
<div class="comments-header clear">
<h3 class="show">Comments (1) ►</h3>
</div>

    <div class="comments-container hidden"><div class="disclaimer">
        <p>The 1 comments<span class="hidden"> about ‘Symptoms’</span> posted are personal views. Any information they give has not been checked and may not be accurate.</p>
    </div><div id="ctl00_PlaceHolderMain_displayComments1_ctl01_UcDisplayComments1_rptComments_ctl01_divComment" class="comment">
            
            
            <h4><strong>theboy9690</strong> said on <strong>13 November 2009</strong></h4>
            <p>good to check about broncitis as well to make sure as the symptoms are like each other</p>
            <p class="report-comment"><a id="ctl00_PlaceHolderMain_displayComments1_ctl01_UcDisplayComments1_rptComments_ctl01_hypCommentLink" href="../../../Pages/comments.aspx?contentId=5094&amp;AreaId=2">Report this content as offensive or unsuitable<span class="hidden"> comment id 5094</span> </a></p>
        </div><div class="comment" id="comment5094"></div></div>


        
    
<!--googleon: all-->

</div></div>
      </div>
      <div class="col one last">
	    <div id="dmp_placeholder"></div>
        <div id="webZoneRightHealthExplorerLink" class="WebPartZone-Vertical">

							</div>
						
        <div id="webZoneRightTreatmentOptions" class="WebPartZone-Vertical">

								</div>
							
        <div class="panel clear">
          <span class="crnr tl"></span><span class="crnr tr"></span>
          <div id="webZoneRight" class="WebPartZone-Vertical">

										<div class="panel"><span class="crnr tl"></span><span class="crnr tr"></span><span class="icn usefullinks"></span><h2>Useful links</h2><div class="panel-top"><h3>NHS Choices links</h3><ul><li><a href="http://www.nhs.uk/planners/yourhealth/pages/yourhealth.aspx" title="Guide to living with a long-term condition" class="link" rel="nofollow">Guide to living with a long-term condition</a></li><li><a href="http://www.nhs.uk/Livewell/Asthma/Pages/Asthmahome.aspx" title="Living with asthma" class="link">Living with asthma</a></li><li><a href="http://www.nhs.uk/Video/Pages/Childrensasthmainhaler.aspx" title="Video: inhaler techniques" class="link">Video: inhaler techniques</a></li><li><a href="http://www.nhs.uk/Conditions/Asthma-in-children/Pages/Introduction.aspx" title="Childhood asthma" class="link">Childhood asthma</a></li></ul><h3>External links</h3><ul><li><a href="http://www.asthma.org.uk/" title="Asthma UK : This is an external site" class="link" rel="nofollow">Asthma UK </a></li><li><a href="http://gosmokefree.nhs.uk/" title="NHS Smokefree : This is an external site" class="link" rel="nofollow">NHS Smokefree </a></li><li><a href="http://www.labtestsonline.org.uk/understanding/analytes/allergy/glance.html" title="Lab Tests Online UK: This is an external site" class="link" rel="nofollow">Lab Tests Online UK</a></li><li><a href="http://www.housedustmite.com/" title="House Dust Mite : This is an external site" class="link" rel="nofollow">House Dust Mite </a></li><li><a href="http://care.asthma.org.uk" title="Compare Your Care: This is an external site" class="link" rel="nofollow">Compare Your Care</a></li><li><a href="http://www.lunguk.org" title="British Lung Foundation: This is an external site" class="link" rel="nofollow">British Lung Foundation</a></li></ul></div><span class="crnr bl"></span><span class="crnr br"></span></div>
											<div class="healthunlocked_wrapper" style="overflow: hidden;"><div style="position: relative; border: 4px solid rgb(108, 196, 82); border-top-left-radius: 8px; border-top-right-radius: 8px; border-bottom-right-radius: 8px; border-bottom-left-radius: 8px;"><div style="position: relative; padding: 4px 6px 8px 8px; background-color: rgb(108, 196, 82); background-position: initial initial; background-repeat: initial initial;"><a href="http://healthunlocked.com/blf" target="_blank" style="color: rgb(255, 255, 255); font-weight: normal; font-size: 15px; text-decoration: none;">Asthma forum</a></div><div style="position: relative; padding: 8px 6px 12px 8px; background-color: rgb(255, 255, 255); border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 8px; border-bottom-left-radius: 8px; background-position: initial initial; background-repeat: initial initial;"><p style="position: relative; margin: 0px; padding: 0px 0px 8px 20px; background-image: url(http://d37jpvxvnmgnc2.cloudfront.net/snowdrop/images/nhschoices/profile_s.gif); background-position: 0px 1px; background-repeat: no-repeat no-repeat;"><a href="http://healthunlocked.com/blf/questions/130735015/does-anyone-know-where-i-can-get-some-lung-function-tests-booked-in-the-north-east-of-england-for-some-staff-thanks" target="_blank" style="color: rgb(107, 107, 206); font-size: 13px; background-image: url(http://d37jpvxvnmgnc2.cloudfront.net/snowdrop/images/nhschoices/icon_newwindow.gif); padding-right: 18px; background-position: 100% 50%; background-repeat: no-repeat no-repeat;">Does anyone know where I can get some Lung Function tests booked in the north east of England for some staff?

Thanks</a><span style="font-size: 12px; color: rgb(136, 136, 136);">&nbsp; 4/23/2014&nbsp;10:23:20&nbsp;AM</span></p><p style="position: relative; margin: 0px; padding: 0px 0px 8px 20px; background-image: url(http://d37jpvxvnmgnc2.cloudfront.net/snowdrop/images/nhschoices/profile_s.gif); background-position: 0px 1px; background-repeat: no-repeat no-repeat;"><a href="http://healthunlocked.com/blf/questions/130734027/hi-there-terry-from-denver-here-has-anyone-had-any-experience-with-the-supplement-nac-n-acetyl-cysteine-500-mg" target="_blank" style="color: rgb(107, 107, 206); font-size: 13px; background-image: url(http://d37jpvxvnmgnc2.cloudfront.net/snowdrop/images/nhschoices/icon_newwindow.gif); padding-right: 18px; background-position: 100% 50%; background-repeat: no-repeat no-repeat;">HI there!  Terry from denver here -- Has anyone had any experience with the supplement NAC?  N-Acetyl Cysteine 500 mg</a><span style="font-size: 12px; color: rgb(136, 136, 136);">&nbsp; 4/23/2014&nbsp;3:42:32&nbsp;AM</span></p><p style="position: relative; margin: 0px; padding: 0px 0px 8px 20px; background-image: url(http://d37jpvxvnmgnc2.cloudfront.net/snowdrop/images/nhschoices/profile_s.gif); background-position: 0px 1px; background-repeat: no-repeat no-repeat;"><a href="http://healthunlocked.com/blf/questions/130733872/baroque" target="_blank" style="color: rgb(107, 107, 206); font-size: 13px; background-image: url(http://d37jpvxvnmgnc2.cloudfront.net/snowdrop/images/nhschoices/icon_newwindow.gif); padding-right: 18px; background-position: 100% 50%; background-repeat: no-repeat no-repeat;">Baroque </a><span style="font-size: 12px; color: rgb(136, 136, 136);">&nbsp; 4/22/2014&nbsp;11:35:08&nbsp;PM</span></p><a href="http://healthunlocked.com/blf" target="_blank" style="color: rgb(136, 136, 136); font-size: 12px; background-image: url(http://d37jpvxvnmgnc2.cloudfront.net/snowdrop/images/nhschoices/icon_newwindow.gif); padding-right: 18px; background-position: 100% 50%; background-repeat: no-repeat no-repeat;">More from the community</a></div></div><div style="position: relative; text-align: right; padding-top: 4px;"><a href="http://www.healthunlocked.com/choices/?" target="_blank"><img src="http://d37jpvxvnmgnc2.cloudfront.net/snowdrop/images/nhschoices/hu_logo2.gif?1" alt="HealthUnlocked" style="width: 108px; height: 40px; border: 0px; float: right;"></a><div style="clear: right;"></div><br><br></div></div><script type="text/javascript">
    var hu_webpart_id = 2;
    var hu_comm_id = 55;

    var huarr = huarr || [];
    huarr.push(['_createWebpart', hu_webpart_id + ',' + hu_comm_id]);
    (function () {
        var hu = document.createElement('script'); 
        hu.id = 'hu_webpartid' + hu_webpart_id;
        hu.type = 'text/javascript'; hu.async = true;
        hu.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'www.healthunlocked.com/choices.v6.js';
        var s = document.getElementsByTagName('script')[document.getElementsByTagName('script').length - 1]; s.parentNode.insertBefore(hu, s);
    })();
</script>       
<noscript>
    &lt;a href="http://www2.healthunlocked.com/components/widgets/nhschoices/teaser.aspx?hu_webpart_id=2&amp;hu_comm_id=55" target="_blank"&gt;Community content from HealthUnlocked&lt;/a&gt;
</noscript>

												<div id="ctl00_SPWebPartManager1_g_d5ea2710_b3c4_466d_a14d_892fe364dea8">
													<div class="panel"><span class="crnr tl"></span><span class="crnr tr"></span><div class="clear"><div class="image"><img src="http://nhs.uk/Livewell/smoking/PublishingImages/83908791_QUIT-SMOKING_377x171.jpg" style="" alt=""></div><div class="panel-text"><h2><a href="http://nhs.uk/livewell/smoking/Pages/Betterlives.aspx">10 health benefits of stopping smoking</a></h2><p>Quit smoking and you'll be healthier, your skin will look better and you'll have better sex, too </p></div></div><span class="crnr bl"></span><span class="crnr br"></span></div>
												</div>
												</div>
											
          <span class="crnr bl"></span><span class="crnr br"></span>
        </div>
        
        <div id="FindAndCompareWebpart" class="WebPartZone-Vertical">

													</div>
												
      </div>
    </div>
  <p class="btp"><a href="#mainContent">Back to top</a></p></div>

    


    <!-- Footer starts here.... -->
    
    <div class="footer clear ui-tabs ui-widget ui-widget-content ui-corner-all">

        <ul class="footer-tabs clear ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
            <li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"><a href="#footer-tab1"><span class="crnr tl"></span><span class="footer-title">NHS Choices information</span><span class="crnr tr"></span></a></li>
            <li class="ui-state-default ui-corner-top"><a href="#footer-tab2"><span class="crnr tl"></span><span class="footer-title">Choices e-newsletters</span><span class="crnr tr"></span></a></li>
            <li class="ui-state-default ui-corner-top"><a href="#footer-tab3"><span class="crnr tl"></span><span class="footer-title">Your pages</span><span class="crnr tr"></span></a></li>
        </ul>

        <div id="footer-tab1" class="footer-tab1 footer-tab-content clear ui-tabs-panel ui-widget-content ui-corner-bottom">
            <div id="ctl00_Footer_ucPersonalisationFooter_SitePolicies" class="footer-list">
													
<h2 class="show">Site policies ►</h2>
<ul class="info hidden">
<li><a href="http://nhs.uk/aboutNHSChoices/aboutnhschoices/termsandconditions/Pages/termsandconditions.aspx" accesskey="8" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Site policies','DCSext.FooterClickUrl','/aboutNHSChoices/aboutnhschoices/termsandconditions/Pages/termsandconditions.aspx','WT.dl','121')" onKeyPress="this.onclick()">Terms and conditions</a></li>
<li><a href="http://nhs.uk/aboutNHSChoices/aboutnhschoices/Aboutus/Pages/Editorialpolicy.aspx" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Site policies','DCSext.FooterClickUrl','/aboutNHSChoices/aboutnhschoices/Aboutus/Pages/Editorialpolicy.aspx','WT.dl','121')" onKeyPress="this.onclick()">Editorial policy</a></li>
<li><a href="http://nhs.uk/aboutNHSChoices/aboutnhschoices/termsandconditions/Pages/commentspolicy.aspx" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Site policies','DCSext.FooterClickUrl','/aboutNHSChoices/aboutnhschoices/termsandconditions/Pages/commentspolicy.aspx','WT.dl','121')" onKeyPress="this.onclick()">Comments policy</a></li>
<li><a href="http://nhs.uk/aboutNHSChoices/professionals/syndication/Pages/Webservices.aspx" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Site policies','DCSext.FooterClickUrl','/aboutNHSChoices/professionals/syndication/Pages/Webservices.aspx','WT.dl','121')" onKeyPress="this.onclick()">Syndication</a></li>
<li><a href="http://nhs.uk/aboutNHSChoices/aboutnhschoices/termsandconditions/Pages/Privacypolicy.aspx" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Site policies','DCSext.FooterClickUrl','/aboutNHSChoices/aboutnhschoices/termsandconditions/Pages/Privacypolicy.aspx','WT.dl','121')" onKeyPress="this.onclick()">Privacy policy</a></li>
<li><a href="http://nhs.uk/aboutNHSChoices/aboutnhschoices/termsandconditions/Pages/cookies-policy.aspx" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Site policies','DCSext.FooterClickUrl','/aboutNHSChoices/aboutnhschoices/termsandconditions/Pages/cookies-policy.aspx','WT.dl','121')" onKeyPress="this.onclick()">Cookies policy</a></li>
<li><a href="http://nhs.uk/aboutNHSChoices/aboutnhschoices/Aboutus/Pages/LinkingtoChoices.aspx" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Site policies','DCSext.FooterClickUrl','/aboutNHSChoices/aboutnhschoices/Aboutus/Pages/LinkingtoChoices.aspx','WT.dl','121')" onKeyPress="this.onclick()">Links policy</a></li>
<li><a href="http://nhs.uk/aboutNHSChoices/aboutnhschoices/Personalaccounts/Pages/NHSChoicesaccount.aspx" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Site policies','DCSext.FooterClickUrl','/aboutNHSChoices/aboutnhschoices/Personalaccounts/Pages/NHSChoicesaccount.aspx','WT.dl','121')" onKeyPress="this.onclick()">Personal accounts</a></li>
<li><a href="http://nhs.uk/accessibility/Pages/Accessibility.aspx " accesskey="0" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Site policies','DCSext.FooterClickUrl','/accessibility/Pages/Accessibility.aspx ','WT.dl','121')" onKeyPress="this.onclick()">Accessibility </a></li>
<li style="border: none;"><a href="http://nhs.uk/choices/pages/sitemap.aspx" accesskey="3" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Site policies','DCSext.FooterClickUrl','/choices/pages/sitemap.aspx','WT.dl','121')" onKeyPress="this.onclick()">Sitemap</a></li>
</ul>


												</div><div id="ctl00_Footer_ucPersonalisationFooter_OtherNHSSites" class="footer-list">
													
<h2 class="show">Other NHS sites ►</h2>
<ul class="info hidden">
<li><a href="http://www.chooseandbook.nhs.uk/" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Other NHS sites','DCSext.FooterClickUrl','http://www.chooseandbook.nhs.uk/','WT.dl','121')" onKeyPress="this.onclick()">Choose and Book</a></li>
<li><a href="http://www.nhscarerecords.nhs.uk/" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Other NHS sites','DCSext.FooterClickUrl','http://www.nhscarerecords.nhs.uk/','WT.dl','121')" onKeyPress="this.onclick()">Summary Care Records</a></li>
<li><a href="http://www.show.scot.nhs.uk/ " rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Other NHS sites','DCSext.FooterClickUrl','http://www.show.scot.nhs.uk/ ','WT.dl','121')" onKeyPress="this.onclick()">NHS Scotland</a></li>
<li><a href="http://www.hscni.net/  " rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Other NHS sites','DCSext.FooterClickUrl','http://www.hscni.net/  ','WT.dl','121')" onKeyPress="this.onclick()">NHS Northern Ireland</a></li>
<li><a href="http://www.nhsdirect.wales.nhs.uk/" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Other NHS sites','DCSext.FooterClickUrl','http://www.nhsdirect.wales.nhs.uk/','WT.dl','121')" onKeyPress="this.onclick()">NHS Wales</a></li>
<li><a href="http://www.nhscareers.nhs.uk/" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Other NHS sites','DCSext.FooterClickUrl','http://www.nhscareers.nhs.uk/','WT.dl','121')" onKeyPress="this.onclick()">NHS Careers</a></li>
<li><a href="http://www.jobs.nhs.uk/" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Other NHS sites','DCSext.FooterClickUrl','http://www.jobs.nhs.uk/','WT.dl','121')" onKeyPress="this.onclick()">NHS Jobs</a></li>
<li><a href="http://www.dh.gov.uk/en/index.htm " rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Other NHS sites','DCSext.FooterClickUrl','http://www.dh.gov.uk/en/index.htm ','WT.dl','121')" onKeyPress="this.onclick()">Department of Health</a></li>
<li style="border: none;"><a href="http://www.england.nhs.uk/" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Other NHS sites','DCSext.FooterClickUrl','http://www.england.nhs.uk/','WT.dl','121')" onKeyPress="this.onclick()">NHS England</a></li>
</ul>


												</div><div id="ctl00_Footer_ucPersonalisationFooter_AbouttheNHS" class="footer-list">
													
<h2 class="show">About the NHS ►</h2>
<ul class="info hidden">
<li><a href="http://nhs.uk/NHSEngland/Pages/NHSEngland.aspx" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','About the NHS','DCSext.FooterClickUrl','/NHSEngland/Pages/NHSEngland.aspx','WT.dl','121')" onKeyPress="this.onclick()">The NHS in England</a></li>
<li><a href="http://nhs.uk/NHSEngland/AboutNHSservices/Pages/NHSServices.aspx" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','About the NHS','DCSext.FooterClickUrl','/NHSEngland/AboutNHSservices/Pages/NHSServices.aspx','WT.dl','121')" onKeyPress="this.onclick()">About NHS services</a></li>
<li><a href="http://nhs.uk/choiceinthenhs" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','About the NHS','DCSext.FooterClickUrl','/choiceinthenhs','WT.dl','121')" onKeyPress="this.onclick()">Choice in the NHS</a></li>
<li><a href="http://nhs.uk/aboutNHSChoices/professionals/healthandcareprofessionals/quality-accounts/Pages/about-quality-accounts.aspx" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','About the NHS','DCSext.FooterClickUrl','/aboutNHSChoices/professionals/healthandcareprofessionals/quality-accounts/Pages/about-quality-accounts.aspx','WT.dl','121')" onKeyPress="this.onclick()">Quality accounts</a></li>
<li><a href="http://nhs.uk/NHSEngland/thenhs/records/proms/Pages/aboutproms.aspx" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','About the NHS','DCSext.FooterClickUrl','/NHSEngland/thenhs/records/proms/Pages/aboutproms.aspx','WT.dl','121')" onKeyPress="this.onclick()">PROMs</a></li>
<li><a href="http://nhs.uk/ServiceDirectories/Pages/AcuteTrustListing.aspx" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','About the NHS','DCSext.FooterClickUrl','/ServiceDirectories/Pages/AcuteTrustListing.aspx','WT.dl','121')" onKeyPress="this.onclick()">Find authorities and trusts</a></li>
<li style="border: none;"><a href="http://nhs.uk/nhsengland/thenhs/healthregulators/pages/healthwatch-england.aspx" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','About the NHS','DCSext.FooterClickUrl','/nhsengland/thenhs/healthregulators/pages/healthwatch-england.aspx','WT.dl','121')" onKeyPress="this.onclick()">Healthwatch England</a></li>
</ul>


												</div><div id="ctl00_Footer_ucPersonalisationFooter_OtherChannels" class="footer-list">
													
<h2 class="show">Other channels ►</h2>
<ul class="info hidden">
<li><a href="http://twitter.com/nhschoices" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Other channels','DCSext.FooterClickUrl','http://twitter.com/nhschoices','WT.dl','121')" onKeyPress="this.onclick()">Follow us on Twitter</a></li>
<li><a href="http://www.facebook.com/nhschoices" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Other channels','DCSext.FooterClickUrl','http://www.facebook.com/nhschoices','WT.dl','121')" onKeyPress="this.onclick()">Facebook</a></li>
<li><a href="http://www.youtube.com/nhschoices" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Other channels','DCSext.FooterClickUrl','http://www.youtube.com/nhschoices','WT.dl','121')" onKeyPress="this.onclick()">YouTube</a></li>
<li><a href="http://nhs.uk/video/pages/MediaLibrary.aspx" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Other channels','DCSext.FooterClickUrl','/video/pages/MediaLibrary.aspx','WT.dl','121')" onKeyPress="this.onclick()">Video library</a></li>
<li><a href="http://nhs.uk/Pages/LinkListing.aspx" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Other channels','DCSext.FooterClickUrl','/Pages/LinkListing.aspx','WT.dl','121')" onKeyPress="this.onclick()">Links library</a></li>
<li style="border: none;"><a href="http://nhs.uk/aboutNHSChoices/professionals/innovationanddevelopment/Pages/training.aspx " rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Other channels','DCSext.FooterClickUrl','/aboutNHSChoices/professionals/innovationanddevelopment/Pages/training.aspx ','WT.dl','121')" onKeyPress="this.onclick()">NHS Choices Training</a></li>
</ul>


												</div><div id="ctl00_Footer_ucPersonalisationFooter_Languages" class="footer-list">
													
<h2 class="show">Other Languages ►</h2>

<span class="language-intro hidden">Visit our </span><span class="language-intro hidden"><a href="http://nhs.uk/aboutNHSChoices/aboutnhschoices/Aboutus/Pages/languageshub.aspx " rel="nofollow" onKeyPress="this.onclick()">language section</a> for more health websites in foreign languages.</span>

												</div><div id="ctl00_Footer_ucPersonalisationFooter_Contact" class="footer-list">
													
<h2 class="show">Contact NHS Choices ►</h2>
<ul class="info hidden">
<li><a href="http://nhs.uk/aboutNHSChoices/Pages/ContactUs.aspx" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Contact NHS Choices','DCSext.FooterClickUrl','/aboutNHSChoices/Pages/ContactUs.aspx','WT.dl','121')" onKeyPress="this.onclick()">Choices helpdesk</a></li>
<li><a href="http://nhs.uk/aboutnhschoices/contactus/pages/freedom-of-information.aspx" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Contact NHS Choices','DCSext.FooterClickUrl','/aboutnhschoices/contactus/pages/freedom-of-information.aspx','WT.dl','121')" onKeyPress="this.onclick()">Freedom of Information requests</a></li>
<li style="border: none;"><a href="http://nhs.uk/aboutNHSChoices/aboutnhschoices/Aboutus/Pages/working-for-us.aspx" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Contact NHS Choices','DCSext.FooterClickUrl','/aboutNHSChoices/aboutnhschoices/Aboutus/Pages/working-for-us.aspx','WT.dl','121')" onKeyPress="this.onclick()">Working for NHS Choices</a></li>
</ul>


												</div>
        </div>
        
        <div id="footer-tab2" class="footer-tab2 footer-tab-content clear ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
            <div id="ctl00_Footer_ucPersonalisationFooter_ChoicesENewsletters">
													
<div class="footer-wrap clear"><div class="footer-box-wrap">
<span class="crnr tl"></span><span class="crnr tr"></span>

<div class="footer-box-content clear">
<img src="http://nhs.uk/PublishingImages/PersonalisationModules/Modules/newsletterpromo.jpg" alt="$feature.FeatureMainImageAltText">
<h2 class="show">NHS Choices e-newsletters ►</h2>
<p>Sign up for Your Health, the monthly e-newsletter packed with the latest news and topical tips from NHS Choices</p>
</div>

<div class="footer-box-button-wrap">
<div class="footer-box-button">
<span class="crnr tl"></span><span class="crnr tr"></span>
<p><span>NHS Choices e-newsletters</span> <a href="http://nhs.uk/aboutNHSChoices/aboutnhschoices/e-newsletters/Pages/newsletters-home.aspx" rel="nofollow" onClick="dcsMultiTrack('DCSext.FooterClickSection','Choices e-newsletters','DCSext.FooterClickUrl','/aboutNHSChoices/aboutnhschoices/e-newsletters/Pages/newsletters-home.aspx','WT.dl','121')" onKeyPress="this.onclick()"><span class="crnr tl"></span><span class="crnr tr"></span>Sign up<span class="crnr bl"></span><span class="crnr br"></span></a></p>
<span class="crnr bl"></span><span class="crnr br"></span>
</div>
</div>

<span class="crnr bl"></span><span class="crnr br"></span>
</div>

<div class="footer-col">
<h2 class="show">Emails from NHS Choices ►</h2>
<p>NHS Choices offers a range of e-newsletters on various topics. Sign up now for the Your Health newsletter to get monthly news and advice straight to your inbox</p>

<ul>
</ul>
</div>

</div>


												</div>
        </div>

        <div id="footer-tab3" class="footer-tab3 footer-tab-content clear ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
            <div id="ctl00_Footer_ucPersonalisationFooter_PersonalisationFooterDefault1_YourPages">
													
<div class="footer-wrap your-pages clear">





<div class="footer-box-wrap">
<span class="crnr tl"></span><span class="crnr tr"></span>
<div class="footer-box-content clear">
<h2 class="show">Create an NHS Choices account ►</h2>
<p>With an account you can keep track of pages on the site and save them to this tab, which you can access on every page when you are logged in.</p>
<div class="footer-box-button-wrap clear">
<div class="footer-box-button clear">
<span class="crnr tl"></span><span class="crnr tr"></span>
<p><a href="http://nhs.uk/Personalisation/Registration.aspx?ReturnUrl=" onClick="dcsMultiTrack('DCSext.FooterClickSection','Your pages','DCSext.FooterClickUrl','/Personalisation/Registration.aspx?ReturnUrl=','WT.dl','121')" onKeyPress="this.onclick()"><span class="crnr tl"></span><span class="crnr tr"></span>Create account<span class="crnr bl"></span><span class="crnr br"></span></a></p>
<span class="crnr bl"></span><span class="crnr br"></span>
</div>
</div>
<p class="footer-login">Already have an account? <a href="http://nhs.uk/Personalisation/Login.aspx">Log in</a></p>
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
                <li><span class="hidden">–</span><a href="http://www.gov.uk/"><img src="http://nhs.uk/img/gov-uk.gif" alt="Link to gov.uk – The new place to find government services and information" class="gov-uk"></a></li>
                <li><span class="hidden">–</span><a href="http://nhs.uk/aboutNHSChoices/aboutnhschoices/Aboutus/Pages/the-information-standard.aspx"><img src="http://nhs.uk/img/information-standards.gif" alt="The Information Standard - Certified member"></a></li>
            </ul>
        </div>

    </div>

<!--googleon: all-->
    <!-- Footer ends here.... -->

    <!-- Webtrends tracking link -->
    <noscript>
    &lt;div&gt;&lt;img style="border: 0; width: 1px; height: 1px;" alt="" src="http://statse.webtrendslive.com/dcss9yzisf9xjyg74mgbihg8p_8d2u/njs.gif?dcsuri=/nojavascript&amp;amp;wt.js=no&amp;amp;wt.tv=8.0.3" /&gt;&lt;/div&gt;
    </noscript>
    









































































































<!-- Google Analytics testing in bau--> 
<script type="text/javascript">
    //<![CDATA[ 
    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    //]]>
</script><script src="http://www.google-analytics.com/ga.js" type="text/javascript"></script> 
<script type="text/javascript">
    //<![CDATA[
    try {
        var pageTracker = _gat._getTracker("UA-9510975-1");
        pageTracker._trackPageview();
    }
    catch (err) { }
    //]]>
</script> 

<script type="text/javascript" src="http://nhs.uk/dmp/js/tag.js"></script>
        

    
												
<script type="text/javascript">
//<![CDATA[
var __wpmExportWarning='This Web Part Page has been personalized. As a result, one or more Web Part properties may contain confidential information. Make sure the properties contain information that is safe for others to read. After exporting this Web Part, view properties in the Web Part description file (.WebPart) by using a text editor such as Microsoft Notepad.';var __wpmCloseProviderWarning='You are about to close this Web Part.  It is currently providing data to other Web Parts, and these connections will be deleted if this Web Part is closed.  To close this Web Part, click OK.  To keep this Web Part, click Cancel.';var __wpmDeleteWarning='You are about to permanently delete this Web Part.  Are you sure you want to do this?  To delete this Web Part, click OK.  To keep this Web Part, click Cancel.';//]]>
</script>
<script language="JavaScript">
<!--
WPSC.Init(document);
var varPartWPQ10 = WPSC.WebPartPage.Parts.Register('WPQ10','7c674266-741d-43c9-b28d-afd0a5eca5f6',document.all.item('WebPartWPQ10'));
var varPartWPQ11 = WPSC.WebPartPage.Parts.Register('WPQ11','9600eaf4-3600-4a54-85ce-9c413d8c8a22',document.all.item('WebPartWPQ11'));
var varPartWPQ1 = WPSC.WebPartPage.Parts.Register('WPQ1','00000000-0000-0000-0000-000000000000',document.all.item('WebPartWPQ1'));
var varPartWPQ2 = WPSC.WebPartPage.Parts.Register('WPQ2','00000000-0000-0000-0000-000000000000',document.all.item('WebPartWPQ2'));
var varPartWPQ3 = WPSC.WebPartPage.Parts.Register('WPQ3','00000000-0000-0000-0000-000000000000',document.all.item('WebPartWPQ3'));
var varPartWPQ4 = WPSC.WebPartPage.Parts.Register('WPQ4','00000000-0000-0000-0000-000000000000',document.all.item('WebPartWPQ4'));
var varPartWPQ5 = WPSC.WebPartPage.Parts.Register('WPQ5','00000000-0000-0000-0000-000000000000',document.all.item('WebPartWPQ5'));
var varPartWPQ6 = WPSC.WebPartPage.Parts.Register('WPQ6','00000000-0000-0000-0000-000000000000',document.all.item('WebPartWPQ6'));
var varPartWPQ7 = WPSC.WebPartPage.Parts.Register('WPQ7','00000000-0000-0000-0000-000000000000',document.all.item('WebPartWPQ7'));
var varPartWPQ8 = WPSC.WebPartPage.Parts.Register('WPQ8','00000000-0000-0000-0000-000000000000',document.all.item('WebPartWPQ8'));
var varPartWPQ9 = WPSC.WebPartPage.Parts.Register('WPQ9','00000000-0000-0000-0000-000000000000',document.all.item('WebPartWPQ9'));
WPSC.WebPartPage.WebURL = 'http:\u002f\u002fwww.nhs.uk\u002fConditions\u002fAsthma';
WPSC.WebPartPage.WebServerRelativeURL = '\u002fConditions\u002fAsthma';

//-->
</script>
<script type="text/javascript">
//<![CDATA[
Sys.Application.initialize();
//]]>
</script>
<script type="text/javascript">
$(document).ready(function() {
	var __assessment = document.createElement('script'); 
	var __assessment_obj = document.getElementsByTagName('script')[document.getElementsByTagName('script').length - 1]; 
	__assessment.id = 'assessment_webpart'; 
	__assessment.ASid = '<?php echo $asid;?>'; 
	__assessment.APPpath = '';
	__assessment.displaydate = true;
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
</form>
</div><div id="goog-gt-tt" class="skiptranslate" dir="ltr"><div style="padding: 8px;"><div><div class="logo"><img src="https://www.google.com/images/icons/product/translate-32.png" width="20" height="20"></div></div></div><div class="top" style="padding: 8px; float: left; width: 100%;"><h1 class="title gray">Original text</h1></div><div class="middle" style="padding: 8px;"><div class="original-text"></div></div><div class="bottom" style="padding: 8px;"><div class="activity-links"><span class="activity-link">Contribute a better translation</span><span class="activity-link"></span></div><div class="started-activity-container"><hr style="color: #CCC; background-color: #CCC; height: 1px; border: none;"><div class="activity-root"></div></div></div><div class="status-message" style="display: none;"></div></div>

<iframe frameborder="0" class="goog-te-menu-frame skiptranslate" style="visibility: visible; box-sizing: content-box; width: 731px; height: 274px; display: none;"></iframe><?php require_once("nav.php");?></body></html>