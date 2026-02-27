<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nuevo usuario</title>
</head>
<body>
    <form action="../../back/acciones/nuevo_usuario.php" method="post" enctype="multipart/form-data" name='nuevoUser'>

    <div>
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni_nuevo" required>
    </div>
    
    <div>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre_nuevo" required>
    </div>
    
    <div>
        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos_nuevo" required>
    </div>
    
    <div>
        <label for="telefono_personal">Teléfono Personal:</label>
        <input type="text" id="telefono_personal" name="telefono_personal_nuevo" required>
    </div>
    
    <div>
        <label for="gmail_contacto">Correo Electrónico de Contacto:</label>
        <input type="email" id="gmail_contacto" name="gmail_contacto_nuevo" required>
    </div>
    
    <div>
        <label for="gmail_empresarial">Correo Electrónico Empresarial:</label>
        <input type="email" id="gmail_empresarial" name="gmail_empresarial_nuevo" required>
    </div>
    
    <div>
        <label for="password_hash">Contraseña:</label>
        <input type="password" id="password_hash" name="password_hash_nuevo" required>
    </div>
        <div>
            <input type="submit" value="Enviar" name='enviar'>
            <input type="reset" value="Borrar" name='borrar'>
        </div>
    </form>
</body>
</html>