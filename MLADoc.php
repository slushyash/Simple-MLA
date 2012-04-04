<?php
require('fpdf.php');
class MLADoc extends FPDF {
	public $lastName;
	public $firstName;
	public $courseName;
	public $addlCourseInfo;
	public $date;
	public $title;
	public $teacherName;
	function __construct($lastName, $firstName, $courseName, $title, $teacherName, $date = null) {
		parent::__construct('P', 'in', 'Letter');
		$this->SetMargins(1, .5);
		$this->SetFont('Times','',12);
		$this->lastName = $lastName;
		$this->firstName = $firstName;
		$this->date = $date == null ? date('j F Y') : date('j F Y', strtotime($date));
		$this->title = $title;
		$this->teacherName = $teacherName;
		$this->courseName = $courseName;
		$this->AddPage();
	}
	function Header() {
		$this->MultiCell(0,1/6, $this->lastName . " " . $this->pageNo(), 0, 'R');
		// header started at half an inch. we move half an inch down minus the height of the font
		$this->Ln(.5-(1/6));
		if($this->pageNo() == 1) {
			// width to end of page, 1/6 height, print Aggarwal Yash, no border, pos to right after call (ovverriden by Ln() anyways), align left, no fill
			$this->Cell(0, 1/6, $this->firstName . " " . $this->lastName, 0, 1, 'L', false); // don't know why I have to put pos to next line..
			$this->Ln();
			$this->Cell(0, 1/6, $this->teacherName , 0, 1, 'L', false);
			$this->Ln();
			$this->Cell(0, 1/6, $this->courseName , 0, 1, 'L', false);
			$this->Ln();
			$this->Cell(0, 1/6, $this->date , 0, 1, 'L', false);
			$this->Ln();
			$this->MultiCell(0, 1/6, $this->title , 0, 'C', false);
			$this->Ln((1/6) - (1/12));
		}
	}
	
	function newParagraph($text, $border = 0) { // border is for debugging
		$paragraphMargin = "            "; //about 1/2 an inch using Times. hacky
		$lineHeight = 2;
		$this->MultiCell(0, 1/6 * $lineHeight, $paragraphMargin . $text, $border, 'L');
	}
	
	function Ln($height = null) {
		if($height === null) {
			parent::Ln(1/6); // size of 12 pt font
		}
		
		else { parent::Ln($height); }
	}
}
