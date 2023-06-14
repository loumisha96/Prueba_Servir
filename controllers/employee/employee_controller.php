<?php
require '../../models/employee/employee_model.php';
require '../../models/conexion.php';

class EmployeeController extends EmployeeModel {
    private $conex;

    function __construct(){
        $this->conex = new mySQLConex();
      }

    public function userView(){
        require '../../views/employee/employee_view.php';
    } 
    
    public function getParams(){
        $request =  $request = file_get_contents("php://input");
        $data = json_decode($request, true);
        $this->nombres = $data['nombres'];
        $this->apellidos=$data['apellidos'];
        $this->fechaNacimiento=$data['fechaNacimiento'];
        $this->departamento=$data['idDepartamento'];
        $this->codigo = $data['codigoEmpleado'];
        if($this->fechaNacimiento=="")
        $this->fechaNacimiento="0000-00-00";
    }


    public function insertUser(){
       $this->getParams();
        $query = "INSERT INTO Empleado(codigoEmpleado, nombres, apellidos, fechaNacimiento, idDepartamento) 
        values (NULL, '$this->nombres', '$this->apellidos', '$this->fechaNacimiento', $this->departamento) ";
        
        $rs = $this->conex->execSQL($query);

        $id = $this->conex->lastID();
        $codigo = 'EMP-'. str_pad($id, 4, '0', STR_PAD_LEFT);
        $query = "UPDATE Empleado SET codigoEmpleado = '$codigo' WHERE idEmpleado = $id";
        $rs = $this->conex->execSQL($query);
        $data = array();
        if($this->conex->modificados()>0){
            $data['codigo']=$codigo;
            $data['sms']="Se ha creado correctamente";
        }     
        else{
            $data['codigo']="error";
            $data['sms']="Error al Insertar";
        }
        echo json_encode($data);
    }
    
    public function getEmployee(){
        
        $query = "SELECT t0.*, t1.nombre as departamento FROM Empleado t0
                INNER JOIN Departamento t1 on t0.idDepartamento = t1.idDepartamento";
        $rs = $this->conex->execSQL($query);

        $data = array();
        while ($detalle = mysqli_fetch_assoc($rs)){
            $data[] = $detalle;
        }

        echo json_encode($data);
    }

    public function getEmployeeByID(){
       $id = $_GET['id'];
       $query = "SELECT t0.*, t1.nombre as departamento FROM Empleado t0
                INNER JOIN Departamento t1 on t0.idDepartamento = t1.idDepartamento
                WHERE t0.codigoEmpleado= '$id'";
        $rs = $this->conex->execSQL($query);
        
        $data = array();
        while ($detalle = mysqli_fetch_assoc($rs)){
            $data[] = $detalle;
        }

        echo json_encode($data);
    }
    public function updateUser(){
        $this->getParams();
        $query = "UPDATE Empleado 
                SET nombres='$this->nombres', apellidos='$this->apellidos', fechaNacimiento='$this->fechaNacimiento', idDepartamento=$this->departamento  
                WHERE codigoEmpleado = '$this->codigo'";
        $rs = $this->conex->execSQL($query);
        $data = array();
        //echo $this->conex->modificados();
        if($this->conex->modificados()>0){
            $data['codigo']=$this->codigo;
            $data['sms']="Se ha modificado correctamente";
        }     
        else{
            $data['codigo']="error";
            $data['sms']="Error al modificar";
        }
        echo json_encode($data);
    }
    public function deleteUser(){
        $this->getParams();
        $query = "Delete FROM Empleado 
                  WHERE codigoEmpleado = '$this->codigo'";
        $rs = $this->conex->execSQL($query);
        $data = array();
        //echo $this->conex->modificados();
        if($this->conex->modificados()>0){
            $data['codigo']=$this->codigo;
            $data['sms']="Se ha eliminado correctamente";
        }else{
            $data['codigo']="error";
            $data['sms']="El código de empleado no existe";
        }     
        echo json_encode($data);
    }
}


if(isset($_GET['action'])){
    $action = $_GET['action'];
    $employeeController = new EmployeeController();
    switch($action){
        case "view":
            $employeeController->userView();
            break;
        case "insert":
            $employeeController->insertUser();
            break;
        case "getEmployee":
            $employeeController->getEmployee();
            break;
        case "update":
            $employeeController->updateUser();
            break;
        case "delete":
            $employeeController->deleteUser();
            break;
        case "getEmployeeByID":
            $employeeController->getEmployeeByID();
            break;

    }
}


?>