<?php 
require_once "connect.php";

function statusSwitch($value, $tag, $space= null){
    $stat = '';
    $stat= statusCheck($value['status'],$stat);
    return "<$tag>$stat</$tag> $space";
}

function statusCheck($num){
    $stat = '';
    switch($num){
        case 0:
            $stat = "Active";
        break;
        case 1:
            $stat = "Inactive";
        break;
    }
    return $stat;
}

function statusFilterDisplay(){
    global $database;
    global $params;
     $statusArr = $database->listRecord("SELECT DISTINCT `status` FROM `$params[table]`"); 
         foreach($statusArr as $value){
             $statusName = strtolower(statusCheck($value['status']));
             $count=  $database->countResult("`status` = $value[status]");
             echo "<a href=\"http://localhost/php_exe/php_ex_12/index.php?status=$statusName\">".ucwords($statusName)."($count)</a>&nbsp;&nbsp";
         }
}
?>