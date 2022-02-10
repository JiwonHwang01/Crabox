<!DOCTYPE HTML>
<html lang="ko">

<head>
<title>Crabox</title>
<meta content="text/html" ;=";" charset="utf-8"/>
<meta charset="utf-8">
<meta name="viewport"content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=no">
<link rel="stylesheet" type="text/css" href="stylesheet.css">


<style>
@media (min-width:651px) and (max-width:1100px) {}
@media (min-width:100px) and (max-width:651px) {}
body {
  background: #ffffff; /* fallback for old browsers */
  background: -webkit-linear-gradient(
    to left,
    #f0f4fd -56.86%,
    #ffffff 126.39%
  ); /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(
    to left,
    #f0f4fd -56.86%,
    #ffffff 126.39%
  ); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
.circle1 {
  position: absolute;
  left: -57px;
  top: -139px;
  background: linear-gradient(
    315deg,
    rgba(255, 255, 255, 0.61) 3.5%,
    rgba(121, 171, 252, 0.61) 93.61%,
    rgba(96, 108, 255, 0.61) 147.83%
  );
  border-radius: 299px;
  width: 299px;
  height: 299px;
}
.circle2 {
  position: absolute;
  top: 67px;
  background: linear-gradient(147.47deg, #6AFCFF 24.48%, #FE84F0 118.65%);
  border-radius: 136px;
  width: 136px;
  height: 136px;
}
.light {
  position: absolute;
  top: 99px;
}
.circle3 {
  position: absolute;
  right: 73.29px;
  top: 339px;
  background: linear-gradient(228.76deg, #2deef9 -34.42%, #e084f1 127.18%);
  transform: rotate(-15.82deg);
  border-radius: 55.65px;
  width: 55.65px;
  height: 55.65px;
}
.title {
  font-size: 32px;
  color: #384f7d;
  font-weight: 900;
  position: relative;
  top: 76px;
}
.form-sub {
  color: rgba(68, 89, 132, 0.3);
  font-size: 12px;
  font-weight: bolder;
  position: relative;
  margin-top: 100px;
  text-align:left;
}
.form-sub2 {
  color: rgba(68, 89, 132, 0.3);
  font-size: 12px;
  font-weight: bolder;
  position: relative;
  margin-top: 50px;
  text-align:left;
}
.form-sub3 {
  color: rgba(68, 89, 132, 0.3);
  font-size: 12px;
  font-weight: bolder;
  position: relative;
  margin-top: 50px;
  text-align:left;
}
.form-sub4 {
  color: rgba(68, 89, 132, 0.3);
  font-size: 12px;
  font-weight: bolder;
  position: relative;
  margin-top: 50px;
  text-align:left;
}
.form-sub5 {
  color: rgba(68, 89, 132, 0.3);
  font-size: 12px;
  font-weight: bolder;
  position: relative;
  margin-top: 50px;
  text-align:left;
}
.form-sub6 {
  color: rgba(68, 89, 132, 0.3);
  font-size: 12px;
  font-weight: bolder;
  position: relative;
  margin-top: 460px;
}
.form-control {
  width: 100%;
  height: 100%;
  background: #ffffff;
  border-image: linear-gradient(125.58deg, #6AFCFF -5.37%, #BAFB67 196.64%);
  border-image-slice: 40;
  outline: none;
  font-size: 1.2rem;
  border-radius: 8px;
  position: relative;
  padding-left: 5px;
  border-width: 0px 0px 3px 0px;
  color: rgba(56, 79, 125, 0.65);
}
.form-control_id {
  width: 100%;
  height: 100%;
  background: #ffffff;
  border-image: linear-gradient(125.58deg, #6AFCFF -5.37%, #BAFB67 196.64%);
  border-image-slice: 40;
  outline: none;
  font-size: 1.2rem;
  border-radius: 8px;
  position: relative;
  padding-left: 5px;
  border-width: 0px 0px 3px 0px;
  color: rgba(56, 79, 125, 0.65);
}
input::placeholder {
  color: rgba(56, 79, 125, 0.65);
  font-size: 14px;
  font-weight: 450;
}
.button {
  position: relative;
  background: linear-gradient(125.58deg, #2DEEF9 -5.37%, #E084F1 196.64%);
  border: 1px solid #ffffff;
  border-radius: 8px;
  width: 100%;
  height: 100%;
  outline: none;
  color: #ffffff;
  font-weight: bolder;
  font-size: 14px;
  margin-top: 50px;
}
.text {
  position: relative;
  color: #445984;
  font-size: 16px;
  margin-top: 50px;
}
</style>
</head>


<script type="text/javascript">
    function tocheckpw2() {
      //alert("www");
      var pw = document.getElementById("PASSWORD").value;
      var pwck = document.getElementById("PASSWORD_CHECK").value;
      var pattern1 = /[0-9]/;
      var pattern2 = /[a-zA-Z]/;
      var pattern3 = /[~!@\#$%<>^&*]/;     // 원하는 특수문자 추가 제거
  		if (pw != pwck) {
        alert("비밀번호가 맞지 않습니다.");
        return false;
  		}
  		if(!pattern1.test(pw)||!pattern2.test(pw)||!pattern3.test(pw)||pw.length<8||pw.length>50){
        alert("비밀번호는 영문+숫자+특수기호 8자리 이상으로 구성하여야 합니다.");
        return false;
      }
    }
</script>
<?php 
    $type = $_POST['type'];
    $userId = $_POST['userId'];
    $flag = $_POST['flag'];
    $email = $_POST['email'];
    $name = $_POST['name'];
  ?>
<script type="text/javascript">
    var flag = "<?php echo $flag ?>"
    var userId = "<?php echo $userId ?>"
    var snsType = "<?php echo $type?>"
    var userEmail = "<?php echo $email?>"
    var userName = "<?php echo $name?>"

    function fromSNS(){
        if(flag=="1"){
          document.getElementById("EMAIL").placeholder = userEmail;
          document.getElementById("EMAIL").disabled = "disabled";
          document.getElementById("NAME").placeholder = userName;
          document.getElementById("NAME").disabled = "disabled";
          document.getElementById("ID").placeholder = userId;
          document.getElementById("ID").disabled = "disabled";

        }
    }
    function setValue(){
      if(flag=="1"){
          document.getElementById("EMAIL").setAttribute("value",userEmail);
          document.getElementById("NAME").setAttribute("value",userName);
          document.getElementById("ID").setAttribute("value",userId);
          alert(document.getElementById('ID').value);
    }
  }
</script>

<body onload = "fromSNS()"> 
    <div class="only-mob">
        <div id="mob-hd"></div>
        <div class="background" style="height:1100px">
        <div class="circle1"></div>
        <div class="circle2"></div>
        <img class="light" src="https://crabox.io/crabox1/image/light.png"/>
        <div class="circle3"></div>
            <div class="title">Welcome!</div>
            <form class="" action ="join_check.php" onsubmit="return tocheckpw2()" style="width:100%; text-align:center" data-ajax="false" method="post" enctype="multipart/form-data">
            <div id="form-group" style="width:90%; height:56px; display: inline-block;">
                <p class="form-sub" style="">ID
                </p>
                <input type="text" name="ID" class="form-control_id" placeholder="ID input" required/>
                <!--<button class=""  type="button"  style="width:20%;cursor:pointer" onclick="id_check()">중복확인</button>-->
            </div>
            <div id="form-group" style="width:90%; height:56px; display: inline-block;">
                <p class="form-sub2" style="">EMAIL
                </p>
                <input type="email" name="EMAIL" class="form-control_id" placeholder="abc123@gmail.com" required/>
                <!--<button class=""  type="button"  style="width:20%;cursor:pointer" onclick="id_check()">중복확인</button>-->
            </div>
            <div id="form-group" style="width:90%; height:56px; display: inline-block;">
                <p class="form-sub3">PASSWORD</p>
                <input type="password" id="PASSWORD" name="PASSWORD" class="form-control" placeholder="⦁⦁⦁⦁⦁⦁⦁⦁" required/>
            </div>
            <div id="form-group" style="width:90%; height:56px; display: inline-block;">
                <p class="form-sub4">TYPE PASSWORD AGAIN</p>
                <input type="password" id="PASSWORD_CHECK" class="form-control" placeholder="⦁⦁⦁⦁⦁⦁⦁⦁" required/>
            </div>
            <div id="form-group" style="width:90%; height:56px; display: inline-block;">
                <p class="form-sub5">NAME</p>
                <input type="text" name="NAME" class="form-control" placeholder="HONG GIL DONG" required/>
            </div>
            <!--<div id="form-group" style="width:90%; height:56px; display: inline-block;">
                <p class="form-sub5">EMAIL</p>
                <input type="email" name="EMAIL" class="form-control" placeholder="abc123@gmail.com" required/>
            </div>-->
            <div style="width:90%; height:56px; display: inline-block;">
              <!--  <button class="button"  type="button"  onclick="btnClick()">회원가입 하기</button>-->
                <input  type="submit" class="button" name="submit" style="cursor:pointer" value="회원가입 하기" />
            </div>
            </form>
            <div class="text" style="display: inline-block;">
                로그인 하러가기
                <a style="font-weight:700; font-size:16px; color:#445984;" href="login.php">Login</a>
            </div>
        </div>
      </div>
</body>
</html>