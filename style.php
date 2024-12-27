<style>
	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
		font-family: "Montserrat", serif;
	}
	
	body {
		padding: 0;
		margin: 0 auto;
		font-family: "Montserrat", serif;
		font-optical-sizing: auto;
		font-weight: normal;
		font-style: normal;
	}
	
	.tba{
		display: flex;
		justify-content: center;
		align-items: center;
		height: 100vh;
		width: 100vw;
		
		& .m-logo{
			width: 280px;
			height: 280px;
			fill:#1c3249;
			transition: all 0.5s;
			cursor: pointer;
			&:hover{
				fill:#336699;
		}
	}
	}
	
	.main-container{
		display: block;
		margin: 0 auto;
		position: relative;
		max-width: 1200px;
		padding: 20px;
	}
	
	.player-container {
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		gap: 20px;
		margin-top: 20px;
	}
	
	.left-section, .right-section{
		flex: 3 1 350px;
	}
	
	.album-title {
		font-size: 2.5em;
		font-weight: 500;
		gap: 10px;
		margin-bottom: 10px;
		display: flex;
		flex-direction: row;
		justify-content: flex-strt;
		align-items: center;
		line-height: 0.8em;
		font-size: calc(24px + (36 - 24) * ((100vw - 300px) / (1600 - 300)));
		& svg{
			fill:#336699;
			width: 50px;
			height: 50px;
			height: auto;
			max-height: 46px;
		}
	}
	
	.count {
		color: #666;
		margin-bottom: 20px;
	}
	
	.album-art-container {
		position: relative;
	}
	
	.album-art {
		width: 100%;
		aspect-ratio: 1;
		object-fit: cover;
		border-radius: 5px;
		box-shadow: 0 2px 5px rgba(0,0,0,0.6);
	}
	
	.audio-player {
		display: block;
		position: absolute;
		width: calc(100% - 20px);
		left: 10px;
		bottom: 10px;
	}
	
	.song-list {
		max-height: 75vh;
		overflow-y: scroll;
		list-style: none;
	}
	
	.song-item {
		padding: 15px;
		border-bottom: 1px solid #eee;
		cursor: pointer;
	}
	
	.song-item:hover {
		background: #f5f5f5;
	}
	
	.accord-box{
		position: absolute;
		top: 10px;
		left: 10px;
		width: calc(100% - 20px);
		z-index: 999;
	}
	
	.accordion {
		background: #000;
		padding: 15px;
		margin-top: 0;
		cursor: pointer;
		border-radius: 5px;
		box-shadow: 0 2px 5px rgba(0,0,0,0.1);
		display: flex;
		color: #fff;
		justify-content: space-between;
		align-items: center;
		opacity: 0.6;
	}
	
	.accordion-content {
		display: none;
		padding: 15px;
		background: #000;
		color: #fff;
		margin-top: 5px;
		border-radius: 0 0 5px 5px;
		line-height: 1.5em;
		font-size: 14px;
		border-radius: 5px;
		height: 55vw;
		max-height: 350px;
		overflow-y: scroll;
	}
</style>