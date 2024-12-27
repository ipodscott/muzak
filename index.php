<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the folder from query parameter
$currentPath = isset($_GET['folder']) ? trim($_GET['folder'], '/') : '';
$folderPath = __DIR__ . '/' . $currentPath;

// Check if we have a valid directory
if (empty($currentPath) || !is_dir($folderPath)) {
	// Show TBA page
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Music Player</title>
		<link rel="stylesheet" href="style.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
	</head>
	<body>
		
		<?php include('svg_library.php');?>
		<div class="tba">
			<svg class="m-logo"><use href="#m-logo"></use></svg>
</div>
	</body>
	</html>
	<?php
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo htmlspecialchars($album['name']); ?></title>
	<link rel="stylesheet" href="../style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>
	<?php include('svg_library.php');?>
	<div class="main-container">
		<h1 class="album-title">
			<a href="/"><svg class="m-logo"><use href="#m-logo"></use></svg></a><?php echo htmlspecialchars($album['album_title']); ?>
		</h1>
		<div class="count">Number of tracks: <?php echo count($album['audio_files']); ?><?php echo $album['year'] ? ' | Year: ' . htmlspecialchars($album['year']) : ''; ?></div>
		
		<div class="player-container">
			<div class="left-section">
				<div class="album-art-container">
					<?php if ($album['album_art']): ?>
						<img src="<?php echo htmlspecialchars($album['album_art']); ?>" alt="Album Art" class="album-art">
					<?php else: ?>
						<div class="album-art" style="background: #eee;"></div>
					<?php endif; ?>
					<div class="accord-box">
						<div class="accordion" id="info-accordion">
							<span>Album Info</span>
							<span>+</span>
						</div>
						<div class="accordion-content" id="info-content">
							<?php echo nl2br(htmlspecialchars($album['summary'])); ?>
						</div>
					</div>
					<audio class="audio-player" id="audio-player" controls>
						<source src="" type="audio/mpeg">
						Your browser does not support the audio element.
					</audio>
				</div>
				
			</div>
			
			<div class="right-section">
				<div class="song-list">
					<?php foreach ($album['audio_files'] as $index => $audio): ?>
					<div class="song-item" data-path="<?php echo htmlspecialchars($audio['path']); ?>">
						<?php echo htmlspecialchars($audio['name']); ?>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
	<?php include('script.php');?>
</body>
</html>