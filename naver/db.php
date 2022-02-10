<?php
$host="34.64.147.149";
$dbid="crabox";
$dbpw="crabox3005";
$dbname="craboxdb";
?>
<?php
function connect_db($host,$dbid,$dbpw,$dbname)
{
    return mysqli_connect($host,$dbid,$dbpw,$dbname);
}

function connect_check($connect){
    if(!$connect){
        echo "<br >MySQL 접속 에러 : ";
        echo mysqli_connect_error()."<br>";
        exit();
    }
    else{
        echo "<br> crabox db 접속 성공 !<br> ";
    }
}

function insertion_check($insertion){
    if(!$insertion){
    echo " <br> DB insert Fail ! <br> ";
    }
    else echo "<br> DB insert success ! <br>";
  }

?>