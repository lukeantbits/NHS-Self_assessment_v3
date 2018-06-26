<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>

<script src="js/jquery-1.8.1.min.js"></script>
</head>

<body>
<pre>
<?php
$client_secret ="RAjDwaXKqy6N_jGC1x54OvxbMqihJAbLumblmb2gSbpzq-FVyxSJaupURrikGZ1QRNs6XUtz8-KdIsl_YPU6_w";
$client_id     ="2dc7b6df-8cdb-488f-b749-8bf693bc0ed8";
$auth_string   = "{$client_id}:{$client_secret}";
$request       = "https://oauth.brightcove.com/v4/access_token?grant_type=client_credentials";
$ch            = curl_init($request);
curl_setopt_array($ch, array(
        CURLOPT_POST           => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_SSL_VERIFYPEER => FALSE,
        CURLOPT_USERPWD        => $auth_string,
        CURLOPT_HTTPHEADER     => array(
            'Content-type: application/x-www-form-urlencoded',
        )
    ));
$response = curl_exec($ch);
curl_close($ch);

// Check for errors
if ($response === FALSE) {
    die(curl_error($ch));
    echo 'An error occurred';
}else{
	$obj = json_decode($response,true);
	//print_r($obj);
	//echo $obj['access_token'];
?>
</pre>
<script language="javascript">
var policy_key = 'BCpkADawqM1OT2ano_knYrgXDGshdXSIXJT1Ub8BNAkFbAJLfdq8AjXZZGk1NfX5zNghRqGT3tjvzF4AVg6hwGkTdpwDh8jbgha1u3WT0HeJoUPaD8wKhoBT-Es'
var account_id = '79227729001'
$(document).ready(function(){

	var token = '<?php echo $obj['access_token'];?>';
	$.ajax({
		url: 'https://policy.api.brightcove.com/v1/accounts/79227729001/policy_keys',
		type: 'post',
		data: {
			"key-data": {
				"account-id": account_id,
				"allowed-domains": [
					"http://localhost"
					
				]
			}
		},
		headers: {
			Authorization:  'Bearer '+token
		},
		dataType: 'json',
		success: function (data) {
			console.info(data);
		}
	});
	//var url = 'https://cms.api.brightcove.com/v1/accounts/79227729001'
	//var oauth_url = 'https://oauth.brightcove.com/v4'*/
	//https://edge.api.brightcove.com/playback/v1/accounts/79227729001/videos
	
	
})
</script>
</body>
</html>
<?php }?>