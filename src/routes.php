<?php
// Routes

// DJH The Controllers will act as the API. Here are there routes.
// Update the routes as new controllers are added.

// $app->get('/users/{id:[0-9]+}', 'UserController:readUser');
$app->get('/', 'DefaultController:indexAction');

$app->get('/users', 'UserController:readAll');
$app->get('/users/{id:[0-9]+}', 'UserController:read');
$app->get('/users/{filter}/{value}', 'UserController:readAllWithFilter');

$app->post('/users', 'UserController:create');
$app->put('/users/{id:[0-9]+}', 'UserController:update');
$app->delete('/users/{id:[0-9]+}', 'UserController:delete');

$app->post('/login', 'UserController:login');
$app->get('/logout', 'UserController:logout');

$app->get('/branchesofservice', 'BranchOfServiceController:readAll');
$app->get('/branchesofservice/{id:[0-9]+}', 'BranchOfServiceController:read');
$app->get('/branchesofservice/{filter}/{value}', 'BranchOfServiceController:readAllWithFilter');

$app->get('/addresses', 'AddressController:readAll');
$app->get('/addresses/{id:[0-9]+}', 'AddressController:read');
$app->get('/addresses/{filter}/{value}', 'AddressController:readAllWithFilter');

$app->get('/genders', 'GenderController:readAll');
$app->get('/genders/{id:[0-9]+}', 'GenderController:read');
$app->get('/genders/{filter}/{value}', 'GenderController:readAllWithFilter');

$app->get('/genders', 'LanguageController:readAll');
$app->get('/genders/{id:[0-9]+}', 'LanguageController:read');
$app->get('/genders/{filter}/{value}', 'LanguageController:readAllWithFilter');

$app->get('/genders', 'EthnicityController:readAll');
$app->get('/genders/{id:[0-9]+}', 'EthnicityController:read');
$app->get('/genders/{filter}/{value}', 'EthnicityController:readAllWithFilter');

$app->get('/genders', 'MedicationController:readAll');
$app->get('/genders/{id:[0-9]+}', 'MedicationController:read');
$app->get('/genders/{filter}/{value}', 'MedicationController:readAllWithFilter');
