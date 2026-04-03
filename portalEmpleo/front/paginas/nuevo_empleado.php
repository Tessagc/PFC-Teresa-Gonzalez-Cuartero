<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nuevo empleado</title>
    <link rel='stylesheet' href='../css/bootstrap.min.css'>
    <script src='../js/bootstrap.min.js'></script>
    <script src='../js/funciones.js'></script>
</head>
<body class='fondo-web'>


    <?php
    // archivos necesarios
        try {
            require_once("../../back/auth/sesion.php");
            require("plantillas/barras_nav.php");
            require("../../back/auth/conexion_bbdd.php");
        } catch (\Throwable $th) {
            echo "No se pudo acceder a los archivos auxiliares";
        }

        // mostrar info y navegacion segun usuario
        try {
            // conexion
            $conexion = mysqli_connect($servidor, $usuario, $contra, $bbdd);
            mysqli_set_charset($conexion, "utf8mb4");


            // sacar la info del usuario para trabajar
            $consulta = mysqli_query($conexion, "SELECT * FROM empleados WHERE cod_empleado = ".$id_sesion_usuario);
            $usuario = mysqli_fetch_array($consulta);

                // barras de navegacion
echo "<header>";
                if ($usuario['rol'] == "admin") { // barra de los admin
                    echo $barra_admin;
                } else if ($usuario['rol'] == "jefe") { // barra de los admin
                    echo $barra_jefe;
                } else if ($usuario['rol'] == "normal") { // barra de los admin
                    echo $barra_normal;
                }
echo "</header>";
                
        } catch (mysqli_sql_exception $sql) {
            echo 'No se pudo acceder a la bbdd: $sql';
        }

        // mensajes de error si los hay
        if (isset($_GET['error'])) {
            if ($_GET['error'] == 0) {
                echo "<p class='text-primary'>Empleado creado exitosamente.</p>";
            } else if ($_GET['error'] == 1) {
                echo "<p class='text-danger'>No se pudo conectar a la base de datos.</p>";
            } else if ($_GET['error'] == 2) {
                echo "<p class='text-danger'>No se pudo añadir el empleado.</p>";
            }  elseif ($_GET['error'] == 3) {
                echo "<p class='text-danger'>Formato de imagen no valido o el archivo es demasiado grande.</p>";
            } elseif ($_GET['error'] == 4) {
                echo "<p class='text-danger'>Imagen ya existente.</p>";
            }
        }

        // obtener lista de departamentos
        $consulta2 = mysqli_query($conexion, "SELECT nombre, cod_departamento FROM departamentos");

        // formulario
    echo "<main>";
        echo "<h2 class='text-center mt-5 mb-4 titulo-mediano fw-bold'>Nuevo empleado</h2>";
        echo "<div class='container mt-5'>";
            echo "<div class='justify-content-center p-4'>";
                echo "<form action='../../back/acciones/crear_empleado.php' method='post' class='mx-auto w-75' enctype='multipart/form-data' name='nuevo_empleado'>
                    <fieldset class='form-group border border-3 rounded-5 border-primary mb-3'>
                        <legend class='text-center fw-bold text-primary fs-4'>Datos personales del empleado</legend>
                        <div class='mb-3 px-5'>
                            <label for='dni' class='form-label fw-semibold fs-5 text-primary'>DNI:</label>
                            <input type='text' id='dni' name='dni_nuevo' class='form-control' required>
                        </div>
                        
                        <div class='mb-3 px-5'>
                            <label for='nombre' class='form-label fw-semibold fs-5 text-primary'>Nombre:</label>
                            <input type='text' id='nombre' name='nombre_nuevo' class='form-control' required>
                        </div>
                        
                        <div class='mb-3 px-5'>
                            <label for='apellidos' class='form-label fw-semibold fs-5 text-primary'>Apellidos:</label>
                            <input type='text' id='apellidos' name='apellidos_nuevo' class='form-control' required>
                        </div>
                        
                        <div class='mb-3 px-5'>
                            <label for='telefono_personal' class='form-label fw-semibold fs-5 text-primary'>Teléfono Personal:</label>
                            <input type='text' id='telefono_personal' name='telefono_personal_nuevo' class='form-control' required>
                        </div>
                        
                        <div class='mb-3 px-5'>
                            <label for='gmail_contacto' class='form-label fw-semibold fs-5 text-primary'>Correo Electrónico de Contacto:</label>
                            <input type='email' id='gmail_contacto' name='gmail_contacto_nuevo' class='form-control' required>
                        </div>
                        
                        <div class='mb-3 px-5'>
                            <label for='gmail_empresarial' class='form-label fw-semibold fs-5 text-primary'>Correo Electrónico Empresarial:</label>
                            <input type='email' id='gmail_empresarial' name='gmail_empresarial_nuevo' class='form-control' required>
                        </div>

                        <div class='mb-3 px-5'>
                            <label for='puesto' class='form-label fw-semibold fs-5 text-primary'>Puesto</label>
                            <input type='text' id='puesto' name='puesto_nuevo' class='form-control' class='form-control' required>
                        </div>

                        <div class='mb-3 px-5'>
                            <label for='estado' class='form-label fw-semibold fs-5 text-primary'>Estado</label>
                            <select name='estado_nuevo' id='estado' class='form-select' required>
                                <option value='' selected hidden>Escoja el estado del empleado</option>
                                <option value='activo'>activo</option>
                                <option value='de baja'>de baja</option>
                                <option value='despedido'>despedido</option>
                            </select>
                        </div>

                        <div class='mb-3 px-5'>
                            <label for='rol' class='form-label fw-semibold fs-5 text-primary'>Rol</label>
                            <select name='rol_nuevo' id='rol' class='form-select' required>
                                <option value='' selected hidden>Escoja el rol del empleado</option>
                                <option value='normal'>normal</option>
                                <option value='jefe'>jefe</option>
                                <option value='admin'>admin</option>
                            </select>
                        </div>
                        
                        <div class='mb-3 px-5'>
                            <label for='password_hash' class='form-label fw-semibold fs-5 text-primary'>Contraseña:</label>
                            <input type='password' id='password_hash' name='password_hash_nuevo' class='form-control' required>
                        </div>

                        <div class='mb-3 px-5'>
                            <label for='foto' class='form-label fw-semibold fs-5 text-primary'>Foto (opcional)</label>
                            <input type='file' name='foto_nuevo' id='foto' class='form-control'>
                        </div>

                        <div class='mb-3 px-5'>
                            <label for='departamento' class='form-label fw-semibold fs-5 text-primary'>Departamento (opcional)</label>
                            <select name='departamento_nuevo' id='departamento' class='form-select'>
                                <option value='' selected hidden>Escoja el departamento del empleado si ya esta asignado</option>";
                                while ($departamento = mysqli_fetch_array($consulta2)) {
                                    echo "<option value='".$departamento['cod_departamento']."'>".$departamento['nombre']."</option>";
                                }
                                
                            echo "</select>
                        </div>
                    </fieldset>
                    <fieldset class='form-group border border-3 rounded-5 border-primary mb-3'>
                        <legend class='text-center fw-bold text-primary fs-4'>Datos de la nomina mensual</legend>
                        <div class='mb-3 px-5'>
                            <label for='periodo' class='form-label fw-semibold fs-5 text-primary'>Periodo:</label>
                            <input type='date' id='periodo' name='periodo' class='form-control' required>
                        </div>

                        <div class='mb-3 px-5'>
                            <label for='sueldo_base' class='form-label fw-semibold fs-5 text-primary'>Sueldo Base:</label>
                            <input type='number' step='0.0001' id='sueldo_base' name='sueldo_base' class='form-control' required>
                        </div>

                        <div class='mb-3 px-5'>
                            <label for='complementos' class='form-label fw-semibold fs-5 text-primary'>Complementos:</label>
                            <input type='number' step='0.01' id='complementos' name='complementos' class='form-control' required>
                        </div>

                        <div class='mb-3 px-5'>
                            <label for='cont_comun' class='form-label fw-semibold fs-5 text-primary'>Contingencias Comunes (porcentaje):</label>
                            <input type='number' step='0.00001' id='cont_comun' name='cont_comun' class='form-control' required>
                        </div>

                        <div class='mb-3 px-5'>
                            <label for='formacion' class='form-label fw-semibold fs-5 text-primary'>Formación (porcentaje):</label>
                            <input type='number' step='0.00001' id='formacion' name='formacion' class='form-control' required>
                        </div>

                        <div class='mb-3 px-5'>
                            <label for='desempleo' class='form-label fw-semibold fs-5 text-primary'>Desempleo (porcentaje):</label>
                            <input type='number' step='0.00001' id='desempleo' name='desempleo' class='form-control' required>
                        </div>

                        <div class='mb-3 px-5'>
                            <label for='irpf' class='form-label fw-semibold fs-5 text-primary'>IRPF (porcentaje):</label>
                            <input type='number' step='0.01' id='irpf' name='irpf' class='form-control' required>
                        </div>
                    </fieldset>

                    <div class='mb-3 container'>
                        <div class='container d-flex justify-content-between'>
                            <input type='submit' value='Guardar' name='enviar' class='btn btn-primary m-1'>
                            <input type='reset' value='Borrar' class='btn btn-secondary m-1'>
                        </div>
                    </div>

                </form>";
            echo "</div>";
        echo "</div>";
    echo "</main>";
    ?>

        
        
    
</body>
</html>