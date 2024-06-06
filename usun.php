<?php
        $id = $_GET['id'];
        $con = new mysqli("localhost", "root", "", "baza_bip");
        $sql = "DELETE FROM dane  WHERE ID = $id";
        mysqli_query($con, $sql);
        header("Location: cms.php");
        exit;
?>
