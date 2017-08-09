<?php
// Routes

    // DJH The Controllers will act as the API.  Here are there routes.
    // Update the routes as new controllers are added.
    
    //$app->get('/users/{id:[0-9]+}', 'UserController:readUser');
    
    $app->get('/', 'DefaultController:indexAction');
    
    $app->get('/users', 'UserController:readAll');
    $app->get('/users/{id:[0-9]+}', 'UserController:read');
    $app->get('/users/{filter}/{value}', 'UserController:readAllWithFilter');
    
    $app->post('/users', 'UserController:create');
    $app->put('/users/{id:[0-9]+}', 'UserController:update');
    $app->delete('/users/{id:[0-9]+}', 'UserController:delete');
    
    $app->post('/login', 'UserController:login');
    $app->post('/logout', 'UserController:logout');
    
    $app->get('/branchesofservice', 'BranchOfServiceController:readAllBranchesOfService');
    $app->get('/branchesofservice/{id:[0-9]+}', 'BranchOfServiceController:readBranchOfService');
    $app->get('/branchesofservice/{filter}/{value}', 'BranchOfServiceController:readAllBranchesOfServiceWithFilter');
    
    $app->get('/addresses', 'AddressController:readAllAddresses');
    $app->get('/addresses/{id:[0-9]+}', 'AddressController:readAddress');
    $app->get('/addresses/{filter}/{value}', 'AddressController:readAllAddressesWithFilter');