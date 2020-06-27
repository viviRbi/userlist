<?php 
    require_once "connect.php";
    require_once "status_helper.php";

  
    if(isset($_POST)){
        $action = $_POST['bullaction'];
        if($action == 'multi-delete'){
            $database->delete($_POST['check']);
        }else{
            $updateTo= statusCheck($action);
            $updateToArr= array('status'=>$action);
            foreach($_POST['check'] as $value){
                $database->update($updateToArr,$value);
            }
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  
?>