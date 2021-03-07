<?php

function prepOutput($output, $separator = '') {
	$output = htmlspecialchars($output, ENT_QUOTES, 'utf-8');
	$output = ltrim($output);
	if (!empty($output)) {
		$output = $separator . $output; 
	}
	return $output;
}

function isAmountEqualTotal($amount, $total) {
	$amountFormatted = number_format((float)$amount, 2, '.', '');
	return($total == $amountFormatted );
}
