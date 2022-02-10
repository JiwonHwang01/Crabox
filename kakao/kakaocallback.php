<?php
  session_start();

  /*------ db connect ------*/

  include 'db.php';
  $link = connect_db($host,$dbid,$dbpw,$dbname);
  mysqli_set_charset($link, "utf-8");

  /*------ db connect ------*/

  $clientId = "abda5ca475e316493fca5c6012b2950d";
  $client_secret = "bJcfb82FPYt0dAVsVk8xQgQ7WZEFZAZy";
  $callbackURI = urlencode("https://crabox.io/kakao/kakaocallback.php");

  $returnCode = $_GET["code"]; // 서버로 부터 토큰을 발급받을 수 있는 코드를 받아옵니다.
  $restAPIKey = $clientId; // 본인의 REST API KEY를 입력해주세요
  $returnUrl = "https://kauth.kakao.com/oauth/token?grant_type=authorization_code&client_id=".$restAPIKey."&redirect_uri=".$callbackURI."&code=".$returnCode."&client_secret=".$client_secret;
 
  $isPost = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $returnUrl);
  curl_setopt($ch, CURLOPT_POST, $isPost);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
  $loginResponse = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close ($ch);

  if($status_code == 200) {

    $p_token = json_decode($loginResponse, true);
    $_SESSION['access_token'] = $p_token['access_token']; 
    $_SESSION['refresh_token'] = $p_token['refresh_token']; 
    $_SESSION['refresh_token_expires_in'] = $p_token['refresh_token_expires_in'];

    $token = $p_token['access_token'];
    //echo "access_token : ".$token;
    /*
    $curl = 'curl -v -X GET https://kapi.kakao.com/v2/user/me -H "Authorization: Bearer '.$token.'"';
    $info = shell_exec($curl);
    $info_arr = json_decode($info, true);
    */
    $me_header = "Bearer ".$token; 
    $me_url = "https://kapi.kakao.com/v2/user/me";
    $me_is_post = true;
    $me_ch = curl_init();
    curl_setopt($me_ch, CURLOPT_URL, $me_url);
    curl_setopt($me_ch, CURLOPT_POST, $me_is_post);
    curl_setopt($me_ch, CURLOPT_POSTFIELDS, false);
    curl_setopt($me_ch, CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($me_ch, CURLOPT_SSLVERSION, 1);
    curl_setopt($me_ch, CURLOPT_RETURNTRANSFER, true);
    $me_headers = array();
    $me_headers[] = "Authorization: ".$me_header;
    curl_setopt($me_ch, CURLOPT_HEADER, true);

    curl_setopt($me_ch, CURLOPT_HTTPHEADER, $me_headers);
    $me_response = curl_exec ($me_ch);
    $me_status_code = curl_getinfo($me_ch, CURLINFO_HTTP_CODE);
    curl_close ($me_ch);

    $HeaderLength=strlen(explode('{',$me_response)[0]);
    $p_res = substr($me_response,$HeaderLength);
    //echo "<br>".$p_res;

    if($me_status_code == 200) {

        $userInfo = json_decode($p_res, true);
        $userName = $userInfo['properties']['nickname'];
        $email = $userInfo['kakao_account']['email'];
        $profile = $userInfo['properties']['profile_image'];

        $userId=explode('@',$email)[0];
        /*
        $gender = $userInfo['kakao_account']['gender'];
        $birthYear = json_decode($me_response, true)['response']['birthyear'];
        if($birthYear!=NULL){
            $age = getdate()['year']-$birthYear;
          }
          else{
            $age = NULL;
          }
          */
        //echo "<br>(이름) ".$userName."<br>(아이디) ".$userId;
        $query = mysqli_query($link,"SELECT * FROM member2 WHERE id ='".$userId."'");
        $cnt = mysqli_num_rows($query);
        if($cnt == 0){ // New User
          $flag = 1;
          echo '
          <form id="goJoin" method="post" action="../account_social.php">  
            <input type="hidden" name="type" value="KAKAO">  
            <input type="hidden" name="userId" value="'.$userId.'">  
            <input type="hidden" name="flag" value="'.$flag.'">  
            <input type="hidden" name="email" value="'.$email.'">  
            <input type="hidden" name="name" value="'.$userName.'">  
          </form>  
          <script>
            this.document.getElementById("goJoin").submit();
          </script>';
        }
        else{
            $result = mysqli_fetch_row($query); 
            if($result[2]=='KAKAO'){
              $res1 = mysqli_query($link,"UPDATE SNS_INFO SET type = 'KAKAO' WHERE id ='".$userId."'");
              $res2 = mysqli_query($link,"UPDATE SNS_INFO SET access_token = '".$access_token."' WHERE id ='".$userId."'");
              $res3 = mysqli_query($link,"UPDATE SNS_INFO SET refresh_token = '".$refresh_token."' WHERE id ='".$userId."'");
              mysqli_query($link,"UPDATE member2 SET gender = '".$gender."' WHERE id ='".$userId."'");
              //mysqli_query($link,"UPDATE member2 SET age = '".$age."' WHERE id ='".$userId."'");
    
              if($res1 && $res2 && $res3){
    
                $_SESSION['id'] = $userId;
                $_SESSION['login_type'] = 'KAKAO';
    
              echo ("<script language=javascript> alert('로그인에 성공하였습니다.');</script>");
              echo ("<meta http-equiv='Refresh' content='0; URL=../searchList.php'>");
              }
            }
            elseif($result[2]!=NULL){ 
                echo ("<script language=javascript> alert('KAKAO 연동 회원이 아닙니다.<br>".$result[2]." 계정으로 로그인 해주십시오.');</script>");
                echo ("<meta http-equiv='Refresh' content='0; URL=../loginMobile.php'>");
              }
            else{
                echo ("<script language=javascript> alert('SNS 연동 회원이 아닙니다.');</script>");
                echo ("<meta http-equiv='Refresh' content='0; URL=../login.php'>");
            }
        }
    }
    else { 
        echo "회원 정보를 불러오지 못 했습니다.<br>";
        echo "Error 내용:".$me_response;
    }
  }
  else { 
    echo "토큰을 발급받지 못 했습니다.<br>";
    echo "Error 내용:".$response;
  }
  mysqli_close($link);
?>
