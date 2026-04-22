<?php

// generar la siguiente nomina para cada empleado, la del mes actual
function generarnominasMesActual($conexion) {

    static $hecho = false;
    if ($hecho) return;
    $hecho = true;

    $generacion_nominas = "
        INSERT INTO nominas (
            cod_empleado,
            periodo,
            sueldo_base,
            complementos,
            cont_comun,
            formacion,
            desempleo,
            irpf,
            total
        )
        SELECT 
            n.cod_empleado,
            DATE_ADD(n.periodo, INTERVAL 1 MONTH),
            n.sueldo_base,
            n.complementos,
            n.cont_comun,
            n.formacion,
            n.desempleo,
            n.irpf,
            n.total
        FROM nominas n
        JOIN (
            SELECT cod_empleado, MAX(periodo) AS ultima_fecha
            FROM nominas
            GROUP BY cod_empleado
        ) ult
        ON n.cod_empleado = ult.cod_empleado
        AND n.periodo = ult.ultima_fecha
        WHERE 
            -- 🔥 SOLO mes actual
            DATE_FORMAT(DATE_ADD(n.periodo, INTERVAL 1 MONTH), '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')
            
            AND NOT EXISTS (
                SELECT 1
                FROM nominas n2
                WHERE n2.cod_empleado = n.cod_empleado
                AND DATE_FORMAT(n2.periodo, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')
            )
        ";

    mysqli_query($conexion, $generacion_nominas);
}
?>