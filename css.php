<?php
/**
 *
 * To use this in your HTML, link to it in the usual way:
 * <link rel="stylesheet" type="text/css" media="screen, print, projection" href="/css.php" />
 */

/* Add your CSS files to this array (THESE ARE ONLY EXAMPLES) */
$cssFiles = array(
  "main.css",
  "utility.css",
  "../js/magnific/magnific-popup.css"
);

/**
 * Ideally, you wouldn't need to change any code beyond this point.
 */
$compressed = "";
foreach ($cssFiles as $cssFile) {
  $compressed .= file_get_contents($cssFile);
}

// Remove comments
$compressed = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $compressed);

// Remove space after colons
$compressed = str_replace(': ', ':', $compressed);

// Remove whitespace
$compressed = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $compressed);

// Enable GZip encoding.
ob_start("ob_gzhandler");

// Enable caching
header('Cache-Control: public');

// Expire in one day
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT');

// Set the correct MIME type, because Apache won't set it for us
header("Content-type: text/css");

// Write everything out
echo($compressed);
?>