<?php

function prepOutput($output, $separator = '') {
	$output = htmlspecialchars($output, ENT_QUOTES, 'utf-8');
	$output = ltrim($output);
	if (!empty($output)) {
		$output = $separator . $output; 
	}
	return $output;
}
