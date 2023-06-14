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

    
    public function getParams(){
        $request =  $request = file_get_contents("php://input");
        $data = json_decode($request, true);
        $this->nombre = $data['nombre'];
        $this->descripcion=$data['descripcion'];
        $this->codigo =$data['codigoDepto'];
        
    }

    public function insertDepartment(){
        $this->getParams();
        $query = "INSERT INTO Departamento(codigoDepto, nombre, descripcion) 
        values (NULL, '$this->nombre', '$this->descripcion') ";
        
        $rs = $this->conex->execSQL($query);

        $id = $this->conex->lastID();
        $codigo = 'D-'. str_pad($id, 4, '0', STR_PAD_LEFT);
        $query = "UPDATE Departamento SET codigoDepto = '$codigo' WHERE idDepartamento = $id";
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
    
    public function getDepartments(){
        $query = "SELECT * FROM Departamento";
        $rs = $this->conex->execSQL($query);

        $data = array();
        while ($detalle = mysqli_fetch_assoc($rs)){
            $data[] = $detalle;
        }

        echo json_encode($data);
    }

    public function getDepartmentByID(){
        $id = $_GET['id'];
        $query = "SELECT * FROM Departamento
                 WHERE codigoDepto= '$id'";
         $rs = $this->conex->execSQL($query);
         
         $data = array();
         while ($detalle = mysqli_fetch_assoc($rs)){
             $data[] = $detalle;
         }
 
         echo json_encode($data);
     }

    public function updateDepartment(){
        $this->getParams();
        $query = "UPDATE Departamento 
                SET nombre='$this->nombre', descripcion='$this->descripcion'
                WHERE codigoDepto = '$this->codigo'";
        $rs = $this->conex->execSQL($query);
        $data = array();
     //   echo $query;
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
    public function deleteDepartment(){
        $this->getParams();
        $query = "Delete FROM Departamento 
                  WHERE codigoDepto = '$this->codigo'";
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
        case "getDepartmentByID":
            
            $departmentController->getDepartmentByID();
            break;
            
    }
}


?>