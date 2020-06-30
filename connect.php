<?php 
    // require_once "define.php";
    require_once "Database.class.php";
    require_once "search_helper.php";
    require_once "paginator_helper.php";
    
    $params = array (
        'server' 	=> DB_HOST,
		'username'	=> DB_USER,
		'password'	=> DB_PASS,
		'database'	=> DB_DB,
		'table'		=> DB_TABLE
    );

    $database = new Database($params);

    $list = $database->listRecord("SELECT * FROM `$params[table]` LIMIT $limitStart,$totalUsersPerPage");

    $active = $database->listRecord("SELECT * FROM `$params[table]` WHERE `status` = 0 LIMIT $limitStart,$totalUsersPerPage");
    $inactive = $database->listRecord("SELECT * FROM `$params[table]` WHERE `status` = 1 LIMIT $limitStart,$totalUsersPerPage");

    $statusAsc = $database->listRecord("SELECT * FROM `$params[table]` ORDER BY `status` ASC LIMIT $limitStart,$totalUsersPerPage");
    $statusDesc = $database->listRecord("SELECT * FROM `$params[table]` ORDER BY `status` DESC LIMIT $limitStart,$totalUsersPerPage");

    $idAsc = $database->listRecord("SELECT * FROM `$params[table]` ORDER BY `id` ASC LIMIT $limitStart,$totalUsersPerPage");
    $idDesc = $database->listRecord("SELECT * FROM `$params[table]` ORDER BY `id` DESC LIMIT $limitStart,$totalUsersPerPage");

    $nameAsc = $database->listRecord("SELECT * FROM `$params[table]` ORDER BY `name` ASC LIMIT $limitStart,$totalUsersPerPage");
    $nameDesc = $database->listRecord("SELECT * FROM `$params[table]` ORDER BY `name` DESC LIMIT $limitStart,$totalUsersPerPage");

    $orderAsc = $database->listRecord("SELECT * FROM `$params[table]` ORDER BY `ordering` ASC LIMIT $limitStart,$totalUsersPerPage");
    $orderDesc = $database->listRecord("SELECT * FROM `$params[table]` ORDER BY `ordering` DESC LIMIT $limitStart,$totalUsersPerPage");
    
    $search = $database->listRecord("SELECT * FROM `$params[table]` WHERE `name` LIKE '%$searchWord%' LIMIT $limitStart,$totalUsersPerPage");


?>