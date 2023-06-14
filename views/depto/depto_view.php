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
            <div class="col-8" >
                <table class="table table-dark">
                    <thead>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                    </thead>
                    <tbody>
                    <tr class="table-active" v-for="d in departamentos">
                            <th scope="row">{{d.codigoDepto}}</th>
                            <td >{{d.nombre}}</td>
                            <td>{{d.descripcion}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="modal" tabindex="-1" id="modal1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Administrar Departamentos</h5>
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
                            <div class="row">
                                
                                    <label for="exampleDataList" class="form-label" >Nombre: </label>
                                    <input class="form-control" id="name"  v-model="departamento.nombre">
                                    <label for="exampleDataList" class="form-label" >Descripcion: </label>
                                    <input class="form-control" id="lastName" v-model="departamento.descripcion" >     
                            </div>
                            <div class="row">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary" v-on:click="savedDepartment()">Guardar</button>
                                    <button type="button" class="btn btn-outline-danger" v-on:click="deleteDepartment()">Eliminar</button>
                                    <button type="button" class="btn btn-outline-warning" v-on:click="cancelar()">Cancelar</button>
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
    <script src="../../models/depto/depto_model.js"></script>
</body>
</html>