<?php
//include '../core/PHPExcel.php';
class Model_Export extends Model{
    function clean_str($str){
		return trim(strip_tags($str));
	}
	
	function get_all_surveys(){
		if(isset($_SESSION['user_id'])){
			$id=$_SESSION['user_id'];
			$query="SELECT id,name FROM surveys WHERE user_id = '$id'";
			$this->connect();
			$surveys = $this->get_dataAr($query);
			// здесь дальше будем вытягивать инфу о каждом опросе
			return $surveys;
		}
		return null;
	}
	function get_survey($id){
		if(isset($_SESSION['user_id'])){
			//$id=$id;
			//$query="SELECT `id`, `text_answer`, `position_answ`, `select_count`, `id_question` FROM `answers` WHERE `id_question` = ".$id." ";
			$query="SELECT `id`, `id_survey`, `text_quest` FROM `questions` WHERE `id_survey`= ".$id." ";
			$this->connect();
			$sur = $this->get_dataAr($query);
			$survey['question'] = $sur[0]['text_quest'];
			$query="SELECT `id`, `text_answer`, `position_answ`, `select_count`, `id_question` FROM `answers` WHERE `id_question` = ".$sur[0]['id']." ";
			$sur = $this->get_dataAr($query);
			$survey['answers'] = $sur;
			

$objPHPExcel = new PHPEXcel();
$objPHPExcel->setActiveSheetIndex(0);

$active_sheet = $objPHPExcel->getActiveSheet();

$active_sheet->getPageSetup()
			->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
			
$active_sheet->getPageSetup()
			->SetPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
			
$active_sheet->getPageMargins()->setTop(1);
$active_sheet->getPageMargins()->setRight(0.75);
$active_sheet->getPageMargins()->setLeft(0.75);
$active_sheet->getPageMargins()->setBottom(1);
//Задаем имя для листа(у нас это вопрос)
//$active_sheet->setTitle($survey['question']);	//ругалось на большую длину тайтла
// Задаем шрифт и размер
$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(12);	

/**
**
**/

// устанавливаем ширину колонок A, B, C (номер по порядку, ответ, кол-во)
$active_sheet->getColumnDimension('A')->setWidth(3);
$active_sheet->getColumnDimension('B')->setWidth(50);
$active_sheet->getColumnDimension('C')->setWidth(6);
// Объединяем ячейки заголовка
$active_sheet->mergeCells('A1:C1');
// Записываем в заголовок "вопрос"
$active_sheet->setCellValue('A1', $this->clean_str($survey['question']));
//Создаем шапку для таблицы
$active_sheet->setCellValue('A2', '#');
$active_sheet->setCellValue('B2', 'ANSWERS');
$active_sheet->setCellValue('C2', 'QTY');

$start_row = 3;
$i = 0;
$total = 0;
foreach($survey['answers'] as $answer){
	$next_row = $start_row + $i;
	$active_sheet->setCellValue('A'.$next_row, $i + 1);
	$active_sheet->setCellValue('B'.$next_row, $this->clean_str($answer['text_answer']));
	$active_sheet->setCellValue('C'.$next_row, $answer['select_count']);	
	$total += $answer['select_count'];
	$i++;	
}

	$active_sheet->setCellValue('A'.($i + 3), 'TOTAL');
	$active_sheet->setCellValue('C'.($i + 3), $total);
	//$active_sheet->setCellValue('C'.($i + 1), $count);
	$active_sheet->mergeCells('A'.($i + 3).':B'.($i + 3));	

// бордер для всей таблицы
$style_borders = array(
	'borders'=>array(
		'outline'=>array(
			'style'=>PHPExcel_Style_Border::BORDER_THICK
		),
		'allborders'=>array(
			'style'=>PHPExcel_Style_Border::BORDER_THIN,
			'color'=>array(
				'rgb'=> '696969'
			)
		)
	)

);

// стиль для ячейки с вопросом
$style_question = array(
	'font'=>array(
		'bold'=> true,
		'name'=> 'Times New Roman',
		'size'=>12
	),
	'alignment'=>array(
		'horizontal'=> PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER
	),
	'fill'=>array(
		'type'=>PHPExcel_STYLE_FILL::FILL_SOLID,
		'color'=>array(
			'rgb'=>'CFCFCF'
		)
	)

);

// стиль для ячейки содержащей заголовок таблицы
$style_header_table = array(
	'borders'=>array(
		'allborders'=>array(
			'style'=>PHPExcel_Style_Border::BORDER_THICK,
			'color'=>array(
				'rgb'=>'000000'
			)
		)
	),
	'font'=>array(
		'bold'=> true,
		'size'=>10
	),
	'alignment'=>array(
		'horizontal'=> PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER
	),

);

// стиль для ячейки TOTAL
$style_footer_table = array(
	'font'=>array(
		'bold'=> true,
		'size'=>10
	),
	'fill'=>array(
		'type'=>PHPExcel_STYLE_FILL::FILL_SOLID,
		'color'=>array(
			'rgb'=>'CFCFCF'
		)
	)

);

$active_sheet->getStyle('A1:C'.($i + 3))->applyFromArray($style_borders);
$active_sheet->getStyle('A1:C1')->applyFromArray($style_question);
$active_sheet->getStyle('A2:C2')->applyFromArray($style_header_table);
$active_sheet->getStyle('A'.($i + 3).':C'.($i + 3))->applyFromArray($style_footer_table);

header("Content-Type:application/vnd.ms-excel");
header("Content-Disposition:attachment;filename='simple.xls'");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit();



			// здесь дальше будем вытягивать инфу о каждом опросе
			//return $survey;
		}
		return null;
	}
}