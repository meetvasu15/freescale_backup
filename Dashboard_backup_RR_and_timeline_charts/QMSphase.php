<?php
$strFontFile = "/usr/share/fonts/msttcorefonts/arial.ttf";
#$strFontFile = "/usr/share/fonts/msttcorefonts/arialbi.ttf";
$strFontFileI = "/usr/share/fonts/msttcorefonts/ariali.ttf";
#$strFontFile = "/usr/share/fonts/msttcorefonts/arialbd.ttf";

#$cImg = imagecreatefromjpeg('Milestones.jpg'); # 459,202
$cImg = ImageCreate(450,200);
$cGreen = ImageColorAllocate($cImg,0x00, 0xFF, 0x00);
$cYellow = ImageColorAllocate($cImg,0xFF, 0xFF, 0x00);
$cRed = ImageColorAllocate($cImg,0xFF, 0x00, 0x00);
$cBlack = ImageColorAllocate($cImg,0x00, 0x00, 0x00);
$cWhite = ImageColorAllocate($cImg,0xFF, 0xFF, 0xFF);
$cGray = ImageColorAllocate($cImg,0x66, 0x66, 0x66);

######################### background
ImageFilledRectangle($cImg, 0, 0, 450, 200,$cWhite);
imageLine($cImg, 35,20,355,20,$cBlack);
imagettftext($cImg, 13, 0, 10, 24, $cBlack, $strFontFile, "20");
imageLine($cImg, 35,40,355,40,$cBlack);
imagettftext($cImg, 13, 0, 10, 44, $cBlack, $strFontFile, "15");
imageLine($cImg, 35,60,355,60,$cBlack);
imagettftext($cImg, 13, 0, 10, 64, $cBlack, $strFontFile, "10");
imageLine($cImg, 35,80,355,80,$cBlack);
imagettftext($cImg, 13, 0, 15, 84, $cBlack, $strFontFile, "5");
imageLine($cImg, 35,100,355,100,$cBlack);
imagettftext($cImg, 13, 0, 15, 104, $cBlack, $strFontFile, "0");
imageLine($cImg, 40,20,40,105,$cBlack);
imageLine($cImg, 85,100,85,105,$cBlack);
imagettftext($cImg, 11, 90, 70, 175, $cBlack, $strFontFileI, "Selection");
imageLine($cImg, 130,100,130,105,$cBlack);
imagettftext($cImg, 11, 90, 115, 190, $cBlack, $strFontFileI, "Opportunity");
imageLine($cImg, 175,100,175,105,$cBlack);
imagettftext($cImg, 11, 90, 160, 180, $cBlack, $strFontFileI, "Feasibility");
imageLine($cImg, 220,100,220,105,$cBlack);
imagettftext($cImg, 11, 90, 205, 172, $cBlack, $strFontFileI, "Planning");
imageLine($cImg, 265,100,265,105,$cBlack);
imagettftext($cImg, 11, 90, 250, 180, $cBlack, $strFontFileI, "Prototype");
imageLine($cImg, 310,100,310,105,$cBlack);
imagettftext($cImg, 11, 90, 295, 145, $cBlack, $strFontFileI, "Pilot");
imageLine($cImg, 355,100,355,105,$cBlack);
imagettftext($cImg, 11, 90, 340, 145, $cBlack, $strFontFileI, "Cert.");

ImageFilledRectangle($cImg, 370,28,380,38,$cRed);
imagettftext($cImg, 11, 0, 370, 58, $cGray, $strFontFile, "Not Aligned");
ImageFilledRectangle($cImg, 370,78,380,88,$cGreen);
imagettftext($cImg, 11, 0, 370, 108, $cGray, $strFontFile, "Aligned");



$aStart = array('sel' => 55,
		'opp' => 100, 
		'fea' => 145, 
		'pla' => 190, 
		'pro' => 235, 
		'pil' => 280, 
		'cer' => 325 
		);

if (!isset($_GET['sel']))
{
	require_once "/proj/.web_webnpi/html/prog/NPI/MCD/programs/npi_mcd_vars.inc.php";
	PHP_connect_to_DB_server();
	$cProj = new NPIproject();
	$strTbName = "pregen_report";
	$strSQL = "SELECT report FROM $strTbName WHERE dvn_id = 1846 AND name = 'PhaseQMS'"; 
	$aaReturn = subSQLRead($cProj->dbName, $strTbName, $strSQL);
	$strRep = $aaReturn[0]['report'];
	if (preg_match('!(sel=[^"]+)!', $strRep, $aTmp))
	{
		$aPara = split('&', $aTmp[0]);	
		foreach($aPara as $strTmp)
		{
			list($strKey, $strValue) = split("=", $strTmp);
			$_GET[$strKey] = $strValue;
		}
	}

}

foreach ($aStart as $strKey => $nStart)
{

	$aSel = split(',',$_GET[$strKey]);
	$nG = 100 - $aSel[1] * 4;
	$nR = $nG - $aSel[0] * 4;

	if ($aSel[1] != 0)
	{
		ImageFilledRectangle($cImg, $nStart,$nG,$nStart + 20,100,$cGreen);
	}
	if ($aSel[0] != 0)
	{
		ImageFilledRectangle($cImg, $nStart,$nR,$nStart + 20 ,$nG,$cRed);
	}
}
#
#$ato = split(',',$_GET['sa']);
#$nR = 30 + round((100 - $ato[1]), 0);
#$nY = 30 + round((100 - $ato[0]), 0);
#
#ImageFilledRectangle($cImg, 160,30,190,$nR,$cRed);
#ImageFilledRectangle($cImg, 160,$nR,190,$nY,$cYellow);
#ImageFilledRectangle($cImg, 160,$nY,190,130,$cGreen);
#
#$ato = split(',',$_GET['qu']);
#$nR = 30 + round((100 - $ato[1]), 0);
#$nY = 30 + round((100 - $ato[0]), 0);
#
#ImageFilledRectangle($cImg, 230,30,260,$nR,$cRed);
#ImageFilledRectangle($cImg, 230,$nR,260,$nY,$cYellow);
#ImageFilledRectangle($cImg, 230,$nY,260,130,$cGreen);
#
#$ato = split(',',$_GET['lastto']);
#$nR = 30 + round((100 - $ato[1]), 0);
#$nY = 30 + round((100 - $ato[0]), 0);
#
## To2 280,25, 303,106
#ImageFilledRectangle($cImg, 300,30,330,$nR,$cRed);
#ImageFilledRectangle($cImg, 300,$nR,330,$nY,$cYellow);
#ImageFilledRectangle($cImg, 300,$nY,330,130,$cGreen);



header('Content-Type: image/png');
ImagePNG($cImg);
imagedestroy($cImg);
?>
