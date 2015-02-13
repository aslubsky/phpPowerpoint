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
    echo '<section data-v="1" data-h="'.($i+1).'">'.$powerpoint->getSlide($i)->getHTML() .'</section>'."\n";
}

//echo $powerpoint->getHTML();