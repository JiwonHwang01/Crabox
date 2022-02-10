<?php
    $clientId = "abda5ca475e316493fca5c6012b2950d";
    $callbackURI = urlencode("https://crabox.io/kakao/kakaocallback.php");
    $kakaoLoginUrl = "https://kauth.kakao.com/oauth/authorize?response_type=code&client_id=".$clientId."&redirect_uri=".$callbackURI;
?>
<a href="<?php echo $kakaoLoginUrl ?>"><img src="kakao_login_medium_wide.png"></a>
