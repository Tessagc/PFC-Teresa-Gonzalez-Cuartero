<?php
    session_start();

    // id del usuario logueado
    $id_sesion_usuario = $_SESSION['id_usuario'];


    // si cierra la sesion
    if (!$_SESSION['logueado']) {
        session_destroy();
        //si entramos por aqui, significa que NO ha iniciado sesion
        header("location:../../index.php");
        exit();
    }


    // tiempo maximo de la sesion
    if($_SESSION['hora_sesion'] + 1800 < time()) {
        // caduca al pasar 30 minutos segundos
        session_destroy();
        header("location:../../index.php?error=5");
        exit();
    }

    // caducidad por inactivida, pendiente


    // se crea tiempo si no hay inactividad
    $_SESSION['timeout']=time();
?>