<?php
    try {
        require("../auth/conexion_bbdd.php");
    } catch (\Throwable $th) {
        header("location:../../front/paginas/ver_empleados.php?error=2");
        exit();
    }


    try {
        if (isset($_POST['enviar'])) {
            // conectar a bbdd
            $conexion = mysqli_connect($servidor, $usuario, $contra, $bbdd);
            mysqli_set_charset($conexion, "utf8mb4");

            // preparar datos empleado, faltan datos
            $cod_empleado_actualizar = $_POST['cod_empleado'];
            $dni = mysqli_real_escape_string($conexion, trim($_POST['dni_nuevo']));
            $nombre = mysqli_real_escape_string($conexion, trim($_POST['nombre_nuevo']));
            $apellidos = mysqli_real_escape_string($conexion, trim($_POST['apellidos_nuevo']));
            $telefono_personal = mysqli_real_escape_string($conexion, trim($_POST['telefono_personal_nuevo']));
            $gmail_contacto = mysqli_real_escape_string($conexion, trim($_POST['gmail_contacto_nuevo']));
            $gmail_empresarial = mysqli_real_escape_string($conexion, trim($_POST['gmail_empresarial_nuevo']));
            $puesto = mysqli_real_escape_string($conexion, trim($_POST['puesto_nuevo']));
            $estado = mysqli_real_escape_string($conexion, trim($_POST['estado_nuevo']));
            $rol = mysqli_real_escape_string($conexion, trim($_POST['rol_nuevo']));
            $password_hash = mysqli_real_escape_string($conexion, $_POST['password_hash_nuevo']);
            $foto = "NULL";
            $cod_departamento = $_POST['departamento_nuevo'];

            // sacar la foto de la BBDD para revisar la enviada
            $consulta1 = mysqli_query($conexion, "SELECT foto FROM empleados WHERE cod_empleado = ".$cod_empleado_actualizar);
            $foto_bd = mysqli_fetch_assoc($consulta1);
            $foto_bd = $foto_bd['foto'];

            // procesar foto ../../media/empleados/
            $nombreArchivo = $_FILES['foto_nuevo']['name'];
            $archivo = $_FILES['foto_nuevo']['tmp_name'];
            $tipo = $_FILES['foto_nuevo']['type'];
            $size = $_FILES['foto_nuevo']['size'];
            $destino = "../../media/empleados/". $nombreArchivo;

            // formatos y tamaño maximo, 1 megabyte
            if ($_FILES['foto_nuevo']['name'] != "" && $_FILES['foto_nuevo']['error'] == 0) {
                if (($tipo == "image/jpeg" or $tipo == "image/png" or $tipo == "image/webp") and $size <= 1000000) {
                    if (!file_exists("../../media/empleados/".$nombreArchivo)) {
                        if (move_uploaded_file($archivo, $destino)) { // crear imagen
                            $foto = $nombreArchivo;
                        }
                    } else {
                        header("location:../../front/paginas/ver_empleados.php?error=6");
                        exit();
                    }
                } else {
                    header("location:../../front/paginas/ver_empleados.php?error=5");
                    exit();
                }
            } 

            $foto_sql = ($foto == "NULL") ? "'$foto_bd'" : "'$foto'";

            // añadir los datos del empleado actualizados
            // encriptacion del la nueva contraseña
            $password_hash = password_hash($password_hash, PASSWORD_DEFAULT);

            // consulta para actualizar datos
            if ($cod_departamento == "") {
                $actualizacion_empleado = "UPDATE empleados SET 
                dni = '$dni',
                nombre = '$nombre',
                apellidos = '$apellidos',
                telefono_personal = '$telefono_personal',
                gmail_contacto = '$gmail_contacto',
                gmail_empresarial = '$gmail_empresarial',
                puesto = '$puesto',
                estado = '$estado',
                rol = '$rol',
                foto = $foto_sql,
                password_hash = '$password_hash'
                WHERE cod_empleado = $cod_empleado_actualizar";
            } else {
                $actualizacion_empleado = "UPDATE empleados SET 
                dni = '$dni',
                nombre = '$nombre',
                apellidos = '$apellidos',
                telefono_personal = '$telefono_personal',
                gmail_contacto = '$gmail_contacto',
                gmail_empresarial = '$gmail_empresarial',
                puesto = '$puesto',
                estado = '$estado',
                rol = '$rol',
                foto = $foto_sql,
                password_hash = '$password_hash',
                cod_departamento = $cod_departamento
                WHERE cod_empleado = $cod_empleado_actualizar";
            }


            // realizar la consulta
            mysqli_query($conexion, $actualizacion_empleado);

            mysqli_close($conexion);
            header("location:../../front/paginas/ver_empleados.php?error=0");
            exit();


            echo "hola";
        } else {
            header("location:../../front/paginas/ver_empleados.php?error=3");
            exit();
        }
    } catch (mysqli_sql_exception $sql) {
        header("location:../../front/paginas/ver_empleados.php?error=3");
        exit();
    }
?>