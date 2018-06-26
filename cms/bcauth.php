<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>

<script src="js/jquery-1.8.1.min.js"></script>
</head>

<body>
<script language="javascript">
var policy_key = 'BCpkADawqM1OT2ano_knYrgXDGshdXSIXJT1Ub8BNAkFbAJLfdq8AjXZZGk1NfX5zNghRqGT3tjvzF4AVg6hwGkTdpwDh8jbgha1u3WT0HeJoUPaD8wKhoBT-Es'
var account_id = '79227729001'
$(document).ready(function(){
	// client secret: RAjDwaXKqy6N_jGC1x54OvxbMqihJAbLumblmb2gSbpzq-FVyxSJaupURrikGZ1QRNs6XUtz8-KdIsl_YPU6_w
	// client id: 2dc7b6df-8cdb-488f-b749-8bf693bc0ed8
	// token = AE91hQ8G20XL7mpIMS5LnLa5HUIft3hihappFaIcyTehZOMZ856YoG1ERn9pmnxrM7hVUXiYebhy9ZVszJn83y6iPNRlM69R0Ef9adb9iEhNMhe-HfNUaLbLdd5709L8px7i-k9AqzPG-hCQUa6_xfPZKm2Nuf0SZQWp3m5iRdK4CVbRt8VaEQ3X-foSXmjTHg2s9bPLkdoRw_Vj07kgAnh7UXSXb53_v98KPmUSMyEIYHcu2wcVScS6pHcjuSFnSytvfLU0Yrnbsx2CHjbR6tBmUxVoA5vc829vRsMQysPf2A711yRgGSskQB55gBlBbMDI72_CdZVRlYBTn_-D2m-CGxTt0axg-sa0kx6bVmpLYI760gO5iQkY0uCLSipoT_vv7pM2eHBH89o4rLH1plMsuWmdXKJYYFBxq8I_paAUQxcmOhUJk-Mw3BlUq8zI7LsjElfjI4QNTZiOVCX7zx3XCIACj9X7x2b_RpJvmPt9DWeF0USARjpkX_9YM3P999CNCsOxR6ou
	
	/*$.post( "//policy.api.brightcove.com/v1/accounts/79227729001/policy_keys", function(data) {
	  console.log( data );
	});*/
	/*var token = 'AE91hQ8CpdA9m8hZ9AzAepRH2lB4QnShqIBNErC_BN4whyuswGkDYe-XnBO1TxLCLYarC3NPDZmriLV7FMug4hq3O9mPoDWB811BfbQsUJ1sjI7IPpE-66jXb9OLZBMDRdCWdLeC-RCmds9AUvmnVRC6YGTTgi6_ExYnv0jYhddKiol_NrGtnALiRliCRFV3XoGsPyM6Ejb546h1NqzwRIGwTJtOhqm8QphUOjjzPIf7n1CmpmE31m4JZ_kprftAUELU31sssyoTTqlGEcinZWucFlqW93k59LZE237TK-KiELtwy5kKsYfbH3DCqw95dIzHQdrj6humH0AExNE06w05LaT31kp79tedSXYYPx9zP7Z2BF5XTRaNJJLktAEqd6AN7Gg9tYZp-i-27IJTDlAPddjmiipEyPrFEO95dBV0XjEJCh0nzsET6oBf_zwYysyeRjqmerAbrv6BhtrWINqVocAE9dIaLWwL_fGEC-1g2hu_tUEO5on-l4lR08DR6r4CWC5wT4Ah'
	$.ajax({
		url: 'https://policy.api.brightcove.com/v1/accounts/79227729001/policy_keys',
		type: 'post',
		data: {
			Authorization:  'Bearer '+token
		},
		headers: {
			Authorization:  'Bearer '+token
		},
		dataType: 'json',
		success: function (data) {
			console.info(data);
		}
	});*/
	//var url = 'https://cms.api.brightcove.com/v1/accounts/79227729001'
	var oauth_url = 'https://oauth.brightcove.com/v4'
	
})
</script>
</body>
</html>