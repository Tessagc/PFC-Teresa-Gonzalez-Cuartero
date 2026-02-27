<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion</title>
    <link rel="stylesheet" href="front/css/bootstrap.min.css">
</head>
<body>
    <main>
        <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 1) {
                    echo "<p>Faltan datos.</p>";
                } elseif($_GET['error'] == 2) {
                    echo "<p>Gmail o contraseña incorrectos.</p>";
                } elseif($_GET['error'] == 3) {
                    echo "<p>Error: no se pudo conectar a la BBDD ".$_GET['mensaje']."</p>";
                } elseif($_GET['error'] == 4) {
                    echo "<p>Sesion cerrada manualmente.</p>";
                } elseif($_GET['error'] == 5) {
                    echo "<p>Sesion caducada.</p>";
                } 
            }
        ?>
        <form action="back/auth/validacion.php" method='post' class='container' name='sesiones' enctype='application/x-www-form-urlencoded'>
            <div class='mb-3 container px-5 w-75'>
                <label for="userSesion" class='form-label fs-4 fw-bold'>Usuario (tu gmail de empresa): </label>
                <input type="email" class='form-control border-info' name="usuario" id="usuario" autofocus required>
            </div>
            <div class='mb-3 container px-5 w-75'>
                <label for="passSesion" class='form-label fs-4 fw-bold'>Contraseña: </label>
                <input type="password" class='form-control border-info' name="contra" id="contra" required minlength='4'>
            </div>
            <div class='mb-3 container'>
                <div class='container d-flex justify-content-center'>
                    <input type="submit" value="Acceder" name='enviar' class='btn btn-primary m-1'>
                    <input type="reset" value="Borrar" class='btn btn-secondary m-1'>
                </div>
            </div>
            
        </form>
    </main>
    <footer>
        
    </footer>
</body>
</html>