<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/AlunniController.php';

$app = AppFactory::create();

$app->get('/', 'AlunniController:home');
$app->get('/alunni', "AlunniController:index");
$app->get('/alunni/{id}', "AlunniController:getid");
$app->post('/alunni', "AlunniController:postalunno");
$app->put('/alunni/{id}', "AlunniController:putalunno");
$app->delete('/alunni/{id}', "AlunniController:deletealunno");

$app->run();
