<?php
use Phalcon\Mvc\Application;
use Phalcon;

use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;

use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Session\Adapter\Files as Session;
use Phalcon\Mvc\View;
use Phalcon\Forms\Manager as FormsManager;

use Phalcon\Flash\Session as FlashSession;



// Register an autoloader
$loader = new Loader();
$loader->registerDirs(
    array(
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
        APP_PATH . '/forms/',
        BASE_PATH . '/vendor/'
    )
)->register();


// Create a DI
$di = new FactoryDefault();

// Setting up the view component
$di['view'] = function() {
    $view = new View();
    $view->setViewsDir(APP_PATH . '/views/');
    return $view;
};

// Setup a base URI so that all generated URIs include the "tutorial" folder
$di['url'] = function() {
    $url = new UrlProvider();
    $url->setBaseUri('/');  /*promijenio važno!!!!*/
    return $url;
};

// Set the database service
$di['db'] = function() {
    return new DbAdapter(array(
        "host"     => "127.0.0.1",
        "username" => "root",
        "password" => "",
        "dbname"   => "books"
    ));
};

$di['transport'] = function() {
    return new Swift_SmtpTransport(array(
        "host"     => "email-smtp.us-west-2.amazonaws.com",
        "port" => "587",
        "security" => "tls"
    ));
};

$di->set(
    'emailUsername',
    function () {
        return 'AKIAIDTSKTPSPJRXEZ2A';
    });

$di->set(
    'emailPass',
    function () {
        return 'AqCBObfLQk9anLILglC04EAqCimuSW+3Ly0j0B0fi2BH';
    });

$di->set(
    'emailEmail',
    function () {
        return 'email-smtp.us-west-2.amazonaws.com';
    });

$di->set(
    'emailPort',
    function () {
        return '587';
    });

$di->set(
    'emailHost',
    function () {
        return 'tls';
    });

$di->setShared(
    "session",
    function () {
        $session = new Session();

        $session->start();

        return $session;
    }
);

//elastično

$di->set(
    "elasticsearch",
    function () {

        $host = "127.0.0.1";
        $port = "9200";

        $builder = new \Elasticsearch\ClientBuilder();
        $builder->setHosts([$host . ':' . $port]);
        return $builder->build();
    },
    true
);



// Handle the request
try {
    $application = new Application($di);
    echo $application->handle()->getContent();
} catch (Exception $e) {
    echo $e->getMessage(), '<br>';
    echo nl2br(htmlentities($e->getTraceAsString()));
}
$di['forms'] = function () {
    return new FormsManager();
};



// Configurar el servicio flash session
$di->set(
    'flashSession',
    function () {
        return new FlashSession();
    }
);






