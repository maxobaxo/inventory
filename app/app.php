<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Inventory.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=inventory';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('home.html.twig');
    });

    $app->get("/items", function() use ($app) {
        $inventory = Inventory::getAll();

        return $app['twig']->render('items.html.twig', array('inventory' => $inventory));
    });

    $app->post("/added", function() use ($app) {
        $added_item = $_GET['new_item'];

        return $app['twig']->render('added.html.twig', array('new_item' => $added_item));
    });

    $app->post("/deleted", function() use ($app) {
        return $app['twig']->render('deleted.html.twig');
    });

    return $app;
?>
