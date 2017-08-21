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

$app->post('/addresses', 'AddressController:create');
$app->put('/addresses/{id:[0-9]+}', 'AddressController:update');
$app->delete('/addresses/{id:[0-9]+}', 'AddressController:delete');

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

$app->get('/counseleechildren', 'Counselee_childController:readAll');
$app->get('/counseleechildren/{id:[0-9]+}', 'Counselee_childController:read');
$app->get('/counseleechildren/{filter}/{value}',
    'Counselee_childController:readAllWithFilter');

$app->post('/counseleechildren', 'Counselee_childController:create');
$app->put('/counseleechildren/{id:[0-9]+}', 'Counselee_childController:update');
$app->delete('/counseleechildren/{id:[0-9]+}',
    'Counselee_childController:delete');

$app->get('/counseleechildbioparents',
    'Counselee_child_bio_parentController:readAll');
$app->get('/counseleechildbioparents/{id:[0-9]+}',
    'Counselee_child_bio_parentController:read');
$app->get('/counseleechildbioparents/{filter}/{value}',
    'Counselee_child_bio_parentController:readAllWithFilter');

$app->post('/counseleechildbioparents',
    'Counselee_child_bio_parentController:create');
$app->put('/counseleechildbioparents/{id:[0-9]+}',
    'Counselee_child_bio_parentController:update');
$app->delete('/counseleechildbioparents/{id:[0-9]+}',
    'Counselee_child_bio_parentController:delete');

$app->get('/counseleechildguardians',
    'Counselee_child_guardianController:readAll');
$app->get('/counseleechildguardians/{id:[0-9]+}',
    'Counselee_child_guardianController:read');
$app->get('/counseleechildguardians/{filter}/{value}',
    'Counselee_child_guardianController:readAllWithFilter');

$app->post('/counseleechildguardians',
    'Counselee_child_guardianController:create');
$app->put('/counseleechildguardians/{id:[0-9]+}',
    'Counselee_child_guardianController:update');
$app->delete('/counseleechildguardians/{id:[0-9]+}',
    'Counselee_child_guardianController:delete');

$app->get('/counseleechildsiblings',
    'Counselee_child_siblingController:readAll');
$app->get('/counseleechildsiblings/{id:[0-9]+}',
    'Counselee_child_siblingController:read');
$app->get('/counseleechildsiblings/{filter}/{value}',
    'Counselee_child_siblingController:readAllWithFilter');

$app->post('/counseleechildsiblings',
    'Counselee_child_siblingController:create');
$app->put('/counseleechildsiblings/{id:[0-9]+}',
    'Counselee_child_siblingController:update');
$app->delete('/counseleechildsiblings/{id:[0-9]+}',
    'Counselee_child_siblingController:delete');

$app->get('/counseleecounselingtopics',
    'Counselee_counseling_topicController:readAll');
$app->get('/counseleecounselingtopics/{id:[0-9]+}',
    'Counselee_counseling_topicController:read');
$app->get('/counseleecounselingtopics/{filter}/{value}',
    'Counselee_counseling_topicController:readAllWithFilter');

$app->post('/counseleecounselingtopics',
    'Counselee_counseling_topicController:create');
$app->put('/counseleecounselingtopics/{id:[0-9]+}',
    'Counselee_counseling_topicController:update');
$app->delete('/counseleecounselingtopics/{id:[0-9]+}',
    'Counselee_counseling_topicController:delete');

$app->get('/counseleedruguses', 'Counselee_drug_useController:readAll');
$app->get('/counseleedruguses/{id:[0-9]+}',
    'Counselee_drug_useController:read');
$app->get('/counseleedruguses/{filter}/{value}',
    'Counselee_drug_useController:readAllWithFilter');

$app->post('/counseleedruguses', 'Counselee_drug_useController:create');
$app->put('/counseleedruguses/{id:[0-9]+}',
    'Counselee_drug_useController:update');
$app->delete('/counseleedruguses/{id:[0-9]+}',
    'Counselee_drug_useController:delete');

$app->get('/counseleemedications', 'Counselee_medicationController:readAll');
$app->get('/counseleemedications/{id:[0-9]+}',
    'Counselee_medicationController:read');
$app->get('/counseleemedications/{filter}/{value}',
    'Counselee_medicationController:readAllWithFilter');

$app->post('/counseleemedications', 'Counselee_medicationController:create');
$app->put('/counseleemedications/{id:[0-9]+}',
    'Counselee_medicationController:update');
$app->delete('/counseleemedications/{id:[0-9]+}',
    'Counselee_medicationController:delete');

$app->get('/counselingtopics', 'Counseling_topicController:readAll');
$app->get('/counselingtopics/{id:[0-9]+}', 'Counseling_topicController:read');
$app->get('/counselingtopics/{filter}/{value}',
    'Counseling_topicController:readAllWithFilter');

$app->post('/counselingtopics', 'Counseling_topicController:create');
$app->put('/counselingtopics/{id:[0-9]+}', 'Counseling_topicController:update');
$app->delete('/counselingtopics/{id:[0-9]+}',
    'Counseling_topicController:delete');

$app->get('/countydata', 'County_dataController:readAll');
$app->get('/countydata/{id:[0-9]+}', 'County_dataController:read');
$app->get('/countydata/{filter}/{value}',
    'County_dataController:readAllWithFilter');

$app->post('/countydata', 'County_dataController:create');
$app->put('/countydata/{id:[0-9]+}', 'County_dataController:update');
$app->delete('/countydata/{id:[0-9]+}', 'County_dataController:delete');

$app->get('/druguses', 'Drug_useController:readAll');
$app->get('/druguses/{id:[0-9]+}', 'Drug_useController:read');
$app->get('/druguses/{filter}/{value}', 'Drug_useController:readAllWithFilter');

$app->post('/druguses', 'Drug_useController:create');
$app->put('/druguses/{id:[0-9]+}', 'Drug_useController:update');
$app->delete('/druguses/{id:[0-9]+}', 'Drug_useController:delete');

$app->get('/fundingsources', 'Funding_sourceController:readAll');
$app->get('/fundingsources/{id:[0-9]+}', 'Funding_sourceController:read');
$app->get('/fundingsources/{filter}/{value}',
    'Funding_sourceController:readAllWithFilter');

$app->post('/fundingsources', 'Funding_sourceController:create');
$app->put('/fundingsources/{id:[0-9]+}', 'Funding_sourceController:update');
$app->delete('/fundingsources/{id:[0-9]+}', 'Funding_sourceController:delete');

$app->get('/identitypreferences', 'Identity_preferenceController:readAll');
$app->get('/identitypreferences/{id:[0-9]+}',
    'Identity_preferenceController:read');
$app->get('/identitypreferences/{filter}/{value}',
    'Identity_preferenceController:readAllWithFilter');

$app->post('/identitypreferences', 'Identity_preferenceController:create');
$app->put('/identitypreferences/{id:[0-9]+}',
    'Identity_preferenceController:update');
$app->delete('/identitypreferences/{id:[0-9]+}',
    'Identity_preferenceController:delete');

$app->get('/miltarydischargetypes',
    'Military_discharge_typeController:readAll');
$app->get('/miltarydischargetypes/{id:[0-9]+}',
    'Military_discharge_typeController:read');
$app->get('/miltarydischargetypes/{filter}/{value}',
    'Military_discharge_typeController:readAllWithFilter');

$app->post('/miltarydischargetypes',
    'Military_discharge_typeController:create');
$app->put('/miltarydischargetypes/{id:[0-9]+}',
    'Military_discharge_typeController:update');
$app->delete('/miltarydischargetypes/{id:[0-9]+}',
    'Military_discharge_typeController:delete');

$app->get('/people', 'PersonController:readAll');
$app->get('/people/{id:[0-9]+}', 'PersonController:read');
$app->get('/people/{filter}/{value}', 'PersonController:readAllWithFilter');

$app->post('/people', 'PersonController:create');
$app->put('/people/{id:[0-9]+}', 'PersonController:update');
$app->delete('/people/{id:[0-9]+}', 'PersonController:delete');

$app->get('/personaddresses', 'Person_addressController:readAll');
$app->get('/personaddresses/{id:[0-9]+}', 'Person_addressController:read');
$app->get('/personaddresses/{filter}/{value}',
    'Person_addressController:readAllWithFilter');

$app->post('/personaddresses', 'Person_addressController:create');
$app->put('/personaddresses/{id:[0-9]+}', 'Person_addressController:update');
$app->delete('/personaddresses/{id:[0-9]+}', 'Person_addressController:delete');

$app->get('/personphones', 'Person_phoneController:readAll');
$app->get('/personphones/{id:[0-9]+}', 'Person_phoneController:read');
$app->get('/personphones/{filter}/{value}',
    'Person_phoneController:readAllWithFilter');

$app->post('/personphones', 'Person_phoneController:create');
$app->put('/personphones/{id:[0-9]+}', 'Person_phoneController:update');
$app->delete('/personphones/{id:[0-9]+}', 'Person_phoneController:delete');

$app->get('/phones', 'PhoneController:readAll');
$app->get('/phones/{id:[0-9]+}', 'PhoneController:read');
$app->get('/phones/{filter}/{value}', 'PhoneController:readAllWithFilter');

$app->post('/phones', 'PhoneController:create');
$app->put('/phones/{id:[0-9]+}', 'PhoneController:update');
$app->delete('/phones/{id:[0-9]+}', 'PhoneController:delete');

$app->get('/roles', 'RoleController:readAll');
$app->get('/roles/{id:[0-9]+}', 'RoleController:read');
$app->get('/roles/{filter}/{value}', 'RoleController:readAllWithFilter');

$app->post('/roles', 'RoleController:create');
$app->put('/roles/{id:[0-9]+}', 'RoleController:update');
$app->delete('/roles/{id:[0-9]+}', 'RoleController:delete');

$app->get('/schools', 'SchoolController:readAll');
$app->get('/schools/{id:[0-9]+}', 'SchoolController:read');
$app->get('/schools/{filter}/{value}', 'SchoolController:readAllWithFilter');

$app->post('/schools', 'SchoolController:create');
$app->put('/schools/{id:[0-9]+}', 'SchoolController:update');
$app->delete('/schools/{id:[0-9]+}', 'SchoolController:delete');

$app->get('/shelterclients', 'Shelter_clientController:readAll');
$app->get('/shelterclients/{id:[0-9]+}', 'Shelter_clientController:read');
$app->get('/shelterclients/{filter}/{value}',
    'Shelter_clientController:readAllWithFilter');

$app->post('/shelterclients', 'Shelter_clientController:create');
$app->put('/shelterclients/{id:[0-9]+}', 'Shelter_clientController:update');
$app->delete('/shelterclients/{id:[0-9]+}', 'Shelter_clientController:delete');

$app->get('/shelterclientadditionalstaff',
    'Shelter_client_additional_staffController:readAll');
$app->get('/shelterclientadditionalstaff/{id:[0-9]+}',
    'Shelter_client_additional_staffController:read');
$app->get('/shelterclientadditionalstaff/{filter}/{value}',
    'Shelter_client_additional_staffController:readAllWithFilter');

$app->post('/shelterclientadditionalstaff',
    'Shelter_client_additional_staffController:create');
$app->put('/shelterclientadditionalstaff/{id:[0-9]+}',
    'Shelter_client_additional_staffController:update');
$app->delete('/shelterclientadditionalstaff/{id:[0-9]+}',
    'Shelter_client_additional_staffController:delete');

$app->get('/shelterclientfundingsources',
    'Shelter_client_funding_sourceController:readAll');
$app->get('/shelterclientfundingsources/{id:[0-9]+}',
    'Shelter_client_funding_sourceController:read');
$app->get('/shelterclientfundingsources/{filter}/{value}',
    'Shelter_client_funding_sourceController:readAllWithFilter');

$app->post('/shelterclientfundingsources',
    'Shelter_client_funding_sourceController:create');
$app->put('/shelterclientfundingsources/{id:[0-9]+}',
    'Shelter_client_funding_sourceController:update');
$app->delete('/shelterclientfundingsources/{id:[0-9]+}',
    'Shelter_client_funding_sourceController:delete');

$app->get('/shelterclientidentitypreferences',
    'Shelter_client_identity_preferenceController:readAll');
$app->get('/shelterclientidentitypreferences/{id:[0-9]+}',
    'Shelter_client_identity_preferenceController:read');
$app->get('/shelterclientidentitypreferences/{filter}/{value}',
    'Shelter_client_identity_preferenceController:readAllWithFilter');

$app->post('/shelterclientidentitypreferences',
    'Shelter_client_identity_preferenceController:create');
$app->put('/shelterclientidentitypreferences/{id:[0-9]+}',
    'Shelter_client_identity_preferenceController:update');
$app->delete('/shelterclientidentitypreferences/{id:[0-9]+}',
    'Shelter_client_identity_preferenceController:delete');

$app->get('/statedata', 'State_dataController:readAll');
$app->get('/statedata/{id:[0-9]+}', 'State_dataController:read');
$app->get('/statedata/{filter}/{value}',
    'State_dataController:readAllWithFilter');

$app->post('/statedata', 'State_dataController:create');
$app->put('/statedata/{id:[0-9]+}', 'State_dataController:update');
$app->delete('/statedata/{id:[0-9]+}', 'State_dataController:delete');

$app->get('/userroles', 'User_roleController:readAll');
$app->get('/userroles/{id:[0-9]+}', 'User_roleController:read');
$app->get('/userroles/{filter}/{value}',
    'User_roleController:readAllWithFilter');

$app->post('/userroles', 'User_roleController:create');
$app->put('/userroles/{id:[0-9]+}', 'User_roleController:update');
$app->delete('/userroles/{id:[0-9]+}', 'User_roleController:delete');

$app->get('/userviews', 'User_viewController:readAll');
$app->get('/userviews/{id:[0-9]+}', 'User_viewController:read');
$app->get('/userviews/{filter}/{value}',
    'User_viewController:readAllWithFilter');

$app->post('/userviews', 'User_viewController:create');
$app->put('/userviews/{id:[0-9]+}', 'User_viewController:update');
$app->delete('/userviews/{id:[0-9]+}', 'User_viewController:delete');

$app->get('/veterans', 'VeteranController:readAll');
$app->get('/veterans/{id:[0-9]+}', 'VeteranController:read');
$app->get('/veterans/{filter}/{value}', 'VeteranController:readAllWithFilter');

$app->post('/veterans', 'VeteranController:create');
$app->put('/veterans/{id:[0-9]+}', 'VeteranController:update');
$app->delete('/veterans/{id:[0-9]+}', 'VeteranController:delete');
