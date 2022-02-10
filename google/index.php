<!DOCTYPE html>

<head>
    <title>G_Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="887858698104-7c2rmmq38j4pv7v64mulomml3r5jfara.apps.googleusercontent.com">

    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script> 
   
    <script>
        function init(){
            gapi.load('auth2', function() {
                window.gauth = gapi.auth2.init({ 
                    client_id:'887858698104-7c2rmmq38j4pv7v64mulomml3r5jfara.apps.googleusercontent.com'
                })
            });
        }
    </script>
    

</head>
<body>
    
    <div class="g-signin2" data-onsuccess="onSignIn"></div>
    <script>
        function onSignIn() {
            var profile = gauth.currentUser.get().getBasicProfile();
            var user = gauth.currentUser.get().getAuthResponse();
            var id_token = user.id_token;
            var access_token = user.access_token;
            var token_type = user.token_type;
            var expires_in = user.expires_in;

            if (gauth.isSignedIn.get()) {
                console.log('ID: ' + profile.getId());
                console.log('Full Name: ' + profile.getName());
                console.log('Image URL: ' + profile.getImageUrl());
                console.log('Email: ' + profile.getEmail());
                console.log("ID Token: " + id_token);
                console.log("Access Token: " + access_token);
                console.log("Token Type: " + token_type);
                console.log("Expires in: " + expires_in); 

                $.ajax({
                    url:'http://localhost/login.php',
                    type : 'POST',
                    data:{'id_token' : id_token},
                    success:function(data){ 
                        alert('성공입니다!');
                        document.write(data);
                    },
                    error:function(err){
                        alert('전송 실패...');
                    }
                });

            }
            else{ console.log("사용자 정보를 받아오는데 실패했습니다.");}
        }
    </script>
    <script>  
    
    
</body>
</html>