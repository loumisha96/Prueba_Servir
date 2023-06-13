<?php
/**
 * Created by PhpStorm.
 * User: Rodolfo
 * Date: 08/12/2019
 * Time: 4:40 PM
 */

class mySQLConex {
    //Variables que vamos a utilizar
    private $servidor = "localhost:3306";

    private $usuarioMySQL = "";
    private $claveMySQL = '';
    private $basedeDatos = "";

    private $conectar;

    function __construct(){


        $this->usuarioMySQL = "root";
        $this->claveMySQL = "1234";
        $this->basedeDatos = "servir_db";

        $this->ConectarMySQL();
        $this->SeleccionarDB();

    }

    private function ConectarMySQL(){
        $this->conectar = mysqli_connect($this->servidor,
            $this->usuarioMySQL,
            $this->claveMySQL) or die(mysqli_connect_error());
        mysqli_set_charset($this->conectar, 'utf8' );
        mysqli_query($this->conectar, "SET NAMES 'utf8'");
        mysqli_query($this->conectar, "SET CHARACTER SET utf8 ");
    }

    private function SeleccionarDB(){
        mysqli_select_db($this->conectar, $this->basedeDatos) or die (mysqli_error($this->conectar));
    }

    public function execSQL($sql) {
        $resultado = mysqli_query($this->conectar,$sql) or die (mysqli_error($this->conectar));
        return $resultado;
    }

    public function lastID(){
        $last_id = mysqli_insert_id($this->conectar);
        return $last_id;
    }
    public function modificados(){
        $last_id = mysqli_affected_rows($this->conectar);
        return $last_id;
    }

    public function contarRegistros($rs) {
        $cant = 0;
        while ($obj = mysqli_fetch_object($rs)){$cant++;}
        return $cant;
    }

    public function verDatoSimple($rs) {
        $dato = "";
        while ($obj = mysqli_fetch_array($rs)){$dato = $obj[0];}
        return $dato;
    }

    public function verObjetoSimple($rs) {
        while ($obj = mysqli_fetch_array($rs)){return $obj;}
    }

}
