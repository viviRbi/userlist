<?php 
require_once "connect.php";
require_once "status_helper.php";


// If the server had id, name, order -list query string = asc, change href to desc, if not, create one
function urlQuery($query){
    global $FRONTEND;
    if (isset($_SERVER['QUERY_STRING'])){
        if ($_SERVER['QUERY_STRING'] == "$query-list=asc"){
            echo "href='$FRONTEND/index.php?$query-list=desc'";

        } elseif($_SERVER['QUERY_STRING'] == "$query-list=desc") {
            echo "href='$FRONTEND/index.php?$query-list=asc'";

        } elseif(strpos($_SERVER['QUERY_STRING'], "$query-list") == false) {
            echo "href='$FRONTEND/index.php?$query-list=asc'";
        }
    }
}

// Get content from urlQuery function, if it = desc => $type =nameDesc | idDesc => userList('nameDesc')
function orderList($query){
    global $type;
    if(isset($_GET[$query]) == "search"){
        $type = "search";
        return $type;
    }
    if(isset($_GET["$query-list"])){
        if ($_GET["$query-list"] == 'asc'){
            $type = $query. "Asc";
        } elseif ($_GET["$query-list"] == 'desc') {
            $type = $query . "Desc";
        }
        return $type;
    } 
}

// $$type = $nameDesc, an array created in connect.php
function usersList($type){
    $html = "";
    global $$type;
    foreach($$type as $key=>$value ){
        $html .= userHTML($value);
    }
    return $html;
}

// use the $value: id, name, status, order to create html
function userHTML($value){
    global $FRONTEND;
    $html  = '';
    $html .= "<tr>";
    $html .= "<th><input type='checkbox' name='check[]' value=$value[id] ></th>";
    $html .= "<td>$value[id]</td>";
    $html .= "<td>$value[name]</td>";
    $html .= statusSwitch($value, "td");
    $html .= "<td>$value[ordering]</td>";
    $html .= '<td>';
    $html .= "<a href=\"$FRONTEND"."/editUser.php?id=$value[id]\">Edit</a> &nbsp;";
    $html .= "<a href=\"$FRONTEND"."/deleteUser.php?id=$value[id]\">Delete</a>";
    $html .= '</td>';
    $html .= "</tr>";
    return $html;
    }
?>