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

$app->post('/users', 'GenderController:create');
$app->put('/users/{id:[0-9]+}', 'GenderController:update');
$app->delete('/users/{id:[0-9]+}', 'GenderController:delete');

$app->get('/languages', 'LanguageController:readAll');
$app->get('/languages/{id:[0-9]+}', 'LanguageController:read');
$app->get('/languages/{filter}/{value}', 'LanguageController:readAllWithFilter');

$app->post('/users', 'LanguageController:create');
$app->put('/users/{id:[0-9]+}', 'LanguageController:update');
$app->delete('/users/{id:[0-9]+}', 'LanguageController:delete');

$app->get('/ethnicities', 'EthnicityController:readAll');
$app->get('/ethnicities/{id:[0-9]+}', 'EthnicityController:read');
$app->get('/ethnicities/{filter}/{value}', 'EthnicityController:readAllWithFilter');

$app->post('/users', 'EthnicityController:create');
$app->put('/users/{id:[0-9]+}', 'EthnicityController:update');
$app->delete('/users/{id:[0-9]+}', 'EthnicityController:delete');

$app->get('/medications', 'MedicationController:readAll');
$app->get('/medications/{id:[0-9]+}', 'MedicationController:read');
$app->get('/medications/{filter}/{value}', 'MedicationController:readAllWithFilter');

$app->post('/users', 'MedicationController:create');
$app->put('/users/{id:[0-9]+}', 'MedicationController:update');
$app->delete('/users/{id:[0-9]+}', 'MedicationController:delete');

$app->get('/users', 'City_dataController:readAll');
$app->get('/users/{id:[0-9]+}', 'City_dataController:read');
$app->get('/users/{filter}/{value}', 'City_dataController:readAllWithFilter');

$app->post('/users', 'City_dataController:create');
$app->put('/users/{id:[0-9]+}', 'City_dataController:update');
$app->delete('/users/{id:[0-9]+}', 'City_dataController:delete');

$app->get('/users', 'City_data_extendedController:readAll');
$app->get('/users/{id:[0-9]+}', 'City_data_extendedController:read');
$app->get('/users/{filter}/{value}', 'City_data_extendedController:readAllWithFilter');

$app->post('/users', 'City_data_extendedController:create');
$app->put('/users/{id:[0-9]+}', 'City_data_extendedController:update');
$app->delete('/users/{id:[0-9]+}', 'City_data_extendedController:delete');

$app->get('/users', 'ClientController:readAll');
$app->get('/users/{id:[0-9]+}', 'ClientController:read');
$app->get('/users/{filter}/{value}', 'ClientController:readAllWithFilter');

$app->post('/users', 'ClientController:create');
$app->put('/users/{id:[0-9]+}', 'ClientController:update');
$app->delete('/users/{id:[0-9]+}', 'ClientController:delete');

$app->get('/users', 'Client_ethnicityController:readAll');
$app->get('/users/{id:[0-9]+}', 'Client_ethnicityController:read');
$app->get('/users/{filter}/{value}', 'Client_ethnicityController:readAllWithFilter');

$app->post('/users', 'Client_ethnicityController:create');
$app->put('/users/{id:[0-9]+}', 'Client_ethnicityController:update');
$app->delete('/users/{id:[0-9]+}', 'Client_ethnicityController:delete');

$app->get('/users', 'Client_languageController:readAll');
$app->get('/users/{id:[0-9]+}', 'Client_languageController:read');
$app->get('/users/{filter}/{value}', 'Client_languageController:readAllWithFilter');

$app->post('/users', 'Client_languageController:create');
$app->put('/users/{id:[0-9]+}', 'Client_languageController:update');
$app->delete('/users/{id:[0-9]+}', 'Client_languageController:delete');

$app->get('/users', 'CounseleeController:readAll');
$app->get('/users/{id:[0-9]+}', 'CounseleeController:read');
$app->get('/users/{filter}/{value}', 'CounseleeController:readAllWithFilter');

$app->post('/users', 'CounseleeController:create');
$app->put('/users/{id:[0-9]+}', 'CounseleeController:update');
$app->delete('/users/{id:[0-9]+}', 'CounseleeController:delete');
