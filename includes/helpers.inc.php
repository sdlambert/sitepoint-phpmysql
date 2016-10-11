<?php

function html($text) {
	return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

/**
 * htmlOut will remove special characters and print it to the document
 * @param  String $text - text to output
 * @return null
 */
function htmlOut($text) {
	echo html($text);
}

?>