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
        $jwtToken, $debug, $jwtToken);
};
$container['BranchOfServiceController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\BranchOfServiceController($logger, $db, $cache,
        $debug, $jwtToken);
};
$container['AddressController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\AddressController($logger, $db, $cache, $debug,
        $jwtToken);
};
$container['GenderController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\GenderController($logger, $db, $cache, $debug,
        $jwtToken);
};
$container['LanguageController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\LanguageController($logger, $db, $cache, $debug,
        $jwtToken);
};
$container['EthnicityController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\EthnicityController($logger, $db, $cache, $debug,
        $jwtToken);
};
$container['MedicationController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\MedicationController($logger, $db, $cache, $debug,
        $jwtToken);
};
$container['CityDataController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\CityDataController($logger, $db, $cache, $debug,
        $jwtToken);
};
$container['CityDataExtendedController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\CityDataExtendedController($logger, $db, $cache,
        $debug, $jwtToken);
};
$container['ClientController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\ClientController($logger, $db, $cache, $debug,
        $jwtToken);
};
$container['ClientEthnicityController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\ClientEthnicityController($logger, $db, $cache,
        $debug, $jwtToken);
};
$container['ClientLanguageController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\ClientLanguageController($logger, $db, $cache,
        $debug, $jwtToken);
};
$container['CounseleeController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\CounseleeController($logger, $db, $cache, $debug,
        $jwtToken);
};
$container['CounseleeChildController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\CounseleeChildController($logger, $db, $cache,
        $debug, $jwtToken);
};
$container['CounseleeChildBioParentController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\CounseleeChildBioParentController($logger, $db,
        $cache, $debug, $jwtToken);
};
$container['CounseleeChildGuardianController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\CounseleeChildGuardianController($logger, $db,
        $cache, $debug, $jwtToken);
};
$container['CounseleeChildSiblingController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\CounseleeChildSiblingController($logger, $db,
        $cache, $debug, $jwtToken);
};
$container['CounseleeCounselingTopicController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\CounseleeCounselingTopicController($logger, $db,
        $cache, $debug, $jwtToken);
};
$container['CounseleeDrugUseController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\CounseleeDrugUseController($logger, $db, $cache,
        $debug, $jwtToken);
};
$container['CounseleeMedicationController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\CounseleeMedicationController($logger, $db, $cache,
        $debug, $jwtToken);
};
$container['CounselingTopicController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\CounselingTopicController($logger, $db, $cache,
        $debug, $jwtToken);
};
$container['CountyDataController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\CountyDataController($logger, $db, $cache, $debug,
        $jwtToken);
};
$container['DrugUseController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\DrugUseController($logger, $db, $cache, $debug,
        $jwtToken);
};
$container['FundingSourceController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\FundingSourceController($logger, $db, $cache,
        $debug, $jwtToken);
};
$container['IdentityPreferenceController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\IdentityPreferenceController($logger, $db, $cache,
        $debug, $jwtToken);
};
$container['MilitaryDischargeTypeController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\MilitaryDischargeTypeController($logger, $db,
        $cache, $debug, $jwtToken);
};
$container['PersonController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\PersonController($logger, $db, $cache, $debug,
        $jwtToken, $jwtToken);
};
$container['PersonAddressController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\PersonAddressController($logger, $db, $cache,
        $debug, $jwtToken);
};
$container['PersonPhoneController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\PersonPhoneController($logger, $db, $cache, $debug,
        $jwtToken);
};
$container['PhoneController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\PhoneController($logger, $db, $cache, $debug,
        $jwtToken);
};
$container['RoleController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\RoleController($logger, $db, $cache, $debug,
        $jwtToken);
};
$container['SchoolController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\SchoolController($logger, $db, $cache, $debug,
        $jwtToken);
};
$container['ShelterClientController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\ShelterClientController($logger, $db, $cache,
        $debug, $jwtToken);
};
$container['ShelterClientAdditionalStaffController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\ShelterClientAdditionalStaffController($logger,
        $db, $cache, $debug, $jwtToken);
};
$container['ShelterClientFundingSourceController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\ShelterClientFundingSourceController($logger, $db,
        $cache, $debug, $jwtToken);
};
$container['ShelterClientIdentityPreferenceController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\ShelterClientIdentityPreferenceController($logger,
        $db, $cache, $debug, $jwtToken);
};
$container['StateDataController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\StateDataController($logger, $db, $cache, $debug,
        $jwtToken);
};
$container['UserRoleController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\UserRoleController($logger, $db, $cache, $debug,
        $jwtToken);
};
$container['UserViewController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\UserViewController($logger, $db, $cache, $debug,
        $jwtToken);
};
$container['VeteranController'] = function ($c) {
    $logger = $c->get('logger');
    $db = $c->get('db');
    $cache = $c->get('cache');
    $debug = $c->get('settings')['debug'];
    $jwt = $c->get('jwt');
    $jwtToken = $jwt->decoded;
    return new FSS\Controllers\VeteranController($logger, $db, $cache, $debug,
        $jwtToken);
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
