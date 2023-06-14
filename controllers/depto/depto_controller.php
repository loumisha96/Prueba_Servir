<?php
require '../../models/depto/depto_model.php';
require '../../models/conexion.php';

class DepartmentController extends DepartmentModel{
    private $conex;

    function __construct(){
        $this->conex = new mySQLConex();
      }


    public function deptoView(){
        require '../../views/depto/depto_view.php';
    } 
    public function insertDepartment(){

    }
    
    public function getDepartments(){
        $query = "SELECT idDepartamento, nombre FROM Departamento";
        $rs = $this->conex->execSQL($query);

        $data = array();
        while ($detalle = mysqli_fetch_assoc($rs)){
            $data[] = $detalle;
        }

        echo json_encode($data);
    }
    public function updateDepartment(){

    }
    public function deleteDepartment(){

    }
}

if(isset($_GET['action'])){
    $action = $_GET['action'];
    $departmentController = new DepartmentController(); 
    switch($action){
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