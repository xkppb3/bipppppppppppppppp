<?php
session_start();
if(isset($_POST['za'])){
    $uz=$_POST['nazwa'];
    $haslo=$_POST['haslo'];
    if($uz=="admin" && $haslo=="123"){
        $_SESSION['wyslij']=true;
        header('Location: cms.php');
    }
    else{
        header('Location: zaloguj.php');
    }

}

?>