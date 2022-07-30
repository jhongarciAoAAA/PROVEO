<?php

  session_start();
  if(!isset($_SESSION['rol']) || $_SESSION['rol'] != '1a' ){
      header('location:index.php');
  }  
  require 'php/metodos.php';
  
  if($_SERVER['REQUEST_METHOD'] == 'POST' && ( isset($_POST['guardar']) || isset($_POST['editar']) )){
    $idForm = $_POST['txtIdProd'];
    $nombreForm = $_POST['txtNombre'];
    $categForm = $_POST["cboCateg"];
    $cantiForm = 0;
    $preUnitForm = $_POST['txtPreUnit'];

    if($idForm>0){
      $numero = crearProducto(0,1,$idForm,$nombreForm,$categForm,$cantiForm,$preUnitForm);
    }else{
      $numero = crearProducto(0,0,0,$nombreForm,$categForm,$cantiForm,$preUnitForm);
    }
    
    
    unset($_POST["txtIdProd"] );
    unset($_POST["txtNombre"] );
    unset($_POST["cboCateg"] );
    unset($_POST["txtCantidad"] );
    unset($_POST["txtPreUnit"] );
    

    $resultado =listarProductos(0);

  }elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar'])){
    $numero = eliminarProducto($_POST['eliminar'],0);
    $resultado =listarProductos(0);

  }elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filtrar'])){
    $resultado =filtrarProds($_POST['filtrar'],0);
  }else{
    $resultado = listarProductos(0);
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
                <a class="nav-link active" style="color: darkgreen;" href="/PROVEO3_1/admProds.php"><span class="glyphicon glyphicon-apple"></span> Admin Productos</a>
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
          <a href="/PROVEO3_1/admUsers.php">Productos</a>
        </div> 
      
        <div class="card-header border-bottom" style="display: flex;" >
          <h1 class="h1 mb-1"><span class="glyphicon glyphicon-apple"></span> Productos</h1>
        </div>
        
        <div class="card-body" >
          <div style="display:flex;justify-content:space-between;">
          <div>
            <form action="admProds.php" method="POST" style="display:flex;margin:10px;">
              <button type="submit"  class="btn btn-warning" style="margin-right:5px ;"><span class="glyphicon glyphicon-filter"></span></button>
              <input type="text" class="form-control form"  placeholder="Nombre, Categoria" name="filtrar">
            </form>
          </div>
  

              <button type="button" id="btnAgregar" onclick="abrirModal()" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <span class="glyphicon glyphicon-plus-sign"></span> Agregar Producto</button>
          </div>  
          <div class="table-responsive">
            <table class="table text-sm mb-0 table-striped table-hover" id="tabla">
              <thead>
                <tr>
                <th style="font-size: 17px;">  </th>
                  <th style="font-size: 17px;">Nombre</th>
                  <th style="font-size: 17px;">Categoria</th>
                  <th style="font-size: 17px;">Precio Unitario</th>
                  <th style="font-size: 17px;">Operaciones</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($resultado as $valor){?>
                <tr>
                <td style="font-size: 17px;"><img src="imgs/<?php echo $valor['nombreprod'];?>.jpg" style="width: 25px;height:25px;"></td>  
                <td style="font-size: 17px;"><?php echo $valor['nombreprod'];?></td>
                  <td style="font-size: 17px;"><?php echo $valor['categoria'];?></td>
                  
                  <td style="font-size: 17px;"><?php echo $valor['precioUni'];?></td>
                  <td style="font-size: 17px;" style="display: flex;">
                    <div style="display: flex;">
                    <form action="editProds.php" method="POST">
                        <button type="submit"  class="btn btn-warning" ><span class="glyphicon glyphicon-edit"></span></button>
                        <input type="text" hidden value='<?php echo recuperarProd($valor['Idpproducto'],0);?>' name="editar">
                      </form>  
                      <form action="admProds.php" method="POST">
                        <button type="submit"  class="btn btn-danger" ><span class="glyphicon glyphicon-remove"></span></button>
                        <input type="text" hidden value='<?php echo $valor['Idpproducto'];?>' name="eliminar">
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
            <h5 class="modal-title" id="myModalLabel" style="margin:auto;font-size:20px;">Producto</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="admProds.php" method="POST">
              <table style="width:80%;margin:auto;">
                <tbody >
                  <tr>
                    <td style="width:40%;">Nombre</td>
                    <td style="width:60%;"><input type="text" required class="form-control form" name="txtNombre" id="txtNombre" ></td>
                    <td style="width:60%;"><input type="text" hidden  name="txtIdProd" id="txtIdProd" value="" ></td>
                  </tr>
                  <tr>
                    <td style="width:40%;">Categoria</td>
                    <td style="width:60%;">
                      <select  class="form-control"   aria-label="Floating label select example" name="cboCateg" id="cboCateg">
                        <option value="lacteos">Lacteos</option>
                        <option value="licores">Licores</option>
                        <option value="granos">Granos</option>
                        <option value="verduras">Verduras</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td style="width:60%;"><input  hidden class="form-control form" type="text" name="txtCantidad" id="txtCantidad" value=""></td>
                  </tr>
                  <tr>
                    <td style="width:40%;">Precio Unitario</td>
                    <td style="width:60%;"><input required required class="form-control form" type="text"  name="txtPreUnit" id="txtPreUnit"></td>
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


  <script src="scripts/jquery-1.10.2.min.js"></script>
  <script src="scripts/jquery-ui.min.js"></script>
  <script src="cosa.js"></script>
  <script src="scripts/datatables.min.js"></script>

    <script src="cosa.js"></script>
    <script src="js/bootstrap.js"></script>
    
</body>
</html>