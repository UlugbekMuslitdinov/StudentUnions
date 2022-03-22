<?php
require_once('fpdi.php');

// initiate FPDI
$pdf =& new FPDI('L', 'cm');
// add a page
$pdf->AddPage();
// set the sourcefile
$pdf->setSourceFile('temp.pdf');
// import page 1
$tplIdx = $pdf->importPage(1);
// use the imported page and place it at point 10,10 with a width of 100 mm
$pdf->useTemplate($tplIdx);

//set page break
$pdf->SetAutoPageBreak(1 , 0);
//set margins
$pdf->SetAutoPageBreak(0 , 0, 0);

// now write some text above the imported page
$pdf->SetFont('Arial');
$pdf->SetTextColor(255,0,0);
$pdf->SetXY(10.37, 5.65);
$pdf->Write(0, "X");
$pdf->SetXY(10.37, 7.36);
$pdf->Write(0, "X");
$pdf->SetXY(10.37, 9.07);
$pdf->Write(0, "X");
$pdf->SetXY(10.37, 10.78);
$pdf->Write(0, "X");
$pdf->SetXY(10.37, 12.49);
$pdf->Write(0, "X");
$pdf->SetXY(11.24, 13.67);
$pdf->Write(0, "3 cheese & a noodle");
$pdf->SetXY(19.20, 19.2);
$pdf->Write(0, "Jaime Masson");
$pdf->SetXY(24.2, 19.2);
$pdf->Write(0, "06-10-2008");


// add a page
$pdf->AddPage();
//import page 2
$tplIdx = $pdf->importPage(2);
// use the imported page and place it at point 10,10 with a width of 100 mm
$pdf->useTemplate($tplIdx);


$pdf->SetXY(2.37, 2.14);
$pdf->Write(0, "Jaime R Masson");
$pdf->SetXY(13.30, 2.14);
$pdf->Write(0, "Yes");
$pdf->SetXY(15.57, 2.14);
$pdf->Write(0, "Junior");
$pdf->SetXY(3.39, 3.19);
$pdf->Write(0, "41 S Shannon Apt 7206 Tucson, AZ 85745");
$pdf->SetXY(15.09, 4.26);
$pdf->Write(0, "x");
$pdf->SetXY(16.63, 4.26);
$pdf->Write(0, "x");
$pdf->SetXY(.70, 5.17);
$pdf->Write(0, "Friend");
$pdf->SetXY(12.27, 5.17);
$pdf->Write(0, "(520)891-0166");
$pdf->SetXY(6.80, 6.31);
$pdf->Write(0, "x");
$pdf->SetXY(8.31, 6.31);
$pdf->Write(0, "x");
$pdf->SetXY(11.32, 6.24);
$pdf->Write(0, "jmasson@email.arizona.edu");
$pdf->SetXY(12.89, 7.20);
$pdf->Write(0, "yes");
$pdf->SetXY(4.11, 8.23);
$pdf->Write(0, "I was a very complicated situation");
$pdf->SetXY(21.10, 2.65);
$pdf->Write(0, "35");
$pdf->SetXY(18.72, 4.52);
$pdf->Write(0, "06-10-2008");
$pdf->SetXY(18.72, 5.90);
$pdf->Write(0, "06-10-2008");
$pdf->SetXY(20.29, 8.32);
$pdf->Write(0, "x");
$pdf->SetXY(21.36, 8.32);
$pdf->Write(0, "x");
$pdf->SetXY(22.43, 8.32);
$pdf->Write(0, "x");
$pdf->SetXY(23.50, 8.32);
$pdf->Write(0, "x");
$pdf->SetXY(24.57, 8.32);
$pdf->Write(0, "x");
$pdf->SetXY(25.64, 8.32);
$pdf->Write(0, "x");
$pdf->SetXY(26.71, 8.32);
$pdf->Write(0, "x");

$pdf->SetXY(20.29, 9.14);
$pdf->Write(0, "x");
$pdf->SetXY(21.36, 9.14);
$pdf->Write(0, "x");
$pdf->SetXY(22.43, 9.14);
$pdf->Write(0, "x");
$pdf->SetXY(23.50, 9.14);
$pdf->Write(0, "x");
$pdf->SetXY(24.57, 9.14);
$pdf->Write(0, "x");
$pdf->SetXY(25.64, 9.14);
$pdf->Write(0, "x");
$pdf->SetXY(26.71, 9.14);
$pdf->Write(0, "x");

$pdf->SetXY(20.29, 9.96);
$pdf->Write(0, "x");
$pdf->SetXY(21.36, 9.96);
$pdf->Write(0, "x");
$pdf->SetXY(22.43, 9.96);
$pdf->Write(0, "x");
$pdf->SetXY(23.50, 9.96);
$pdf->Write(0, "x");
$pdf->SetXY(24.57, 9.96);
$pdf->Write(0, "x");
$pdf->SetXY(25.64, 9.96);
$pdf->Write(0, "x");
$pdf->SetXY(26.71, 9.96);
$pdf->Write(0, "x");

$pdf->SetXY(20.29, 10.78);
$pdf->Write(0, "x");
$pdf->SetXY(21.36, 10.78);
$pdf->Write(0, "x");
$pdf->SetXY(22.43, 10.78);
$pdf->Write(0, "x");
$pdf->SetXY(23.50, 10.78);
$pdf->Write(0, "x");
$pdf->SetXY(24.57, 10.78);
$pdf->Write(0, "x");
$pdf->SetXY(25.64, 10.78);
$pdf->Write(0, "x");
$pdf->SetXY(26.71, 10.78);
$pdf->Write(0, "x");

$pdf->SetXY(20.29, 11.60);
$pdf->Write(0, "x");
$pdf->SetXY(21.36, 11.60);
$pdf->Write(0, "x");
$pdf->SetXY(22.43, 11.60);
$pdf->Write(0, "x");
$pdf->SetXY(23.50, 11.60);
$pdf->Write(0, "x");
$pdf->SetXY(24.57, 11.60);
$pdf->Write(0, "x");
$pdf->SetXY(25.64, 11.60);
$pdf->Write(0, "x");
$pdf->SetXY(26.71, 11.60);
$pdf->Write(0, "x");

$pdf->SetXY(20.29, 12.42);
$pdf->Write(0, "x");
$pdf->SetXY(21.36, 12.42);
$pdf->Write(0, "x");
$pdf->SetXY(22.43, 12.42);
$pdf->Write(0, "x");
$pdf->SetXY(23.50, 12.42);
$pdf->Write(0, "x");
$pdf->SetXY(24.57, 12.42);
$pdf->Write(0, "x");
$pdf->SetXY(25.64, 12.42);
$pdf->Write(0, "x");
$pdf->SetXY(26.71, 12.42);
$pdf->Write(0, "x");

$pdf->SetXY(20.29, 13.24);
$pdf->Write(0, "x");
$pdf->SetXY(21.36, 13.24);
$pdf->Write(0, "x");
$pdf->SetXY(22.43, 13.24);
$pdf->Write(0, "x");
$pdf->SetXY(23.50, 13.24);
$pdf->Write(0, "x");
$pdf->SetXY(24.57, 13.24);
$pdf->Write(0, "x");
$pdf->SetXY(25.64, 13.24);
$pdf->Write(0, "x");
$pdf->SetXY(26.71, 13.24);
$pdf->Write(0, "x");

$pdf->SetXY(20.29, 14.06);
$pdf->Write(0, "x");
$pdf->SetXY(21.36, 14.06);
$pdf->Write(0, "x");
$pdf->SetXY(22.43, 14.06);
$pdf->Write(0, "x");
$pdf->SetXY(23.50, 14.06);
$pdf->Write(0, "x");
$pdf->SetXY(24.57, 14.06);
$pdf->Write(0, "x");
$pdf->SetXY(25.64, 14.06);
$pdf->Write(0, "x");
$pdf->SetXY(26.71, 14.06);
$pdf->Write(0, "x");

$pdf->SetXY(20.29, 14.88);
$pdf->Write(0, "x");
$pdf->SetXY(21.36, 14.88);
$pdf->Write(0, "x");
$pdf->SetXY(22.43, 14.88);
$pdf->Write(0, "x");
$pdf->SetXY(23.50, 14.88);
$pdf->Write(0, "x");
$pdf->SetXY(24.57, 14.88);
$pdf->Write(0, "x");
$pdf->SetXY(25.64, 14.88);
$pdf->Write(0, "x");
$pdf->SetXY(26.71, 14.88);
$pdf->Write(0, "x");

$pdf->SetXY(20.29, 15.70);
$pdf->Write(0, "x");
$pdf->SetXY(21.36, 15.70);
$pdf->Write(0, "x");
$pdf->SetXY(22.43, 15.70);
$pdf->Write(0, "x");
$pdf->SetXY(23.50, 15.70);
$pdf->Write(0, "x");
$pdf->SetXY(24.57, 15.70);
$pdf->Write(0, "x");
$pdf->SetXY(25.64, 15.70);
$pdf->Write(0, "x");
$pdf->SetXY(26.71, 15.70);
$pdf->Write(0, "x");

$pdf->SetXY(20.29, 16.52);
$pdf->Write(0, "x");
$pdf->SetXY(21.36, 16.52);
$pdf->Write(0, "x");
$pdf->SetXY(22.43, 16.52);
$pdf->Write(0, "x");
$pdf->SetXY(23.50, 16.52);
$pdf->Write(0, "x");
$pdf->SetXY(24.57, 16.52);
$pdf->Write(0, "x");
$pdf->SetXY(25.64, 16.52);
$pdf->Write(0, "x");
$pdf->SetXY(26.71, 16.52);
$pdf->Write(0, "x");

$pdf->SetXY(20.29, 17.34);
$pdf->Write(0, "x");
$pdf->SetXY(21.36, 17.34);
$pdf->Write(0, "x");
$pdf->SetXY(22.43, 17.34);
$pdf->Write(0, "x");
$pdf->SetXY(23.50, 17.34);
$pdf->Write(0, "x");
$pdf->SetXY(24.57, 17.34);
$pdf->Write(0, "x");
$pdf->SetXY(25.64, 17.34);
$pdf->Write(0, "x");
$pdf->SetXY(26.71, 17.34);
$pdf->Write(0, "x");

$pdf->SetXY(20.29, 18.16);
$pdf->Write(0, "x");
$pdf->SetXY(21.36, 18.16);
$pdf->Write(0, "x");
$pdf->SetXY(22.43, 18.16);
$pdf->Write(0, "x");
$pdf->SetXY(23.50, 18.16);
$pdf->Write(0, "x");
$pdf->SetXY(24.57, 18.16);
$pdf->Write(0, "x");
$pdf->SetXY(25.64, 18.16);
$pdf->Write(0, "x");
$pdf->SetXY(26.71, 18.16);
$pdf->Write(0, "x");

$pdf->SetFontSize(7);
$pdf->SetXY(.73, 12.23);
$pdf->Write(0, "EEGEE's");
$pdf->SetXY(.73, 13.24);
$pdf->Write(0, "EEGEE's");
$pdf->SetXY(.73, 14.21);
$pdf->Write(0, "EEGEE's");
$pdf->SetXY(.73, 15.17);
$pdf->Write(0, "EEGEE's");
$pdf->SetXY(.73, 15.94);
$pdf->Write(0, "EEGEE's");

$pdf->SetXY(.73, 17.01);
$pdf->Write(0, "EEGEE's");
$pdf->SetXY(.73, 17.98);
$pdf->Write(0, "EEGEE's");
$pdf->SetXY(.73, 18.84);
$pdf->Write(0, "EEGEE's");
$pdf->SetXY(.73, 19.80);
$pdf->Write(0, "EEGEE's");
$pdf->SetXY(.73, 20.76);
$pdf->Write(0, "EEGEE's");

$pdf->SetXY(6.26, 11.56);
$pdf->MultiCell(4.25, .3, 'this is a test i hope it works.this is a test i hope it worksthis is a test i hope it worksthis is a test i hope it worksthis is a test i hope it worksthis is a test i hope it worksthis is a test i hope it worksthis is a test i hope it worksthis is a test i hope it worksthis is a test i hope it works');
$pdf->SetXY(10.51, 11.56);
$pdf->MultiCell(1.43, .3, 'this is a test i hope it works.');
$pdf->SetXY(11.91, 11.56);
$pdf->MultiCell(2.46, .3, 'this is a test i hope it works.this is a test i hope it works.');
$pdf->SetXY(14.37, 11.56);
$pdf->MultiCell(3.89, .3, 'this is a test i hope it works.this is a test i hope it works.');



$pdf->SetXY(6.26, 16.19);
$pdf->MultiCell(4.25, .3, 'this is a test i hope it works.this is a test i hope it worksthis is a test i hope it worksthis is a test i hope it worksthis is a test i hope it worksthis is a test i hope it worksthis is a test i hope it worksthis is a test i hope it worksthis is a test i hope it worksthis is a test i hope it works');
$pdf->SetXY(10.51, 16.19);
$pdf->MultiCell(1.43, .3, 'this is a test i hope it works.');
$pdf->SetXY(11.91, 16.19);
$pdf->MultiCell(2.46, .3, 'this is a test i hope it works.this is a test i hope it works.');
$pdf->SetXY(14.37, 16.19);
$pdf->MultiCell(3.89, .3, 'this is a test i hope it works.this is a test i hope it works.');

$pdf->SetXY(18.72, 19.97);
$pdf->Write(0, "EEGEE's");


$pdf->Output('newpdf.pdf', 'F');