<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Server Configuration:</h2>";
echo "ModRewrite enabled: " . (in_array('mod_rewrite', apache_get_modules()) ? 'Yes' : 'No') . "<br>";
echo "Directory: " . __DIR__ . "<br>";
echo "Request URI: " . $_SERVER['REQUEST_URI'] . "<br>";
echo "Query String: " . $_SERVER['QUERY_STRING'] . "<br>";

if(isset($_GET['folder'])) {
	echo "Folder parameter: " . $_GET['folder'] . "<br>";
}

// Test folder reading
$testFolder = __DIR__ . '/audio-1';
echo "<h2>Testing folder access:</h2>";
echo "Folder exists: " . (is_dir($testFolder) ? 'Yes' : 'No') . "<br>";
echo "Folder readable: " . (is_readable($testFolder) ? 'Yes' : 'No') . "<br>";

// List contents
if(is_dir($testFolder)) {
	echo "<h3>Folder contents:</h3>";
	$files = scandir($testFolder);
	echo "<pre>";
	print_r($files);
	echo "</pre>";
}
?>