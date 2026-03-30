<?php
    // archivos requeridos
    try {
        require("../auth/conexion_bbdd.php");
    } catch (Throwable $th) {
        header("location:../../front/paginas/ver_departamentos.php?error=1");
        exit();
    }



    try {
        // ¿hay informacion de un departamento?
        if (isset($_POST['enviar'])) {
            // conectar con la BBDD
            $conexion = mysqli_connect($servidor, $usuario, $contra, $bbdd);
            mysqli_set_charset($conexion, "utf8mb4");

            // preparar datos para la creacion del departamento
            $nombre_departamento = mysqli_real_escape_string($conexion, $_POST['nombre_departamento']);
            $descripcion_departamento = mysqli_real_escape_string($conexion, $_POST['descripcion_departamento']);
            $jefe_departamento = $_POST['jefe_departamento'];
            $id_actualizar = $_POST['cod_departamento'];

            // prepara consulta en funcion de si se asigno jefe al departamento
            if ($jefe_departamento == "") {
                $consulta = "UPDATE departamentos
                SET nombre = '$nombre_departamento',
                descripcion = '$descripcion_departamento'
                WHERE cod_departamento = $id_actualizar";
            } else {
                $consulta = "UPDATE departamentos
                SET nombre = '$nombre_departamento',
                descripcion = '$descripcion_departamento',
                cod_jefe_departamento = $jefe_departamento
                WHERE cod_departamento = $id_actualizar";
                }

            // hacer consulta 
            try {
                mysqli_query($conexion, $consulta);

                // asignamos tambien el departamento al empleado jefe si se asigno

                if ($jefe_departamento != "") {
                    $update = "UPDATE empleados 
                        SET cod_departamento = $id_actualizar 
                        WHERE cod_empleado = $jefe_departamento";

                        mysqli_query($conexion, $update);
                    }
            } catch (mysqli_sql_exception $sql) {
                header("location:../../front/paginas/ver_departamentos.php?error=2");
                exit();
            }

            // cerramos conexion y volvemos
            mysqli_close($conexion);
            header("location:../../front/paginas/ver_departamentos.php?error=4");
            exit();
        } else {
            header("location:../../front/paginas/ver_departamentos.php");
            exit();
        }
        
    } catch (mysqli_sql_exception $sql) {
        header("location:../../front/paginas/ver_departamentos.php?error=2");
        exit();
    }
?>