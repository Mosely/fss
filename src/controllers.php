<?php
// Controller definitions
$container['DefaultController'] = function ($c) {
    return new FSS\Controllers\defaultController();
};
$container['UserController'] = function ($c) {
    return new FSS\Controllers\userController($c);
};
$container['BranchOfServiceController'] = function ($c) {
    return new FSS\Controllers\branchOfServiceController($c);
};
$container['AddressController'] = function ($c) {
    return new FSS\Controllers\addressController($c);
};
$container['GenderController'] = function ($c) {
    return new FSS\Controllers\genderController($c);
};
$container['LanguageController'] = function ($c) {
    return new FSS\Controllers\languageController($c);
};
$container['EthnicityController'] = function ($c) {
    return new FSS\Controllers\ethnicityController($c);
};
$container['MedicationController'] = function ($c) {
    return new FSS\Controllers\medicationController($c);
};
$container['City_dataController'] = function ($c) {
    return new FSS\Controllers\city_dataController($c);
};
$container['City_data_extendedController'] = function ($c) {
    return new FSS\Controllers\city_data_extendedController($c);
};
$container['ClientController'] = function ($c) {
    return new FSS\Controllers\clientController($c);
};
$container['Client_ethnicityController'] = function ($c) {
    return new FSS\Controllers\client_ethnicityController($c);
};
$container['Client_languageController'] = function ($c) {
    return new FSS\Controllers\client_languageController($c);
};
$container['CounseleeController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
