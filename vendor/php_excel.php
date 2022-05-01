<?php

session_start();
require_once 'connect.php';
// •	Инвентарный номер
// •	Наименование оборудования
// •	Сотрудник
// •	Дата выдачи


// Подключаем класс для работы с excel
require_once('Classes/PHPExcel.php');
// Подключаем класс для вывода данных в формате excel


// Создаем объект класса PHPExcel
$xls = new PHPExcel();
// Устанавливаем индекс активного листа
$xls->setActiveSheetIndex(0);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('Отчет');

// Вставляем текст в ячейку A1
$sheet->setCellValue("A1", 'Отчет');
$sheet->getStyle('A1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID
);
$sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('EEEEEE');

// Объединяем ячейки
$sheet->mergeCells('A1:H1');

$sheet->setCellValue("A2", 'Инвентарный номер');
$sheet->getStyle('A2')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID
);
$sheet->getStyle('A2')->getFill()->getStartColor()->setRGB('EEEEEE');

$sheet->setCellValue("B2", 'Наименование оборудования');
$sheet->getStyle('B2')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID
);
$sheet->getStyle('B2')->getFill()->getStartColor()->setRGB('EEEEEE');

$sheet->setCellValue("C2", 'Сотрудник');
$sheet->getStyle('C2')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID
);
$sheet->getStyle('C2')->getFill()->getStartColor()->setRGB('EEEEEE');

$sheet->setCellValue("D2", 'Дата выдачи');
$sheet->getStyle('D2')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID
);
$sheet->getStyle('D2')->getFill()->getStartColor()->setRGB('EEEEEE');



// Выравнивание текста
$sheet->getStyle('A1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER
);

for ($i = 2; $i < 10; $i++) {
    for ($j = 2; $j < 10; $j++) {
        // Выводим таблицу умножения
        $sheet->setCellValueByColumnAndRow(
            $i - 2,
            $j,
            $i . "x" . $j . "=" . ($i * $j)
        );
        // Применяем выравнивание
        $sheet->getStyleByColumnAndRow($i - 2, $j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    }
}

header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment; filename=file.xlsx");

$objWriter = new PHPExcel_Writer_Excel2007($xls);
$objWriter->save(__DIR__ . '/file.xlsx');
exit();

$file = 'file.xlsx';
readfile($file);
