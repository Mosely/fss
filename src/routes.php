<?php
// Routes

// DJH The Controllers will act as the API. Here are there routes.
// Update the routes as new controllers are added.

// $app->get('/users/{id:[0-9]+}', 'UserController:readUser');
$app->get('/', 'DefaultController:indexAction');

$app->get('/users', 'UserController:readAll');
$app->get('/users/{id:[0-9]+}', 'UserController:read');
$app->get('/users/{params:.*}', 'UserController:readAllWithFilter');

$app->post('/users', 'UserController:create');
$app->put('/users/{id:[0-9]+}', 'UserController:update');
$app->delete('/users/{id:[0-9]+}', 'UserController:delete');

$app->post('/login', 'UserController:login');
$app->get('/logout', 'UserController:logout');

$app->get('/branchesofservice', 'BranchOfServiceController:readAll');
$app->get('/branchesofservice/{id:[0-9]+}', 'BranchOfServiceController:read');
$app->get('/branchesofservice/{params:.*}', 'BranchOfServiceController:readAllWithFilter');

$app->get('/addresses', 'AddressController:readAll');
$app->get('/addresses/{id:[0-9]+}', 'AddressController:read');
$app->get('/addresses/{params:.*}', 'AddressController:readAllWithFilter');

$app->post('/addresses', 'AddressController:create');
$app->put('/addresses/{id:[0-9]+}', 'AddressController:update');
$app->delete('/addresses/{id:[0-9]+}', 'AddressController:delete');

$app->get('/genders', 'GenderController:readAll');
$app->get('/genders/{id:[0-9]+}', 'GenderController:read');
$app->get('/genders/{params:.*}', 'GenderController:readAllWithFilter');

$app->post('/genders', 'GenderController:create');
$app->put('/genders/{id:[0-9]+}', 'GenderController:update');
$app->delete('/genders/{id:[0-9]+}', 'GenderController:delete');

$app->get('/languages', 'LanguageController:readAll');
$app->get('/languages/{id:[0-9]+}', 'LanguageController:read');
$app->get('/languages/{params:.*}', 'LanguageController:readAllWithFilter');

$app->post('/languages', 'LanguageController:create');
$app->put('/languages/{id:[0-9]+}', 'LanguageController:update');
$app->delete('/languages/{id:[0-9]+}', 'LanguageController:delete');

$app->get('/ethnicities', 'EthnicityController:readAll');
$app->get('/ethnicities/{id:[0-9]+}', 'EthnicityController:read');
$app->get('/ethnicities/{params:.*}', 'EthnicityController:readAllWithFilter');

$app->post('/ethnicities', 'EthnicityController:create');
$app->put('/ethnicities/{id:[0-9]+}', 'EthnicityController:update');
$app->delete('/ethnicities/{id:[0-9]+}', 'EthnicityController:delete');

$app->get('/medications', 'MedicationController:readAll');
$app->get('/medications/{id:[0-9]+}', 'MedicationController:read');
$app->get('/medications/{params:.*}', 'MedicationController:readAllWithFilter');

$app->post('/medications', 'MedicationController:create');
$app->put('/medications/{id:[0-9]+}', 'MedicationController:update');
$app->delete('/medications/{id:[0-9]+}', 'MedicationController:delete');

$app->get('/citydata', 'CityDataController:readAll');
$app->get('/citydata/{id:[0-9]+}', 'CityDataController:read');
$app->get('/citydata/{params:.*}', 'CityDataController:readAllWithFilter');

$app->post('/citydata', 'CityDataController:create');
$app->put('/citydata/{id:[0-9]+}', 'CityDataController:update');
$app->delete('/citydata/{id:[0-9]+}', 'CityDataController:delete');

$app->get('/citydataextended', 'CityDataExtendedController:readAll');
$app->get('/citydataextended/{id:[0-9]+}', 'CityDataExtendedController:read');
$app->get('/citydataextended/{params:.*}', 'CityDataExtendedController:readAllWithFilter');

$app->post('/citydataextended', 'CityDataExtendedController:create');
$app->put('/citydataextended/{id:[0-9]+}', 'CityDataExtendedController:update');
$app->delete('/citydataextended/{id:[0-9]+}',
    'CityDataExtendedController:delete');

$app->get('/clients', 'ClientController:readAll');
$app->get('/clients/{id:[0-9]+}', 'ClientController:read');
$app->get('/clients/{params:.*}', 'ClientController:readAllWithFilter');

$app->post('/clients', 'ClientController:create');
$app->put('/clients/{id:[0-9]+}', 'ClientController:update');
$app->delete('/clients/{id:[0-9]+}', 'ClientController:delete');

$app->get('/clientethnicities', 'ClientEthnicityController:readAll');
$app->get('/clientethnicities/{id:[0-9]+}', 'ClientEthnicityController:read');
$app->get('/clientethnicities/{params:.*}',
    'ClientEthnicityController:readAllWithFilter');

$app->post('/clientethnicities', 'ClientEthnicityController:create');
$app->put('/clientethnicities/{id:[0-9]+}', 'ClientEthnicityController:update');
$app->delete('/clientethnicities/{id:[0-9]+}',
    'ClientEthnicityController:delete');

$app->get('/clientlanguages', 'ClientLanguageController:readAll');
$app->get('/clientlanguages/{id:[0-9]+}', 'ClientLanguageController:read');
$app->get('/clientlanguages/{params:.*}', 'ClientLanguageController:readAllWithFilter');

$app->post('/clientlanguages', 'ClientLanguageController:create');
$app->put('/clientlanguages/{id:[0-9]+}', 'ClientLanguageController:update');
$app->delete('/clientlanguages/{id:[0-9]+}', 'ClientLanguageController:delete');

$app->get('/counselees', 'CounseleeController:readAll');
$app->get('/counselees/{id:[0-9]+}', 'CounseleeController:read');
$app->get('/counselees/{params:.*}', 'CounseleeController:readAllWithFilter');

$app->post('/counselees', 'CounseleeController:create');
$app->put('/counselees/{id:[0-9]+}', 'CounseleeController:update');
$app->delete('/counselees/{id:[0-9]+}', 'CounseleeController:delete');

$app->get('/counseleechildren', 'CounseleeChildController:readAll');
$app->get('/counseleechildren/{id:[0-9]+}', 'CounseleeChildController:read');
$app->get('/counseleechildren/{params:.*}', 'CounseleeChildController:readAllWithFilter');

$app->post('/counseleechildren', 'CounseleeChildController:create');
$app->put('/counseleechildren/{id:[0-9]+}', 'CounseleeChildController:update');
$app->delete('/counseleechildren/{id:[0-9]+}', 'CounseleeChildController:delete');

$app->get('/counseleechildbioparents',
    'CounseleeChildBioParentController:readAll');
$app->get('/counseleechildbioparents/{id:[0-9]+}',
    'CounseleeChildBioParentController:read');
$app->get('/counseleechildbioparents/{params:.*}',
    'CounseleeChildBioParentController:readAllWithFilter');

$app->post('/counseleechildbioparents',
    'CounseleeChildBioParentController:create');
$app->put('/counseleechildbioparents/{id:[0-9]+}',
    'CounseleeChildBioParentController:update');
$app->delete('/counseleechildbioparents/{id:[0-9]+}',
    'CounseleeChildBioParentController:delete');

$app->get('/counseleechildguardians', 'CounseleeChildGuardianController:readAll');
$app->get('/counseleechildguardians/{id:[0-9]+}',
    'CounseleeChildGuardianController:read');
$app->get('/counseleechildguardians/{params:.*}',
    'CounseleeChildGuardianController:readAllWithFilter');

$app->post('/counseleechildguardians', 'CounseleeChildGuardianController:create');
$app->put('/counseleechildguardians/{id:[0-9]+}',
    'CounseleeChildGuardianController:update');
$app->delete('/counseleechildguardians/{id:[0-9]+}',
    'CounseleeChildGuardianController:delete');

$app->get('/counseleechildsiblings', 'CounseleeChildSiblingController:readAll');
$app->get('/counseleechildsiblings/{id:[0-9]+}',
    'CounseleeChildSiblingController:read');
$app->get('/counseleechildsiblings/{params:.*}',
    'CounseleeChildSiblingController:readAllWithFilter');

$app->post('/counseleechildsiblings', 'CounseleeChildSiblingController:create');
$app->put('/counseleechildsiblings/{id:[0-9]+}',
    'CounseleeChildSiblingController:update');
$app->delete('/counseleechildsiblings/{id:[0-9]+}',
    'CounseleeChildSiblingController:delete');

$app->get('/counseleecounselingtopics',
    'CounseleeCounselingTopicController:readAll');
$app->get('/counseleecounselingtopics/{id:[0-9]+}',
    'CounseleeCounselingTopicController:read');
$app->get('/counseleecounselingtopics/{params:.*}',
    'CounseleeCounselingTopicController:readAllWithFilter');

$app->post('/counseleecounselingtopics',
    'CounseleeCounselingTopicController:create');
$app->put('/counseleecounselingtopics/{id:[0-9]+}',
    'CounseleeCounselingTopicController:update');
$app->delete('/counseleecounselingtopics/{id:[0-9]+}',
    'CounseleeCounselingTopicController:delete');

$app->get('/counseleedruguses', 'CounseleeDrugUseController:readAll');
$app->get('/counseleedruguses/{id:[0-9]+}', 'CounseleeDrugUseController:read');
$app->get('/counseleedruguses/{params:.*}', 'CounseleeDrugUseController:readAllWithFilter');

$app->post('/counseleedruguses', 'CounseleeDrugUseController:create');
$app->put('/counseleedruguses/{id:[0-9]+}', 'CounseleeDrugUseController:update');
$app->delete('/counseleedruguses/{id:[0-9]+}',
    'CounseleeDrugUseController:delete');

$app->get('/counseleemedications', 'CounseleeMedicationController:readAll');
$app->get('/counseleemedications/{id:[0-9]+}',
    'CounseleeMedicationController:read');
$app->get('/counseleemedications/{params:.*}',
    'CounseleeMedicationController:readAllWithFilter');

$app->post('/counseleemedications', 'CounseleeMedicationController:create');
$app->put('/counseleemedications/{id:[0-9]+}',
    'CounseleeMedicationController:update');
$app->delete('/counseleemedications/{id:[0-9]+}',
    'CounseleeMedicationController:delete');

$app->get('/counselingtopics', 'CounselingTopicController:readAll');
$app->get('/counselingtopics/{id:[0-9]+}', 'CounselingTopicController:read');
$app->get('/counselingtopics/{params:.*}',
    'CounselingTopicController:readAllWithFilter');

$app->post('/counselingtopics', 'CounselingTopicController:create');
$app->put('/counselingtopics/{id:[0-9]+}', 'CounselingTopicController:update');
$app->delete('/counselingtopics/{id:[0-9]+}', 'CounselingTopicController:delete');

$app->get('/countydata', 'CountyDataController:readAll');
$app->get('/countydata/{id:[0-9]+}', 'CountyDataController:read');
$app->get('/countydata/{params:.*}', 'CountyDataController:readAllWithFilter');

$app->post('/countydata', 'CountyDataController:create');
$app->put('/countydata/{id:[0-9]+}', 'CountyDataController:update');
$app->delete('/countydata/{id:[0-9]+}', 'CountyDataController:delete');

$app->get('/druguses', 'DrugUseController:readAll');
$app->get('/druguses/{id:[0-9]+}', 'DrugUseController:read');
$app->get('/druguses/{params:.*}', 'DrugUseController:readAllWithFilter');

$app->post('/druguses', 'DrugUseController:create');
$app->put('/druguses/{id:[0-9]+}', 'DrugUseController:update');
$app->delete('/druguses/{id:[0-9]+}', 'DrugUseController:delete');

$app->get('/fundingsources', 'FundingSourceController:readAll');
$app->get('/fundingsources/{id:[0-9]+}', 'FundingSourceController:read');
$app->get('/fundingsources/{params:.*}', 'FundingSourceController:readAllWithFilter');

$app->post('/fundingsources', 'FundingSourceController:create');
$app->put('/fundingsources/{id:[0-9]+}', 'FundingSourceController:update');
$app->delete('/fundingsources/{id:[0-9]+}', 'FundingSourceController:delete');

$app->get('/identitypreferences', 'IdentityPreferenceController:readAll');
$app->get('/identitypreferences/{id:[0-9]+}',
    'IdentityPreferenceController:read');
$app->get('/identitypreferences/{params:.*}',
    'IdentityPreferenceController:readAllWithFilter');

$app->post('/identitypreferences', 'IdentityPreferenceController:create');
$app->put('/identitypreferences/{id:[0-9]+}',
    'IdentityPreferenceController:update');
$app->delete('/identitypreferences/{id:[0-9]+}',
    'IdentityPreferenceController:delete');

$app->get('/miltarydischargetypes', 'MilitaryDischargeTypeController:readAll');
$app->get('/miltarydischargetypes/{id:[0-9]+}',
    'MilitaryDischargeTypeController:read');
$app->get('/miltarydischargetypes/{params:.*}',
    'MilitaryDischargeTypeController:readAllWithFilter');

$app->post('/miltarydischargetypes', 'MilitaryDischargeTypeController:create');
$app->put('/miltarydischargetypes/{id:[0-9]+}',
    'MilitaryDischargeTypeController:update');
$app->delete('/miltarydischargetypes/{id:[0-9]+}',
    'MilitaryDischargeTypeController:delete');

$app->get('/people', 'PersonController:readAll');
$app->get('/people/{id:[0-9]+}', 'PersonController:read');
$app->get('/people/{params:.*}', 'PersonController:readAllWithFilter');

$app->post('/people', 'PersonController:create');
$app->put('/people/{id:[0-9]+}', 'PersonController:update');
$app->delete('/people/{id:[0-9]+}', 'PersonController:delete');

$app->get('/personaddresses', 'PersonAddressController:readAll');
$app->get('/personaddresses/{id:[0-9]+}', 'PersonAddressController:read');
$app->get('/personaddresses/{params:.*}', 'PersonAddressController:readAllWithFilter');

$app->post('/personaddresses', 'PersonAddressController:create');
$app->put('/personaddresses/{id:[0-9]+}', 'PersonAddressController:update');
$app->delete('/personaddresses/{id:[0-9]+}', 'PersonAddressController:delete');

$app->get('/personphones', 'PersonPhoneController:readAll');
$app->get('/personphones/{id:[0-9]+}', 'PersonPhoneController:read');
$app->get('/personphones/{params:.*}', 'PersonPhoneController:readAllWithFilter');

$app->post('/personphones', 'PersonPhoneController:create');
$app->put('/personphones/{id:[0-9]+}', 'PersonPhoneController:update');
$app->delete('/personphones/{id:[0-9]+}', 'PersonPhoneController:delete');

$app->get('/phones', 'PhoneController:readAll');
$app->get('/phones/{id:[0-9]+}', 'PhoneController:read');
$app->get('/phones/{params:.*}', 'PhoneController:readAllWithFilter');

$app->post('/phones', 'PhoneController:create');
$app->put('/phones/{id:[0-9]+}', 'PhoneController:update');
$app->delete('/phones/{id:[0-9]+}', 'PhoneController:delete');

$app->get('/roles', 'RoleController:readAll');
$app->get('/roles/{id:[0-9]+}', 'RoleController:read');
$app->get('/roles/{params:.*}', 'RoleController:readAllWithFilter');

$app->post('/roles', 'RoleController:create');
$app->put('/roles/{id:[0-9]+}', 'RoleController:update');
$app->delete('/roles/{id:[0-9]+}', 'RoleController:delete');

$app->get('/schools', 'SchoolController:readAll');
$app->get('/schools/{id:[0-9]+}', 'SchoolController:read');
$app->get('/schools/{params:.*}', 'SchoolController:readAllWithFilter');

$app->post('/schools', 'SchoolController:create');
$app->put('/schools/{id:[0-9]+}', 'SchoolController:update');
$app->delete('/schools/{id:[0-9]+}', 'SchoolController:delete');

$app->get('/shelterclients', 'ShelterClientController:readAll');
$app->get('/shelterclients/{id:[0-9]+}', 'ShelterClientController:read');
$app->get('/shelterclients/{params:.*}', 'ShelterClientController:readAllWithFilter');

$app->post('/shelterclients', 'ShelterClientController:create');
$app->put('/shelterclients/{id:[0-9]+}', 'ShelterClientController:update');
$app->delete('/shelterclients/{id:[0-9]+}', 'ShelterClientController:delete');

$app->get('/shelterclientadditionalstaff',
    'ShelterClientAdditionalStaffController:readAll');
$app->get('/shelterclientadditionalstaff/{id:[0-9]+}',
    'ShelterClientAdditionalStaffController:read');
$app->get('/shelterclientadditionalstaff/{params:.*}',
    'ShelterClientAdditionalStaffController:readAllWithFilter');

$app->post('/shelterclientadditionalstaff',
    'ShelterClientAdditionalStaffController:create');
$app->put('/shelterclientadditionalstaff/{id:[0-9]+}',
    'ShelterClientAdditionalStaffController:update');
$app->delete('/shelterclientadditionalstaff/{id:[0-9]+}',
    'ShelterClientAdditionalStaffController:delete');

$app->get('/shelterclientfundingsources',
    'ShelterClientFundingSourceController:readAll');
$app->get('/shelterclientfundingsources/{id:[0-9]+}',
    'ShelterClientFundingSourceController:read');
$app->get('/shelterclientfundingsources/{params:.*}',
    'ShelterClientFundingSourceController:readAllWithFilter');

$app->post('/shelterclientfundingsources',
    'ShelterClientFundingSourceController:create');
$app->put('/shelterclientfundingsources/{id:[0-9]+}',
    'ShelterClientFundingSourceController:update');
$app->delete('/shelterclientfundingsources/{id:[0-9]+}',
    'ShelterClientFundingSourceController:delete');

$app->get('/shelterclientidentitypreferences',
    'ShelterClientIdentityPreferenceController:readAll');
$app->get('/shelterclientidentitypreferences/{id:[0-9]+}',
    'ShelterClientIdentityPreferenceController:read');
$app->get('/shelterclientidentitypreferences/{params:.*}',
    'ShelterClientIdentityPreferenceController:readAllWithFilter');

$app->post('/shelterclientidentitypreferences',
    'ShelterClientIdentityPreferenceController:create');
$app->put('/shelterclientidentitypreferences/{id:[0-9]+}',
    'ShelterClientIdentityPreferenceController:update');
$app->delete('/shelterclientidentitypreferences/{id:[0-9]+}',
    'ShelterClientIdentityPreferenceController:delete');

$app->get('/statedata', 'StateDataController:readAll');
$app->get('/statedata/{id:[0-9]+}', 'StateDataController:read');
$app->get('/statedata/{params:.*}', 'StateDataController:readAllWithFilter');

$app->post('/statedata', 'StateDataController:create');
$app->put('/statedata/{id:[0-9]+}', 'StateDataController:update');
$app->delete('/statedata/{id:[0-9]+}', 'StateDataController:delete');

$app->get('/userroles', 'UserRoleController:readAll');
$app->get('/userroles/{id:[0-9]+}', 'UserRoleController:read');
$app->get('/userroles/{params:.*}', 'UserRoleController:readAllWithFilter');

$app->post('/userroles', 'UserRoleController:create');
$app->put('/userroles/{id:[0-9]+}', 'UserRoleController:update');
$app->delete('/userroles/{id:[0-9]+}', 'UserRoleController:delete');

$app->get('/userviews', 'UserViewController:readAll');
$app->get('/userviews/{id:[0-9]+}', 'UserViewController:read');
$app->get('/userviews/{params:.*}', 'UserViewController:readAllWithFilter');

$app->post('/userviews', 'UserViewController:create');
$app->put('/userviews/{id:[0-9]+}', 'UserViewController:update');
$app->delete('/userviews/{id:[0-9]+}', 'UserViewController:delete');

$app->get('/veterans', 'VeteranController:readAll');
$app->get('/veterans/{id:[0-9]+}', 'VeteranController:read');
$app->get('/veterans/{params:.*}', 'VeteranController:readAllWithFilter');

$app->post('/veterans', 'VeteranController:create');
$app->put('/veterans/{id:[0-9]+}', 'VeteranController:update');
$app->delete('/veterans/{id:[0-9]+}', 'VeteranController:delete');

$app->get('/reports', 'ReportController:readAll');
$app->get('/reports/{id:[0-9]+}', 'ReportController:read');
$app->get('/reports/{params:.*}', 'ReportController:readAllWithFilter');

$app->post('/reports', 'ReportController:create');
$app->put('/reports/{id:[0-9]+}', 'ReportController:update');
$app->delete('/reports/{id:[0-9]+}', 'ReportController:delete');

$app->get('/reportoutput/{id:[0-9]+}', 'ReportController:generateReportOutput');
