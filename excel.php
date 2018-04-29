<?php
//Incluimos librería y archivo de conexión
    include('Classes/PHPExcel.php');
	$dw = mysqli_connect("localhost", "root","","catastro_dw");
    $dw->set_charset("utf8");

    //consultas
    //productos

  
    $sql = "SELECT * FROM tbl_vialidad";
    $resultado = mysqli_query($dw,$sql);

    $sql = "SELECT * FROM tbl_numeros_oficiales";
    $resultadon = mysqli_query($dw,$sql);
    
    $sql = "SELECT * FROM tbl_glorietas";
    $resultadog = mysqli_query($dw,$sql);

    $sql = "SELECT * FROM tbl_licencias_de_construccion";
    $resultadol = mysqli_query($dw,$sql);

    $sql = "SELECT * FROM tbl_camellones";
    $resultadoc = mysqli_query($dw,$sql);
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

    $fila = 5; //Establecemos en que fila inciara a imprimir los datos
    
    $objPHPExcel->getActiveSheet()->getStyle('I1:N3')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('I4:N5')->applyFromArray($estiloTituloColumnas);
    
     $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Números oficiales');
    $objPHPExcel->getActiveSheet()->mergeCells('I1:N3');
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('I4', 'id');
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(40);
    $objPHPExcel->getActiveSheet()->setCellValue('J4', 'coord_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('K4', 'coord_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('L4', 'num_oficial');
    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('M4', 'id_colonia');
    $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('N4', 'id_colonia');
    //Recorremos los resultados de la consulta y los imprimimos

    while ($rows = mysqli_fetch_array($resultadon)){
        
        $objPHPExcel->getActiveSheet()->setCellValue('I'.$fila, $rows['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('J'.$fila, $rows['coord_x']);
        $objPHPExcel->getActiveSheet()->setCellValue('K'.$fila, $rows['coord_y']);
        $objPHPExcel->getActiveSheet()->setCellValue('L'.$fila, $rows['num_oficial']);
        $objPHPExcel->getActiveSheet()->setCellValue('M'.$fila, $rows['id_colonia']);
        $objPHPExcel->getActiveSheet()->setCellValue('N'.$fila, $rows['fecha_act']);
        
        $fila++; 
    }
  
   $fila = $fila-1;
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "I5:N".$fila);
    $objPHPExcel->getActiveSheet()->getStyle("I5:N".$fila)->getAlignment()->setWrapText(true);    

    //////// glorietas
     $fila = 5; //Establecemos en que fila inciara a imprimir los datos
    //renombre
    $objPHPExcel->getActiveSheet()->getStyle('Q1:V3')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('Q4:V5')->applyFromArray($estiloTituloColumnas);
    
     $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Glorietas');
    $objPHPExcel->getActiveSheet()->mergeCells('Q1:V3');
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('Q4', 'id');
    $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('R4', 'coord_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('S4', 'coord_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(50);
    $objPHPExcel->getActiveSheet()->setCellValue('T4', 'nombre');
    $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(55);
    $objPHPExcel->getActiveSheet()->setCellValue('U4', 'monumento');
     $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('V4', 'fecha_act');

	while ($rows = mysqli_fetch_array($resultadog)){
        
        $objPHPExcel->getActiveSheet()->setCellValue('Q'.$fila, $rows['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('R'.$fila, $rows['coord_x']);
        $objPHPExcel->getActiveSheet()->setCellValue('S'.$fila, $rows['coord_y']);
        $objPHPExcel->getActiveSheet()->setCellValue('T'.$fila, $rows['nombre']);
        $objPHPExcel->getActiveSheet()->setCellValue('U'.$fila, $rows['monumento']);
        $objPHPExcel->getActiveSheet()->setCellValue('V'.$fila, $rows['fecha_act']);
   
        
        $fila++; 
    }
  
   $fila = $fila-1;
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "Q5:V".$fila);
    $objPHPExcel->getActiveSheet()->getStyle("Q5:V".$fila)->getAlignment()->setWrapText(true);

  /////// licencias de contruccion
      $fila = 5; //Establecemos en que fila inciara a imprimir los datos
    //renombre
    $objPHPExcel->getActiveSheet()->getStyle('Y1:AB3')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('Y4:AB5')->applyFromArray($estiloTituloColumnas);
    
     $objPHPExcel->getActiveSheet()->setCellValue('Y1', 'Licencias de contrucción');
    $objPHPExcel->getActiveSheet()->mergeCells('Y1:AB3');
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('Y4', 'id');
    $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('Z4', 'coord_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('AA4', 'coord_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('AB4', 'fecha_act');

	while ($rows = mysqli_fetch_array($resultadol)){
        
        $objPHPExcel->getActiveSheet()->setCellValue('Y'.$fila, $rows['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('Z'.$fila, $rows['coord_x']);
        $objPHPExcel->getActiveSheet()->setCellValue('AA'.$fila, $rows['coord_y']);
        $objPHPExcel->getActiveSheet()->setCellValue('AB'.$fila, $rows['fecha_act']);
   
        
        $fila++; 
    }
  
   $fila = $fila-1;
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "Y5:AB".$fila);
    $objPHPExcel->getActiveSheet()->getStyle("Y5:AB".$fila)->getAlignment()->setWrapText(true);

  /////// camellones
       $fila = 5; //Establecemos en que fila inciara a imprimir los datos
    //renombre
    $objPHPExcel->getActiveSheet()->getStyle('AE1:AI3')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('AE4:AI5')->applyFromArray($estiloTituloColumnas);
    
     $objPHPExcel->getActiveSheet()->setCellValue('AE1', 'Camellones');
    $objPHPExcel->getActiveSheet()->mergeCells('AE1:AI3');
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('AE4', 'id');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('AF4', 'coord_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('AG4', 'coord_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('AH4', 'area');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('AI4', 'fecha_act');


	while ($rows = mysqli_fetch_array($resultadoc)){
        
        $objPHPExcel->getActiveSheet()->setCellValue('AE'.$fila, $rows['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('AF'.$fila, $rows['coord_x']);
        $objPHPExcel->getActiveSheet()->setCellValue('AG'.$fila, $rows['coord_y']);
        $objPHPExcel->getActiveSheet()->setCellValue('AH'.$fila, $rows['area']);
        $objPHPExcel->getActiveSheet()->setCellValue('AI'.$fila, $rows['fecha_act']);
   
        
        $fila++; 
    }
  
   $fila = $fila-1;
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion,"AE5:AI".$fila);
    $objPHPExcel->getActiveSheet()->getStyle("AE5:AI".$fila)->getAlignment()->setWrapText(true);
 
    /////////////////////////////////////////////////////////////////////////////////////////////// Segunda hoja
    
    $sql = "SELECT * FROM tbl_hospital";
    $resultados = mysqli_query($dw,$sql);


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