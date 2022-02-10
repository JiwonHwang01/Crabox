<?php // 현재 로그인 된 사용자 access token 넘겨 받아야하는 작업 추후에 진행
     include 'db.php';
     $access_token = $_POST[access_token];
     $link = connect_db($host,$dbid,$dbpw,$dbname);
     mysqli_set_charset($link, "utf-8");
   
     $client_id = "VbK9KZIy8cmDashQbai4";
     $client_secret = "Po6oCL3CjM";
     
     $redirectURI = urlencode("http://127.0.0.1/naver/navercallback.php"); //문자열을 url 쿼리로 사용할 수 있도록 encode 해주는 함수
     $url = "https://nid.naver.com/oauth2.0/token?grant_type=delete&client_id=".$client_id."&client_secret=".$client_secret."&access_token=".$access_token;
     $is_post = false;
     $ch = curl_init(); //리소스 초기화
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_POST, $is_post);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $response = curl_exec ($ch); //서버에 데이터 요청하여 응답을 받는 과정
     $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
     curl_close ($ch); //리소스 해제
     

     if($status_code == 200) { 
        //넘어오는 값보고 파싱 수정해야함
        $processed_response = substr(str_replace('","','&',str_replace('":"','=',$response)),2,-2);
        parse_str($processed_response);
        $sql = "DELETE TABLE SNS_INFO WHERE access_token = $access_token";
        mysqli_query($link,$sql);
        if($result != 'success') echo "오류<br>";// '네이버 - 내정보 - 보안설정 - 외부사이트 연결'에서 해당앱 삭제
     }
     else echo "오류<br>";// '네이버 - 내정보 - 보안설정 - 외부사이트 연결'에서 해당앱 삭제
?>