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

$app->post('/genders', 'AddressController:create');
$app->put('/genders/{id:[0-9]+}', 'AddressController:update');
$app->delete('/genders/{id:[0-9]+}', 'AddressController:delete');

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

$app->get('/counselee_children', 'Counselee_childController:readAll');
$app->get('/counselee_children/{id:[0-9]+}', 'Counselee_childController:read');
$app->get('/counselee_children/{filter}/{value}', 'Counselee_childController:readAllWithFilter');

$app->post('/counselee_children', 'Counselee_childController:create');
$app->put('/counselee_children/{id:[0-9]+}', 'Counselee_childController:update');
$app->delete('/counselee_children/{id:[0-9]+}', 'Counselee_childController:delete');

$app->get('/counselee_child_bio_parents', 'Counselee_child_bio_parentController:readAll');
$app->get('/counselee_child_bio_parents/{id:[0-9]+}', 'Counselee_child_bio_parentController:read');
$app->get('/counselee_child_bio_parents/{filter}/{value}', 'Counselee_child_bio_parentController:readAllWithFilter');

$app->post('/counselee_child_bio_parents', 'Counselee_child_bio_parentController:create');
$app->put('/counselee_child_bio_parents/{id:[0-9]+}', 'Counselee_child_bio_parentController:update');
$app->delete('/counselee_child_bio_parents/{id:[0-9]+}', 'Counselee_child_bio_parentController:delete');

$app->get('/counselee_child_guardians', 'Counselee_child_guardianController:readAll');
$app->get('/counselee_child_guardians/{id:[0-9]+}', 'Counselee_child_guardianController:read');
$app->get('/counselee_child_guardians/{filter}/{value}', 'Counselee_child_guardianController:readAllWithFilter');

$app->post('/counselee_child_guardians', 'Counselee_child_guardianController:create');
$app->put('/counselee_child_guardians/{id:[0-9]+}', 'Counselee_child_guardianController:update');
$app->delete('/counselee_child_guardians/{id:[0-9]+}', 'Counselee_child_guardianController:delete');

$app->get('/counselee_child_siblings', 'Counselee_child_siblingController:readAll');
$app->get('/counselee_child_siblings/{id:[0-9]+}', 'Counselee_child_siblingController:read');
$app->get('/counselee_child_siblings/{filter}/{value}', 'Counselee_child_siblingController:readAllWithFilter');

$app->post('/counselee_child_siblings', 'Counselee_child_siblingController:create');
$app->put('/counselee_child_siblings/{id:[0-9]+}', 'Counselee_child_siblingController:update');
$app->delete('/counselee_child_siblings/{id:[0-9]+}', 'Counselee_child_siblingController:delete');

$app->get('/counselee_counseling_topics', 'Counselee_counseling_topicController:readAll');
$app->get('/counselee_counseling_topics/{id:[0-9]+}', 'Counselee_counseling_topicController:read');
$app->get('/counselee_counseling_topics/{filter}/{value}', 'Counselee_counseling_topicController:readAllWithFilter');

$app->post('/counselee_counseling_topics', 'Counselee_counseling_topicController:create');
$app->put('/counselee_counseling_topics/{id:[0-9]+}', 'Counselee_counseling_topicController:update');
$app->delete('/counselee_counseling_topics/{id:[0-9]+}', 'Counselee_counseling_topicController:delete');

$app->get('/counselee_drug_uses', 'Counselee_drug_useController:readAll');
$app->get('/counselee_drug_uses/{id:[0-9]+}', 'Counselee_drug_useController:read');
$app->get('/counselee_drug_uses/{filter}/{value}', 'Counselee_drug_useController:readAllWithFilter');

$app->post('/counselee_drug_uses', 'Counselee_drug_useController:create');
$app->put('/counselee_drug_uses/{id:[0-9]+}', 'Counselee_drug_useController:update');
$app->delete('/counselee_drug_uses/{id:[0-9]+}', 'Counselee_drug_useController:delete');

$app->get('/counselee_medications', 'Counselee_medicationController:readAll');
$app->get('/counselee_medications/{id:[0-9]+}', 'Counselee_medicationController:read');
$app->get('/counselee_medications/{filter}/{value}', 'Counselee_medicationController:readAllWithFilter');

$app->post('/counselee_medications', 'Counselee_medicationController:create');
$app->put('/counselee_medications/{id:[0-9]+}', 'Counselee_medicationController:update');
$app->delete('/counselee_medications/{id:[0-9]+}', 'Counselee_medicationController:delete');

$app->get('/counseling_topics', 'Counseling_topicController:readAll');
$app->get('/counseling_topics/{id:[0-9]+}', 'Counseling_topicController:read');
$app->get('/counseling_topics/{filter}/{value}', 'Counseling_topicController:readAllWithFilter');

$app->post('/counseling_topics', 'Counseling_topicController:create');
$app->put('/counseling_topics/{id:[0-9]+}', 'Counseling_topicController:update');
$app->delete('/counseling_topics/{id:[0-9]+}', 'Counseling_topicController:delete');

$app->get('/county_data', 'County_dataController:readAll');
$app->get('/county_data/{id:[0-9]+}', 'County_dataController:read');
$app->get('/county_data/{filter}/{value}', 'County_dataController:readAllWithFilter');

$app->post('/county_data', 'County_dataController:create');
$app->put('/county_data/{id:[0-9]+}', 'County_dataController:update');
$app->delete('/county_data/{id:[0-9]+}', 'County_dataController:delete');

$app->get('/drug_use', 'Drug_useController:readAll');
$app->get('/drug_use/{id:[0-9]+}', 'Drug_useController:read');
$app->get('/drug_use/{filter}/{value}', 'Drug_useController:readAllWithFilter');

$app->post('/drug_use', 'Drug_useController:create');
$app->put('/drug_use/{id:[0-9]+}', 'Drug_useController:update');
$app->delete('/drug_use/{id:[0-9]+}', 'Drug_useController:delete');

$app->get('/funding_sources', 'Funding_sourceController:readAll');
$app->get('/funding_sources/{id:[0-9]+}', 'Funding_sourceController:read');
$app->get('/funding_sources/{filter}/{value}', 'Funding_sourceController:readAllWithFilter');

$app->post('/funding_sources', 'Funding_sourceController:create');
$app->put('/funding_sources/{id:[0-9]+}', 'Funding_sourceController:update');
$app->delete('/funding_sources/{id:[0-9]+}', 'Funding_sourceController:delete');

$app->get('/identity_preferences', 'Identity_preferenceController:readAll');
$app->get('/identity_preferences/{id:[0-9]+}', 'Identity_preferenceController:read');
$app->get('/identity_preferences/{filter}/{value}', 'Identity_preferenceController:readAllWithFilter');

$app->post('/identity_preferences', 'Identity_preferenceController:create');
$app->put('/identity_preferences/{id:[0-9]+}', 'Identity_preferenceController:update');
$app->delete('/identity_preferences/{id:[0-9]+}', 'Identity_preferenceController:delete');

$app->get('/miltary_discharge_types', 'Military_discharge_typeController:readAll');
$app->get('/miltary_discharge_types/{id:[0-9]+}', 'Military_discharge_typeController:read');
$app->get('/miltary_discharge_types/{filter}/{value}', 'Military_discharge_typeController:readAllWithFilter');

$app->post('/miltary_discharge_types', 'Military_discharge_typeController:create');
$app->put('/miltary_discharge_types/{id:[0-9]+}', 'Military_discharge_typeController:update');
$app->delete('/miltary_discharge_types/{id:[0-9]+}', 'Military_discharge_typeController:delete');

$app->get('/people', 'PersonController:readAll');
$app->get('/people/{id:[0-9]+}', 'PersonController:read');
$app->get('/people/{filter}/{value}', 'PersonController:readAllWithFilter');

$app->post('/people', 'PersonController:create');
$app->put('/people/{id:[0-9]+}', 'PersonController:update');
$app->delete('/people/{id:[0-9]+}', 'PersonController:delete');

$app->get('/person_addresses', 'Person_addressController:readAll');
$app->get('/person_addresses/{id:[0-9]+}', 'Person_addressController:read');
$app->get('/person_addresses/{filter}/{value}', 'Person_addressController:readAllWithFilter');

$app->post('/person_addresses', 'Person_addressController:create');
$app->put('/person_addresses/{id:[0-9]+}', 'Person_addressController:update');
$app->delete('/person_addresses/{id:[0-9]+}', 'Person_addressController:delete');

$app->get('/person_phones', 'Person_phoneController:readAll');
$app->get('/person_phones/{id:[0-9]+}', 'Person_phoneController:read');
$app->get('/person_phones/{filter}/{value}', 'Person_phoneController:readAllWithFilter');

$app->post('/person_phones', 'Person_phoneController:create');
$app->put('/person_phones/{id:[0-9]+}', 'Person_phoneController:update');
$app->delete('/person_phones/{id:[0-9]+}', 'Person_phoneController:delete');

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

$app->get('/shelter_clients', 'Shelter_clientController:readAll');
$app->get('/shelter_clients/{id:[0-9]+}', 'Shelter_clientController:read');
$app->get('/shelter_clients/{filter}/{value}', 'Shelter_clientController:readAllWithFilter');

$app->post('/shelter_clients', 'Shelter_clientController:create');
$app->put('/shelter_clients/{id:[0-9]+}', 'Shelter_clientController:update');
$app->delete('/shelter_clients/{id:[0-9]+}', 'Shelter_clientController:delete');

$app->get('/shelter_client_additional_staff', 'Shelter_client_additional_staffController:readAll');
$app->get('/shelter_client_additional_staff/{id:[0-9]+}', 'Shelter_client_additional_staffController:read');
$app->get('/shelter_client_additional_staff/{filter}/{value}', 'Shelter_client_additional_staffController:readAllWithFilter');

$app->post('/shelter_client_additional_staff', 'Shelter_client_additional_staffController:create');
$app->put('/shelter_client_additional_staff/{id:[0-9]+}', 'Shelter_client_additional_staffController:update');
$app->delete('/shelter_client_additional_staff/{id:[0-9]+}', 'Shelter_client_additional_staffController:delete');

$app->get('/shelter_client_funding_sources', 'Shelter_client_funding_sourceController:readAll');
$app->get('/shelter_client_funding_sources/{id:[0-9]+}', 'Shelter_client_funding_sourceController:read');
$app->get('/shelter_client_funding_sources/{filter}/{value}', 'Shelter_client_funding_sourceController:readAllWithFilter');

$app->post('/shelter_client_funding_sources', 'Shelter_client_funding_sourceController:create');
$app->put('/shelter_client_funding_sources/{id:[0-9]+}', 'Shelter_client_funding_sourceController:update');
$app->delete('/shelter_client_funding_sources/{id:[0-9]+}', 'Shelter_client_funding_sourceController:delete');

$app->get('/shelter_client_identity_preferences', 'Shelter_client_identity_preferenceController:readAll');
$app->get('/shelter_client_identity_preferences/{id:[0-9]+}', 'Shelter_client_identity_preferenceController:read');
$app->get('/shelter_client_identity_preferences/{filter}/{value}',
          'Shelter_client_identity_preferenceController:readAllWithFilter');

$app->post('/shelter_client_identity_preferences', 'Shelter_client_identity_preferenceController:create');
$app->put('/shelter_client_identity_preferences/{id:[0-9]+}', 'Shelter_client_identity_preferenceController:update');
$app->delete('/shelter_client_identity_preferences/{id:[0-9]+}', 'Shelter_client_identity_preferenceController:delete');

$app->get('/state_data', 'State_dataController:readAll');
$app->get('/state_data/{id:[0-9]+}', 'State_dataController:read');
$app->get('/state_data/{filter}/{value}', 'State_dataController:readAllWithFilter');

$app->post('/state_data', 'State_dataController:create');
$app->put('/state_data/{id:[0-9]+}', 'State_dataController:update');
$app->delete('/state_data/{id:[0-9]+}', 'State_dataController:delete');

$app->get('/user_roles', 'User_roleController:readAll');
$app->get('/user_roles/{id:[0-9]+}', 'User_roleController:read');
$app->get('/user_roles/{filter}/{value}', 'User_roleController:readAllWithFilter');

$app->post('/user_roles', 'User_roleController:create');
$app->put('/user_roles/{id:[0-9]+}', 'User_roleController:update');
$app->delete('/user_roles/{id:[0-9]+}', 'User_roleController:delete');

$app->get('/user_views', 'User_viewController:readAll');
$app->get('/user_views/{id:[0-9]+}', 'User_viewController:read');
$app->get('/user_views/{filter}/{value}', 'User_viewController:readAllWithFilter');

$app->post('/user_views', 'User_viewController:create');
$app->put('/user_views/{id:[0-9]+}', 'User_viewController:update');
$app->delete('/user_views/{id:[0-9]+}', 'User_viewController:delete');

$app->get('/veterans', 'VeteranController:readAll');
$app->get('/veterans/{id:[0-9]+}', 'VeteranController:read');
$app->get('/veterans/{filter}/{value}', 'VeteranController:readAllWithFilter');

$app->post('/veterans', 'VeteranController:create');
$app->put('/veterans/{id:[0-9]+}', 'VeteranController:update');
$app->delete('/veterans/{id:[0-9]+}', 'VeteranController:delete');
