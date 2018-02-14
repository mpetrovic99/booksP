<?php
error_reporting(E_ALL);

use Phalcon\Mvc\Application;

use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;

use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Session\Adapter\Files as Session;
use Phalcon\Mvc\View;
use Phalcon\Forms\Manager as FormsManager;

use Phalcon\Flash\Session as FlashSession;


define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

require APP_PATH.'/../vendor/autoload.php';

include APP_PATH . "/config/services.php";
/*
$client = Elasticsearch\ClientBuilder::create()->build();

$params = [

    'index' => 'my_index',

    'type'  => 'my_type',

    'id'    => 'my_id',

    'body'  => ['testField' => 'abc'],

];

$response = $client->index($params);

print_r($response);
*/