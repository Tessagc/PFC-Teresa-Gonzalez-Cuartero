<?php
    try {
        require_once("../../back/auth/sesion.php");
        require("../../back/auth/conexion_bbdd.php");
        require("../../back/librerias/fpdf.php");
    } catch (Throwable $th) {
        echo "No se pudo acceder a los archivos auxiliares";
    }


    try {
        if (isset($_GET['cod_nomina'])) {

             // conexion
            $conexion = mysqli_connect($servidor, $usuario, $contra, $bbdd);

            // sacar la info de la nomina
            $consulta = mysqli_query($conexion, "SELECT * FROM nominas WHERE cod_nomina =".$_GET['cod_nomina']);
            $nomina = mysqli_fetch_array($consulta);

            // sacar el nombre del usuario
            $consulta1 = mysqli_query($conexion, "SELECT nombre, apellidos FROM empleados WHERE cod_empleado =".$id_sesion_usuario);
            $usuario = mysqli_fetch_array($consulta1);

            $pdf = new FPDF();
            // titulo
            $titulo = "Nomina de ".$usuario['nombre']." ".$usuario['apellidos'];
            $pdf->SetTitle($titulo);

            // autor
            $pdf->setAuthor('Nombre empresa');

            // PDF
            $pdf->AddPage();

            // datos de la nomina
            $pdf->SetFont('Arial','B',26);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(0,8,"Nomina de ".$usuario['nombre']." ".$usuario['apellidos'],0,0, 'C');


            $pdf->Ln();
            $pdf->Ln();
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(43,8,'Fecha de pago: ',0,0);
            $pdf->SetFont('Arial', '', 13);
            $pdf->Cell(20,8,$nomina['periodo']);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(38,8,'Sueldo Bruto: ',0,0);
            $pdf->SetFont('Arial', '', 13);
            $pdf->Cell(20,8,iconv('UTF-8','windows-1252',$nomina['sueldo_base']." €"));

            $pdf->Ln();
            $pdf->Ln();
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(44,8,'Complementos: ',0,0);
            $pdf->SetFont('Arial', '', 13);
            $pdf->Cell(20,8,iconv('UTF-8','windows-1252',$nomina['complementos']." €"));

            $pdf->Ln();
            $pdf->Ln();
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(69,8,'Contingencias Comunes: ',0,0);
            $pdf->SetFont('Arial', '', 13);
            $pdf->Cell(20,8,iconv('UTF-8','windows-1252',$nomina['cont_comun']." €"));

            $pdf->Ln();
            $pdf->Ln();
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(31,8,utf8_decode("Formación: "),0,0);
            $pdf->SetFont('Arial', '', 13);
            $pdf->Cell(20,8,iconv('UTF-8','windows-1252',$nomina['formacion']." €"));

            $pdf->Ln();
            $pdf->Ln();
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(33,8,utf8_decode("Desempleo: "),0,0);
            $pdf->SetFont('Arial', '', 13);
            $pdf->Cell(20,8,iconv('UTF-8','windows-1252',$nomina['desempleo']." €"));

            $pdf->Ln();
            $pdf->Ln();
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(15,8,utf8_decode("IRPF: "),0,0);
            $pdf->SetFont('Arial', '', 13);
            $pdf->Cell(10,8,iconv('UTF-8','windows-1252',$nomina['irpf']." €"));

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(16,8,utf8_decode("Total: "),0,0);
            $pdf->SetFont('Arial', '', 13);
            $pdf->Cell(10,8,iconv('UTF-8','windows-1252',$nomina['total']." €"));


            // enviar documento al navegador
            $pdf->Output();

        } else {
            header("location:mis_nominas.php");
            exit();
        }
        
    } catch (mysqli_sql_exception $sql) {
        echo "No se pudo acceder a la bbdd: $sql";
    }
?>