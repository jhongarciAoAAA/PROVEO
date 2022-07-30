<?php
    require 'php/database.php';
    function listarUsuarios(){

        $db = new Database();
        $con = $db->conectar();
        $comando = $con->query("SELECT IdUser,nombre,correo,celular,rol,ciudad,barrio FROM usuarios ORDER BY IdUser ASC");
        $comando->execute();
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC); 
        return $resultado;
    }
    function crearUsuario($flag,$IdUser,$nombre,$correo,$celular,$contras,$rol,$ciudad,$barrio){
        $nregAfectados=0;
        
        if($flag == 0){
            $flag = validarReg($correo,$contras);
            if($flag == 0){
                try{
                
                    $db = new Database();
                    $con = $db->conectar();
                    $sql = "INSERT INTO usuarios (nombre,correo,celular,contras,rol,ciudad,barrio) VALUES (?,?,?,?,?,?,?)";
                    $stmt= $con->prepare($sql);
                    $stmt->execute([$nombre, $correo, $celular,$contras,$rol,$ciudad,$barrio]);
                    $nregAfectados=1;
                    return $nregAfectados;
                }catch(Exception $e){
                    return $nregAfectados;
                }
            }
            
        }elseif ($flag != 0) {
            try{
                $db = new Database();
                $con = $db->conectar();
                $consulta = "UPDATE `usuarios` SET `nombre`=?, `correo`=?,`celular`=?,`contras`=?,`ciudad`=?,`barrio`=? WHERE `IdUser`=?";
                $sql = $con->prepare($consulta);
                $sql->execute([$nombre,$correo,$celular,$contras,$ciudad,$barrio,$IdUser]);
                $nregAfectados=1;
                return $nregAfectados;

            }catch(Exception $e){
                return $nregAfectados;
            }
        }
    }
    function eliminarUsuario($id){
        $nregAfectados=0;
        try{
            $db = new Database();
            $con = $db->conectar();
            $sql = "DELETE FROM usuarios WHERE IdUser=?";
            $stmt= $con->prepare($sql);
            $stmt->execute([$id]);
            $nregAfectados=1;
            return $nregAfectados;
        }catch(Exception $e){
            return $nregAfectados;
        }

    }
    function validarReg($correo,$contras){
        $db = new Database();
        $con = $db->conectar();
        $comando = $con->query("SELECT IdUser FROM usuarios WHERE correo='".$correo."' AND contras='".$contras."'");
        $comando->execute();
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC); 
        return count($resultado);
    }
    function recuperarReg($id){
        $db = new Database();
        $con = $db->conectar();
        $comando = $con->query("SELECT IdUser,nombre,correo,celular,contras,rol,ciudad,barrio FROM usuarios WHERE IdUser='".$id."'");
        $comando->execute();
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC); 
        $retorno = $resultado[0]['IdUser'].'-'.$resultado[0]['nombre'].'-'.$resultado[0]['correo'].'-'.$resultado[0]['celular'].'-'.$resultado[0]['contras'].'-'.$resultado[0]['rol'].'-'.$resultado[0]['ciudad'].'-'.$resultado[0]['barrio'];
        return $retorno;
    }
    function filtrarUsers($nombre){
        
        if($nombre != ""){
            $db = new Database();
            $con = $db->conectar();

            $filtro= "SELECT IdUser,nombre,correo,celular,rol,ciudad,barrio FROM usuarios WHERE nombre LIKE ?";
            $resultado = $con->prepare($filtro);
            $resultado->execute([$nombre]);
            $resultado = $resultado->fetchAll(PDO::FETCH_ASSOC); 
            if(count($resultado)){
                return $resultado;
            }
            $filtro = "SELECT IdUser,nombre,correo,celular,rol,ciudad,barrio FROM usuarios WHERE barrio LIKE ?";
            $resultado = $con->prepare($filtro);
            $resultado->execute([$nombre]);
            $resultado = $resultado->fetchAll(PDO::FETCH_ASSOC); 
            if(count($resultado)){
                return $resultado;
            }
            $filtro = "SELECT IdUser,nombre,correo,celular,rol,ciudad,barrio FROM usuarios WHERE ciudad LIKE ?";
            $resultado = $con->prepare($filtro);
            $resultado->execute([$nombre]);
            $resultado = $resultado->fetchAll(PDO::FETCH_ASSOC); 
            if(count($resultado)){
                return $resultado;
            }
            return listarUsuarios();  
        }
        return listarUsuarios();
        
    }
    function crearProducto($IdPropi,$flag,$IdProd,$nombre,$categoria,$cantidad,$precioUnit){
        $nregAfectados=0;
        
        if($flag == 0){
            $flag = validarProd($IdPropi,$nombre);
            if($flag == 0){
                try{
                
                    $db = new Database();
                    $con = $db->conectar();
                    $sql = "INSERT INTO productos (nombreprod,categoria,cantidad,precioUni,IdProp) VALUES (?,?,?,?,?)";
                    $stmt= $con->prepare($sql);
                    $stmt->execute([$nombre, $categoria, $cantidad,$precioUnit,$IdPropi]);
                    $nregAfectados=1;
                    return $nregAfectados;
                }catch(Exception $e){
                    return $nregAfectados;
                }
            }
            
        }elseif ($flag != 0) {
            try{
                $db = new Database();
                $con = $db->conectar();
                $consulta = "UPDATE `productos` SET `nombreprod`=?, `categoria`=?,`cantidad`=?,`precioUni`=? WHERE `IdProp`=? AND `Idpproducto`=?";
                $sql = $con->prepare($consulta);
                $sql->execute([$nombre,$categoria,$cantidad,$precioUnit,$IdPropi,$IdProd]);
                $nregAfectados=1;
                return $nregAfectados;

            }catch(Exception $e){
                return $nregAfectados;
            }
        }
    }
    function validarProd($IdPropi,$nombre){
        $db = new Database();
        $con = $db->conectar();
        $comando = $con->query("SELECT Idpproducto FROM productos WHERE IdProp='".$IdPropi."' AND nombreprod='".$nombre."'");
        $comando->execute();
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC); 
        return count($resultado);
    }
    function listarProductos($idPropietario){

        $db = new Database();
        $con = $db->conectar();
        $comando = $con->query("SELECT Idpproducto,nombreprod,categoria,cantidad,precioUni,IdProp FROM productos WHERE IdProp='".$idPropietario."' ");
        $comando->execute();
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC); 
        return $resultado;
    }
    function eliminarProducto($idProd,$propi){
        $nregAfectados=0;
        try{
            $db = new Database();
            $con = $db->conectar();
            $sql = "DELETE FROM productos WHERE Idpproducto=? AND IdProp=?";
            $stmt= $con->prepare($sql);
            $stmt->execute([$idProd,$propi]);
            $nregAfectados=1;
            return $nregAfectados;
        }catch(Exception $e){
            return $nregAfectados;
        }

    }
    function recuperarProd($id,$propi){
        $db = new Database();
        $con = $db->conectar();
        $comando = $con->query("SELECT Idpproducto,nombreprod,categoria,cantidad,precioUni FROM productos WHERE Idpproducto='".$id."' AND IdProp='".$propi."'");
        $comando->execute();
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC); 
        $retorno = $resultado[0]['Idpproducto'].'-'.$resultado[0]['nombreprod'].'-'.$resultado[0]['categoria'].'-'.$resultado[0]['cantidad'].'-'.$resultado[0]['precioUni'];
        return $retorno;
    }
    function filtrarProds($nombre,$propi){
        
        if($nombre != ""){
            $db = new Database();
            $con = $db->conectar();

            $filtro= "SELECT Idpproducto,nombreprod,categoria,cantidad,precioUni FROM productos WHERE nombreprod LIKE ?";
            $resultado = $con->prepare($filtro);
            $resultado->execute([$nombre]);
            $resultado = $resultado->fetchAll(PDO::FETCH_ASSOC); 
            if(count($resultado)){
                return $resultado;
            }
            $filtro = "SELECT Idpproducto,nombreprod,categoria,cantidad,precioUni FROM productos WHERE categoria LIKE ?";
            $resultado = $con->prepare($filtro);
            $resultado->execute([$nombre]);
            $resultado = $resultado->fetchAll(PDO::FETCH_ASSOC); 
            if(count($resultado)){
                return $resultado;
            }
            return listarProductos($propi);  
        }
        return listarProductos($propi);
        
    }
    function listarPeticionesPub(){
        
        $db = new Database();
        $con = $db->conectar();
        $comando = $con->query("SELECT IdPetPub,IdTienda,Idsproductos,cantidades,preciosUni,estado,fecha FROM peticionesPub ORDER BY IdPetPub ASC");
        $comando->execute();
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);           

        return $resultado;   
    }
    function formatearProductos($Idprods,$cant){
        $productosbd = explode(',', $Idprods);
        $cantidadesbd = explode(',',$cant);
        $productos = array();
        $db = new Database();
            for ($i = 0; $i < count($productosbd); $i++) {
                $con = $db->conectar();
                $comando = $con->query("SELECT nombreprod FROM productos WHERE Idpproducto = ".$productosbd[$i]." AND IdProp = 0"); 
                $comando->execute();
                $nombre = $comando->fetchAll(PDO::FETCH_ASSOC); 
                array_push($productos, $nombre[0]['nombreprod'].":".$cantidadesbd[$i].",");  
            }
        return $productos;

    }
    function recuperarNombreUser($id){
        $db = new Database();
        $con = $db->conectar();
        $comando = $con->query("SELECT nombre FROM usuarios WHERE IdUser=".$id);
        $comando->execute();
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC); 
        return $resultado[0]['nombre'];
    }
    function eliminarPeticion($idPetiPub){
        $nregAfectados=0;
        try{
            $db = new Database();
            $con = $db->conectar();
            $sql = "DELETE FROM peticionespub WHERE IdPetPub=?";
            $stmt= $con->prepare($sql);
            $stmt->execute([$idPetiPub]);
            $nregAfectados=1;
            return $nregAfectados;
        }catch(Exception $e){
            return $nregAfectados;
        }
    }

?>












