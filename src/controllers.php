<?php
// Controller definitions
$container['DefaultController'] = function ($c) {
    return new FSS\Controllers\DefaultController();
};
$container['UserController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\UserController(
        $logger, $db, $cache, $jwt, $jwtToken, $debug);
};
$container['BranchOfServiceController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\BranchOfServiceController(
        $logger, $db, $cache, $debug);
};
$container['AddressController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\AddressController(
        $logger, $db, $cache, $debug);
};
$container['GenderController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\GenderController(
        $logger, $db, $cache, $debug);
};
$container['LanguageController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\LanguageController(
        $logger, $db, $cache, $debug);
};
$container['EthnicityController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\EthnicityController(
        $logger, $db, $cache, $debug);
};
$container['MedicationController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\MedicationController(
        $logger, $db, $cache, $debug);
};
$container['City_dataController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CityDataController(
        $logger, $db, $cache, $debug);
};
$container['City_data_extendedController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CityDataExtendedController(
        $logger, $db, $cache, $debug);
};
$container['ClientController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\ClientController(
        $logger, $db, $cache, $debug);
};
$container['Client_ethnicityController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\ClientEthnicityController(
        $logger, $db, $cache, $debug);
};
$container['Client_languageController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\ClientLanguageController(
        $logger, $db, $cache, $debug);
};
$container['CounseleeController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CounseleeController(
        $logger, $db, $cache, $debug);
};
$container['Counselee_childController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CounseleeChildController(
        $logger, $db, $cache, $debug);
};
$container['Counselee_child_bio_parentController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CounseleeChildBioParentController(
        $logger, $db, $cache, $debug);
};
$container['Counselee_child_guardianController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CounseleeChildGuardianController(
        $logger, $db, $cache, $debug);
};
$container['Counselee_child_siblingController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CounseleeChildSiblingController(
        $logger, $db, $cache, $debug);
};
$container['Counselee_counseling_topicController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CounseleeCounselingTopicController(
        $logger, $db, $cache, $debug);
};
$container['Counselee_drug_useController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CounseleeDrugUseController(
        $logger, $db, $cache, $debug);
};
$container['Counselee_medicationController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CounseleeMedicationController(
        $logger, $db, $cache, $debug);
};
$container['Counseling_topicController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CounselingTopicController(
        $logger, $db, $cache, $debug);
};
$container['County_dataController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CountyDataController(
        $logger, $db, $cache, $debug);
};
$container['Drug_useController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\DrugUseController(
        $logger, $db, $cache, $debug);
};
$container['Funding_sourceController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\FundingSourceController(
        $logger, $db, $cache, $debug);
};
$container['Identity_preferenceController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\IdentityPreferenceController(
        $logger, $db, $cache, $debug);
};
$container['Military_discharge_typeController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\MilitaryDischargeTypeController(
        $logger, $db, $cache, $debug);
};
$container['PersonController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\PersonController(
        $logger, $db, $cache, $debug);
};
$container['Person_addressController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\PersonAddressController(
        $logger, $db, $cache, $debug);
};
$container['Person_phoneController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\PersonPhoneController(
        $logger, $db, $cache, $debug);
};
$container['PhoneController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\PhoneController(
        $logger, $db, $cache, $debug);
};
$container['RoleController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\RoleController(
        $logger, $db, $cache, $debug);
};
$container['SchoolController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\SchoolController(
        $logger, $db, $cache, $debug);
};
$container['Shelter_clientController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\ShelterClientController(
        $logger, $db, $cache, $debug);
};
$container['Shelter_client_additional_staffController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\ShelterClientAdditionalStaffController(
        $logger, $db, $cache, $debug);
};
$container['Shelter_client_funding_sourceController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\ShelterClientFundingSourceController(
        $logger, $db, $cache, $debug);
};
$container['Shelter_client_identity_preferenceController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\ShelterClientIdentityPreferenceController(
        $logger, $db, $cache, $debug);
};
$container['State_dataController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\StateDataController(
        $logger, $db, $cache, $debug);
};
$container['User_roleController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\UserRoleController(
        $logger, $db, $cache, $debug);
};
$container['User_viewController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\UserViewController(
        $logger, $db, $cache, $debug);
};
$container['VeteranController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\VeteranController(
        $logger, $db, $cache, $debug);
};
$container['ReportController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\ReportController(
        $logger, $db, $cache, $jwtToken, $debug);
};
