<?php

include 'dbdbinfo.php';

if($conn){
    echo "MySQL 접속 성공!!!!";
}else{
    echo "MySQL 접속 실패.....";
}

$dataid = $_POST['id'];
//$dataaccess = $_POST['accesstoken'];
$dataname = $_POST['username'];
$dataemail = $_POST['email'];
$databirthday = $_POST['birthday'];
$datapicture = $_POST['picture'];

echo("php에서 출력하는 id토큰입니다!!". (".$dataid."));
//echo("php에서 출력하는 access토큰입니다!!". ($dataaccess));
//echo "   제발..되자....";

$userid = explode('@',$dataemail)[0]; //email에서 아이디만 잘라서 아이디 포함

mysqli_query($link,"");
$checksql = "SELECT * FROM fbdb WHERE id = '$userid'";
$res = mysqli_query($conn,$checksql);
$count = mysqli_num_rows($res);
if($count){
    echo '이미 존재하는 회원입니다! 로그인된 페이지로 넘기기';
    //로그인된 페이지주소 입력해서 거기로 넘기기
}
else{
    echo '없는회원!회원가입존으로 이동';    
    //echo "<script>location.href='https://crabox.io/test/조채원/0121.php';</script>";//이걸 다른 페이지로 만들어서 해보자
    mysqli_query($conn,"INSERT INTO fbdb VALUES ('$dataid', '$userid' , '$dataname' ,'$dataemail','$databirthday','$datapicture')"); // 프로필 db로 이동
    //mysqli_query($conn,"INSERT INTO chotestgoogle VALUES (null, '$dataid' ,'$dataaccess')"); //토큰값 저장하기
}

mysqli_close($conn);
?>