<?php

    try{

        $base=new PDO('mysql:host=localhost;dbname=nexoweb','root', '');

        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $base->exec("SET CHARACTER SET UTF8");

    }catch(Exception $e){

        die("Error: " . $e->getMessage());

    }    

    function cifrarContrasena($texto){

        $ascii = "";
    for ($i = 0; $i < strlen($texto); $i++) {
        $caracter = $texto[$i];
        $valor_ascii = ord($caracter);
        $ascii .= $valor_ascii . " ";
    }
    return $ascii;

    }
    function decodificar($ascii) {
        $texto_original = "";
        $valores = explode(" ", $ascii);
        foreach ($valores as $valor) {
        $caracter = chr(intval($valor));
        $texto_original .= $caracter;
        }

    return $texto_original;
    }

    function verificarContrasena($contrasena, $hash){
    
        // Verificar si la contraseña coincide con el hash almacenado
        if(decodificar($hash)==$contrasena)return true;
        return false;
    
    }

    function nombreUsuarioExiste($nombre_usuario) {

        global $base;
    
        // Consulta SQL para verificar si el nombre de usuario ya existe
        $consulta = "SELECT COUNT(*) FROM usuario WHERE NombreUsuario = :nombre_usuario";
        $stmt = $base->prepare($consulta);
        $stmt->bindParam(':nombre_usuario', $nombre_usuario, PDO::PARAM_STR);
        $stmt->execute();
    
        // Obtenemos el resultado de la consulta
        $resultado = $stmt->fetchColumn();
    
        // Si el resultado es mayor que 0, significa que el nombre de usuario ya existe
        return $resultado > 0;

    }    
    function generarCaracteresAlAzar() {
        $caracteresPosibles = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        return $caracteresPosibles[rand(0, strlen($caracteresPosibles) - 1)].$caracteresPosibles[rand(0, strlen($caracteresPosibles) - 1)].$caracteresPosibles[rand(0, strlen($caracteresPosibles) - 1)];
    }
?>
