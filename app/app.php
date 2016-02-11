<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/CD.php";

    session_start();
    if(empty($_SESSION['list_of_albums'])) {
        $_SESSION['list_of_albums'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path'=> __DIR__.'/../views'));

    $app->get("/", function() use ($app) {
        $albums = $_SESSION['list_of_albums'];
        return $app['twig']->render('index.html.twig', array('albums'=> $albums));
    });

    $app->post('/new_album', function() use ($app) {

        $newAlbum = new CD($_POST['inputTitle'], $_POST['inputArtist'], $_POST['inputCoverArt']);
        $newAlbum->saveAlbum();
        $albums = $_SESSION['list_of_albums'];
        // var_dump($albums);
        return $app['twig']->render('index.html.twig', array('albums'=> $albums));
    });

    $app->post('/deleteAll', function() use ($app) {
        $_SESSION['list_of_albums'] = array();
        return $app['twig']->render('index.html.twig');
    });

    $app->post('/artistMatch', function() use ($app) {
        $search = $_POST['searchArtist'];
        $albums = $_SESSION['list_of_albums'];
        $matching_artists = array();

        foreach ($albums as $album) {
            $search = strtolower($search);
            $artist_name = $album->getArtist();
            $artist_name = strtolower($artist_name);

            if (strpos($artist_name, $search) !== false) {
                array_push($matching_artists, $album);
            }
        }
        return $app['twig']->render('search.html.twig', array('albumTest'=> $matching_artists));

    });

    return $app;

?>
