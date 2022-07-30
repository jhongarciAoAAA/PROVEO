<?php
    session_start();
    if(!isset($_SESSION['rol']) || $_SESSION['rol'] != '1a' ){
        header('location:index.php');
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
                    <a class="nav-link active" style="color: darkgreen;"  href="/PROVEO3_1/homeAdmin.php"><span class="glyphicon glyphicon-home"></span> Home</a>
                    </li>
                    <li class="nav-item" style="font-size:15px ;">
                    <a class="nav-link  " style="color: darkgreen;"  href="/PROVEO3_1/admUsers.php"><span class="glyphicon glyphicon-user"></span> Admin Usuarios</a>
                    </li>
                    <li class="nav-item" style="font-size:15px ;">
                    <a class="nav-link " style="color: darkgreen;" href="/PROVEO3_1/admProds.php"><span class="glyphicon glyphicon-apple"></span> Admin Productos</a>
                    </li>
                    <li class="nav-item " style="font-size:15px ;">
                    <a class="nav-link " style="color: darkgreen;" href="/PROVEO3_1/admPetiPu.php"><span class="glyphicon glyphicon-globe"></span> Admin Pet Publicas</a>
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
       <a href="/PROVEO3_1/homeAdmin.php">Home/</a>
       <div class="card-header border-bottom" style="display: flex;" >
          <h1 class="h1 mb-1"><span class="glyphicon glyphicon-home"></span> Home</h1>
        </div>
      </div>
      
    </div>


  </div>


    <script src="cosa.js"></script>
    <script src="js/bootstrap.js"></script>
    
</body>
</html>





<div class="container-fluid">
            <div class="row">
            <div class="col-lg-12">
                <div class="card">
                  <div class="card-header border-bottom" style="display: flex;" >
                    <h1 class="h1 mb-1"><span class="glyphicon glyphicon-th"></span> Usuarios</h1>
                  </div>
                  <div class="card-body" >
                  <button type="button" id="btnAgregar" onclick="abrirModal()" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"> Agregar Usuario</button>
                    <div class="table-responsive">
                      <table class="table text-sm mb-0 table-striped table-hover" >
                        <thead>
                          <tr>
                            <th style="font-size: 22px;">Nombre</th>
                            <th style="font-size: 22px;">Correo</th>
                            <th style="font-size: 22px;">Celular</th>
                            <th style="font-size: 22px;">Rol</th>
                            <th style="font-size: 22px;">Ciudad</th>
                            <th style="font-size: 22px;">Barrio</th>
                            <th style="font-size: 22px;">Operaciones</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            foreach ($resultado as $valor){?>
                              <tr>
                              <td style="font-size: 17px;"><?php echo $valor['nombre'];?></td>
                              <td style="font-size: 17px;"><?php echo $valor['correo'];?></td>
                              <td style="font-size: 17px;"><?php echo $valor['celular'];?></td>
                              <td style="font-size: 17px;"><?php echo $valor['rol'];?></td>
                              <td style="font-size: 17px;"><?php echo $valor['ciudad'];?></td>
                              <td style="font-size: 17px;"><?php echo $valor['barrio'];?></td>
                              <td style="font-size: 17px;" style="display: flex;">
                              <div style="display: flex;">
                              <button type="button" id="edit" value='<?php echo json_encode(recuperarReg($valor['IdUser']));?>' onclick="llenarModal()" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal"><span class="glyphicon glyphicon-edit"></span></button>                            
                              <form action="admUsers.php" method="POST">
                                <button type="submit"  class="btn btn-danger" ><span class="glyphicon glyphicon-trash"></span></button>
                                <input type="text" hidden value='<?php echo $valor['IdUser'];?>' name="eliminar">
                              </form>
  
                                
                                

                              
                              </div>
                              </td>
                              </tr><?php
                            }
                            ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  
                            <label style="color:green"><?php echo $rta;  ?></label>

                </div>
              </div>
            </div>
          </div>