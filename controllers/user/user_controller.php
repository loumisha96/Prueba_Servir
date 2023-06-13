<?php
require '../../models/user/user_model.php';

class UserController extends UserModel{

    public function userView(){
        require '../../views/user/user_view.php';
    } 
    public function insertUser(){

    }
    
    public function getUsers(){

    }
    public function updateUser(){

    }
    public function deleteUser(){

    }
}


if(isset($_GET['action'])){
    $action = $_GET['action'];
    $userController = new UserController();
    switch($action){
        case "view":
            $userController->userView();
            break;
        case "insert":
            $userController->insertUser();
            break;
        case "getUsers":
            $userController->getUsers();
            break;
        case "update":
            $userController->updateUser();
            break;
        case "delete":
            $userController->deleteUser();
            break;

    }
}


?>