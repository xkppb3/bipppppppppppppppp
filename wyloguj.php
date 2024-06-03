<?php
session_start();
if(isset($_POST['wyloguj'])){
header('Location: zaloguj.php');
}
?>
