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
    return new FSS\Controllers\UserController($logger, $db, $cache, $jwt,
        $jwtToken, $debug);
};
$container['BranchOfServiceController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\BranchOfServiceController($logger, $db, $cache,
        $debug);
};
$container['AddressController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\AddressController($logger, $db, $cache, $debug);
};
$container['GenderController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\GenderController($logger, $db, $cache, $debug);
};
$container['LanguageController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\LanguageController($logger, $db, $cache, $debug);
};
$container['EthnicityController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\EthnicityController($logger, $db, $cache, $debug);
};
$container['MedicationController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\MedicationController($logger, $db, $cache, $debug);
};
$container['CityDataController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CityDataController($logger, $db, $cache, $debug);
};
$container['CityDataExtendedController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CityDataExtendedController($logger, $db, $cache,
        $debug);
};
$container['ClientController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\ClientController($logger, $db, $cache, $debug);
};
$container['ClientEthnicityController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\ClientEthnicityController($logger, $db, $cache,
        $debug);
};
$container['ClientLanguageController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\ClientLanguageController($logger, $db, $cache,
        $debug);
};
$container['CounseleeController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CounseleeController($logger, $db, $cache, $debug);
};
$container['CounseleeChildController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CounseleeChildController($logger, $db, $cache,
        $debug);
};
$container['CounseleeChildBioParentController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CounseleeChildBioParentController($logger, $db,
        $cache, $debug);
};
$container['CounseleeChildGuardianController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CounseleeChildGuardianController($logger, $db,
        $cache, $debug);
};
$container['CounseleeChildSiblingController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CounseleeChildSiblingController($logger, $db,
        $cache, $debug);
};
$container['CounseleeCounselingTopicController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CounseleeCounselingTopicController($logger, $db,
        $cache, $debug);
};
$container['CounseleeDrugUseController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CounseleeDrugUseController($logger, $db, $cache,
        $debug);
};
$container['CounseleeMedicationController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CounseleeMedicationController($logger, $db, $cache,
        $debug);
};
$container['CounselingTopicController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CounselingTopicController($logger, $db, $cache,
        $debug);
};
$container['CountyDataController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\CountyDataController($logger, $db, $cache, $debug);
};
$container['DrugUseController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\DrugUseController($logger, $db, $cache, $debug);
};
$container['FundingSourceController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\FundingSourceController($logger, $db, $cache,
        $debug);
};
$container['IdentityPreferenceController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\IdentityPreferenceController($logger, $db, $cache,
        $debug);
};
$container['MilitaryDischargeTypeController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\MilitaryDischargeTypeController($logger, $db,
        $cache, $debug);
};
$container['PersonController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\PersonController($logger, $db, $cache, $debug);
};
$container['PersonAddressController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\PersonAddressController($logger, $db, $cache,
        $debug);
};
$container['PersonPhoneController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\PersonPhoneController($logger, $db, $cache, $debug);
};
$container['PhoneController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\PhoneController($logger, $db, $cache, $debug);
};
$container['RoleController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\RoleController($logger, $db, $cache, $debug);
};
$container['SchoolController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\SchoolController($logger, $db, $cache, $debug);
};
$container['ShelterClientController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\ShelterClientController($logger, $db, $cache,
        $debug);
};
$container['ShelterClientAdditionalStaffController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\ShelterClientAdditionalStaffController($logger,
        $db, $cache, $debug);
};
$container['ShelterClientFundingSourceController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\ShelterClientFundingSourceController($logger, $db,
        $cache, $debug);
};
$container['ShelterClientIdentityPreferenceController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\ShelterClientIdentityPreferenceController($logger,
        $db, $cache, $debug);
};
$container['StateDataController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\StateDataController($logger, $db, $cache, $debug);
};
$container['UserRoleController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\UserRoleController($logger, $db, $cache, $debug);
};
$container['UserViewController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\UserViewController($logger, $db, $cache, $debug);
};
$container['VeteranController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\VeteranController($logger, $db, $cache, $debug);
};
$container['ReportController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    $debug = $c->get('settings')['debug'];
    return new FSS\Controllers\ReportController($logger, $db, $cache, $jwtToken,
        $debug);
};
