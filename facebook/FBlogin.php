<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
  
   
</head>

<body>
    <div id="fb-root"></div>
    <div class="fb-login-button" data-width="1" data-size="large" data-button-type="login_with" data-layout="default" data-auto-logout-link="true" data-use-continue-as="false"></div>


<script>
  window.fbAsyncInit = function() {
     FB.init({               //sdk 초기화
      appId      : '3597626313605829',
      cookie     : true,                    
      xfbml      : true,                    
      version    : 'v9.0',          
    });

    
FB.getLoginStatus(function(response) {
  statusChangeCallback(response);
    if (response.status === 'connected') { 
      var accesstoken = response.authResponse.accessToken;
      console.log('access token ' + accesstoken);

    }
  });

  }

  
function statusChangeCallback(response) { 
        //console.log('statusChangeCallback'); 
        console.log(response); 

        if (response.status === 'connected') {  
            testAPI(); }
        else if (response.status === 'not_authorized') { 
            //document.getElementById('status').innerHTML = 'Please log ' + 'into this app.'; } 
        else {  
            //document.getElementById('status').innerHTML = 'Please log ' + 'into Facebook.'; }
        }

function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
    console.log(response);
  });

  };


   

  (function(d, s, id){
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "https://connect.facebook.net/en_US/sdk.js";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
   


function testAPI() {
  console.log('환영!');
  FB.api('/me', {fields : 'email,name,gender,birthday,picture' },function(response) {
    console.log(JSON.stringify(response));
    console.log('로그인 성공 name ' + response.name);
    console.log('로그인 성공 userid ' + response.id);
    console.log('로그인 성공 email ' + response.email);
    console.log('로그인 성공 birthday ' + response.birthday);
    //console.log('로그인 성공 gender ' + response.gender); /gender가 안됨....==>검수절차 완료해야함
    console.log('로그인 성공 gender ' + response.picture);
    //document.getElementById('status').innerHTML = 
    //'로그인 성공감사' + response.name;

    var id =response.id
    $.ajax({
          url:'https://crabox.io/kakao/fbcallback.php',
          type : 'POST',
          //headers :{Authorization: 'Bearer '+token}, headers 넣으니 오류발생....
          data:{'id' : response.id ,
          'username' : response.name, 'email' : response.email, 'birthday' : response.birthday, 'picture' : response.picture },
          success:function(data){
            alert('성공입니다!');
            document.write(data);
          },error:function(err){
            alert('실패...');
          }
        });
});



FB.login(function(response) {
    if (response.authResponse) {
        //user authorized the app
    }
}, {scope: 'email,public_profile,user_birthday,gender', return_scopes: true});









}




  </script>

   

    <fb:login-button 
    scope="public_profile,email,user_birthday" onlogin="checkLoginState();">
  </fb:login-button>

 
  
</body>
</html>