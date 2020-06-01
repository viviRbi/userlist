<?php 
    require_once "Database.class.php";
    require_once "search_helper.php";
    require_once "paginator_helper.php";
    
    $params = array (
        'server' 	=> 'localhost',
		'username'	=> 'root',
		'password'	=> '',
		'database'	=> 'php_ex_12',
		'table'		=> 'users',
    );
    // Insert data-------------------------------------
    // $addin = array('name'=>'Member33', 'status' => 1, 'ordering' => 19);

    // Update data-------------------------------------
    // $update = array(
    //     'name' => 'Member2',
    //     'status' => 0
    // );
    $database = new Database($params);

    echo $limitStart;

    $list = $database->listRecord("SELECT * FROM `$params[table]` LIMIT $limitStart,$totalUsersPerPage");
    // $status = $database->listRecord("SELECT DISTINCT `status` FROM `$params[table]`");

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







    // TEST CHANGE INFO --------------------------------
    // $database->setConnect(mysqli_connect('localhost','root',''));
    // $database->setDatabase('php_ex_12');
    // $database->setTable('users');
    
    //TEST INSERT --------------------------------------
    // $database->insert($addin);
    
    //TEST UPDATE --------------------------------------
    // $database->update($update, 20);
    // echo $database->affected_row();

    //TEST DELETE --------------------------------------
    // $database->delete(2);
    // $database->delete(array(16,17));
    
    //TEST SHOW ROWS
    // $query = "SELECT * FROM `users` WHERE `id`> 12 ORDER BY id ASC";
    // $database->listRecord($query);

    // TEST COUNT RESULT
?>