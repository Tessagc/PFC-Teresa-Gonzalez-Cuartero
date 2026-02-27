<?php
    try {
        require("../auth/conexion_bbdd.php");
    } catch (\Throwable $th) {
        echo "Error al encontrar la bbdd";
    }


    try {
        if (isset($_POST['enviar'])) {
            // conectar a bbdd
            $conexion = mysqli_connect($servidor, $usuario, $contra, $bbdd);

            // preparar datos modificar datos
            $dni = mysqli_real_escape_string($conexion, trim($_POST['dni_nuevo']));
            $nombre = mysqli_real_escape_string($conexion, trim($_POST['nombre_nuevo']));
            $apellidos = mysqli_real_escape_string($conexion, trim($_POST['apellidos_nuevo']));
            $telefono_personal = mysqli_real_escape_string($conexion, trim($_POST['telefono_personal_nuevo']));
            $gmail_contacto = mysqli_real_escape_string($conexion, trim($_POST['gmail_contacto_nuevo']));
            $gmail_empresarial = mysqli_real_escape_string($conexion, trim($_POST['gmail_empresarial_nuevo']));
            $password_hash = mysqli_real_escape_string($conexion, $_POST['password_hash_nuevo']);

            // encriptacion del la contraseña
            $password_hash = password_hash($password_hash, PASSWORD_DEFAULT);

            // hacer la consulta
            mysqli_query($conexion, "INSERT INTO empleados (dni, nombre, apellidos, telefono_personal, gmail_contacto, gmail_empresarial, password_hash)
            VALUES ('$dni','$nombre','$apellidos','$telefono_personal','$gmail_contacto','$gmail_empresarial','$password_hash')");

            mysqli_close($conexion);
            echo "todo correcto";
        }
    } catch (\Throwable $th) {
        echo "Error al conectar la bbdd";
    }

?>