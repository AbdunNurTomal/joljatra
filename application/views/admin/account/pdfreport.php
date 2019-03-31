<?php
$month_name='';
if($month==1){$month_name='January';}
if($month==2){$month_name='February';}
if($month==3){$month_name='March';}
if($month==4){$month_name='April';}
if($month==5){$month_name='May';}
if($month==6){$month_name='June';}
if($month==7){$month_name='July';}
if($month==8){$month_name='August';}
if($month==9){$month_name='September';}
if($month==10){$month_name='October';}
if($month==11){$month_name='November';}
if($month==12){$month_name='December';}

	tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "H.R. Overseas account report of ".$month_name."/".$year;
$obj_pdf->SetTitle($title);
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 9);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
ob_start();
    // we can have any view part here like HTML, PHP etc
    $content='
	<h1 style="border-bottom: 1px solid #000">This month income '.$ful_month_income.' TK.</h1>
	'.$income.'
	
	<h1 style="border-bottom: 1px solid #000">This month Expenditure '.$ful_month_expenditure.' TK.</h1>
	'.$expenditure.'
	';
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('hr-overseas-account.pdf', 'I');;
?>