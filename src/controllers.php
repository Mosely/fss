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
