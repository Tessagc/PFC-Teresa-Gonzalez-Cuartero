<?php
try {
        require("../auth/conexion_bbdd.php");
    } catch (\Throwable $th) {
        header("location:../../front/paginas/ver_empleados.php?error=2");
        exit();
    }



    try {
       if (isset($_POST['cod_empleado'])) {
        
            // conexion con la BBDD
            $conexion = mysqli_connect($servidor, $usuario, $contra, $bbdd);
            mysqli_set_charset($conexion, "utf8mb4");

            // recoger los datos, cod_empleado incluido para las proximas nominas
            $id_empleado = $_POST['cod_empleado'];

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

            // extraer el siguente mes
            $consulta1 = mysqli_query($conexion, "SELECT DATE_ADD(max(periodo), INTERVAL 1 MONTH) AS siguiente_mes FROM nominas
            WHERE cod_empleado = ".$id_empleado);
            $fecha_proxima = mysqli_fetch_array($consulta1);
            $fecha_guardar = $fecha_proxima['siguiente_mes'];


            // crear la nueva de las proximas nominas
            $nueva_nomina = "INSERT INTO nominas (cod_empleado, periodo, sueldo_base, complementos, cont_comun, 
            formacion, desempleo, irpf, total)
            VALUES ('$id_empleado', '$fecha_guardar', '$sueldo_base', '$complementos', '$cont_comun', 
            '$formacion', '$desempleo', '$irpf', '$total')";


            mysqli_query($conexion, $nueva_nomina);

            mysqli_close($conexion);
            header("location:../../front/paginas/ver_empleados.php?error=8");
            exit();



        } else {
            header("location:../../front/paginas/ver_empleados.php?error=4");
            exit();
        }
    } catch (mysqli_sql_exception $sql) {
        header("location:../../front/paginas/ver_empleados.php?error=7");
        exit();
    }
?>