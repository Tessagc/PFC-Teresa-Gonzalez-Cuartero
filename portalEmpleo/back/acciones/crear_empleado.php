<?php
    try {
        require("../auth/conexion_bbdd.php");
    } catch (\Throwable $th) {
        header("location:../../front/paginas/nuevo_empleado.php?error=1");
        exit();
    }


    try {
        if (isset($_POST['enviar'])) {
            // conectar a bbdd
            $conexion = mysqli_connect($servidor, $usuario, $contra, $bbdd);
            mysqli_set_charset($conexion, "utf8mb4");

            // preparar datos empleado, faltan datos
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
                        header("location:../../front/paginas/nuevo_empleado.php?error=4");
                        exit();
                    }
                } else {
                    header("location:../../front/paginas/nuevo_empleado.php?error=3");
                    exit();
                }
            } 


            $foto_sql = ($foto == "NULL") ? "NULL" : "'$foto'";


            // encriptacion del la contraseña
            $password_hash = password_hash($password_hash, PASSWORD_DEFAULT);

            // añadir el nuevo empleado
            if ($cod_departamento == "") {
                $consulta_empleado = "INSERT INTO empleados 
                (dni, nombre, apellidos, telefono_personal, gmail_contacto, 
                gmail_empresarial, puesto, estado, rol, password_hash, foto)
                VALUES 
                ('$dni', '$nombre', '$apellidos', '$telefono_personal', '$gmail_contacto', 
                '$gmail_empresarial', '$puesto', '$estado', '$rol', '$password_hash', 
                $foto_sql)";
            } else {
                $consulta_empleado = "INSERT INTO empleados 
                (dni, nombre, apellidos, telefono_personal, gmail_contacto, 
                gmail_empresarial, puesto, estado, rol, password_hash, 
                foto, cod_departamento)
                VALUES 
                ('$dni', '$nombre', '$apellidos', '$telefono_personal', '$gmail_contacto', 
                '$gmail_empresarial', '$puesto', '$estado', '$rol', '$password_hash', 
                $foto_sql, $cod_departamento)";
            }

            mysqli_query($conexion, $consulta_empleado);

            // preparar la primera nomina

            // recoger los datos, cod_empleado incluido
            $id_empleado = mysqli_insert_id($conexion);

            $periodo = $_POST['periodo'];
            $sueldo_base = (float) $_POST['sueldo_base'];
            $complementos = (float) $_POST['complementos'];

            $cont_comun_porcen = (float) $_POST['cont_comun'];
            $formacion_porcen = (float) $_POST['formacion'];
            $desempleo_porcen = (float) $_POST['desempleo'];
            $irpf_porcen = (float) $_POST['irpf'];

            // sacar los impuestos 
            $cont_comun = $sueldo_base * $cont_comun_porcen / 100;
            $formacion = $sueldo_base * $formacion_porcen / 100;
            $desempleo = $sueldo_base * $desempleo_porcen / 100;
            $irpf = $sueldo_base * $irpf_porcen / 100;

            // calcular el total
            $total = $sueldo_base + $complementos - $cont_comun - $formacion - $desempleo - $irpf;

            // realizar la consulta
            $consulta_nomina = "INSERT INTO nominas
            (cod_empleado, periodo, sueldo_base, complementos, cont_comun, 
            formacion, desempleo, irpf, total)
            VALUES
            ('$id_empleado', '$periodo', '$sueldo_base', '$complementos', '$cont_comun', 
            '$formacion', '$desempleo', '$irpf', '$total')";

            mysqli_query($conexion, $consulta_nomina);


            mysqli_close($conexion);
            header("location:../../front/paginas/nuevo_empleado.php?error=0");
            exit();
        } else {
            header("location:../../front/paginas/nuevo_empleado.php?error=2");
            exit();
        }
    } catch (mysqli_sql_exception $sql) {
        header("location:../../front/paginas/nuevo_empleado.php?error=2");
        exit();
    }
?>