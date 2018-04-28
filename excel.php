<?php
//Incluimos librería y archivo de conexión
    include('Classes/PHPExcel.php');
	$dw = mysqli_connect("localhost", "root","","catastro_dw");
    $dw->set_charset("utf8");

    //consultas
    //productos

  
    $sql = "SELECT * FROM tbl_vialidad";
    $resultado = mysqli_query($dw,$sql);

    //proveedores
    //$sql = "SELECT * FROM proveedores";
    //$resultadoproveedores = sqlsrv_query($conn,$sql);
   
    $objPHPExcel  = new PHPExcel();

    //Establecemos la pestaña activa y nombre a la pestaña
    $objPHPExcel->setActiveSheetIndex(0);//establecer como si fuera arreglo
    $objPHPExcel->getActiveSheet()->setTitle("Urbano");//titulo
    
    $estiloTituloReporte = array(
    'font' => array(
    'name'      => 'Arial',
    'bold'      => true,
    'italic'    => false,
    'strike'    => false,
    'size' =>13
    ),
    'fill' => array(
    'type'  => PHPExcel_Style_Fill::FILL_SOLID
    ),
    'borders' => array(
    'allborders' => array(
    'style' => PHPExcel_Style_Border::BORDER_NONE
    )
    ),
    'alignment' => array(
    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
    );
    
    $estiloTituloColumnas = array(
    'font' => array(
    'name'  => 'Arial',
    'bold'  => true,
    'size' =>10,
    'color' => array(
    'rgb' => 'FFFFFF'
    )
    ),
    'fill' => array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'color' => array('rgb' => '5F9EA0')
    ),
    'borders' => array(
    'allborders' => array(
    'style' => PHPExcel_Style_Border::BORDER_THIN
    )
    ),
    'alignment' =>  array(
    'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
    );
    
    $estiloInformacion = new PHPExcel_Style();
    $estiloInformacion->applyFromArray( array(
    'font' => array(
    'name'  => 'Arial',
    'color' => array(
    'rgb' => '000000'
    )
    ),
    'fill' => array(
    'type'  => PHPExcel_Style_Fill::FILL_SOLID
    ),
    'borders' => array(
    'allborders' => array(
    'style' => PHPExcel_Style_Border::BORDER_THIN
    )
    ),
    'alignment' =>  array(
    'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
    ));

    //productos añadir nombre de columnas y titulo
    $fila = 5; //Establecemos en que fila inciara a imprimir los datos
    //renombre
    $objPHPExcel->getActiveSheet()->getStyle('A1:F3')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('A4:F5')->applyFromArray($estiloTituloColumnas);
    
     $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Vialidades');
    $objPHPExcel->getActiveSheet()->mergeCells('A1:F3');
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('A4', 'id');
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('B4', 'coord_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('C4', 'coord_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
    $objPHPExcel->getActiveSheet()->setCellValue('D4', 'nombre');
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('E4', 'id_material');
     $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('F4', 'fecha_act');
    //base de datos
    //Recorremos los resultados de la consulta y los imprimimos
	while ($rows = mysqli_fetch_array($resultado)){
        
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, $rows['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, $rows['coord_x']);
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, $rows['coord_y']);
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, $rows['nombre']);
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, $rows['id_material']);
        $objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, $rows['fecha_act']);
   
        
        $fila++; 
    }
  
   $fila = $fila-1;
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A5:F".$fila);
    $objPHPExcel->getActiveSheet()->getStyle("A5:F".$fila)->getAlignment()->setWrapText(true);


/*
    //proveedores añadir nombre de columnas y titulo
    $fila = 7; //Establecemos en que fila inciara a imprimir los datos
    
    $objPHPExcel->getActiveSheet()->getStyle('G1:K5')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('G6:K6')->applyFromArray($estiloTituloColumnas);
    
     $objPHPExcel->getActiveSheet()->setCellValue('G1', 'CATALOGO DE PROVEEDORES');
    $objPHPExcel->getActiveSheet()->mergeCells('G1:K5');
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('G6', 'id_proveedor');
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(40);
    $objPHPExcel->getActiveSheet()->setCellValue('H6', 'nombre');
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('I6', 'razon social');
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('J6', 'colonia');
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('K6', 'calle');
    
    //Recorremos los resultados de la consulta y los imprimimos

    while( $rows = sqlsrv_fetch_array($resultadoproveedores, SQLSRV_FETCH_ASSOC)){
        
        $objPHPExcel->getActiveSheet()->setCellValue('G'.$fila, $rows['id_proveedor']);
        $objPHPExcel->getActiveSheet()->setCellValue('H'.$fila, $rows['nombre']);
        $objPHPExcel->getActiveSheet()->setCellValue('I'.$fila, $rows['razon_social']);
        $objPHPExcel->getActiveSheet()->setCellValue('J'.$fila, $rows['colonia']);
        $objPHPExcel->getActiveSheet()->setCellValue('K'.$fila, $rows['calle']);
        
        $fila++; 
    }
  
   $fila = $fila-1;
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "G7:K".$fila);
    $objPHPExcel->getActiveSheet()->getStyle("G7:K".$fila)->getAlignment()->setWrapText(true);     */

    
    $sql = "SELECT * FROM tbl_hospital";
    $resultados = mysqli_query($dw,$sql);

    $estiloInformacion1 = new PHPExcel_Style();
    $estiloInformacion1->applyFromArray( array(
    'font' => array(
    'name'  => 'Arial',
    'color' => array(
    'rgb' => '000000'
    )
    ),
    'fill' => array(
    'type'  => PHPExcel_Style_Fill::FILL_SOLID
    ),
    'borders' => array(
    'allborders' => array(
    'style' => PHPExcel_Style_Border::BORDER_THIN
    )
    ),
    'alignment' =>  array(
    'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
    ));
  
    $objPHPExcel->createSheet(1);
    //Establecemos la pestaña activa y nombre a la pestaña
    $objPHPExcel->setActiveSheetIndex(1);//establecer como si fuera arreglo
    $objPHPExcel->getActiveSheet(1)->setTitle("Salud");//titulo

    //productos añadir nombre de columnas y titulo
    $fila = 5; //Establecemos en que fila inciara a imprimir los datos
    //renombre
    $objPHPExcel->getActiveSheet()->getStyle('A1:G3')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('A4:G5')->applyFromArray($estiloTituloColumnas);
    
     $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Hospitales');
    $objPHPExcel->getActiveSheet()->mergeCells('A1:G3');
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('A4', 'id');
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('B4', 'coord_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('C4', 'coord_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
    $objPHPExcel->getActiveSheet()->setCellValue('D4', 'nombre');
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
    $objPHPExcel->getActiveSheet()->setCellValue('E4', 'tipo');
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('F4', 'dependencia');
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('G4', 'fecha_act');
    //base de datos
    //Recorremos los resultados de la consulta y los imprimimos
	while ($rows = mysqli_fetch_array($resultados)){
        
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, $rows['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, $rows['coord_x']);
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, $rows['coord_y']);
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, $rows['nombre']);
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, $rows['tipo']);
        $objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, $rows['dependencia']);
        $objPHPExcel->getActiveSheet()->setCellValue('G'.$fila, $rows['fecha_act']);
   
        
        $fila++; 
    }
  
   $fila = $fila-1;
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A5:G".$fila);
    $objPHPExcel->getActiveSheet()->getStyle("A5:G".$fila)->getAlignment()->setWrapText(true);
 

    $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment;filename="DataWarehouse.xlsx"');
    header('Cache-Control: max-age=0');
    
    $writer->save('php://output');
mysqli_close($dw );
?>