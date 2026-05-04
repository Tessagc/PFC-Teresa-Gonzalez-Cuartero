## Autora

    Teresa González Cuartero  
    Proyecto de Fin de Grado - DAW

## Portal de empleados


    Aplicación web para la gestión interna de empleados, departamentos, incidencias, fichajes y nóminas.

    Permite centralizar la información de la empresa en una unica plataforma de forma segura, con control de acceso basado
    en roles.

## Tecnologias usadas

    PHP
    MySQL
    HTML, CSS y JavaScript
    Bootstrap
    FPDF

## Funcionalidades

    Sistema de autenticación y control de acceso por roles (admin, jefe, empleado)
    Gestión de empleados (CRUD)
    Gestión de departamentos
    Gestión de incidencias
    Registro de fichajes
    Generación de nóminas en PDF
    Control de sesiones y seguridad con bcrypt


## Roles de los usuarios
    Administrador(admin): acceso completo al Sistema
    Jefe: Consulta de su departamento, nominas y envio de incidencias
    Empleados: Consulta de sus nominas y envio de incidencias


## Seguridad

    Contraseñas cifradas con bcrypt
    Gestión de sesiones con $_SESSION
    Control de acceso por roles
    Uso de método POST para envío de datos



## Para acceder a la aplicación
    https://portalempleo.kesug.com/

    Usuario de pruebas: admin@empresa.com
    Contraseña: 1234