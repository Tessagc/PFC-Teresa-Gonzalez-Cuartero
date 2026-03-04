<?php
    session_start();

    // archivos necesarios
    try {
        require("conexion_bbdd.php");
    } catch (Throwable $th) {
        echo "Error al encontrar la bbdd";
    }

    // id del usuario logueado
    $id_sesion_usuario = $_SESSION['id_usuario'];


    // si cierra la sesion
    if (!$_SESSION['logueado']) {
        //si entramos por aqui, significa que NO ha iniciado sesion
        header("location:../../index.php");
        exit();
    }


    // tiempo maximo de la sesion
    if($_SESSION['hora_sesion'] + 1800 < time()) {
        // caduca al pasar 30 minutos segundos

        // registramos la salida
        $cod_usuario = $_SESSION['id_usuario'];
        $fecha_salida = date("Y-m-d H:i:s");

        $conexion = mysqli_connect($servidor, $usuario, $contra, $bbdd);
        $consulta = mysqli_query($conexion, "INSERT INTO fichajes (cod_empleado, fecha_hora, tipo) VALUES ('$cod_usuario', '$fecha_salida', 'salida')");

        session_destroy();
        header("location:../../index.php?error=5");
        exit();
    }

    // caducidad por inactivida, pendiente


    // se crea tiempo si no hay inactividad
    $_SESSION['timeout']=time();
?>