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
            <div class="col-8" v-for="c in cines" >
                <table class="table table-dark">
                    <thead>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">3</th>
                            <td >Larry the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="inicio.js"></script>
</body>
</html>