<?php 
    require_once "connect.php";

    $searchWord = "";
    if(isset($_GET['search'])){
        $type= 'search';
        $searchWord= $_GET['search'];
    }
?>