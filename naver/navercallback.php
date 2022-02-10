<?php
  // 네이버 로그인 콜백 예제
  include 'db.php';

  $link = connect_db($host,$dbid,$dbpw,$dbname);
  mysqli_set_charset($link, "utf-8");

  $client_id = "VbK9KZIy8cmDashQbai4";
  $client_secret = "Po6oCL3CjM";

  $code = $_GET["code"];;
  $state = $_GET["state"];;
  $redirectURI = urlencode("https://crabox.io/naver/navercallback.php"); //문자열을 url 쿼리로 사용할 수 있도록 encode 해주는 함수
  $url = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=".$client_id."&client_secret=".$client_secret."&redirect_uri=".$redirectURI."&code=".$code."&state=".$state;
  $is_post = false;
  $ch = curl_init(); //리소스 초기화
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
  $response = curl_exec ($ch); //서버에 데이터 요청하여 응답을 받는 과정
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

  curl_close ($ch); //리소스 해제
  if($status_code == 200) {
    //echo $response;
    
    // parsing    
    //echo "<br>";
    $processed_token = substr(str_replace('","','&',str_replace('":"','=',$response)),2,-2);
    //echo($processed_token);
    parse_str($processed_token);
    //echo "<br>( access_token )<br>".$access_token."<br>( refresh_token )<br>".$refresh_token.
    "<br>( token_type )<br>".$token_type."<br>";

    $token = $access_token;
    $me_header = "Bearer ".$token; 
    $me_url = "https://openapi.naver.com/v1/nid/me";
    $me_is_post = false;
    $me_ch = curl_init();
    curl_setopt($me_ch, CURLOPT_URL, $me_url);
    curl_setopt($me_ch, CURLOPT_POST, $me_is_post);
    curl_setopt($me_ch, CURLOPT_RETURNTRANSFER, true);
    $me_headers = array();
    $me_headers[] = "Authorization: ".$me_header;
    curl_setopt($me_ch, CURLOPT_HTTPHEADER, $me_headers);
    $me_response = curl_exec ($me_ch);
    $me_status_code = curl_getinfo($me_ch, CURLINFO_HTTP_CODE);
    //echo "<br>status_code:".$me_status_code."<br>";
    curl_close ($me_ch);

    if($me_status_code == 200) { //서버에 user 정보 요청 성공
      
      // parsing
      $processed_userInfo = substr(str_replace('","','&',str_replace('":"','=',$me_response)),44,-3);
      parse_str($processed_userInfo);
      $userId=explode('@',$email)[0];

      $date = getdate()[year]."-".getdate()[mon]."-".getdate()[mday];
      //echo $processed_userInfo;
      //echo "<br>( date )<br>".$date;
      //echo "<br>( keyID )<br>".$id."<br>( userId )<br>".$userId."<br>( userGender )<br>".$gender."<br>( userEmail )<br>".$email.
      "<br>( userName )<br>".$name."<br>( userName )<br>".$birthday."<br>";
      
      //기존 회원 중에 있는지 검색 ( userId )
      $query = mysqli_query($link,"SELECT * FROM member2 WHERE id ='".$userId."'");
      $cnt = mysqli_num_rows($query);
      if($cnt == 0){ //새로운 회원이므로 memeber2 db에 회원 정보, SNS_INFO에 token 값 저장
        $flag = 1;
        include 'test_hjw.php'
  
    
        /* post로 넘겨서 띄워주기
        $sql = "INSERT INTO member2 (id, type, name, email, birthday) 
              VALUES ('".$userId."','NAVER','".$name."','".$email."','".$birthday."')";
        $result = mysqli_query($link,$sql);
        insertion_check($result); //member2.Insert 체크
        $sql = "INSERT INTO SNS_INFO (id, type, key_id, email,connect_date, access_token, refresh_token) 
        VALUES ('".$userId."','NAVER','".$id."','".$email."','".$date."','".$access_token."','".$refresh_toekn."')";
        $result = mysqli_query($link,$sql);
        insertion_check($result); //member2.Insert 체크

        echo "<br>신규 회원입니다. NAVER Info 업데이트 완료 !";
        */
      }
      else{
        $sql1 = "UPDATE SNS_INFO SET type = 'NAVER' WHERE id ='".$userId."'";
        $sql2 = "UPDATE SNS_INFO SET access_token = '".$access_token."' WHERE id ='".$userId."'";
        $sql3 = "UPDATE SNS_INFO SET refresh_token = '".$refresh_token."' WHERE id ='".$userId."'";
        mysqli_query($link,$sql1);
        mysqli_query($link,$sql2);
        mysqli_query($link,$sql3);
        mysqli_query($link,"UPDATE member2 SET type = 'NAVER' WHERE id ='".$userId."'");
        
        echo "<br>기존에 있는 회원입니다. token 업데이트 완료 !";
      }
    }
    else { 
      echo "회원 정보를 불러오지 못 했습니다.<br>";
      echo "Error 내용:".$response;
    }

  } 
  else { 
    echo "토큰을 발급받지 못 했습니다.<br>";
    echo "Error 내용:".$response;
  }
?>
