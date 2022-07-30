<?php
    session_start();
    if(!isset($_SESSION['rol']) || $_SESSION['rol'] != '1a' ){
        header('location:index.php');
    }  
    require 'php/metodos.php';    

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar'])) {
        $numero = eliminarPeticion($_POST['eliminar']);
        $resultado=listarPeticionesPub();
    }elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filtrar'])){
      
    }else{ 
      $resultado=listarPeticionesPub();
      
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROVEO APP</title>

  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="styles/homeAdmin.css">
  <link rel="stylesheet" href="styles/css/bootstrap.css">

  <link href="css/datatables.css" rel="stylesheet" />
  <link href="css/jquery-ui.min.css" rel="stylesheet" />

</head>
<body >
  <div class="kingContainer">
    <div class="navContainer">
        <div>
            <div class="border-bottom" >
            <p style="text-align: center;font-size: 25px;color:darkgreen;">PEDRITOS</p>
            <p style="text-align: center;font-size: 15px;color:darkgreen;">Administrador</p>
            </div>
        </div>
        <div class="navDiv" >
            <nav class="nav nav-tabs justify-content-center">
            <ul class="nav flex-column">
                    <li class="nav-item" style="font-size:15px ;">
                    <a class="nav-link " style="color: darkgreen;"  href="/PROVEO3_1/homeAdmin.php"><span class="glyphicon glyphicon-home"></span> Home</a>
                    </li>
                    <li class="nav-item" style="font-size:15px ;">
                    <a class="nav-link  " style="color: darkgreen;"  href="/PROVEO3_1/admUsers.php"><span class="glyphicon glyphicon-user"></span> Admin Usuarios</a>
                    </li>
                    <li class="nav-item" style="font-size:15px ;">
                    <a class="nav-link " style="color: darkgreen;" href="/PROVEO3_1/admProds.php"><span class="glyphicon glyphicon-apple"></span> Admin Productos</a>
                    </li>
                    <li class="nav-item " style="font-size:15px ;">
                    <a class="nav-link active" style="color: darkgreen;" href="/PROVEO3_1/admPetiPu.php"><span class="glyphicon glyphicon-globe"></span> Admin Pet Publicas</a>
                    </li>
                    <li class="nav-item " style="font-size:15px ;">
                    <a class="nav-link " style="color: darkgreen;" href="/PROVEO3_1/admPetiPri.php"><span class="glyphicon glyphicon-transfer"></span> Admin Pet Privadas</a>
                    </li>
                </ul>   
            </nav>
            <div class="cerrarSesionDiv">
            <form action="cerrarSesion.php">
                <button type="submit" class="btn btn-dark" ><span class="glyphicon glyphicon-lock"></span> Cerrar Sesion</button>
            </form>
            </div>

        </div>
    </div>
    <div class="contenidoContainer">
      
      <div class="card" style="margin-top:50px;margin-left:50px;margin-right:50px;">
        <div>
          <a href="/PROVEO3_1/homeAdmin.php">Home/</a>
          <a href="/PROVEO3_1/admPetiPu.php">Peticiones</a>
        </div> 
      
        <div class="card-header border-bottom" style="display: flex;" >
          <h1 class="h1 mb-1"><span class="glyphicon glyphicon-globe"></span> Peticiones Públicas</h1>
        </div>
        
        <div class="card-body" >
          <div style="display:flex;justify-content:space-between;">
          <div>
            <form action="admUsers.php" method="POST" style="display:flex;margin:10px;">
              <button type="submit"  class="btn btn-warning" style="margin-right:5px ;"><span class="glyphicon glyphicon-filter"></span></button>
              <input type="text" class="form-control form"  placeholder="Nombre, Estado, Fecha" name="filtrar">
            </form>
          </div>
          </div>  
          <div class="table-responsive">
            <table class="table text-sm mb-0 table-striped table-hover" id="tabla">
              <thead>
                <tr>
                
                  <th style="font-size: 22px;">Tienda</th>
                  <th style="font-size: 22px;">Productos</th>
                  <th style="font-size: 22px;">Estado</th>
                  <th style="font-size: 22px;">fecha</th>
  
                  <th style="font-size: 22px;">Operaciones</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($resultado as $valor){
                $nombre = recuperarNombreUser($valor['IdTienda']);
                $productos = formatearProductos($valor['Idsproductos'],$valor['cantidades']);
                $productos2 = implode($productos);
                ?>
                <tr>
                <td style="font-size: 17px;"><?php echo $nombre;?></td>
                  <td style="font-size: 17px;"><?php echo $productos2;?></td>
                  <td style="font-size: 17px;"><?php echo $valor['estado'];?></td>
                  <td style="font-size: 17px;"><?php echo $valor['fecha'];?></td>

                  <td style="font-size: 17px;" style="display: flex;">
                    <div style="display: flex;">
                    <form action="editUsers.php" method="POST">
                        <button type="submit"  class="btn btn-dark" ><span class="glyphicon glyphicon-eye-open"></span></button>
                        <input type="text" hidden value='' name="editar">
                      </form>  
                      <form action="admPetiPu.php" method="POST">
                        <button type="submit"  class="btn btn-danger" ><span class="glyphicon glyphicon-remove"></span></button>
                        <input type="text" hidden value='<?php echo $valor['IdPetPub'];?>' name="eliminar">
                      </form>                            
                    </div>
                  </td>
                </tr><?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
  <script src="js/bootstrap.js"></script>
  <script src="scripts/jquery-1.10.2.min.js"></script>
  <script src="scripts/jquery-ui.min.js"></script>
  <script src="cosa.js"></script>
  <script src="scripts/datatables.min.js"></script>
  <script src="cosa.js"></script>
</body>
</html>