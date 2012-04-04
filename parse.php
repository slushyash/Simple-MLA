<?php
require_once('MLADoc.php');
$lastName = $_POST['lastName'];
$firstName = $_POST['firstName'];
$courseName = $_POST['courseName'];
$title = $_POST['title'];
$teacherName = $_POST['teacherName'];
$essay = $_POST['essay'];
$essay = str_replace("\t", "", $essay);
$paragraphs = explode("\n", $essay);

$pdf = new MLADoc($lastName, $firstName, $courseName, $title, $teacherName);
foreach($paragraphs as $paragraph) {
	$pdf->newParagraph($paragraph);
}

$pdf->Output();
