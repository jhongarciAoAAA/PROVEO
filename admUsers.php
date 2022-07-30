<?php
    session_start();
    if(!isset($_SESSION['rol']) || $_SESSION['rol'] != '1a' ){
        header('location:index.php');
    }  
    require 'php/metodos.php';
    

    if($_SERVER['REQUEST_METHOD'] == 'POST' && ( isset($_POST['guardar']) || isset($_POST['editar']) )){
      $idUserForm = $_POST['txtIdUser'];
      $nombreForm = $_POST['txtNombre'];
      $correoForm = $_POST['txtCorreo'];
      $celularForm = $_POST['txtCel'];
      $contrasForm = $_POST['txtContra'];
      $RolForm = $_POST['cboRol'];
      $ciudadForm = $_POST['txtCiudad'];
      $barrioForm = $_POST['txtBarrio'];
      
      if($idUserForm>0){
        $numero = crearUsuario(1,$idUserForm,$nombreForm,$correoForm,$celularForm,$contrasForm,$RolForm,$ciudadForm,$barrioForm);
      }else{
        $numero = crearUsuario(0,0,$nombreForm,$correoForm,$celularForm,$contrasForm,$RolForm,$ciudadForm,$barrioForm);
      }
     
      unset($_POST["txtIdUser"] );
      unset($_POST["txtNombre"] );
      unset($_POST["txtCorreo"] );
      unset($_POST["txtCel"] );
      unset($_POST["txtContra"] );
      unset($_POST["cboRol"] );
      unset($_POST["txtCiudad"] );
      unset($_POST["txtBarrio"] );
      $resultado =listarUsuarios();
      

    }elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar'])) {
      $numero = eliminarUsuario($_POST['eliminar']);
      $resultado =listarUsuarios();
      
    }elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filtrar'])){
      $resultado =filtrarUsers($_POST['filtrar']);
    }else{
      $resultado =listarUsuarios();
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
                <a class="nav-link active " style="color: darkgreen;"  href="/PROVEO3_1/admUsers.php"><span class="glyphicon glyphicon-user"></span> Admin Usuarios</a>
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
        <div>
          <a href="/PROVEO3_1/homeAdmin.php">Home/</a>
          <a href="/PROVEO3_1/admUsers.php">Usuarios</a>
        </div> 
      
        <div class="card-header border-bottom" style="display: flex;" >
          <h1 class="h1 mb-1"><span class="glyphicon glyphicon-user"></span> Usuarios</h1>
        </div>
        
        <div class="card-body" >
          <div style="display:flex;justify-content:space-between;">
          <div>
            <form action="admUsers.php" method="POST" style="display:flex;margin:10px;">
              <button type="submit"  class="btn btn-warning" style="margin-right:5px ;"><span class="glyphicon glyphicon-filter"></span></button>
              <input type="text" class="form-control form"  placeholder="Nombre, Barrio, Ciudad" name="filtrar">
            </form>
          </div>
  

              <button type="button" id="btnAgregar" onclick="abrirModal()" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <span class="glyphicon glyphicon-plus-sign"></span> Agregar Usuario</button>
          </div>  
          <div class="table-responsive">
            <table class="table text-sm mb-0 table-striped table-hover" id="tabla">
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
              <?php foreach ($resultado as $valor){?>
                <tr>
                <td style="font-size: 17px;"><?php echo $valor['nombre'];?></td>
                  <td style="font-size: 17px;"><?php echo $valor['correo'];?></td>
                  <td style="font-size: 17px;"><?php echo $valor['celular'];?></td>
                  <td style="font-size: 17px;"><?php echo $valor['rol'];?></td>
                  <td style="font-size: 17px;"><?php echo $valor['ciudad'];?></td>
                  <td style="font-size: 17px;"><?php echo $valor['barrio'];?></td>
                  <td style="font-size: 17px;" style="display: flex;">
                    <div style="display: flex;">
                    <form action="editUsers.php" method="POST">
                        <button type="submit"  class="btn btn-warning" ><span class="glyphicon glyphicon-edit"></span></button>
                        <input type="text" hidden value='<?php echo recuperarReg($valor['IdUser']);?>' name="editar">
                      </form>  
                      <form action="admUsers.php" method="POST">
                        <button type="submit"  class="btn btn-danger" ><span class="glyphicon glyphicon-remove"></span></button>
                        <input type="text" hidden value='<?php echo $valor['IdUser'];?>' name="eliminar">
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
  <div class="modalContainer">
    <div class="modal " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel" style="margin:auto;font-size:20px;">Usuario</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="admUsers.php" method="POST">
              <table style="width:80%;margin:auto;">
                <tbody >
                  <tr>
                    <td style="width:40%;">Nombre</td>
                    <td style="width:60%;"><input type="text" required class="form-control form" name="txtNombre" id="txtNombre" ></td>
                    <td style="width:60%;"><input type="text" hidden  name="txtIdUser" id="txtIdUser" value="" ></td>
                  </tr>
                  <tr>
                    <td style="width:40%;"> Correo</td>
                    <td style="width:60%;"><input type="text" required class="form-control form" name="txtCorreo" id="txtCorreo"></td>
                  </tr>
                  <tr>
                    <td style="width:40%;">Celular</td>
                    <td style="width:60%;"><input required class="form-control form" type="text" name="txtCel" id="txtCel"></td>
                  </tr>
                  <tr>
                    <td style="width:40%;">Contraseña</td>
                    <td style="width:60%;"><input required class="form-control form" type="text" name="txtContra" id="txtContra"></td>
                  </tr>
                  <tr>
                    <td style="width:40%;">rol</td>
                    <td style="width:60%;">
                      <select  class="form-control"   aria-label="Floating label select example" name="cboRol" id="cboRol">
                        <option value="1a">Administrador</option>
                        <option value="2pr">Proveedor</option>
                        <option value="3pv">Punto de venta</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td style="width:40%;">Ciudad</td>
                    <td style="width:60%;"><input  required class="form-control form" type="text" name="txtCiudad" id="txtCiudad"></td>
                  </tr>
                  <tr>
                    <td style="width:40%;">Barrio</td>
                    <td style="width:60%;"><input required required class="form-control form" type="text"  name="txtBarrio" id="txtBarrio"></td>
                  </tr>
                </tbody>
              </table>
          </div>  
          <div class="modal-footer">
            <button class="btn btn-success"  name ="guardar" type="submit">Guardar</button>
            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
          </div>
            </form>
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