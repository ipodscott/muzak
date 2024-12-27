# Music Player Directory Browser

A PHP-based music player that dynamically creates a player interface for any directory containing audio files.

## Features

-   Dynamic audio player for each directory
-   Auto-play and loop functionality
-   Support for multiple image formats as album art (jpg, png, gif, webp)
-   Configurable album title and year via data.json
-   Track count display
-   Mobile-responsive design
-   Native HTML5 audio controls

## Directory Structure
root/
  ├── root/
  │   ├── style.css
  │   ├── index.php
  │   ├── controls.php
  │   ├── script.php
  │   ├── .htaccess
  │   ├──  svg_library.php
  │   └── audio-directory-1/
  │       ├── data.json
  │       ├── any-image./jpg/webp/png/gif
  │       ├── track1.mp3
  │       ├── track2.mp3
  │       ├── track3.mp3
  │       └── summary.txt
  │   └── audio-directory-2/
  │       ├── data.json
  │       ├── any-image./jpg/webp/png/gif
  │       ├── track1.mp3
  │       ├── track2.mp3
  │       ├── track3.mp3
  │       └── summary.txt
    
## Configuration

**data.json**
{
     "albumTitle":  "Album Name", 
     "year":  "2024" 
}

## .htaccess

Options -Indexes
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} -d
RewriteRule ^(.*)$ index.php?folder=$1 [QSA,L]

## Switch to another file

All your files and folders are presented as a tree in the file explorer. You can switch from one to another by clicking a file in the tree.

## Usage

 1. Create a directory in the root folder
 2. Add MP3 files
 3.  Include any image file for album art
 4. Add data.json with album info
 5. Access via: `domain.com/muzak/directory-name

`
## Requirements

 - PHP 7.0+
 - Apache with mod_rewrite
 - Web server with directory write permissions
