<?php
//Incluimos librería y archivo de conexión
    include('Classes/PHPExcel.php');
	$dw = mysqli_connect("localhost", "root","","catastro_dw");
    $dw->set_charset("utf8");

    //consultas
    //productos
  
    $sql = "SELECT t.id, t.nombre, t.id_material, t.coord_x, t.coord_y, c.material , t.fecha_act FROM tbl_vialidad as t join ct_tipo_material as c on t.id_material= c.id";
    $resultado = mysqli_query($dw,$sql);

    $sql = "SELECT t.coord_x , t.coord_y, t.id, t.num_oficial, c.colonia , t.id_colonia, t.fecha_act FROM tbl_numeros_oficiales as t join ct_colonia as c on t.id_colonia= c.id";
    $resultadon = mysqli_query($dw,$sql);
    
    $sql = "SELECT * FROM tbl_glorietas";
    $resultadog = mysqli_query($dw,$sql);

    $sql = "SELECT * FROM tbl_licencias_de_construccion";
    $resultadol = mysqli_query($dw,$sql);

    $sql = "SELECT * FROM tbl_camellones";
    $resultadoc = mysqli_query($dw,$sql);

    $sql = "SELECT * FROM tbl_antenas_telecomunicacion";
    $resultadoat = mysqli_query($dw,$sql);
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
    $objPHPExcel->getActiveSheet()->setCellValue('B4', 'coordenada_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('C4', 'coordenada_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
    $objPHPExcel->getActiveSheet()->setCellValue('D4', 'nombre');
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('E4', 'material');
     $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('F4', 'fecha act.');

	while ($rows = mysqli_fetch_array($resultado)){
        
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, $rows['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, $rows['coord_x']);
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, $rows['coord_y']);
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, $rows['nombre']);
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, $rows['material']);
        $objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, $rows['fecha_act']);
   
        
        $fila++; 
    }
  
   $fila = $fila-1;
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A5:F".$fila);
    $objPHPExcel->getActiveSheet()->getStyle("A5:F".$fila)->getAlignment()->setWrapText(true);
//////////////////Numeros oficiales
    $fila = 5; //Establecemos en que fila inciara a imprimir los datos
    
    $objPHPExcel->getActiveSheet()->getStyle('I1:N3')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('I4:N5')->applyFromArray($estiloTituloColumnas);
    
     $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Números oficiales');
    $objPHPExcel->getActiveSheet()->mergeCells('I1:N3');
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('I4', 'id');
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(40);
    $objPHPExcel->getActiveSheet()->setCellValue('J4', 'coordenada_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('K4', 'coordenada_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('L4', 'no. oficial');
    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('M4', 'colonia');
    $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('N4', 'fecha act.');
    //Recorremos los resultados de la consulta y los imprimimos

    while ($rows = mysqli_fetch_array($resultadon)){
        
        $objPHPExcel->getActiveSheet()->setCellValue('I'.$fila, $rows['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('J'.$fila, $rows['coord_x']);
        $objPHPExcel->getActiveSheet()->setCellValue('K'.$fila, $rows['coord_y']);
        $objPHPExcel->getActiveSheet()->setCellValue('L'.$fila, $rows['num_oficial']);
        $objPHPExcel->getActiveSheet()->setCellValue('M'.$fila, $rows['colonia']);
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
    $objPHPExcel->getActiveSheet()->setCellValue('R4', 'coordenada_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('S4', 'coordenada_y');
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
    $objPHPExcel->getActiveSheet()->setCellValue('Z4', 'coordenada_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('AA4', 'coordenada_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('AB4', 'fecha act.');

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
    $objPHPExcel->getActiveSheet()->setCellValue('AF4', 'coordenada_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('AG4', 'coordenada_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('AH4', 'area');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('AI4', 'fecha act.');


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
    /////// Antenas de telecomunicacion
           $fila = 5; //Establecemos en que fila inciara a imprimir los datos
    //renombre
    $objPHPExcel->getActiveSheet()->getStyle('AL1:AS3')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('AL4:AS5')->applyFromArray($estiloTituloColumnas);
    
     $objPHPExcel->getActiveSheet()->setCellValue('AL1', 'Antenas de telecomunicación');
    $objPHPExcel->getActiveSheet()->mergeCells('AL1:AS3');
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('AL4', 'id');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('AM4','clave catastral');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('AN4', 'coordenada_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('AO4', 'coordenada_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AP')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('AP4', 'no. oficial');
     $objPHPExcel->getActiveSheet()->getColumnDimension('AQ')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('AQ4', 'obra');
     $objPHPExcel->getActiveSheet()->getColumnDimension('AR')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('AR4', 'tipo de obra');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AS')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('AS4', 'fecha act.');


	while ($rows = mysqli_fetch_array($resultadoat)){
        
        $objPHPExcel->getActiveSheet()->setCellValue('AL'.$fila, $rows['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('AM'.$fila, $rows['clave_cata']);
        $objPHPExcel->getActiveSheet()->setCellValue('AN'.$fila, $rows['coord_x']);
        $objPHPExcel->getActiveSheet()->setCellValue('AO'.$fila, $rows['coord_y']);
        $objPHPExcel->getActiveSheet()->setCellValue('AP'.$fila, $rows['num_oficial']);
        $objPHPExcel->getActiveSheet()->setCellValue('AQ'.$fila, $rows['obra']);
        $objPHPExcel->getActiveSheet()->setCellValue('AR'.$fila, $rows['tipo_de_obra']);
        $objPHPExcel->getActiveSheet()->setCellValue('AS'.$fila, $rows['fecha_act']);
   
        
        $fila++; 
    }
  
   $fila = $fila-1;
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion,"AL5:AS".$fila);
    $objPHPExcel->getActiveSheet()->getStyle("AL5:AS".$fila)->getAlignment()->setWrapText(true);
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
    $objPHPExcel->getActiveSheet()->setCellValue('B4', 'coordenada_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('C4', 'coordenada_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
    $objPHPExcel->getActiveSheet()->setCellValue('D4', 'nombre');
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
    $objPHPExcel->getActiveSheet()->setCellValue('E4', 'tipo');
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('F4', 'dependencia');
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('G4', 'fecha act.');
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
////////////////////////////////////////////////////////////////////////////////////////////////////////// tercera hoja

    $sql = "SELECT * FROM tbl_paradas_de_camion";
    $resultados = mysqli_query($dw,$sql);
    $sql = "SELECT * FROM tbl_multas";
    $resultadosm = mysqli_query($dw,$sql);
    $sql = "SELECT * FROM tbl_rutas_camion";
    $resultadosrc = mysqli_query($dw,$sql);
    $sql = "SELECT * FROM tbl_topes";
    $resultadost = mysqli_query($dw,$sql);
    $sql = "SELECT * FROM tbl_accidentes";
    $resultadosac = mysqli_query($dw,$sql);
    $sql = "SELECT * FROM tbl_semaforos";
    $resultadoss = mysqli_query($dw,$sql);


    $objPHPExcel->createSheet(2);
    //Establecemos la pestaña activa y nombre a la pestaña
    $objPHPExcel->setActiveSheetIndex(2);//establecer como si fuera arreglo
    $objPHPExcel->getActiveSheet(2)->setTitle("Vialidad");//titulo

    //productos añadir nombre de columnas y titulo
    $fila = 5; //Establecemos en que fila inciara a imprimir los datos
    //renombre
    $objPHPExcel->getActiveSheet()->getStyle('A1:D3')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('A4:D5')->applyFromArray($estiloTituloColumnas);
    
     $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Paradas de camión');
    $objPHPExcel->getActiveSheet()->mergeCells('A1:D3');
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('A4', 'id');
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('B4', 'coord_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('C4', 'coord_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('D4', 'fecha_act');
    //base de datos
    //Recorremos los resultados de la consulta y los imprimimos
	while ($rows = mysqli_fetch_array($resultados)){
        
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, $rows['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, $rows['coord_x']);
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, $rows['coord_y']);
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, $rows['fecha_act']);
   
        
        $fila++; 
    }
  
   $fila = $fila-1;
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A5:D".$fila);
    $objPHPExcel->getActiveSheet()->getStyle("A5:D".$fila)->getAlignment()->setWrapText(true); 
//////////////////////////////Multas
     $fila = 5; //Establecemos en que fila inciara a imprimir los datos
    //renombre
    $objPHPExcel->getActiveSheet()->getStyle('G1:L3')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('G4:L5')->applyFromArray($estiloTituloColumnas);
    
     $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Paradas de camión');
    $objPHPExcel->getActiveSheet()->mergeCells('G1:L3');
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('G4', 'id');
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('H4', 'coord_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('I4', 'coord_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(70);
    $objPHPExcel->getActiveSheet()->setCellValue('J4', 'descripcion');
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('K4', 'fecha_ini');
    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('L4', 'fecha_act');
    //base de datos
    //Recorremos los resultados de la consulta y los imprimimos
	while ($rows = mysqli_fetch_array($resultadosm)){      
        $objPHPExcel->getActiveSheet()->setCellValue('G'.$fila, $rows['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('H'.$fila, $rows['coord_x']);
        $objPHPExcel->getActiveSheet()->setCellValue('I'.$fila, $rows['coord_y']);
        $objPHPExcel->getActiveSheet()->setCellValue('J'.$fila, $rows['descripcion']);
        $objPHPExcel->getActiveSheet()->setCellValue('K'.$fila, $rows['fecha_ini']);
        $objPHPExcel->getActiveSheet()->setCellValue('L'.$fila, $rows['fecha_act']);
   
        
        $fila++; 
    }
  
   $fila = $fila-1;
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "G5:L".$fila);
    $objPHPExcel->getActiveSheet()->getStyle("G5:L".$fila)->getAlignment()->setWrapText(true); 
    ////////////////////////////// rutas camion
         $fila = 5; //Establecemos en que fila inciara a imprimir los datos
    //renombre
    $objPHPExcel->getActiveSheet()->getStyle('O1:S3')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('O4:S5')->applyFromArray($estiloTituloColumnas);
    
     $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Paradas de camión');
    $objPHPExcel->getActiveSheet()->mergeCells('O1:S3');
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('O4', 'id');
    $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('P4', 'coord_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('Q4', 'coord_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(40);
    $objPHPExcel->getActiveSheet()->setCellValue('R4', 'nombre');
    $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('S4', 'fecha_act');
    //base de datos
    //Recorremos los resultados de la consulta y los imprimimos
	while ($rows = mysqli_fetch_array($resultadosrc)){      
        $objPHPExcel->getActiveSheet()->setCellValue('O'.$fila, $rows['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('P'.$fila, $rows['coord_x']);
        $objPHPExcel->getActiveSheet()->setCellValue('Q'.$fila, $rows['coord_y']);
        $objPHPExcel->getActiveSheet()->setCellValue('R'.$fila, $rows['nombre']);
        $objPHPExcel->getActiveSheet()->setCellValue('S'.$fila, $rows['fecha_act']);
   
        
        $fila++; 
    }
  
   $fila = $fila-1;
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "O5:S".$fila);
    $objPHPExcel->getActiveSheet()->getStyle("O5:S".$fila)->getAlignment()->setWrapText(true); 
    //////////////////////////////////Topes
  $fila = 5; //Establecemos en que fila inciara a imprimir los datos
    //renombre
    $objPHPExcel->getActiveSheet()->getStyle('V1:AD3')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('V4:AD5')->applyFromArray($estiloTituloColumnas);
    
    $objPHPExcel->getActiveSheet()->setCellValue('V1', 'Topes');
    $objPHPExcel->getActiveSheet()->mergeCells('V1:AD3');
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('V4', 'id');
    $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('W4', 'coord_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('X4', 'coord_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('Y4', 'id_color');
    $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('Z4', 'id_c_fisica');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('AA4', 'id_tipo_material');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(25);
    $objPHPExcel->getActiveSheet()->setCellValue('AB4', 'fecha_mant');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(25);
    $objPHPExcel->getActiveSheet()->setCellValue('AC4', 'fecha_ini');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('AD4', 'fecha_act');
	while ($rows = mysqli_fetch_array($resultadost)){      
        $objPHPExcel->getActiveSheet()->setCellValue('V'.$fila, $rows['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('W'.$fila, $rows['coord_x']);
        $objPHPExcel->getActiveSheet()->setCellValue('X'.$fila, $rows['coord_y']);
        $objPHPExcel->getActiveSheet()->setCellValue('Y'.$fila, $rows['id_color']);
        $objPHPExcel->getActiveSheet()->setCellValue('Z'.$fila, $rows['id_c_fisica']);
        $objPHPExcel->getActiveSheet()->setCellValue('AA'.$fila, $rows['id_tipo_material']);
        $objPHPExcel->getActiveSheet()->setCellValue('AB'.$fila, $rows['fecha_mant']);
        $objPHPExcel->getActiveSheet()->setCellValue('AC'.$fila, $rows['fecha_ini']);
        $objPHPExcel->getActiveSheet()->setCellValue('AD'.$fila, $rows['fecha_act']);
   
        
        $fila++; 
    }
  
   $fila = $fila-1;
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "V5:AD".$fila);
    $objPHPExcel->getActiveSheet()->getStyle("V5:AD".$fila)->getAlignment()->setWrapText(true); 
    /////////////////////////////Accidentes
      $fila = 5; //Establecemos en que fila inciara a imprimir los datos
    //renombre
    $objPHPExcel->getActiveSheet()->getStyle('AG1:AO3')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('AG4:AO5')->applyFromArray($estiloTituloColumnas);
    
    $objPHPExcel->getActiveSheet()->setCellValue('AG1', 'Accidentes');
    $objPHPExcel->getActiveSheet()->mergeCells('AG1:AO3');
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('AG4', 'id');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('AH4', 'coord_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('AI4', 'coord_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('AJ4', 'hora');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('AK4', 'fecha');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('AL4', 'lesionados');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(25);
    $objPHPExcel->getActiveSheet()->setCellValue('AM4', 'muertos');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setWidth(25);
    $objPHPExcel->getActiveSheet()->setCellValue('AN4', 'afectados');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('AO4', 'fecha_act');
	while ($rows = mysqli_fetch_array($resultadosac)){      
        $objPHPExcel->getActiveSheet()->setCellValue('AG'.$fila, $rows['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('AH'.$fila, $rows['coord_x']);
        $objPHPExcel->getActiveSheet()->setCellValue('AI'.$fila, $rows['coord_y']);
        $objPHPExcel->getActiveSheet()->setCellValue('AJ'.$fila, $rows['hora']);
        $objPHPExcel->getActiveSheet()->setCellValue('AK'.$fila, $rows['fecha']);
        $objPHPExcel->getActiveSheet()->setCellValue('AL'.$fila, $rows['lesionados']);
        $objPHPExcel->getActiveSheet()->setCellValue('AM'.$fila, $rows['muertos']);
        $objPHPExcel->getActiveSheet()->setCellValue('AN'.$fila, $rows['afectados']);
        $objPHPExcel->getActiveSheet()->setCellValue('AO'.$fila, $rows['fecha_act']);
   
        
        $fila++; 
    }
  
   $fila = $fila-1;
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "AR5:AO".$fila);
    $objPHPExcel->getActiveSheet()->getStyle("AR5:AO".$fila)->getAlignment()->setWrapText(true); 
    /////////////////////////////// semaforos

      $fila = 5; //Establecemos en que fila inciara a imprimir los datos
    //renombre
    $objPHPExcel->getActiveSheet()->getStyle('AR1:BE3')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('AR4:BE5')->applyFromArray($estiloTituloColumnas);
    
    $objPHPExcel->getActiveSheet()->setCellValue('AR1', 'Semáforos');
    $objPHPExcel->getActiveSheet()->mergeCells('AR1:BE3');
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('AR')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('AR4', 'id');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AS')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('AS4', 'coord_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AT')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('AT4', 'coord_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AU')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('AU4', 'tipo_semaforo');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('AV4', 'id_tipo_material');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AW')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('AW4', 'id_tipo_de_luz');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AX')->setWidth(25);
    $objPHPExcel->getActiveSheet()->setCellValue('AX4', 'id_tipo_co');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AY')->setWidth(25);
    $objPHPExcel->getActiveSheet()->setCellValue('AY4', 'id_tipo_estruc');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AZ')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('AZ4', 'id_color');
    $objPHPExcel->getActiveSheet()->getColumnDimension('BA')->setWidth(25);
    $objPHPExcel->getActiveSheet()->setCellValue('BA4', 'id_c_fisica');
    $objPHPExcel->getActiveSheet()->getColumnDimension('BB')->setWidth(25);
    $objPHPExcel->getActiveSheet()->setCellValue('BB4', 'id_c_fisica_ele');
    $objPHPExcel->getActiveSheet()->getColumnDimension('BC')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('BC4', 'fecha_mant');
    $objPHPExcel->getActiveSheet()->getColumnDimension('BD')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('BD4', 'fecha_ini');
    $objPHPExcel->getActiveSheet()->getColumnDimension('BE')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('BE4', 'fecha_act');

	while ($rows = mysqli_fetch_array($resultadoss)){      
        $objPHPExcel->getActiveSheet()->setCellValue('AR'.$fila, $rows['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('AS'.$fila, $rows['coord_x']);
        $objPHPExcel->getActiveSheet()->setCellValue('AT'.$fila, $rows['coord_y']);
        $objPHPExcel->getActiveSheet()->setCellValue('AU'.$fila, $rows['tipo_semaforo']);
        $objPHPExcel->getActiveSheet()->setCellValue('AV'.$fila, $rows['id_tipo_material']);
        $objPHPExcel->getActiveSheet()->setCellValue('AW'.$fila, $rows['id_tipo_de_luz']);
        $objPHPExcel->getActiveSheet()->setCellValue('AX'.$fila, $rows['id_tipo_de_co']);
        $objPHPExcel->getActiveSheet()->setCellValue('AY'.$fila, $rows['id_tipo_estruc']);
        $objPHPExcel->getActiveSheet()->setCellValue('AZ'.$fila, $rows['id_color']);
        $objPHPExcel->getActiveSheet()->setCellValue('BA'.$fila, $rows['id_c_fisica']);
        $objPHPExcel->getActiveSheet()->setCellValue('BB'.$fila, $rows['id_c_fisica_ele']);
        $objPHPExcel->getActiveSheet()->setCellValue('BC'.$fila, $rows['fecha_mant']);
        $objPHPExcel->getActiveSheet()->setCellValue('BD'.$fila, $rows['fecha_ini']);
        $objPHPExcel->getActiveSheet()->setCellValue('BE'.$fila, $rows['fecha_act']);
   
        
        $fila++; 
    }
  
   $fila = $fila-1;
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "AR5:BE".$fila);
    $objPHPExcel->getActiveSheet()->getStyle("AR5:BE".$fila)->getAlignment()->setWrapText(true); 
    ////////////////////////////////////////////////////Cuarta hoja
    ///
    
    $sql = "SELECT * FROM tbl_sismo_2003";
    $resultadoss = mysqli_query($dw,$sql);
    $sql = "SELECT * FROM tbl_atlas_de_riesgo";
    $resultadosa = mysqli_query($dw,$sql);
    $sql = "SELECT * FROM tbl_refugios_temporales";
    $resultadosr = mysqli_query($dw,$sql);

    $objPHPExcel->createSheet(3);//crea nueva hoja
    //Establecemos la pestaña activa y nombre a la pestaña
    $objPHPExcel->setActiveSheetIndex(3);//establecer como si fuera arreglo
    $objPHPExcel->getActiveSheet(3)->setTitle(" Protección civil");//titulo

    ////////////////////sismo
    $fila = 5; 
    $objPHPExcel->getActiveSheet()->getStyle('A1:H3')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('A4:H5')->applyFromArray($estiloTituloColumnas);
    
     $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Sismos');
    $objPHPExcel->getActiveSheet()->mergeCells('A1:H3');
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('A4', 'id');
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('B4', 'coord_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('C4', 'coord_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('D4', 'area');
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('E4', 'num_oficial');
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('F4', 'id_colonia');
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('G4', 'clasificacion');
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('H4', 'fecha_act');
    //base de datos
    //Recorremos los resultados de la consulta y los imprimimos
	while ($rows = mysqli_fetch_array($resultadoss)){
        
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, $rows['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, $rows['coord_x']);
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, $rows['coord_y']);
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, $rows['area']);
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, $rows['num_oficial']);
        $objPHPExcel->getActiveSheet()->setCellValue('F'.$fila, $rows['id_colonia']);
        $objPHPExcel->getActiveSheet()->setCellValue('G'.$fila, $rows['clasificacion']);
        $objPHPExcel->getActiveSheet()->setCellValue('H'.$fila, $rows['fecha_act']);  
        $fila++; 
    }
  
   $fila = $fila-1;
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A5:H".$fila);
    $objPHPExcel->getActiveSheet()->getStyle("A5:H".$fila)->getAlignment()->setWrapText(true);
    /////////////////atlas de riesgo
    $fila = 5; 
    $objPHPExcel->getActiveSheet()->getStyle('K1:W3')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('K4:W5')->applyFromArray($estiloTituloColumnas);
    
     $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Atlas de riesgo');
    $objPHPExcel->getActiveSheet()->mergeCells('K1:W3');
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('K4', 'id');
    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('L4', 'coord_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('M4', 'coord_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('N4', 'fenomeno');
    $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('O4', 'detalles');
    $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('P4', 'fuente');
    $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('Q4', 'tipo');
    $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('R4', 'fen_clasi');
    $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('S4', 'ame_ampl');
    $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('T4', 'periodo_ret');
    $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('U4', 'intensid_uni');
    $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('V4', 'cauce');
    $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('W4', 'fecha_act');
   
	while ($rows = mysqli_fetch_array($resultadosa)){
        
        $objPHPExcel->getActiveSheet()->setCellValue('K'.$fila, $rows['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('L'.$fila, $rows['coord_x']);
        $objPHPExcel->getActiveSheet()->setCellValue('M'.$fila, $rows['coord_y']);
        $objPHPExcel->getActiveSheet()->setCellValue('N'.$fila, $rows['fenomeno']);
        $objPHPExcel->getActiveSheet()->setCellValue('O'.$fila, $rows['detalles']);
        $objPHPExcel->getActiveSheet()->setCellValue('P'.$fila, $rows['fuente']);
        $objPHPExcel->getActiveSheet()->setCellValue('Q'.$fila, $rows['tipo']);
        $objPHPExcel->getActiveSheet()->setCellValue('R'.$fila, $rows['fen_clasi']);
        $objPHPExcel->getActiveSheet()->setCellValue('S'.$fila, $rows['ame_ampl']);
        $objPHPExcel->getActiveSheet()->setCellValue('T'.$fila, $rows['periodo_ret']);
        $objPHPExcel->getActiveSheet()->setCellValue('U'.$fila, $rows['intensid_uni']);
        $objPHPExcel->getActiveSheet()->setCellValue('V'.$fila, $rows['cauce']);
        $objPHPExcel->getActiveSheet()->setCellValue('W'.$fila, $rows['fecha_act']);  
        $fila++; 
    }
  
   $fila = $fila-1;
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "K5:W".$fila);
    $objPHPExcel->getActiveSheet()->getStyle("K5:W".$fila)->getAlignment()->setWrapText(true);
       ////////////////////Refugios temporales
    $fila = 5; 
    $objPHPExcel->getActiveSheet()->getStyle('Z1:AJ3')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('Z4:AJ5')->applyFromArray($estiloTituloColumnas);
    
     $objPHPExcel->getActiveSheet()->setCellValue('Z1', 'Sismos');
    $objPHPExcel->getActiveSheet()->mergeCells('Z1:AJ3');
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('Z4', 'id');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('AA4', 'coord_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('AB4', 'coord_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('AC4', 'area');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('AD4', 'nombre');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('AE4', 'id_colonia');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(40);
    $objPHPExcel->getActiveSheet()->setCellValue('AF4', 'propietario');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(15);
    $objPHPExcel->getActiveSheet()->setCellValue('AG4', 'construccion');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('AH4', 'superficie');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('AI4', 'capacidad');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('AJ4', 'fecha_act');
    //base de datos
    //Recorremos los resultados de la consulta y los imprimimos
	while ($rows = mysqli_fetch_array($resultadosr)){
        
        $objPHPExcel->getActiveSheet()->setCellValue('Z'.$fila, $rows['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('AA'.$fila, $rows['coord_x']);
        $objPHPExcel->getActiveSheet()->setCellValue('AB'.$fila, $rows['coord_y']);
        $objPHPExcel->getActiveSheet()->setCellValue('AC'.$fila, $rows['area']);
        $objPHPExcel->getActiveSheet()->setCellValue('AD'.$fila, $rows['nombre']);
        $objPHPExcel->getActiveSheet()->setCellValue('AE'.$fila, $rows['id_colonia']);
        $objPHPExcel->getActiveSheet()->setCellValue('AF'.$fila, $rows['propietario']);
        $objPHPExcel->getActiveSheet()->setCellValue('AG'.$fila, $rows['construccion']);
        $objPHPExcel->getActiveSheet()->setCellValue('AH'.$fila, $rows['superficie']);
        $objPHPExcel->getActiveSheet()->setCellValue('AI'.$fila, $rows['capacidad']);
        $objPHPExcel->getActiveSheet()->setCellValue('AJ'.$fila, $rows['fecha_act']);  
        $fila++; 
    }
  
   $fila = $fila-1;
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "Z5:AJ".$fila);
    $objPHPExcel->getActiveSheet()->getStyle("Z5:AJ".$fila)->getAlignment()->setWrapText(true);
////////////////////////////////////////////////////////////////////////////////////////////////////////// tercera hoja

    $sql = "SELECT * FROM tbl_cauces_de_agua";
    $resultados = mysqli_query($dw,$sql);
    $objPHPExcel->createSheet(4);
    //Establecemos la pestaña activa y nombre a la pestaña
    $objPHPExcel->setActiveSheetIndex(4);//establecer como si fuera arreglo
    $objPHPExcel->getActiveSheet(4)->setTitle("Ecología");//titulo

    //productos añadir nombre de columnas y titulo
    $fila = 5; //Establecemos en que fila inciara a imprimir los datos
    //renombre
    $objPHPExcel->getActiveSheet()->getStyle('A1:E3')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('A4:E5')->applyFromArray($estiloTituloColumnas);
    
     $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Cauces de agua');
    $objPHPExcel->getActiveSheet()->mergeCells('A1:E3');
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('A4', 'id');
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('B4', 'coordenada_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('C4', 'coordenada_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
    $objPHPExcel->getActiveSheet()->setCellValue('D4', 'nombre');
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('E4', 'fecha act.');
    //base de datos
    //Recorremos los resultados de la consulta y los imprimimos
	while ($rows = mysqli_fetch_array($resultados)){
        
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, $rows['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$fila, $rows['coord_x']);
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$fila, $rows['coord_y']);
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$fila, $rows['nombre']);
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$fila, $rows['fecha_act']);

        
        $fila++; 
    }
  
   $fila = $fila-1;
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A5:E".$fila);
    $objPHPExcel->getActiveSheet()->getStyle("A5:E".$fila)->getAlignment()->setWrapText(true);
  ////////////arboles
    $sql = "SELECT t.coord_x, t.fecha_act, t.coord_y, t.id, t.especie, t.ancho_m, t.alto_m, t.id_c_fisica, t.numero, t.solicito, t.autoriza, t.fecha_reso, t.reforestacion, c.c_fisica FROM tbl_arboles as t join ct_cond_fisica as c on t.id_c_fisica= c.id";
    $resul = mysqli_query($dw,$sql);
    $fila = 5; //Establecemos en que fila inciara a imprimir los datos
    //renombre
    $objPHPExcel->getActiveSheet()->getStyle('H1:T3')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('H4:T5')->applyFromArray($estiloTituloColumnas);
    
     $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Arboles');
    $objPHPExcel->getActiveSheet()->mergeCells('H1:T3');
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('H4', 'id');
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('I4', 'coordenada_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('J4', 'coordenada_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('K4', 'especie');
    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('L4', 'alto');
    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('M4', 'ancho');
    $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('N4', 'reforestacion');
    $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('O4', 'condicion fisica');
    $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('P4', 'numero');
    $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('Q4', 'solicito');
    $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('R4', 'autoriza');
    $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('S4', 'fecha resolución');
    $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('T4', 'fecha act.');
    //base de datos
    //Recorremos los resultados de la consulta y los imprimimos
	while ($rows = mysqli_fetch_array($resul)){
        
        $objPHPExcel->getActiveSheet()->setCellValue('H'.$fila, $rows['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('I'.$fila, $rows['coord_x']);
        $objPHPExcel->getActiveSheet()->setCellValue('J'.$fila, $rows['coord_y']);
        $objPHPExcel->getActiveSheet()->setCellValue('K'.$fila, $rows['especie']);
        $objPHPExcel->getActiveSheet()->setCellValue('L'.$fila, $rows['alto_m']);
        $objPHPExcel->getActiveSheet()->setCellValue('M'.$fila, $rows['ancho_m']);
        $objPHPExcel->getActiveSheet()->setCellValue('N'.$fila, $rows['reforestacion']);
        $objPHPExcel->getActiveSheet()->setCellValue('O'.$fila, $rows['c_fisica']);
        $objPHPExcel->getActiveSheet()->setCellValue('P'.$fila, $rows['numero']);
        $objPHPExcel->getActiveSheet()->setCellValue('Q'.$fila, $rows['solicito']);
        $objPHPExcel->getActiveSheet()->setCellValue('R'.$fila, $rows['autoriza']);
        $objPHPExcel->getActiveSheet()->setCellValue('S'.$fila, $rows['fecha_reso']);
        $objPHPExcel->getActiveSheet()->setCellValue('T'.$fila, $rows['fecha_act']);
    
    $fila++; 
    }
  
   $fila = $fila-1;
 
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "H5:T".$fila);
    $objPHPExcel->getActiveSheet()->getStyle("H5:T".$fila)->getAlignment()->setWrapText(true);
     /////cuerpos de agua
    $sql = "SELECT t.coord_x , t.coord_y, t.id, t.area, c.tipo, t.id_ca, t.fecha_act FROM tbl_cuerpos_de_agua as t join ct_cuerpos_agua as c on t.id_ca= c.id";
    $resultadoc = mysqli_query($dw,$sql);

    $fila = 5; //Establecemos en que fila inciara a imprimir los datos
    //renombre
    $objPHPExcel->getActiveSheet()->getStyle('Z1:AE3')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('Z4:AE5')->applyFromArray($estiloTituloColumnas);
    
     $objPHPExcel->getActiveSheet()->setCellValue('Z1', 'Cuerpos de agua');
    $objPHPExcel->getActiveSheet()->mergeCells('Z1:AE3');
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setCellValue('Z4', 'id');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('AA4', 'coordenada_x');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('AB4', 'coordenada_y');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('AC4', 'area');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(30);
    $objPHPExcel->getActiveSheet()->setCellValue('AD4', 'tipo');
    $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setCellValue('AE4', 'fecha act.');
    //base de datos
    //Recorremos los resultados de la consulta y los imprimimos
	while ($rows = mysqli_fetch_array($resultadoc)){
        
        $objPHPExcel->getActiveSheet()->setCellValue('Z'.$fila, $rows['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('AA'.$fila, $rows['coord_x']);
        $objPHPExcel->getActiveSheet()->setCellValue('AB'.$fila, $rows['coord_y']);
        $objPHPExcel->getActiveSheet()->setCellValue('AC'.$fila, $rows['area']);
        $objPHPExcel->getActiveSheet()->setCellValue('AD'.$fila, $rows['tipo']);
        $objPHPExcel->getActiveSheet()->setCellValue('AE'.$fila, $rows['fecha_act']);

        
        $fila++; 
    }
  
   $fila = $fila-1;
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "Z5:AE".$fila);
    $objPHPExcel->getActiveSheet()->getStyle("Z5:AE".$fila)->getAlignment()->setWrapText(true);
    /////////////////////////////fin
    $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment;filename="DataWarehouse.xlsx"');
    header('Cache-Control: max-age=0');
    
    $writer->save('php://output');
    mysqli_close($dw );
  
?>