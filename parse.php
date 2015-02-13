<?php
$file = __DIR__.'/testpresentation.pptx';
echo "file is " . $file."\n";

function __autoload($class) {
	// convert namespace to full file path
	$class = str_replace('\\', '/', $class) . '.php';
	require_once($class);
}

use phpoffice\powerpoint\PowerPoint;

$powerpoint = new Powerpoint($file);
$powerpoint->buildAll();
// echo "Number of slides:   " . $powerpoint->getNumberOfSlides() . "\n";
// echo "The first slide is: " . $powerpoint->getSlide(0)->filename . "\n";

$l = $powerpoint->getNumberOfSlides();
for($i=0; $i<$l; $i++) {
    //print_r($powerpoint->getSlide(0)->getHTML());
	$slide = $powerpoint->getSlide($i);
	$slideCont = [];
	$slideCont []= '<section data-v="1" data-h="'.($i+1).'">';
	$prevParagraph = null;
	$p = 1;
	foreach($slide->paragraphs as $paragraph) {
		print_r($slide);exit;
		$markup = $paragraph->getHTML($prevParagraph);
		$id = uniqid();
		$objCont = [];
		$objCont []= '<div slides-editor-object class="object move" data-id="'.$id.'" tabindex="'.$p.'" style="">';
		$objCont []= '<div class="object-expand-point tl"></div>';
		$objCont []= '<div class="object-expand-point ml"></div>';
		$objCont []= '<div class="object-expand-point bl"></div>';
		$objCont []= '<div class="object-expand-point tc"></div>';
		$objCont []= '<div class="object-expand-point bc"></div>';
		$objCont []= '<div class="object-expand-point tr"></div>';
		$objCont []= '<div class="object-expand-point mr"></div>';
		$objCont []= '<div class="object-expand-point br"></div>';
		$objCont []= '<editor contenteditable="false" ng-model="text" class="content" style="padding: 0px;">'.$markup.'</editor>';
		$objCont []= '</div>';
		$slideCont []= implode('', $objCont);

		$prevParagraph = $paragraph;
		$p++;
	}
	$slideCont []= '</section>';
//	echo implode('', $slideCont)."\n";
	exit;
}

//echo $powerpoint->getHTML();