<?php
    session_start();

    // archivos necesarios
    try {
        require("conexion_bbdd.php");
    } catch (Throwable $th) {
        echo "Error al encontrar la bbdd";
    }

    // registrar salida
    $cod_usuario = $_SESSION['id_usuario'];
    $fecha_salida = date("Y-m-d H:i:s");

    $conexion = mysqli_connect($servidor, $usuario, $contra, $bbdd);
    $consulta = mysqli_query($conexion, "INSERT INTO fichajes (cod_empleado, fecha_hora, tipo) VALUES ('$cod_usuario', '$fecha_salida', 'salida')");

    session_destroy();
    header("location:../../index.php?error=4");
    exit();
?>