<script>
	const audioPlayer = document.getElementById('audio-player');
	const songItems = document.querySelectorAll('.song-item');
	const infoAccordion = document.getElementById('info-accordion');
	const infoContent = document.getElementById('info-content');
	
	let currentlyPlaying = null;
	let currentIndex = 0;

	// Function to play song by index
	function playSongByIndex(index) {
		const items = Array.from(songItems);
		const item = items[index];
		
		// Reset previous playing item
		if (currentlyPlaying) {
			currentlyPlaying.style.background = '';
			currentlyPlaying.style.color = ''; // Reset text color of previous item
		}
		
		// Update currently playing
		currentlyPlaying = item;
		item.style.background = '#333';
		item.style.color = '#ffffff'; // Set text color to white for current item
		currentIndex = index;
		
		// Play the song
		audioPlayer.src = item.dataset.path;
		audioPlayer.play();
	}

	// Song list functionality
	songItems.forEach((item, index) => {
		item.addEventListener('click', () => {
			playSongByIndex(index);
		});
	});

	// Handle end of song
	audioPlayer.addEventListener('ended', () => {
		let nextIndex = currentIndex + 1;
		// If we're at the end, loop back to the beginning
		if (nextIndex >= songItems.length) {
			nextIndex = 0;
		}
		playSongByIndex(nextIndex);
	});

	// Accordion functionality
	infoAccordion.addEventListener('click', () => {
		const isHidden = infoContent.style.display === 'none' || !infoContent.style.display;
		infoContent.style.display = isHidden ? 'block' : 'none';
		infoAccordion.querySelector('span:last-child').textContent = isHidden ? '-' : '+';
	});
</script>