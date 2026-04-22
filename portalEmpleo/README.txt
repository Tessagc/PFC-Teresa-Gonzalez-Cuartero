Estructura navegadores del header

navegador admin:
Mi info - empleados (ver/añadir) - departamentos(ver/añadir) - incidencias - nominas - cerrar sesion
editar/crear/borrar departamentos/empleados
de empleados, ver sus fichajes y sus nominas, y actualizar las proximas nominas
ver su info, los empleados y los departamentos
atender incidencias
ver/generar pdf nomina

navegador jefe:
Mi info - empleados - departamento - reportar incidencia - nominas - cerrar sesion
ver departamento/empleados del departamento
reportar incidencia
ver/generar pdf nomina

navegador normal:
Mi info - departamento - reportar incidencia - nominas - cerrar sesion
ver departamento/su info como empleado
reportar incidencia
ver/generar pdf nomina


Notas.
Index es el archivo de login
En js el archivo bootstrap.min.js NO SE MODIFICA
Si se necesita añadir clase a bootstrap, hacerlo al final del archivo css



SQL tablas:

CREATE TABLE Departamentos (
    cod_departamento INT PRIMARY KEY AUTO_INCREMENTET,
    cod_jefe_departamento INT NULL,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    CONSTRAINT fk_jefe_departamento
        FOREIGN KEY (cod_jefe_departamento)
        REFERENCES Empleado(cod_empleado)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

CREATE TABLE Empleados (
    cod_empleado INT PRIMARY KEY AUTO_INCREMENTET,
    dni VARCHAR(20) NOT NULL UNIQUE,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(80) NOT NULL,
    telefono_personal VARCHAR(20) NOT NULL,
    gmail_contacto VARCHAR(100) NOT NULL,
    gmail_empresarial VARCHAR(100) NOT NULL,
    puesto VARCHAR(50) NOT NULL,
    estado ENUM('activo', 'de baja', 'despedido') DEFAULT 'activo',
    rol ENUM('normal', 'jefe', 'admin') DEFAULT 'normal',
    password_hash VARCHAR(255) NOT NULL,
    foto VARCHAR(255),
    cod_departamento INT NULL,
    CONSTRAINT fk_departamento
        FOREIGN KEY (cod_departamento)
        REFERENCES Departamentos(cod_departamento)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);



CREATE TABLE Nominas (
    cod_nomina INT PRIMARY KEY AUTO_INCREMENTET,
    cod_empleado INT NOT NULL,
    periodo DATE NOT NULL,
    sueldo_base DECIMAL(10,2) NOT NULL,
    complementos DECIMAL(10,2) DEFAULT 0 NOT NULL,
    cont_comun DECIMAL(10,2) DEFAULT 0 NOT NULL,
    formacion DECIMAL(10,2) DEFAULT 0 NOT NULL,
    desempleo DECIMAL(10,2) DEFAULT 0 NOT NULL,
    irpf DECIMAL(10,2) DEFAULT 0 NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    CONSTRAINT fk_nomina_empleado
        FOREIGN KEY (cod_empleado)
        REFERENCES Empleados(cod_empleado)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
	CONSTRAINT uc_empleado_periodo 
	UNIQUE (cod_empleado, periodo);
);

CREATE TABLE Fichajes (
    cod_fichaje INT PRIMARY KEY AUTO_INCREMENTET,
    cod_empleado INT NOT NULL,
    fecha_hora DATETIME NOT NULL,
    tipo ENUM('entrada','salida') NOT NULL,
    CONSTRAINT fk_fichaje_empleado
        FOREIGN KEY (cod_empleado)
        REFERENCES Empleados(cod_empleado)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Incidencias (
    cod_incidencia INT PRIMARY KEY AUTO_INCREMENTET,
    cod_empleado_reportante INT NOT NULL,
    cod_empleado_gestor INT NULL,
    descripcion TEXT NOT NULL,
    gravedad ENUM('baja','media','alta') default alta,
    atendida BOOLEAN default false,
    fecha_creacion DATETIME NOT NULL,
    fecha_resolucion DATETIME NULL,
    CONSTRAINT fk_incidencia_empleado_reportante
        FOREIGN KEY (cod_empleado_reportante)
        REFERENCES Empleados(cod_empleado)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT fk_incidencia_empleado_gestor
        FOREIGN KEY (cod_empleado_gestor)
        REFERENCES Empleados(cod_empleado)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);




Funciones JavaScript:
Mostrar opción de negar/aceptar borrado de empleado/departamento
el js de Bootstrap
posible: comprobar inputs validos





Para calcular nomina
total bruto = sueldo_bruto + complementos
contingencia común = (total bruto + complementos) * 0.047
formación = (total bruto + complementos) * 0.001
desempleo = (total bruto + complementos) * 0.0155
IRPF = total bruto * % dependiente
total neto = sueldo bruto - cont comun - formación - desempleo - IRPF





