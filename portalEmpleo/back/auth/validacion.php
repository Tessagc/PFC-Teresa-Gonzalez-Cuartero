<?php
    try {
        require("conexion_bbdd.php");
    } catch (Throwable $th) {
        echo "Error al encontrar la bbdd";
    }

    // falta la sesion

    try {
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['enviar'])) {

            // datos enviados
            $user = trim($_POST['usuario']);
            $pass = trim($_POST['contra']);

            // que no haya nada vacio
            if (empty($user) or empty($pass)) {
                header("location:../../index.php?error=1");
                exit();
            }

            // proceso con bases de datos
            $conexion = mysqli_connect($servidor, $usuario, $contra, $bbdd);

            $user=mysqli_real_escape_string($conexion, $user);
            $pass=mysqli_real_escape_string($conexion, $pass);

            $resultado = mysqli_query($conexion, "SELECT cod_empleado, password_hash FROM empleados WHERE gmail_empresarial='$user';");
            $info = mysqli_fetch_array($resultado);

            if ($info && password_verify($pass, $info['password_hash'])) {
                session_start();
                $_SESSION['usuasio_log'] = $user;
                $_SESSION['id_usuario'] = $info['cod_empleado'];
                $_SESSION['logueado'] = true;
                $_SESSION['hora_sesion'] = time();

                header("location:../../front/paginas/mi_info.php?usuario=".$info['cod_empleado']);
                exit();
            } else {
                header("location:../../index.php?error=2");
                exit();
            }

        }
    } catch (mysqli_sql_exception $sql) {
        $error = "Error al acceder a la bbdd".$sql->getMessage();
        header("location:../../index.php?error=3&mensaje=".$error);
        exit();
    }
?>