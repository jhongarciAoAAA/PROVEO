<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        require 'php/database.php';
        $correoForm =isset($_POST['correo']) ? $_POST['correo']:null;
        $contrasForm = isset($_POST['contras']) ? $_POST['contras']:null; 
        $rolForm = isset($_POST['rol']) ? $_POST['rol']:null;
        $db = new Database();
        $con = $db->conectar();
        $comando = $con->query("SELECT IdUser,nombre,correo,contras FROM usuarios WHERE correo='".$correoForm."' AND contras='".$contrasForm."'");
        $comando->execute();
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);

       
      if(count($resultado)){

        header('location:homeAdmin.php');
        session_start();
        $_SESSION['usuario']=$correoForm;
        $_SESSION['rol']=$rolForm;
        $_SESSION['nombre']=$resultado[0]['nombre'];
        $_SESSION['id']=$resultado[0]['IdUser'];

        
       }else{$error='CREDENCIALES INCORRECTAS';}
    }else{
        $error='';
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/index.css"/>
    <link rel="stylesheet" href="css/bootstrap.css"/>
    
    
    <title>PROVEO APP</title>
</head>
<body style="background-color: darkgreen;">
    <div class="container" style="background-color: darkgreen;">
        <div class="container-form">
            <form method="POST">
            <div>
            <h1 style="color:aliceblue;">INICIAR <strong class="text-success">SESION</strong></h1>
            </div>
            <div class="form-floating">
                <select class="form-select" name="rol" id="floatingSelect" aria-label="Floating label select example">
                  <option value="1a">Administrador</option>
                  <option value="2pr">Proveedor</option>
                  <option value="3pv">Punto de venta</option>
                </select>
                <label for="floatingSelect">Tipo de usuario</label>
            </div>
            <div class="form-floating">
                <input type="text" name="correo" class="form-control" placeholder="Leave a comment here" id="floatingTextarea">
                <label for="floatingTextarea">Correo</label>
            </div>

            <div class="form-floating">
                <input type="text" name="contras" class="form-control" placeholder="Leave a comment here" id="floatingTextarea">
                <label for="floatingTextarea">Contraseña</label>
            </div>

            <div class="divBtn">
                <label style="color:white"><?php echo $error;?></label>
                <div style="width: auto;">
                    <button type="submit" class="btn btn-success">Ingresar</button>           
                </div>
            </div>              
            </form>
        </div>
    </div>
    <script src="js/bootstrap.js"></script>
</body>
</html>