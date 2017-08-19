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
$app->get('/branchesofservice/{filter}/{value}',
    'BranchOfServiceController:readAllWithFilter');

$app->get('/addresses', 'AddressController:readAll');
$app->get('/addresses/{id:[0-9]+}', 'AddressController:read');
$app->get('/addresses/{filter}/{value}', 'AddressController:readAllWithFilter');

$app->get('/genders', 'GenderController:readAll');
$app->get('/genders/{id:[0-9]+}', 'GenderController:read');
$app->get('/genders/{filter}/{value}', 'GenderController:readAllWithFilter');

$app->post('/genders', 'GenderController:create');
$app->put('/genders/{id:[0-9]+}', 'GenderController:update');
$app->delete('/genders/{id:[0-9]+}', 'GenderController:delete');

$app->get('/languages', 'LanguageController:readAll');
$app->get('/languages/{id:[0-9]+}', 'LanguageController:read');
$app->get('/languages/{filter}/{value}', 'LanguageController:readAllWithFilter');

$app->post('/languages', 'LanguageController:create');
$app->put('/languages/{id:[0-9]+}', 'LanguageController:update');
$app->delete('/languages/{id:[0-9]+}', 'LanguageController:delete');

$app->get('/ethnicities', 'EthnicityController:readAll');
$app->get('/ethnicities/{id:[0-9]+}', 'EthnicityController:read');
$app->get('/ethnicities/{filter}/{value}',
    'EthnicityController:readAllWithFilter');

$app->post('/ethnicities', 'EthnicityController:create');
$app->put('/ethnicities/{id:[0-9]+}', 'EthnicityController:update');
$app->delete('/ethnicities/{id:[0-9]+}', 'EthnicityController:delete');

$app->get('/medications', 'MedicationController:readAll');
$app->get('/medications/{id:[0-9]+}', 'MedicationController:read');
$app->get('/medications/{filter}/{value}',
    'MedicationController:readAllWithFilter');

$app->post('/medications', 'MedicationController:create');
$app->put('/medications/{id:[0-9]+}', 'MedicationController:update');
$app->delete('/medications/{id:[0-9]+}', 'MedicationController:delete');

$app->get('/citydata', 'City_dataController:readAll');
$app->get('/citydata/{id:[0-9]+}', 'City_dataController:read');
$app->get('/citydata/{filter}/{value}', 'City_dataController:readAllWithFilter');

$app->post('/citydata', 'City_dataController:create');
$app->put('/citydata/{id:[0-9]+}', 'City_dataController:update');
$app->delete('/citydata/{id:[0-9]+}', 'City_dataController:delete');

$app->get('/citydataextended', 'City_data_extendedController:readAll');
$app->get('/citydataextended/{id:[0-9]+}', 'City_data_extendedController:read');
$app->get('/citydataextended/{filter}/{value}',
    'City_data_extendedController:readAllWithFilter');

$app->post('/citydataextended', 'City_data_extendedController:create');
$app->put('/citydataextended/{id:[0-9]+}', 'City_data_extendedController:update');
$app->delete('/citydataextended/{id:[0-9]+}',
    'City_data_extendedController:delete');

$app->get('/clients', 'ClientController:readAll');
$app->get('/clients/{id:[0-9]+}', 'ClientController:read');
$app->get('/clients/{filter}/{value}', 'ClientController:readAllWithFilter');

$app->post('/clients', 'ClientController:create');
$app->put('/clients/{id:[0-9]+}', 'ClientController:update');
$app->delete('/clients/{id:[0-9]+}', 'ClientController:delete');

$app->get('/clientethnicities', 'Client_ethnicityController:readAll');
$app->get('/clientethnicities/{id:[0-9]+}', 'Client_ethnicityController:read');
$app->get('/clientethnicities/{filter}/{value}',
    'Client_ethnicityController:readAllWithFilter');

$app->post('/clientethnicities', 'Client_ethnicityController:create');
$app->put('/clientethnicities/{id:[0-9]+}', 'Client_ethnicityController:update');
$app->delete('/clientethnicities/{id:[0-9]+}',
    'Client_ethnicityController:delete');

$app->get('/clientlanguages', 'Client_languageController:readAll');
$app->get('/clientlanguages/{id:[0-9]+}', 'Client_languageController:read');
$app->get('/clientlanguages/{filter}/{value}',
    'Client_languageController:readAllWithFilter');

$app->post('/clientlanguages', 'Client_languageController:create');
$app->put('/clientlanguages/{id:[0-9]+}', 'Client_languageController:update');
$app->delete('/clientlanguages/{id:[0-9]+}', 'Client_languageController:delete');

$app->get('/counselees', 'CounseleeController:readAll');
$app->get('/counselees/{id:[0-9]+}', 'CounseleeController:read');
$app->get('/counselees/{filter}/{value}',
    'CounseleeController:readAllWithFilter');

$app->post('/counselees', 'CounseleeController:create');
$app->put('/counselees/{id:[0-9]+}', 'CounseleeController:update');
$app->delete('/counselees/{id:[0-9]+}', 'CounseleeController:delete');
