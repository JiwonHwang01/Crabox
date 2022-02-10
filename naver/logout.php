<?php
    session_start();
   
    unset($_SESSION['id']);
    unset($_SESSION['login_type']);
    if(!isset($_SESSION['id']) && !isset($_SESSION['logintype'])){
        $destroyCheck = True;
    }

    session_destroy();
    if($destroyCheck){
        header("Location: ../");
    }
?>

