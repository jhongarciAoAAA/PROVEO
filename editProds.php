<?php
    session_start();
    if(!isset($_SESSION['rol']) || $_SESSION['rol'] != '1a' ){
        header('location:index.php');
    }  
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editar'])){
        $RET=$_POST['editar'];
        $lista = explode('-', $RET);
        
        $IdProdRet = $lista[0];
        $nombreProdRet = $lista[1];
        $categRet = $lista[2];
        $cantiRet = $lista[3];
        $preUnitRet = $lista[4];

    }else{
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
      <div >
        <div class="border-bottom" >
          <p style="text-align: center;font-size: 25px;color:darkgreen;"><?php echo $_SESSION['nombre'];?></p>
          <p style="text-align: center;font-size: 15px;color:darkgreen;">Administrador</p>
        </div>
      <div class="navDiv" >

        <div class="cerrarSesionDiv">
          <form action="cerrarSesion.php">
            <button type="submit" class="btn btn-dark" ><span class="glyphicon glyphicon-lock"></span> Cerrar Sesion</button>
          </form>
        </div>

      </div>
    </div>

    </div>
    <div class="contenidoContainer">
      
    <div class="card" style="margin-top:2%;margin-left:50px;width: 70%;">
        <div>
          <a href="/PROVEO3_1/homeAdmin.php">Home/</a>
          <a href="/PROVEO3_1/admProds.php">Productos/</a>
          <a href="/PROVEO3_1/admProds.php">Editar</a>
        </div> 
        <div class="card-header border-bottom" style="display: flex;" >
          <h1 class="h1 mb-1"><span class="glyphicon glyphicon-edit"></span> Editar Producto</h1>
        </div>
        <div style="padding: 30px;">
        <form action="admProds.php" method="POST">
            <div>
                <input type="number" hidden  name="txtIdProd" id="txtIdProd" value="<?php echo $IdProdRet; ?>">
            </div>
            <div>
                <label><span class="glyphicon glyphicon-star"></span> Nombre </label>
                <input type="text"  class="form-control form" name="txtNombre" id="txtNombre" style="width: 50%;" value="<?php echo $nombreProdRet; ?>">
            </div>
            <div>
                <label><span class="glyphicon glyphicon-star"></span> Categoria </label>
                <select  class="form-control" style="width:50%;"  aria-label="Floating label select example" name="cboCateg" id="cboCateg" >
                    <option value="<?php echo $categRet; ?>"><?php echo $categRet; ?></option>
                </select>
            </div>
            <div>
                
                <input  hidden class="form-control form" type="text" name="txtCanti" id="txtCanti" style="width: 50%;" value="<?php echo $cantiRet; ?>">
            </div>
            <div>
                <label><span class="glyphicon glyphicon-star"></span> Precio Unitario </label>
                <input required required class="form-control form" type="text"  name="txtPreUnit" id="txtPreUnit" style="width: 50%;" value="<?php echo $preUnitRet; ?>">
            </div>
                
          </div>  
          <div class="card-footer">
            <button class="btn btn-success"  name ="editar" type="submit">Aceptar Cambios</button>
            <button class="btn btn-warning"><a href="/PROVEO3_1/admProds.php" class="text text-dark" >Regresar</a></button>
            
          </div>
            </form>
        </div>      
    </div>


  </div>


    <script src="cosa.js"></script>
    <script src="js/bootstrap.js"></script>
    
</body>
</html>

