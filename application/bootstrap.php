<?php

/*Общие константы приложения*/

session_start();
define("ROOT", $_SERVER['DOCUMENT_ROOT']);
define("CONTROLLER_PATH", ROOT . "/application/controllers/");
define("MODEL_PATH", ROOT . "/application/models/");
define("VIEW_PATH", ROOT . "/application/views/");
define("UPLOAD_FOLDER", ROOT. "/uploads/");
define("UTILS", ROOT . "/application/utils/");

require_once('db.php');
require_once('route.php');
require_once UTILS . "Utils.php";
require_once MODEL_PATH . 'Model.php';
require_once VIEW_PATH . 'View.php';
require_once CONTROLLER_PATH . 'Controller.php';


Routing::buildRoute();