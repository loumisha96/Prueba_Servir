<?php
require '../../models/depto/depto_model.php';

class DepartamentController extends DepartmentModel{

    public function deptoView(){
        require '../../views/depto/depto_view.php';
    } 
    public function insertDepartment(){

    }
    
    public function getDepartments(){

    }
    public function updateDepartment(){

    }
    public function deleteDepartment(){

    }
}

if(isset($_GET['action'])){
    $action = $_GET['action'];
    $departmentController = new DepartmentController();
    switch($departmentController){
        case "view":
            $departmentController->deptoView();
            break;
        case "insert":
            $departmentController->insertDepartment();
            break;
        case "getDepartments":
            $departmentController->getDepartments();
            break;
        case "update":
            $departmentController->updateDepartment();
            break;
        case "delete":
            $departmentController->deleteDepartment();
            break;

    }
}


?>