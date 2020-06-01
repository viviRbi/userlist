<?php 
// require_once "connect.php";
// $totalPage              = $database->countResult(); not works. Undefined $database

$totalUsersPerPage      = 3;
$pageDisplay            = 4;
$currentPage			= (isset($_GET['page'])) ? $_GET['page'] : 1;

$limitStart             = ($currentPage-1) * $totalUsersPerPage;

?>