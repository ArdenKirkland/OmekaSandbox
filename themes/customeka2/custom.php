<?php
/* adapted from Griddy theme */
function elementaire_custom_background()
{
	if(function_exists('get_theme_option') && $bgimage = get_theme_option('Background Image')) {
		$storage = Zend_Registry::get('storage');
        	$bgimage_url = $storage->getUri($storage->getPathByType($bgimage, 'theme_uploads'));
	        $html = $bgimage_url;
	} else { 
		$html = ""; 
	} 
        echo $html;
}

function elementaire_custom_header_background()
{
    if(function_exists('get_theme_option') && $headerBg = get_theme_option('Header Background')) {
        $storage = Zend_Registry::get('storage');
        $headerBg = $storage->getUri($storage->getPathByType($headerBg, 'theme_uploads'));
	echo $headerBg;
    }
}
