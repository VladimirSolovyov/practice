<?php

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Tradesoft")
	->setLastModifiedBy("Tradesoft")
	->setTitle("Office 2007 XLSX Document")
	->setSubject("Office 2007 XLSX Document")
	->setDescription("Document for Office 2007 XLSX")
	->setKeywords("office 2007 openxml");

$objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');

$border_style_right = array(
	'borders' => array(
		'right' => array(
			'style' => PHPExcel_Style_Border::BORDER_THICK,
			'color' => array(
				'argb' => '0000D0'),
		)
	)
);
$border_style_left = array(
	'borders' => array(
		'left' => array(
			'style' => PHPExcel_Style_Border::BORDER_THICK,
			'color' => array(
				'argb' => '0000D0'),
		)
	)
);
$border_style_bottom = array(
	'borders' => array(
		'bottom' => array(
			'style' => PHPExcel_Style_Border::BORDER_THICK,
			'color' => array('argb' => '0000D0'),
		)
	)
);
$border_style_top = array(
	'borders' => array(
		'top' => array(
			'style' => PHPExcel_Style_Border::BORDER_THICK,
			'color' => array('argb' => '0000D0'),
		)
	)
);
$border_style_bottom_dashed = array(
	'borders' => array(
		'bottom' => array(
			'style' => PHPExcel_Style_Border::BORDER_MEDIUMDASHED,
			'color' => array(
				'argb' => '0000D0'),
		)
	)
);

$style8 = array(
	'font' => array(
		'bold' => false,
		'size' => 8
	));
$style_middle = array(
	'font' => array(
		'bold' => false,
		'size' => 8.5
	));
$style_right9 = array(
	'font' => array(
		'bold' => false,
		'size' => 9
	),
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
	)
);

$style_right = array(
	'font' => array(
		'bold' => false,
		'size' => 8.5
	),
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
	)
);

$style_table_left = array(
	'font' => array(
		'bold' => false,
		'size' => 8.5
	),
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('rgb' => '000000')
		)
	),
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	)
);

$style_table_right = array(
	'font' => array(
		'bold' => false,
		'size' => 8.5
	),
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('rgb' => '000000')
		)
	),
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	)
);
$style10 = array(
	'font' => array(
		'bold' => false,
		'size' => 10
	));
$style_black_border = array(
	'font' => array(
		'bold' => false,
		'size' => 12
	),
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('rgb' => '000000')
		)
	),
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	)
);

$style_border_small = array(
	'font' => array(
		'bold' => false,
		'size' => 8.5
	),
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('rgb' => '000000')
		)
	),
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	)
);
$style_bottom = array(
	'font' => array(
		'bold' => false,
		'size' => 8.5
	),
	'borders' => array(
		'bottom' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN
		)
	),
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	)
);

$style_small = array(
	'font' => array(
		'bold' => false,
		'size' => 8
	),
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	)
);

$style_bold = array(
	'font' => array(
		'bold' => true,
		'size' => 12
	),
);

$style_blue = array(
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('rgb' => '0000D0')
		)
	),
);

$style_border_right = array(
	'font' => array(
		'bold' => false,
		'size' => 9
	),
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('rgb' => '000000')
		)
	),
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
	)
);

$style_vertical_line = array(
	'borders' => array(
		'left' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN
		)
	),
);

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A8', '(организация-грузоотправитель, адрес, телефон, факс, банковские реквизиты)')
	->setCellValue('A7', $DATA['shipper'])
	->setCellValue('A10', '(структурное подразделение)')
	->setCellValue('A28', "Но- мер по по- рядку")
	->setCellValue('AD26', 'ТОВАРНАЯ НАКЛАДНАЯ')
	->setCellValue('AH28', "Вид упаков- ки")
	->setCellValue('AM28', "Количество")
	->setCellValue('AC29', "код по ОКЕИ")
	->setCellValue('AM29', "в одном месте")
	->setCellValue('AR29', "мест, штук")
	->setCellValue('AX25', "Номер\nдокумента")
	->setCellValue('AX26', $DATA['document_code'])
	->setCellValue('AW28', "Масса брутто")
	->setCellValue('BB28', "Количест- во\n(масса нетто)")
	->setCellValue('BL21', "Транспортная накладная")
	->setCellValue('BH28', "Цена,\nруб. коп.")
	->setCellValue('BQ28', "Сумма без учета НДС, руб. коп.")
	->setCellValue('BI25', "Дата\nсоставления")
	->setCellValue('BI26', $DATA['doc_short_date'])
	->setCellValue('BW1', 'Унифицированная форма № ТОРГ-12')
	->setCellValue('B12', 'Грузополучатель')
	->setCellValue('B14', 'Поставщик')
	->setCellValue('B16', 'Плательщик')
	->setCellValue('B18', 'Основание')
	->setCellValue('BW2', 'Утверждена постановлением Госкомстата')
	->setCellValue('BW3', 'России от 25.12.98 № 132')
	->setCellValue('BW23', 'Вид операции')
	->setCellValue('BV6', 'Форма по ОКУД')
	->setCellValue('BX28', "НДС")
	->setCellValue('BX29', "ставка, %")
	->setCellValue('BY7', 'по ОКПО')
	->setCellValue('BY12', 'по ОКПО')
	->setCellValue('BY14', 'по ОКПО')
	->setCellValue('BY16', 'по ОКПО')
	->setCellValue('BY17', 'номер')
	->setCellValue('BY19', 'дата')
	->setCellValue('BY21', 'номер')
	->setCellValue('BY22', 'дата')
	->setCellValue('BO10', 'Вид деятельности по ОКДП')
	->setCellValue('CB29', "сумма,\nруб. коп.")
	->setCellValue('CF5', 'Код')
	->setCellValueExplicit('CF6', '0330212', PHPExcel_Cell_DataType::TYPE_STRING)
	->setCellValueExplicit('CF7', $DATA['bsp_okpo'], PHPExcel_Cell_DataType::TYPE_STRING)
	->setCellValue('CF8', '')
	->setCellValue('CF10', '')
	->setCellValue('CF12', '')
	->setCellValueExplicit('CF13', $DATA['bsp_okpo'], PHPExcel_Cell_DataType::TYPE_STRING)
	->setCellValue('CF15', '')
	->setCellValue('CF17', '')
	->setCellValue('CF19', '')
	->setCellValue('CF21', '')
	->setCellValue('CF22', '')
	->setCellValue('CF23', '')
	->setCellValue('CI28', "Сумма с учетом НДС,\nруб. коп.")
	->setCellValue('D28', "Товар")
	->setCellValue('D29', "наименование,\nхарактеристика, сорт, артикул\nтовара")
	->setCellValue('L12', $DATA['consignee'])
	->setCellValue('L13', '(организация, адрес, телефон, факс, банковские реквизиты)')
	->setCellValue('I14', $DATA['provider'])
	->setCellValue('L15', '(организация, адрес, телефон, факс, банковские реквизиты)')
	->setCellValue('L16', $DATA['payer'])
	->setCellValue('L17', '(организация, адрес, телефон, факс, банковские реквизиты)')
	->setCellValue('L18', $DATA['base'])
	->setCellValue('T29', "код")
	->setCellValue('L19', '(договор, заказ-наряд)')
	->setCellValue('X28', "Единица\nизмерения")
	->setCellValue('X29', "наиме- нование")
	->setCellValue('A30', 1)
	->setCellValue('D30', 2)
	->setCellValue('T30', 3)
	->setCellValue('X30', 4)
	->setCellValue('AC30', 5)
	->setCellValue('AH30', 6)
	->setCellValue('AM30', 7)
	->setCellValue('AR30', 8)
	->setCellValue('AW30', 9)
	->setCellValue('BB30', 10)
	->setCellValue('BH30', 11)
	->setCellValue('BQ30', 12)
	->setCellValue('BX30', 13)
	->setCellValue('CB30', 14)
	->setCellValue('CI30', 15);
foreach ($objPHPExcel->getActiveSheet()->getRowDimensions() as $rd) {
	$rd->setRowHeight(-1);
}
//Для корректной работы переноса строки
$objPHPExcel->getActiveSheet()->getStyle('A28')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('AH28')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('AM28')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('AC29')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('AM29')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('AR29')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('AW28')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('AX25')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('BB28')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('BH28')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('BX28')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('BX29')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('BQ28')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('BI25')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('CB29')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('CI28')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('D28')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('D29')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('T29')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('X28')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('X29')->getAlignment()->setWrapText(true);
//Стили
$objPHPExcel->getActiveSheet(0)->getStyle('A7:BX7')->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('A8:BN8')->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('A9:CE9')->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('A10:BN10')->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('A10:BN10')->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('A28:C29')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('AD26:AW26')->applyFromArray($style_bold);
$objPHPExcel->getActiveSheet(0)->getStyle('AH28:AL29')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('AM28:AV28')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('AC29:AG29')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('AM29:AQ29')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('AR29:AV29')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('AX25:BH25')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('AX26:BH26')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('AX26')->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('AW28:BA29')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BB28:BG29')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('B12')->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('B14')->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('B16')->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('B18')->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('BI26')->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('BI25:BS25')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BI26:BS26')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BX28:CH28')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BH28:BP29')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BQ28:BW29')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BW1')->applyFromArray($style8);
$objPHPExcel->getActiveSheet(0)->getStyle('BW2')->applyFromArray($style8);
$objPHPExcel->getActiveSheet(0)->getStyle('BW3')->applyFromArray($style8);
$objPHPExcel->getActiveSheet(0)->getStyle('BW23')->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('BL21')->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('BV6')->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('BX29:CA29')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BY7')->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('BY12')->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('BY14')->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('BY16')->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('BY17:CD18')->applyFromArray($style_border_right);
$objPHPExcel->getActiveSheet(0)->getStyle('BY19:CD20')->applyFromArray($style_border_right);
$objPHPExcel->getActiveSheet(0)->getStyle('BY21:CD21')->applyFromArray($style_border_right);
$objPHPExcel->getActiveSheet(0)->getStyle('BY22:CD22')->applyFromArray($style_border_right);
$objPHPExcel->getActiveSheet(0)->getStyle('BO10')->applyFromArray($style_right9);
$objPHPExcel->getActiveSheet(0)->getStyle('CF5:CQ5')->applyFromArray($style_black_border);
$objPHPExcel->getActiveSheet(0)->getStyle('CF6:CQ6')->applyFromArray($style_black_border);
$objPHPExcel->getActiveSheet(0)->getStyle('CF7:CQ7')->applyFromArray($style_black_border);
$objPHPExcel->getActiveSheet(0)->getStyle('CF8:CQ9')->applyFromArray($style_black_border);
$objPHPExcel->getActiveSheet(0)->getStyle('CF10:CQ11')->applyFromArray($style_black_border);
$objPHPExcel->getActiveSheet(0)->getStyle('CF12:CQ12')->applyFromArray($style_black_border);
$objPHPExcel->getActiveSheet(0)->getStyle('CF13:CQ14')->applyFromArray($style_black_border);
$objPHPExcel->getActiveSheet(0)->getStyle('CF15:CQ16')->applyFromArray($style_black_border);
$objPHPExcel->getActiveSheet(0)->getStyle('CF17:CQ18')->applyFromArray($style_black_border);
$objPHPExcel->getActiveSheet(0)->getStyle('CF19:CQ20')->applyFromArray($style_black_border);
$objPHPExcel->getActiveSheet(0)->getStyle('CF21:CQ21')->applyFromArray($style_black_border);
$objPHPExcel->getActiveSheet(0)->getStyle('CF22:CQ22')->applyFromArray($style_black_border);
$objPHPExcel->getActiveSheet(0)->getStyle('CF23:CQ23')->applyFromArray($style_black_border);
$objPHPExcel->getActiveSheet(0)->getStyle('CF6:CQ23')->applyFromArray($style_black_border);
$objPHPExcel->getActiveSheet(0)->getStyle('CI28:CQ29')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('D28:W28')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('D29:S29')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('CB29:CH29')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('I14')->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('L12')->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('L16')->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('L18')->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('L12:BX12')->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('L13:BX13')->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('I14:BX14')->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('L15:BX15')->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('I16:BX16')->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('L17:BX17')->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('L18:BX18')->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('L19:BX19')->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('T29:W29')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('X28:AG28')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('X29:AB29')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('A30:C30')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('D30:S30')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('T30:W30')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('X30:AB30')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('AC30:AG30')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('AH30:AL30')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('AM30:AQ30')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('AR30:AV30')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('AW30:BA30')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BB30:BG30')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BH30:BP30')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BQ30:BW30')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BX30:CA30')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('CB30:CH30')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('CI30:CQ30')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet()->getStyle('CF6:CQ23')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('CF6:CQ23')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('CF6:CQ23')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('CF6:CQ23')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('AX26:BS26')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('AX26:BS26')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('AX26:BS26')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('AX26:BS26')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
//Row width
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AP')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AQ')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AR')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AS')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AT')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AU')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AV')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AW')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AX')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AY')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('AZ')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BA')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BB')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BC')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BD')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BE')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BF')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BG')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BH')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BI')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BJ')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BK')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BL')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BM')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BN')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BO')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BP')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BQ')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BR')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BS')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BT')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BU')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BV')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BW')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BX')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BY')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('BZ')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('CA')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('CB')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('CC')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('CD')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('CE')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('CF')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('CG')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('CH')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('CI')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('CJ')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('CK')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('CL')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('CM')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('CN')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('CO')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('CP')->setWidth(1.5);
$objPHPExcel->getActiveSheet()->getColumnDimension('CQ')->setWidth(1.5);

//Row height
$objPHPExcel->getActiveSheet()->getRowDimension('6')->setRowHeight(18.2);
$objPHPExcel->getActiveSheet()->getRowDimension('7')->setRowHeight(18.2);
$objPHPExcel->getActiveSheet()->getRowDimension('8')->setRowHeight(9.1);
$objPHPExcel->getActiveSheet()->getRowDimension('9')->setRowHeight(9.1);
$objPHPExcel->getActiveSheet()->getRowDimension('10')->setRowHeight(9.1);
$objPHPExcel->getActiveSheet()->getRowDimension('11')->setRowHeight(9.1);
$objPHPExcel->getActiveSheet()->getRowDimension('12')->setRowHeight(18.2);
$objPHPExcel->getActiveSheet()->getRowDimension('13')->setRowHeight(8.2);
$objPHPExcel->getActiveSheet()->getRowDimension('14')->setRowHeight(10);
$objPHPExcel->getActiveSheet()->getRowDimension('15')->setRowHeight(8.2);
$objPHPExcel->getActiveSheet()->getRowDimension('16')->setRowHeight(10);
$objPHPExcel->getActiveSheet()->getRowDimension('17')->setRowHeight(8.2);
$objPHPExcel->getActiveSheet()->getRowDimension('18')->setRowHeight(10);
$objPHPExcel->getActiveSheet()->getRowDimension('19')->setRowHeight(9.1);
$objPHPExcel->getActiveSheet()->getRowDimension('20')->setRowHeight(9.1);
$objPHPExcel->getActiveSheet()->getRowDimension('21')->setRowHeight(18.2);
$objPHPExcel->getActiveSheet()->getRowDimension('22')->setRowHeight(18.2);
$objPHPExcel->getActiveSheet()->getRowDimension('23')->setRowHeight(18.2);
$objPHPExcel->getActiveSheet()->getRowDimension('25')->setRowHeight(25);
$objPHPExcel->getActiveSheet()->getRowDimension('28')->setRowHeight(25);
$objPHPExcel->getActiveSheet()->getRowDimension('29')->setRowHeight(35);

//Merge columns !!
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A7:BX7');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A8:BN8');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A9:CE9');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A10:BN10');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A28:C29');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AH28:AL29');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AM28:AV28');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AC29:AG29');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AM29:AQ29');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AR29:AV29');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AX25:BH25');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AX26:BH26');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AW28:BA29');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BB28:BG29');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BH28:BP29');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BQ28:BW29');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BI25:BS25');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BI26:BS26');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BO10:CD11');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BX28:CH28');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BX29:CA29');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BY17:CD18');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BY19:CD20');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BY21:CD21');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BY22:CD22');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CB29:CH29');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CF5:CQ5');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CF6:CQ6');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CF7:CQ7');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CF8:CQ9');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CF10:CQ11');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CF12:CQ12');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CF13:CQ14');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CF15:CQ16');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CF17:CQ18');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CF19:CQ20');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CF21:CQ21');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CF22:CQ22');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CF23:CQ23');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CI28:CQ29');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D28:W28');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D29:S29');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('L12:BX12');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('L13:BX13');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('I14:BX14');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('L15:BX15');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('L16:BX16');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('L17:BX17');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('L18:BX18');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('L19:BX19');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('T29:W29');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('X28:AG28');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('X29:AB29');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A30:C30');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D30:S30');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('T30:W30');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('X30:AB30');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AC30:AG30');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AH30:AL30');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AM30:AQ30');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AR30:AV30');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AW30:BA30');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BB30:BG30');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BH30:BP30');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BQ30:BW30');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BX30:CA30');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CB30:CH30');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CI30:CQ30');
// устанавливаем авто подбор высоты
$ActiveSheet = $objPHPExcel->getActiveSheet();    // ширина испытуемой ячейки

// задаём текст для дубликата
$ActiveSheet->setCellValue('ZA7', $DATA['shipper'])
	->setCellValue('ZB12', $DATA['consignee'])
	->setCellValue('ZC14', $DATA['provider'])
	->setCellValue('ZD16', $DATA['payer'])
	->setCellValue('ZE18', $DATA['base'])
	->setCellValue('ZF26', $DATA['document_code'])
	->setCellValue('ZG26', $DATA['doc_short_date']);
$objPHPExcel->getActiveSheet(0)->getStyle('ZA7')->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('ZB12')->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('ZC14')->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('ZD16')->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('ZE18')->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('ZF26')->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('ZG26')->applyFromArray($style_border_small);

// устанавливаем идентичную ширину дубликату и делаем невидимым
$ActiveSheet->getColumnDimension('ZA')->setWidth(109)->setVisible(false);
$ActiveSheet->getColumnDimension('ZB')->setWidth(93)->setVisible(false);
$ActiveSheet->getColumnDimension('ZC')->setWidth(97)->setVisible(false);
$ActiveSheet->getColumnDimension('ZD')->setWidth(97)->setVisible(false);
$ActiveSheet->getColumnDimension('ZE')->setWidth(97)->setVisible(false);
$ActiveSheet->getColumnDimension('ZF')->setWidth(97)->setVisible(false);
$ActiveSheet->getColumnDimension('ZG')->setWidth(15.8)->setVisible(false);

$objPHPExcel->getActiveSheet()->getStyle('A7')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('L12')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('I14')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('L16')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('L18')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('AX26')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('BI26')->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->getRowDimension(7)->setRowHeight(-1);
$objPHPExcel->getActiveSheet()->getRowDimension(12)->setRowHeight(-1);
$objPHPExcel->getActiveSheet()->getRowDimension(14)->setRowHeight(-1);
$objPHPExcel->getActiveSheet()->getRowDimension(16)->setRowHeight(-1);
$objPHPExcel->getActiveSheet()->getRowDimension(18)->setRowHeight(-1);
$objPHPExcel->getActiveSheet()->getRowDimension(26)->setRowHeight(-1);
// задаём авто перенос дубликату
$ActiveSheet->getStyle('ZA7')->getAlignment()->setWrapText(true);
$ActiveSheet->getStyle('ZB12')->getAlignment()->setWrapText(true);
$ActiveSheet->getStyle('ZC14')->getAlignment()->setWrapText(true);
$ActiveSheet->getStyle('ZD16')->getAlignment()->setWrapText(true);
$ActiveSheet->getStyle('ZE18')->getAlignment()->setWrapText(true);
$ActiveSheet->getStyle('ZF26')->getAlignment()->setWrapText(true);
$ActiveSheet->getStyle('ZG26')->getAlignment()->setWrapText(true);
$i = 30;
$k = $i + 1;

$sum_pieces = null;
$sum_gross_weight = null;
$sum_quantity_net_weight = null;
$sum_price = null;
$sum_amount_without_vat = null;
$sum_amount = null;
$sum_amount_including_vat = null;

foreach ($CONTENT as $key => $val) {

	$description = $val['dcc_name'];
	if ($val['pst_article_display'] != "") {
		$description .= ' ' . $val['pst_article_display'];
	} else {
		$description .= ' ' . $val['dcc_article'];
	}
	$description .= $val['dcc_brand'];

	if ($DATA['bsp_tax_rate'] > 0) {
		$val['price'] = $val['fdd_price_in_country'] / (1 + $DATA['bsp_tax_rate']/100);
		$val['amount_without_vat'] = $val['fdd_price_in_country'] * $val['dcc_amount'] / (1 + $DATA['bsp_tax_rate'] / 100);
		$val['amount'] = $val['fdd_price_in_country'] * $val['dcc_amount'] * $DATA['bsp_tax_rate'] / (100 + $DATA['bsp_tax_rate']);
	} else {
		$val['price'] = $val['fdd_price_in_country'];
		$val['amount_without_vat'] = $val['fdd_price_in_country'] * $val['dcc_amount'];
		$val['amount'] = '0.00';
	}

	$val['amount_including_vat'] = $val['fdd_price_in_country'] * $val['dcc_amount'];

	$i++;
	//$sum_pieces += $val['pieces'];
	$sum_gross_weight += $val['pos_sum_weight'];
	$sum_quantity_net_weight += $val['dcc_amount'];
	$sum_price += $val['price'];
	$sum_amount_without_vat += $val['amount_without_vat'];
	$sum_amount += $val['amount'];
	$sum_amount_including_vat += $val['amount_including_vat'];
	$objPHPExcel->getActiveSheet(0)->getStyle('A' . $i . ':C' . $i)->applyFromArray($style_border_small);
	$objPHPExcel->getActiveSheet(0)->getStyle('D' . $i . ':S' . $i)->applyFromArray($style_table_left);
	$objPHPExcel->getActiveSheet(0)->getStyle('T' . $i . ':W' . $i)->applyFromArray($style_table_right);
	$objPHPExcel->getActiveSheet(0)->getStyle('X' . $i . ':AB' . $i)->applyFromArray($style_table_left);
	$objPHPExcel->getActiveSheet(0)->getStyle('AC' . $i . ':AG' . $i)->applyFromArray($style_table_right);
	$objPHPExcel->getActiveSheet(0)->getStyle('AH' . $i . ':AL' . $i)->applyFromArray($style_table_left);
	$objPHPExcel->getActiveSheet(0)->getStyle('AM' . $i . ':AQ' . $i)->applyFromArray($style_table_right);
	$objPHPExcel->getActiveSheet(0)->getStyle('AR' . $i . ':AV' . $i)->applyFromArray($style_table_right);
	$objPHPExcel->getActiveSheet(0)->getStyle('AW' . $i . ':BA' . $i)->applyFromArray($style_table_right);
	$objPHPExcel->getActiveSheet(0)->getStyle('BB' . $i . ':BG' . $i)->applyFromArray($style_table_right);
	$objPHPExcel->getActiveSheet(0)->getStyle('BH' . $i . ':BP' . $i)->applyFromArray($style_table_right);
	$objPHPExcel->getActiveSheet(0)->getStyle('BQ' . $i . ':BW' . $i)->applyFromArray($style_table_right);
	$objPHPExcel->getActiveSheet(0)->getStyle('BX' . $i . ':CA' . $i)->applyFromArray($style_table_left);
	$objPHPExcel->getActiveSheet(0)->getStyle('CB' . $i . ':CH' . $i)->applyFromArray($style_table_right);
	$objPHPExcel->getActiveSheet(0)->getStyle('CI' . $i . ':CQ' . $i)->applyFromArray($style_table_right);
	// Add some data
	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A' . $i, $key + 1)
		->setCellValue('D' . $i, $description)
		->setCellValue('T' . $i, '')
		->setCellValue('X' . $i, $val['unt_name'])
		->setCellValue('AC' . $i, '796')
		->setCellValue('AH' . $i, '')
		->setCellValue('AM' . $i, '')
		->setCellValue('AR' . $i, '')
		->setCellValue('AW' . $i, $val['pos_sum_weight'] ? number_format($val['pos_sum_weight'], 2, ',', ' ') : '')
		->setCellValue('BB' . $i, $val['dcc_amount'] ? number_format($val['dcc_amount'], 3, ',', ' ') : '')
		->setCellValue('BH' . $i, $val['dcc_price'] ? number_format($val['dcc_price'], 2, ',', ' ') : '')
		->setCellValue('BQ' . $i, $val['amount_without_vat'] ? number_format($val['amount_without_vat'], 2, ',', ' ') : '')
		->setCellValue('BX' . $i, 'Без НДС')
		->setCellValue('CB' . $i, $val['amount'] ? number_format($val['amount'], 2, ',', ' ') : '')
		->setCellValue('CI' . $i, $val['amount_including_vat'] ? number_format($val['amount_including_vat'], 2, ',', ' ') : '');
	//Merge columns !!
	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A' . $i . ':C' . $i);
	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D' . $i . ':S' . $i);
	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('T' . $i . ':W' . $i);
	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('X' . $i . ':AB' . $i);
	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AC' . $i . ':AG' . $i);
	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AH' . $i . ':AL' . $i);
	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AM' . $i . ':AQ' . $i);
	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AR' . $i . ':AV' . $i);
	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AW' . $i . ':BA' . $i);
	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BB' . $i . ':BG' . $i);
	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BH' . $i . ':BP' . $i);
	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BQ' . $i . ':BW' . $i);
	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BX' . $i . ':CA' . $i);
	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CB' . $i . ':CH' . $i);
	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CI' . $i . ':CQ' . $i);
	$objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('D' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('T' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('X' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('AC' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('AH' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('AM' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('AR' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('AW' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('BB' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('BH' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('BQ' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('BX' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('CB' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('CI' . $i)->getAlignment()->setWrapText(true);

	// задаём текст для дубликата
	$ActiveSheet
		->setCellValue('YA' . $i, $key + 1)
		->setCellValue('YB' . $i, $description)
		->setCellValue('YC' . $i, '')
		->setCellValue('YD' . $i, $val['unt_name'])
		->setCellValue('YE' . $i, '796')
		->setCellValue('YF' . $i, '')
		->setCellValue('YG' . $i, '')
		->setCellValue('YH' . $i, '')
		->setCellValue('YI' . $i, $val['pos_sum_weight'] ? number_format($val['pos_sum_weight'], 2, ',', ' ') : '')
		->setCellValue('YJ' . $i, $val['dcc_amount'] ? number_format($val['dcc_amount'], 3, ',', ' ') : '')
		->setCellValue('YK' . $i, $val['dcc_price'] ? number_format($val['dcc_price'], 2, ',', ' ') : '')
		->setCellValue('YL' . $i, $val['amount_without_vat'] ? number_format($val['amount_without_vat'], 2, ',', ' ') : '')
		->setCellValue('YM' . $i, 'Без НДС')
		->setCellValue('YN' . $i, $val['amount'] ? number_format($val['amount'], 2, ',', ' ') : '')
		->setCellValue('YO' . $i, $val['amount_including_vat'] ? number_format($val['amount_including_vat'], 2, ',', ' ') : '');

	$objPHPExcel->getActiveSheet(0)->getStyle('YA' . $i)->applyFromArray($style_border_small);
	$objPHPExcel->getActiveSheet(0)->getStyle('YB' . $i)->applyFromArray($style_table_left);
	$objPHPExcel->getActiveSheet(0)->getStyle('YC' . $i)->applyFromArray($style_table_right);
	$objPHPExcel->getActiveSheet(0)->getStyle('YD' . $i)->applyFromArray($style_table_left);
	$objPHPExcel->getActiveSheet(0)->getStyle('YE' . $i)->applyFromArray($style_table_right);
	$objPHPExcel->getActiveSheet(0)->getStyle('YF' . $i)->applyFromArray($style_table_left);
	$objPHPExcel->getActiveSheet(0)->getStyle('YG' . $i)->applyFromArray($style_table_right);
	$objPHPExcel->getActiveSheet(0)->getStyle('YH' . $i)->applyFromArray($style_table_right);
	$objPHPExcel->getActiveSheet(0)->getStyle('YI' . $i)->applyFromArray($style_table_right);
	$objPHPExcel->getActiveSheet(0)->getStyle('YJ' . $i)->applyFromArray($style_table_right);
	$objPHPExcel->getActiveSheet(0)->getStyle('YK' . $i)->applyFromArray($style_table_right);
	$objPHPExcel->getActiveSheet(0)->getStyle('YL' . $i)->applyFromArray($style_table_right);
	$objPHPExcel->getActiveSheet(0)->getStyle('YM' . $i)->applyFromArray($style_table_left);
	$objPHPExcel->getActiveSheet(0)->getStyle('YN' . $i)->applyFromArray($style_table_right);
	$objPHPExcel->getActiveSheet(0)->getStyle('YO' . $i)->applyFromArray($style_table_right);

	// устанавливаем идентичную ширину дубликату и делаем невидимым
	$ActiveSheet->getColumnDimension('YA')->setWidth(4.2)->setVisible(false);
	$ActiveSheet->getColumnDimension('YB')->setWidth(23)->setVisible(false);
	$ActiveSheet->getColumnDimension('YC')->setWidth(6)->setVisible(false);
	$ActiveSheet->getColumnDimension('YD')->setWidth(7.1)->setVisible(false);
	$ActiveSheet->getColumnDimension('YE')->setWidth(7.1)->setVisible(false);
	$ActiveSheet->getColumnDimension('YF')->setWidth(7.1)->setVisible(false);
	$ActiveSheet->getColumnDimension('YG')->setWidth(7.1)->setVisible(false);
	$ActiveSheet->getColumnDimension('YH')->setWidth(7.1)->setVisible(false);
	$ActiveSheet->getColumnDimension('YI')->setWidth(7.1)->setVisible(false);
	$ActiveSheet->getColumnDimension('YJ')->setWidth(8.8)->setVisible(false);
	$ActiveSheet->getColumnDimension('YK')->setWidth(12.7)->setVisible(false);
	$ActiveSheet->getColumnDimension('YL')->setWidth(10)->setVisible(false);
	$ActiveSheet->getColumnDimension('YM')->setWidth(6)->setVisible(false);
	$ActiveSheet->getColumnDimension('YN')->setWidth(10)->setVisible(false);
	$ActiveSheet->getColumnDimension('YO')->setWidth(12.7)->setVisible(false);
	$objPHPExcel->getActiveSheet()->getStyle('A' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('D' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('T' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('X' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('AC' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('AH' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('AM' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('AR' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('AW' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('BB' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('BH' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('BQ' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('BX' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('CB' . $i)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('CI' . $i)->getAlignment()->setWrapText(true);

	$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(-1);
	// задаём авто перенос дубликату
	$ActiveSheet->getStyle('YA' . $i)->getAlignment()->setWrapText(true);
	$ActiveSheet->getStyle('YB' . $i)->getAlignment()->setWrapText(true);
	$ActiveSheet->getStyle('YC' . $i)->getAlignment()->setWrapText(true);
	$ActiveSheet->getStyle('YD' . $i)->getAlignment()->setWrapText(true);
	$ActiveSheet->getStyle('YE' . $i)->getAlignment()->setWrapText(true);
	$ActiveSheet->getStyle('YF' . $i)->getAlignment()->setWrapText(true);
	$ActiveSheet->getStyle('YG' . $i)->getAlignment()->setWrapText(true);
	$ActiveSheet->getStyle('YH' . $i)->getAlignment()->setWrapText(true);
	$ActiveSheet->getStyle('YI' . $i)->getAlignment()->setWrapText(true);
	$ActiveSheet->getStyle('YJ' . $i)->getAlignment()->setWrapText(true);
	$ActiveSheet->getStyle('YK' . $i)->getAlignment()->setWrapText(true);
	$ActiveSheet->getStyle('YL' . $i)->getAlignment()->setWrapText(true);
	$ActiveSheet->getStyle('YM' . $i)->getAlignment()->setWrapText(true);
	$ActiveSheet->getStyle('YN' . $i)->getAlignment()->setWrapText(true);
	$ActiveSheet->getStyle('YO' . $i)->getAlignment()->setWrapText(true);
}

$objPHPExcel->getActiveSheet()->getStyle('T' . $k . ':W' . $i)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('T' . $k . ':W' . $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('T' . $k . ':W' . $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('T' . $k . ':W' . $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('AC' . $k . ':BW' . $i)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('AC' . $k . ':BW' . $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('AC' . $k . ':BW' . $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('AC' . $k . ':BW' . $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('CB' . $k . ':CQ' . $i)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('CB' . $k . ':CQ' . $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('CB' . $k . ':CQ' . $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('CB' . $k . ':CQ' . $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);

$i++;
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('AM' . $i, 'Итого')
	->setCellValue('AR' . $i, $sum_pieces ? number_format($sum_pieces, 2, ',', ' ') : '')
	->setCellValue('AW' . $i, $sum_gross_weight ? number_format($sum_gross_weight, 2, ',', ' ') : '')
	->setCellValue('BB' . $i, $sum_quantity_net_weight ? number_format($sum_quantity_net_weight, 3, ',', ' ') : '')
	->setCellValue('BH' . $i, 'X')
	->setCellValue('BQ' . $i, $sum_amount_without_vat ? number_format($sum_amount_without_vat, 2, ',', ' ') : '')
	->setCellValue('BX' . $i, 'X')
	->setCellValue('CB' . $i, 'X')
	->setCellValue('CI' . $i, $sum_amount_including_vat ? number_format($sum_amount_including_vat, 2, ',', ' ') : '');
$objPHPExcel->getActiveSheet(0)->getStyle('AM' . $i . ':AQ' . $i)->applyFromArray($style_right);
$objPHPExcel->getActiveSheet(0)->getStyle('AR' . $i . ':AV' . $i)->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('AW' . $i . ':BA' . $i)->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BB' . $i . ':BG' . $i)->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BH' . $i . ':BP' . $i)->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BQ' . $i . ':BW' . $i)->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BX' . $i . ':CA' . $i)->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('CB' . $i . ':CH' . $i)->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('CI' . $i . ':CQ' . $i)->applyFromArray($style_border_small);

$objPHPExcel->getActiveSheet()->getStyle('A1:CQ' . $i)->applyFromArray($border_style_bottom_dashed);

//Merge columns !!
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AM' . $i . ':AQ' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AR' . $i . ':AV' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AW' . $i . ':BA' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BB' . $i . ':BG' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BH' . $i . ':BP' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BQ' . $i . ':BW' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BX' . $i . ':CA' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CB' . $i . ':CH' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CI' . $i . ':CQ' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A' . $i . ':C' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D' . $i . ':S' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('T' . $i . ':W' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('X' . $i . ':AB' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AC' . $i . ':AG' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AH' . $i . ':AL' . $i);
$i++;
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('AH' . $i, 'Всего по накладной')
	->setCellValue('AR' . $i, $sum_pieces ? number_format($sum_pieces, 2, ',', ' ') : '')
	->setCellValue('AW' . $i, $sum_gross_weight ? number_format($sum_gross_weight, 2, ',', ' ') : '')
	->setCellValue('BB' . $i, $sum_quantity_net_weight ? number_format($sum_quantity_net_weight, 3, ',', ' ') : '')
	->setCellValue('BH' . $i, 'X')
	->setCellValue('BQ' . $i, $sum_amount_without_vat ? number_format($sum_amount_without_vat, 2, ',', ' ') : '')
	->setCellValue('BX' . $i, 'X')
	->setCellValue('CB' . $i, 'X')
	->setCellValue('CI' . $i, $sum_amount_including_vat ? number_format($sum_amount_including_vat, 2, ',', ' ') : '');
$objPHPExcel->getActiveSheet(0)->getStyle('AH' . $i . ':AQ' . $i)->applyFromArray($style_right);
$objPHPExcel->getActiveSheet(0)->getStyle('AR' . $i . ':AV' . $i)->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('AW' . $i . ':BA' . $i)->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BB' . $i . ':BG' . $i)->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BH' . $i . ':BP' . $i)->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BQ' . $i . ':BW' . $i)->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BX' . $i . ':CA' . $i)->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('CB' . $i . ':CH' . $i)->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet(0)->getStyle('CI' . $i . ':CQ' . $i)->applyFromArray($style_border_small);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AH' . $i . ':AQ' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AR' . $i . ':AV' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AW' . $i . ':BA' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BB' . $i . ':BG' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BH' . $i . ':BP' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BQ' . $i . ':BW' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BX' . $i . ':CA' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CB' . $i . ':CH' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CI' . $i . ':CQ' . $i);

$i++;
$j = $i;
$i = $i + 2;
$i = $j;

$i++;
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('D' . $i, 'Товарная накладная имеет приложение на')
	->setCellValue('BO' . $i, 'листах');
$objPHPExcel->getActiveSheet(0)->getStyle('D' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('BO' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('Y' . $i . ':BN' . $i)->applyFromArray($style_bottom);

$i++;

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('BO' . $i, 'порядковых номеров записей')
	->setCellValue('D' . $i, 'и содержит')
	->setCellValue('K' . $i, $DATA['positions_text']);
$objPHPExcel->getActiveSheet(0)->getStyle('BO' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('D' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('BO' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('K' . $i . ':BN' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(18.2);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('K' . $i . ':BN' . $i);
// задаём текст для дубликата
$ActiveSheet->setCellValue('ZH' . $i, $DATA['positions_text']);
$objPHPExcel->getActiveSheet(0)->getStyle('ZH' . $i)->applyFromArray($style_bottom);
// устанавливаем идентичную ширину дубликату и делаем невидимым
$ActiveSheet->getColumnDimension('ZH')->setWidth(80)->setVisible(false);
$objPHPExcel->getActiveSheet()->getStyle('K' . $i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(-1);
// задаём авто перенос дубликату
$ActiveSheet->getStyle('ZH' . $i)->getAlignment()->setWrapText(true);
$i++;

// Add some data
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K' . $i, '(прописью)');
$objPHPExcel->getActiveSheet(0)->getStyle('K' . $i . ':BN' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(9.1);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('K' . $i . ':BN' . $i);

$i++;

$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(9.1);

$j = $i;
$i = $i + 2;
$i = $j;

$i++;
$n = $i;
// Add some data
$objPHPExcel->getActiveSheet(0)->getStyle('CA' . $i . ':CQ' . ($i + 1))->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(9.1);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CA' . $i . ':CQ' . ($i + 1));
$i++;
// Add some data
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC' . $i, 'Масса груза (нетто)')
	->setCellValue('AN' . $i, $DATA['doc_sum_weight_text']);
$objPHPExcel->getActiveSheet(0)->getStyle('AC' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('AN' . $i . ':BY' . $i)->applyFromArray($style_bottom);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AN' . $i . ':BY' . $i);

// задаём текст для дубликата
$ActiveSheet->setCellValue('ZG' . $i, $DATA['doc_sum_weight_text']);
$objPHPExcel->getActiveSheet(0)->getStyle('ZG' . $i)->applyFromArray($style_bottom);
// устанавливаем идентичную ширину дубликату и делаем невидимым
$ActiveSheet->getColumnDimension('ZG')->setWidth(54)->setVisible(false);
$objPHPExcel->getActiveSheet()->getStyle('AN' . $i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(-1);
// задаём авто перенос дубликату
$ActiveSheet->getStyle('ZG' . $i)->getAlignment()->setWrapText(true);
$i++;

// Add some data
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AN' . $i, '(прописью)');
$objPHPExcel->getActiveSheet(0)->getStyle('AN' . $i . ':BY' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('CA' . $i . ':CQ' . ($i + 1))->applyFromArray($style_border_small);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(9.1);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AN' . $i . ':BY' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CA' . $i . ':CQ' . ($i + 1));

$i++;
// Add some data
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC' . $i, 'Масса груза (брутто)')->setCellValue('AN' . $i, '')
	->setCellValue('K' . $i, $DATA['places_text'])
	->setCellValue('D' . $i, 'Всего мест');
$objPHPExcel->getActiveSheet(0)->getStyle('AC' . $i . ':AL' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('D' . $i . ':I' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('AN' . $i . ':BY' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('K' . $i . ':AA' . $i)->applyFromArray($style_bottom);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AN' . $i . ':BY' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('K' . $i . ':AA' . $i);
$objPHPExcel->getActiveSheet()->getStyle('CA' . $n . ':CQ' . $i)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('CA' . $n . ':CQ' . $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('CA' . $n . ':CQ' . $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
$objPHPExcel->getActiveSheet()->getStyle('CA' . $n . ':CQ' . $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);

// задаём текст для дубликата
$ActiveSheet->setCellValue('ZK' . $i, $DATA['places_text'])
	->setCellValue('ZI' . $i, '');
$objPHPExcel->getActiveSheet(0)->getStyle('ZK' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('ZI' . $i)->applyFromArray($style_bottom);
// устанавливаем идентичную ширину дубликату и делаем невидимым
$ActiveSheet->getColumnDimension('ZK')->setWidth(24.5)->setVisible(false);
$ActiveSheet->getColumnDimension('ZI')->setWidth(54)->setVisible(false);
$objPHPExcel->getActiveSheet()->getStyle('K' . $i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('AN' . $i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(-1);
// задаём авто перенос дубликату
$ActiveSheet->getStyle('ZK' . $i)->getAlignment()->setWrapText(true);
$ActiveSheet->getStyle('ZI' . $i)->getAlignment()->setWrapText(true);

$i++;

// Add some data
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AN' . $i, '(прописью)')
	->setCellValue('K' . $i, '(прописью)');
$objPHPExcel->getActiveSheet(0)->getStyle('AN' . $i . ':BY' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('K' . $i . ':AA' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(9.1);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AN' . $i . ':BY' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('K' . $i . ':AA' . $i);

$i++;

$j = $i;
$i = $i + 2;
$i = $j;
$i++;

// Add some data
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $i, 'Приложение (паспорта, сертификаты и т.п.) на')
	->setCellValue('AR' . $i, 'листах')
	->setCellValue('AX' . $i, 'По доверенности №')
	->setCellValue('BW' . $i, 'от «')
	->setCellValue('CA' . $i, '»')
	->setCellValue('CO' . $i, 'года,')
	->setCellValue('BH' . $i, '')
	->setCellValue('BY' . $i, '');

$objPHPExcel->getActiveSheet(0)->getStyle('A' . $i . ':W' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('AR' . $i . ':AV' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('AX' . $i . ':BF' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('AW' . $i . ':AW' . ($i + 13))->applyFromArray($style_vertical_line);
$objPHPExcel->getActiveSheet(0)->getStyle('BH' . $i . ':BU' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('BW' . $i . ':BX' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('CA' . $i . ':CB' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('CC' . $i . ':CJ' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('CL' . $i . ':CN' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('CO' . $i . ':CQ' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('X' . $i . ':AQ' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('BY' . $i . ':BZ' . $i)->applyFromArray($style_bottom);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BH' . $i . ':BU' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BY' . $i . ':BZ' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CC' . $i . ':CJ' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CL' . $i . ':CN' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('X' . $i . ':AQ' . $i);
// задаём текст для дубликата
$ActiveSheet->setCellValue('ZL' . $i, '')
	->setCellValue('ZM' . $i, '');
$objPHPExcel->getActiveSheet(0)->getStyle('ZL' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('ZM' . $i)->applyFromArray($style_bottom);
// устанавливаем идентичную ширину дубликату и делаем невидимым
$ActiveSheet->getColumnDimension('ZL')->setWidth(20)->setVisible(false);
$ActiveSheet->getColumnDimension('ZM')->setWidth(2.8)->setVisible(false);
$objPHPExcel->getActiveSheet()->getStyle('BH' . $i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('BY' . $i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(-1);
// задаём авто перенос дубликату
$ActiveSheet->getStyle('ZL' . $i)->getAlignment()->setWrapText(true);
$ActiveSheet->getStyle('ZM' . $i)->getAlignment()->setWrapText(true);
$i++;
// Add some data
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V' . $i, '(прописью)');
$objPHPExcel->getActiveSheet(0)->getStyle('V' . $i . ':Z' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(9.1);

$i++;
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A' . $i, 'Всего отпущено на сумму')
	->setCellValue('N' . $i, $DATA['invoice_summ_text'])
	->setCellValue('BD' . $i, '')
	->setCellValue('AX' . $i, 'выданной');
$objPHPExcel->getActiveSheet(0)->getStyle('A' . $i . ':M' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('AX' . $i . ':BB' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('BD' . $i . ':CQ' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('N' . $i . ':AS' . $i)->applyFromArray($style_bottom);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BD' . $i . ':CQ' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('N' . $i . ':AS' . $i);
// задаём текст для дубликата
$ActiveSheet->setCellValue('ZN' . $i, '')
	->setCellValue('ZJ' . $i, $DATA['invoice_summ_text']);
$objPHPExcel->getActiveSheet(0)->getStyle('ZN' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('ZJ' . $i)->applyFromArray($style_bottom);
// устанавливаем идентичную ширину дубликату и делаем невидимым
$ActiveSheet->getColumnDimension('ZN')->setWidth(57.5)->setVisible(false);
$ActiveSheet->getColumnDimension('ZJ')->setWidth(46)->setVisible(false);
$objPHPExcel->getActiveSheet()->getStyle('BD' . $i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('N' . $i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(-1);
// задаём авто перенос дубликату
$ActiveSheet->getStyle('ZN' . $i)->getAlignment()->setWrapText(true);
$ActiveSheet->getStyle('ZJ' . $i)->getAlignment()->setWrapText(true);
$i++;
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('N' . $i, '(прописью)')
	->setCellValue('BD' . $i, '(кем, кому (организация, должность, фамилия, и., о.))');
$objPHPExcel->getActiveSheet(0)->getStyle('BD' . $i . ':CQ' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('N' . $i . ':AS' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(9.1);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BD' . $i . ':CQ' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('N' . $i . ':AS' . $i);

$i++;
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('AJ' . $i, 'руб.')
	->setCellValue('AT' . $i, 'коп.');
$objPHPExcel->getActiveSheet(0)->getStyle('A' . $i . ':AI' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('AM' . $i . ':AS' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('AJ' . $i . ':AL' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('AT' . $i . ':AV' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('AX' . $i . ':CQ' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(18.2);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A' . $i . ':AI' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AM' . $i . ':AS' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AJ' . $i . ':AL' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AT' . $i . ':AV' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AX' . $i . ':CQ' . $i);

$i++;
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(9.1);

$j = $i;
$i = $i + 2;
$i = $j;
$i++;
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A' . $i, 'Отпуск груза разрешил')
	->setCellValue('L' . $i, '');
$objPHPExcel->getActiveSheet(0)->getStyle('A' . $i . ':K' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('AG' . $i . ':AU' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('AX' . $i . ':CQ' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('L' . $i . ':T' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('V' . $i . ':AE' . $i)->applyFromArray($style_bottom);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A' . $i . ':K' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AG' . $i . ':AU' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AX' . $i . ':CQ' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('L' . $i . ':T' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('V' . $i . ':AE' . $i);
// задаём текст для дубликата
$ActiveSheet->setCellValue('ZP' . $i, '');
$objPHPExcel->getActiveSheet(0)->getStyle('ZP' . $i)->applyFromArray($style_bottom);
// устанавливаем идентичную ширину дубликату и делаем невидимым
$ActiveSheet->getColumnDimension('ZP')->setWidth(12.8)->setVisible(false);
$objPHPExcel->getActiveSheet()->getStyle('L' . $i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(-1);
// задаём авто перенос дубликату
$ActiveSheet->getStyle('ZP' . $i)->getAlignment()->setWrapText(true);
$i++;
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('L' . $i, '(должность)')
	->setCellValue('V' . $i, '(подпись)')
	->setCellValue('AG' . $i, '(расшифровка подписи)');
$objPHPExcel->getActiveSheet(0)->getStyle('L' . $i . ':T' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('V' . $i . ':AE' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('AG' . $i . ':AU' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(9.1);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('L' . $i . ':T' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('V' . $i . ':AE' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AG' . $i . ':AU' . $i);

$i++;

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A' . $i, 'Главный (старший) бухгалтер')
	->setCellValue('AX' . $i, 'Груз принял')
	->setCellValue('BE' . $i, '')
	->setCellValue('P' . $i, '');
$objPHPExcel->getActiveSheet(0)->getStyle('A' . $i . ':O' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('AX' . $i . ':BC' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('P' . $i . ':U' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('AG' . $i . ':AU' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('V' . $i . ':AE' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('BE' . $i . ':BM' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('BO' . $i . ':BW' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('BY' . $i . ':CQ' . $i)->applyFromArray($style_bottom);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A' . $i . ':O' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('V' . $i . ':AE' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AG' . $i . ':AU' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BE' . $i . ':BM' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BO' . $i . ':BW' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BY' . $i . ':CQ' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('P' . $i . ':U' . $i);

// задаём текст для дубликата
$ActiveSheet->setCellValue('ZQ' . $i, '')
	->setCellValue('ZP' . $i, '');
$objPHPExcel->getActiveSheet(0)->getStyle('ZQ' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('ZP' . $i)->applyFromArray($style_middle);
// устанавливаем идентичную ширину дубликату и делаем невидимым
$ActiveSheet->getColumnDimension('ZQ')->setWidth(12.8)->setVisible(false);
$ActiveSheet->getColumnDimension('ZP')->setWidth(8.7)->setVisible(false);
$objPHPExcel->getActiveSheet()->getStyle('BE' . $i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('P' . $i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(-1);
// задаём авто перенос дубликату
$ActiveSheet->getStyle('ZQ' . $i)->getAlignment()->setWrapText(true);
$ActiveSheet->getStyle('ZP' . $i)->getAlignment()->setWrapText(true);

$i++;
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('V' . $i, '(подпись)')
	->setCellValue('AG' . $i, '(расшифровка подписи)')
	->setCellValue('BE' . $i, '(должность)')
	->setCellValue('BO' . $i, '(подпись)')
	->setCellValue('BY' . $i, '(расшифровка подписи)');
$objPHPExcel->getActiveSheet(0)->getStyle('V' . $i . ':AE' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('AG' . $i . ':AU' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BE' . $i . ':BM' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BO' . $i . ':BW' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BY' . $i . ':CQ' . $i)->applyFromArray($style_small);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('V' . $i . ':AE' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AG' . $i . ':AU' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BE' . $i . ':BM' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BO' . $i . ':BW' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BY' . $i . ':CQ' . $i);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(9.1);

$i++;

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A' . $i, 'Отпуск груза произвел')
	->setCellValue('AX' . $i, 'Груз получил грузополучатель')
	->setCellValue('L' . $i, '')
	->setCellValue('BN' . $i, '');
$objPHPExcel->getActiveSheet(0)->getStyle('A' . $i . ':K' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('AG' . $i . ':AU' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('AX' . $i . ':BG' . $i)->applyFromArray($style_middle);
$objPHPExcel->getActiveSheet(0)->getStyle('L' . $i . ':T' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('V' . $i . ':AE' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('BN' . $i . ':BW' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('BY' . $i . ':CD' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('CF' . $i . ':CQ' . $i)->applyFromArray($style_bottom);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A' . $i . ':K' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AG' . $i . ':AU' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('L' . $i . ':T' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('V' . $i . ':AE' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BN' . $i . ':BW' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BY' . $i . ':CD' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CF' . $i . ':CQ' . $i);
// задаём текст для дубликата
$ActiveSheet->setCellValue('ZO' . $i, '')
	->setCellValue('ZR' . $i, '');
$objPHPExcel->getActiveSheet(0)->getStyle('ZO' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('ZR' . $i)->applyFromArray($style_bottom);
// устанавливаем идентичную ширину дубликату и делаем невидимым
$ActiveSheet->getColumnDimension('ZO')->setWidth(12.8)->setVisible(false);
$ActiveSheet->getColumnDimension('ZR')->setWidth(14.5)->setVisible(false);
$objPHPExcel->getActiveSheet()->getStyle('L' . $i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('BN' . $i)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(-1);
// задаём авто перенос дубликату
$ActiveSheet->getStyle('ZO' . $i)->getAlignment()->setWrapText(true);
$ActiveSheet->getStyle('ZR' . $i)->getAlignment()->setWrapText(true);
$i++;

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('L' . $i, '(должность)')
	->setCellValue('V' . $i, '(подпись)')
	->setCellValue('AG' . $i, '(расшифровка подписи)')
	->setCellValue('BN' . $i, '(должность)')
	->setCellValue('BY' . $i, '(подпись)')
	->setCellValue('CF' . $i, '(расшифровка подписи)');
$objPHPExcel->getActiveSheet(0)->getStyle('L' . $i . ':T' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('V' . $i . ':AE' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('AG' . $i . ':AU' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('V' . $i . ':AE' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BN' . $i . ':BW' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BY' . $i . ':CD' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('CF' . $i . ':CQ' . $i)->applyFromArray($style_small);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('L' . $i . ':T' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('V' . $i . ':AE' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AG' . $i . ':AU' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BN' . $i . ':BW' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BY' . $i . ':CD' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('CF' . $i . ':CQ' . $i);
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(9.1);

$i++;
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(9.1);

$j = $i;
$i = $i + 2;
$i = $j;
$i++;
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('G' . $i, 'М.П.')
	->setCellValue('M' . $i, '«')
	->setCellValue('P' . $i, '»')
	->setCellValue('AX' . $i, 'М.П.')
	->setCellValue('AD' . $i, 'года')
	->setCellValue('BU' . $i, 'года')
	->setCellValue('BD' . $i, '«')
	->setCellValue('BG' . $i, '»');
$objPHPExcel->getActiveSheet(0)->getStyle('G' . $i . ':I' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('AA' . $i . ':AC' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('AX' . $i . ':AZ' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('AD' . $i . ':AF' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BU' . $i . ':BW' . $i)->applyFromArray($style_small);
$objPHPExcel->getActiveSheet(0)->getStyle('BE' . $i . ':BF' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('BI' . $i . ':BP' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('BR' . $i . ':BT' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('N' . $i . ':O' . $i)->applyFromArray($style_bottom);
$objPHPExcel->getActiveSheet(0)->getStyle('R' . $i . ':Y' . $i)->applyFromArray($style_bottom);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G' . $i . ':I' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('N' . $i . ':O' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('R' . $i . ':Y' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AA' . $i . ':AC' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AX' . $i . ':AZ' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AD' . $i . ':AF' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BE' . $i . ':BF' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BI' . $i . ':BP' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BR' . $i . ':BT' . $i);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('BU' . $i . ':BW' . $i);
$i++;
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(3);

$objPHPExcel->getActiveSheet()->getStyle('A1:CQ' . $i)->applyFromArray($border_style_right);
$objPHPExcel->getActiveSheet()->getStyle('A1:CQ' . $i)->applyFromArray($border_style_left);
$objPHPExcel->getActiveSheet()->getStyle('A1:CQ' . $i)->applyFromArray($border_style_bottom);
$objPHPExcel->getActiveSheet()->getStyle('A1:CQ' . $i)->applyFromArray($border_style_top);

$i++;

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Торг12');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

return $objPHPExcel;
