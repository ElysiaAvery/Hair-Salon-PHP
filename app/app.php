<?php
  date_default_timezone_set('America/Los_Angeles');

  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Stylist.php";
  require_once __DIR__."/../src/Client.php";

  $app = new Silex\Application();

  $server = 'mysql:host=localhost;dbname=hair_salon';
  $username = 'root';
  $password = 'root';
  $DB = new PDO($server, $username, $password);

  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
  ));

  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\HttpFoundation\Request;
  Request::enableHttpMethodParameterOverride();

  $app->get("/", function() use ($app) {
    return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
  });

  $app->post("/stylists", function() use ($app) {
    if(isset($_POST['name'])) {
      foreach($_POST as $val) {
        if(trim($val) == '' || empty($val)) {
          $error = 'You have entered an invalid name.';
          return $app['twig']->render('error.html.twig', array('error' => $error));
        } else {}
      }
      $stylist = new Stylist($_POST['name']);
      $stylist->save();
      return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    } else {}
  });

  $app->error(function (\Exception $e, Request $request, $code) {
    switch ($code) {
      case 404:
        $message = 'The requested page could not be found.';
        break;
      default:
        $message = 'We are sorry, but something went terribly wrong.';
    }
    return new Response($message);
  });

  $app->get("/stylists/{id}", function($id) use ($app) {
    $stylist = Stylist::find($id);
    return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
  });

  $app->get("/stylists/{id}/edit", function($id) use ($app) {
    $stylist = Stylist::find($id);
    return $app['twig']->render('stylist_edit.html.twig', array('stylist' => $stylist));
  });

  $app->patch("/stylists/{id}", function($id) use ($app) {
    if(isset($_POST['name'])) {
      foreach($_POST as $val) {
        if(trim($val) == '' || empty($val)) {
          $error = 'You have entered an invalid name.';
          return $app['twig']->render('error.html.twig', array('error' => $error));
        } else {}
      }
      $name = $_POST['name'];
      $stylist = Stylist::find($id);
      $stylist->update($name);
      return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    } else {}
  });

  $app->delete("/stylists/{id}", function($id) use ($app) {
    $stylist = Stylist::find($id);
    $stylist->delete();
    return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
  });

  $app->get("/clients", function() use ($app) {
    return $app['twig']->render('clients.html.twig', array('clients' => Client::getAll()));
  });

  $app->post("/clients", function() use ($app) {
    if(isset($_POST['name'])) {
      foreach($_POST as $val) {
        if(trim($val) == '' || empty($val)) {
          $error = 'You have entered an invalid name.';
          return $app['twig']->render('error.html.twig', array('error' => $error));
        } else {}
      }
      $name = $_POST['name'];
      $stylist_id = $_POST['stylist_id'];
      $client = new Client($name, $id = null, $stylist_id);
      $client->save();
      $stylist = Stylist::find($stylist_id);
      return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    } else {}
  });

  $app->get("/clients/{id}", function($id) use ($app) {
    $client = Client::find($id);
    return $app['twig']->render('client.html.twig', array('client' => $client));
  });

  $app->patch("/clients/{id}", function($id) use ($app) {
    if(isset($_POST['name'])) {
      foreach($_POST as $val) {
        if(trim($val) == '' || empty($val)) {
          $error = 'You have entered an invalid name.';
          return $app['twig']->render('error.html.twig', array('error' => $error));
        } else {}
      }
      $name = $_POST['name'];
      $client = Client::find($id);
      $client->update($name);
      return $app['twig']->render('client.html.twig', array('client' => $client));
    } else {}
  });

  $app->delete("/clients/{id}", function($id) use ($app) {
    $client = Client::find($id);
    $client->delete();
    return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
  });

  return $app;
?>
