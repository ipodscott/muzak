<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the folder from query parameter
$currentPath = isset($_GET['folder']) ? trim($_GET['folder'], '/') : '';
$folderPath = __DIR__ . '/' . $currentPath;

// Check if the folder exists
if (!is_dir($folderPath)) {
	header("HTTP/1.0 404 Not Found");
	echo "Album not found";
	exit;
}

// Get album information
function getAlbumInfo($folderPath) {
	$album = [
		'name' => basename($folderPath),
		'audio_files' => [],
		'summary' => '',
		'album_art' => '',
		'album_title' => 'Album Title', // Default title
		'year' => '' // Default empty year
	];
	
	// Get album title and year from data.json if it exists
	$dataPath = $folderPath . '/data.json';
	if (file_exists($dataPath)) {
		$jsonData = json_decode(file_get_contents($dataPath), true);
		if (isset($jsonData['albumTitle'])) {
			$album['album_title'] = $jsonData['albumTitle'];
		}
		if (isset($jsonData['year'])) {
			$album['year'] = $jsonData['year'];
		}
	}
	
	// Get audio files
	$audioFiles = glob($folderPath . '/*.mp3');
	foreach ($audioFiles as $file) {
		$webPath = str_replace($_SERVER['DOCUMENT_ROOT'], '', $file);
		$album['audio_files'][] = [
			'name' => pathinfo($file, PATHINFO_FILENAME), // Remove .mp3 extension
			'path' => $webPath
		];
	}
	
	// Get summary if exists
	$summaryPath = $folderPath . '/summary.txt';
	if (file_exists($summaryPath)) {
		$album['summary'] = file_get_contents($summaryPath);
	}
	
	// Get first image file for album art
	$imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
	$albumArt = null;
	
	foreach ($imageExtensions as $ext) {
		$images = glob($folderPath . '/*.' . $ext);
		if (!empty($images)) {
			$albumArt = $images[0]; // Get the first image found
			break;
		}
	}
	
	if ($albumArt) {
		$webPath = str_replace($_SERVER['DOCUMENT_ROOT'], '', $albumArt);
		$album['album_art'] = $webPath;
	}
	
	return $album;
}

$album = getAlbumInfo($folderPath);