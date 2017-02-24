<?php 
/* 
 * This file contains functions for processing colors.  
 * for Elementaire 3.0. 
 * Adapted from http://lab.clearpixel.com.au/2008/06/darken-or-lighten-colours-dynamically-using-php/ 
 */ 
function colorBrightness($hex, $percent) {
	// Work out if hash given
	$hash = '';
	if (stristr($hex,'#')) {
		$hex = str_replace('#','',$hex);
		$hash = '#';
	}
	/// HEX TO RGB
	$rgb = hex_to_rgb($hex); 
	//// CALCULATE 
	for ($i=0; $i<3; $i++) {
		// See if brighter or darker
		if ($percent > 0) {
			// Lighter
			$rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
		} else {
			// Darker
			$positivePercent = $percent - ($percent*2);
			$rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
		}
		// In case rounding up causes us to go to 256
		if ($rgb[$i] > 255) {
			$rgb[$i] = 255;
		}
	}
	//// RBG to Hex
	//$hex = '';
	//for($i=0; $i < 3; $i++) {
		//// Convert the decimal digit to hex
		//$hexDigit = dechex($rgb[$i]);
		//// Add a leading zero if necessary
		//if(strlen($hexDigit) == 1) {
		//$hexDigit = "0" . $hexDigit;
		//}
		//// Append to the hex string
		//$hex .= $hexDigit;
	//}
	$hex = rgb_to_hex( $rgb ); 
	return $hash.$hex;
} 

function hex_to_rgb($hex) { 
	if (stristr($hex,'#')) {
		$hex = str_replace('#','',$hex);
	}
	return array(hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2)));
} 

function rgb_to_hex($rgb) { 
	$hex = '';
	foreach ( $rgb as $rgb_color ) { 
		// Convert the decimal digit to hex
		$hexDigit = dechex( $rgb_color );
		// Add a leading zero if necessary
		if ( strlen( $hexDigit ) == 1 ) $hexDigit = "0" . $hexDigit; 
		// Append to the hex string
		$hex .= $hexDigit;
	} 
	return $hex; 
} 

/**
 * Determines whether a color appears light or not. 
 *
 * @param array
 * @return bool 
 *  - True: is a light color
 *  - False: is a dark color
 */ 
function is_light_color($rgb) { 
	return ( ( ( $rgb[0] * 0.2126 + $rgb[1] * 0.7152 + $rgb[2] * 0.0722 ) / 255.0 ) > 0.5 ); 
} 

/** 
 * Increases or decreases color saturation 
 *
 * @param $hex Color, in hex
 * @param $amount Percent, negative or positive, like -0.4 
 * @return $hex Color, saturated or desaturated
 */ 
function colorSaturation($hex, $amount) { 

	// Turn a percentage like 0.4 into one like 40
	$amount = 100 * $amount; 

	// convert hex to HSL so we can deal with it better
	$hsl = rgb_to_hsl ( hex_to_rgb( $hex ) ); 
	
	// add amount of saturation 
	$hsl[2] = $hsl[2] + $amount; 

	// convert back to hex
	$hex = rgb_to_hex( hsl_to_rgb( $hsl ) ); 

	return $hex; 
} 

/**
 * @string rgb - rgb array
 * @return Array hsl
 **/
function rgb_to_hsl($rgb){
	// Where RGB values = 0 ÷ 255.
	$var_R = $rgb[0] / 255;
	$var_G = $rgb[1] / 255;
	$var_B = $rgb[2] / 255;
	// Min. value of RGB
	$var_Min = min($var_R, $var_G, $var_B);
	// Max. value of RGB
	$var_Max = max($var_R, $var_G, $var_B);
	// Delta RGB value
	$del_Max = $var_Max - $var_Min;
	$L = ($var_Max + $var_Min) / 2;
	if ( $del_Max == 0 ) {
		// This is a gray, no chroma...
		// HSL results = 0 ÷ 1
		$H = 0;
		$S = 0;
	} else {
		// Chromatic data...
		if ($L < 0.5) {
			$S = $del_Max / ($var_Max + $var_Min);
		} else {
			$S = $del_Max / ( 2 - $var_Max - $var_Min );
		}
		$del_R = ((($var_Max - $var_R) / 6) + ($del_Max / 2)) / $del_Max;
		$del_G = ((($var_Max - $var_G) / 6) + ($del_Max / 2)) / $del_Max;
		$del_B = ((($var_Max - $var_B) / 6) + ($del_Max / 2)) / $del_Max;
		if ($var_R == $var_Max) {
			$H = $del_B - $del_G;
		} else if ($var_G == $var_Max) {
			$H = ( 1 / 3 ) + $del_R - $del_B;
		} else if ($var_B == $var_Max) {
			$H = ( 2 / 3 ) + $del_G - $del_R;
		}
		if ($H < 0) {
			$H += 1;
		}
		if ($H > 1) {
			$H -= 1;
		}
	}
	return array(round($H*360), round($S,2), round($L,2));
}
/**
 * @string hsl - hsl array
 * @return Array rgb
 **/
function hsl_to_rgb($hsl)
{
	if(is_array($hsl) && count($hsl) == 3)list($h, $s, $l) = $hsl;
	else {
		throw new Exception('Not a valid HSL');
	}
	if($h>0)$h /= 360;
	if($s == 0)
	{
		$r = $l;
		$g = $l;
		$b = $l;
	}
	else
	{
		if($l < .5)
		{
			$t2 = $l * (1.0 + $s);
		}
		else
		{
			$t2 = ($l + $s) - ($l * $s);
		}
		$t1 = 2.0 * $l - $t2;
		$rt3 = $h + 1.0/3.0;
		$gt3 = $h;
		$bt3 = $h - 1.0/3.0;
		if($rt3 < 0) $rt3 += 1.0;
		if($rt3 > 1) $rt3 -= 1.0;
		if($gt3 < 0) $gt3 += 1.0;
		if($gt3 > 1) $gt3 -= 1.0;
		if($bt3 < 0) $bt3 += 1.0;
		if($bt3 > 1) $bt3 -= 1.0;
		if(6.0 * $rt3 < 1) $r = $t1 + ($t2 - $t1) * 6.0 * $rt3;
		elseif(2.0 * $rt3 < 1) $r = $t2;
		elseif(3.0 * $rt3 < 2) $r = $t1 + ($t2 - $t1) * ((2.0/3.0) - $rt3) * 6.0;
		else $r = $t1;
		if(6.0 * $gt3 < 1) $g = $t1 + ($t2 - $t1) * 6.0 * $gt3;
		elseif(2.0 * $gt3 < 1) $g = $t2;
		elseif(3.0 * $gt3 < 2) $g = $t1 + ($t2 - $t1) * ((2.0/3.0) - $gt3) * 6.0;
		else $g = $t1;
		if(6.0 * $bt3 < 1) $b = $t1 + ($t2 - $t1) * 6.0 * $bt3;
		elseif(2.0 * $bt3 < 1) $b = $t2;
		elseif(3.0 * $bt3 < 2) $b = $t1 + ($t2 - $t1) * ((2.0/3.0) - $bt3) * 6.0;
		else $b = $t1;
	}
	$r = (int)round(255.0 * $r);
	$g = (int)round(255.0 * $g);
	$b = (int)round(255.0 * $b);
	return array($r, $g, $b);
}
