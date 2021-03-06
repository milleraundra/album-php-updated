<?php
    class CD
    {
        private $title;
        private $artist;
        private $cover_art;

        function __construct($album_name, $band_name, $image_path)
        {
            $this->title = $album_name;
            $this->artist = $band_name;
            $this->cover_art = $image_path;

        }

        function setTitle($new_title)
        {
            $this->title = $new_title;
        }

        function getTitle()
        {
            return $this->title;
        }

        function setArtist($new_artist)
        {
            $this->artist = $new_artist;
        }

        function getArtist()
        {
            return $this->artist;
        }

        function setCoverArt($new_cover_art)
        {
            $this->cover_art = $new_cover_art;
        }

        function getCoverArt()
        {
            return $this->cover_art;
        }

        function saveAlbum()
        {
            array_push($_SESSION['list_of_albums'], $this);
        }

        // function artistMatch($artist_input)
        // {
        //     $matching_artists = array();
        //     if ($artist_input == $this->artist) {
        //         array_push($matching_artists, $this);
        //     }
        //     return $matching_artists;
        // }

    }
?>
