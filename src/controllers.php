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
$container['Counselee_childController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['Counselee_child_bio_parentController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['Counselee_child_guardianController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['Counselee_child_siblingController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['Counselee_counseling_topicController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['Counselee_drug_useController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['Counselee_medicationController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['Counseling_topicController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['County_dataController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['Drug_useController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['Funding_sourceController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['Identity_preferenceController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['Military_discharge_typeController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['PersonController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['Person_addressController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['Person_phoneController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['PhoneController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['RoleController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['SchoolController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['Shelter_clientController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['Shelter_client_additional_staffController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['Shelter_client_funding_sourceController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['Shelter_client_identity_preferenceController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['State_dataController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['User_roleController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['User_viewController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};
$container['VeteranController'] = function ($c) {
    return new FSS\Controllers\counseleeController($c);
};

