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
        return $app['twig']->render('index.html.twig');

    });

    $app->post('/new_album', function() use ($app) {

        $newAlbum = new CD($_POST['inputTitle'], $_POST['inputArtist'], $_POST['inputCoverArt']);
        $newAlbum->saveAlbum();
        $albums = $_SESSION['list_of_albums'];
        var_dump($albums);
        return $app['twig']->render('index.html.twig', array('albums'=> $albums));
    });

    $app->post('/deleteAll', function() use ($app) {
        $_SESSION['list_of_albums'] = array();
        return $app['twig']->render('index.html.twig');
    });

    return $app;

?>
