<?php
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

    

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    
    <title>Examen-Servir</title>
</head>
<body>

    <div id="formulario" class="container"  style="padding: 20px">
        <div class="row">
        <div class="col-2"></div>
            <div class="col-8">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="http://localhost/Servir_Examen/index.php">Home</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <button class="btn btn-light" type="button" v-on:click="administrar()">Administrar</button>
                            </li>
                        </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row" style="padding: 30px">
            <div class="col-2"></div>
            <div class="col-8"  >
                <table class="table table-dark">
                    <thead>
                        <th>Código</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Departamento</th>
                    </thead>
                    <tbody>
                        <tr class="table-active" v-for="e in empleados">
                            <th scope="row">{{e.codigoEmpleado}}</th>
                            <td >{{e.nombres}}</td>
                            <td>{{e.apellidos}}</td>
                            <td>{{e.fechaNacimiento}}</td>
                            <td>{{e.departamento}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal" tabindex="-1" id="modal1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Administrar Empleados</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div  class="container" style="padding: 20px" >

                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-6">
                                    <input id="txtCodigo" class="form-control"  placeholder="Type to search code..." v-model="empleado.codigoEmpleado">
                                </div>
                                <div class="col-2">
                                <button type="button" class="btn btn-outline-info" v-on:click="search()"><i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                
                                    <label for="exampleDataList" class="form-label" >Nombres: </label>
                                    <input class="form-control" id="name"  v-model="empleado.nombres">
                                    <label for="exampleDataList" class="form-label" >Apellidos: </label>
                                    <input class="form-control" id="lastName" v-model="empleado.apellidos" >

                                
                                
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="exampleDataList" class="form-label" type="date">Fecha de Nacimiento: </label>
                                    <input class="form-control" id="date" v-model="fecha">        
                                </div>
                                <div class="col-6">
                                    <label for="exampleDataList" class="form-label" >Departamento: </label>
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="selectDepartment" v-model="empleado.idDepartamento">
                                        <option selected>Elige un departamento</option>
                                        <option v-bind:value="d.idDepartamento" v-for="d in departamentos">{{d.nombre}}</option>
                                    </select>
                                    
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary" v-on:click="savedEmployee()">Guardar</button>
                                    <button type="button" class="btn btn-outline-danger" v-on:click="deleteEmployee()">Eliminar</button>
                                    <button type="button" class="btn btn-outline-warning" v-on:click="cancelar()">Borrar</button>
                                </div>
                            </div>
                            <div class="row">
                            
                            <div class="col-12">
                                <br>
                                <div v-show="succes" class="alert alert-success alert-dismissible" id="myAlert">
                                    <strong>Success!</strong>{{sms}}
                                    <button type="button" class="btn-close" v-on:click="closeToast()"></button>
                                </div>
                                <div v-show="error" class="alert alert-success alert-dismissible" id="myAlert">
                                    <strong>Error!</strong> {{sms}}
                    
                                    <button type="button" class="btn-close" v-on:click="closeToast()"></button>
                                </div>
                            </div>
                        </div>

                        </div>

                    </div>
                    
                    
                    

                    
                </div>
            </div>
        </div>
    
    </div>
    <script src="../../models/employee/employee_model.js"></script>
</body>
</html>