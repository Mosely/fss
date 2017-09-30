<?php
// Controller definitions
$container['DefaultController'] = function ($c) {
    return new FSS\Controllers\DefaultController();
};
$container['UserController'] = function ($c) {
    return new FSS\Controllers\UserController($c);
};
$container['BranchOfServiceController'] = function ($c) {
    return new FSS\Controllers\BranchOfServiceController($c);
};
$container['AddressController'] = function ($c) {
    return new FSS\Controllers\AddressController($c);
};
$container['GenderController'] = function ($c) {
    return new FSS\Controllers\GenderController($c);
};
$container['LanguageController'] = function ($c) {
    return new FSS\Controllers\LanguageController($c);
};
$container['EthnicityController'] = function ($c) {
    return new FSS\Controllers\EthnicityController($c);
};
$container['MedicationController'] = function ($c) {
    return new FSS\Controllers\MedicationController($c);
};
$container['City_dataController'] = function ($c) {
    return new FSS\Controllers\CityDataController($c);
};
$container['City_data_extendedController'] = function ($c) {
    return new FSS\Controllers\CityDataExtendedController($c);
};
$container['ClientController'] = function ($c) {
    return new FSS\Controllers\ClientController($c);
};
$container['Client_ethnicityController'] = function ($c) {
    return new FSS\Controllers\ClientEthnicityController($c);
};
$container['Client_languageController'] = function ($c) {
    return new FSS\Controllers\ClientLanguageController($c);
};
$container['CounseleeController'] = function ($c) {
    return new FSS\Controllers\CounseleeController($c);
};
$container['Counselee_childController'] = function ($c) {
    return new FSS\Controllers\CounseleeChildController($c);
};
$container['Counselee_child_bio_parentController'] = function ($c) {
    return new FSS\Controllers\CounseleeChildBioParentController($c);
};
$container['Counselee_child_guardianController'] = function ($c) {
    return new FSS\Controllers\CounseleeChildGuardianController($c);
};
$container['Counselee_child_siblingController'] = function ($c) {
    return new FSS\Controllers\CounseleeChildSiblingController($c);
};
$container['Counselee_counseling_topicController'] = function ($c) {
    return new FSS\Controllers\CounseleeCounselingTopicController($c);
};
$container['Counselee_drug_useController'] = function ($c) {
    return new FSS\Controllers\CounseleeDrugUseController($c);
};
$container['Counselee_medicationController'] = function ($c) {
    return new FSS\Controllers\CounseleeMedicationController($c);
};
$container['Counseling_topicController'] = function ($c) {
    return new FSS\Controllers\CounselingTopicController($c);
};
$container['County_dataController'] = function ($c) {
    return new FSS\Controllers\CountyDataController($c);
};
$container['Drug_useController'] = function ($c) {
    return new FSS\Controllers\DrugUseController($c);
};
$container['Funding_sourceController'] = function ($c) {
    return new FSS\Controllers\FundingSourceController($c);
};
$container['Identity_preferenceController'] = function ($c) {
    return new FSS\Controllers\IdentityPreferenceController($c);
};
$container['Military_discharge_typeController'] = function ($c) {
    return new FSS\Controllers\MilitaryDischargeTypeController($c);
};
$container['PersonController'] = function ($c) {
    return new FSS\Controllers\PersonController($c);
};
$container['Person_addressController'] = function ($c) {
    return new FSS\Controllers\PersonAddressController($c);
};
$container['Person_phoneController'] = function ($c) {
    return new FSS\Controllers\PersonPhoneController($c);
};
$container['PhoneController'] = function ($c) {
    return new FSS\Controllers\PhoneController($c);
};
$container['RoleController'] = function ($c) {
    return new FSS\Controllers\RoleController($c);
};
$container['SchoolController'] = function ($c) {
    return new FSS\Controllers\SchoolController($c);
};
$container['Shelter_clientController'] = function ($c) {
    return new FSS\Controllers\ShelterClientController($c);
};
$container['Shelter_client_additional_staffController'] = function ($c) {
    return new FSS\Controllers\ShelterClientAdditionalStaffController($c);
};
$container['Shelter_client_funding_sourceController'] = function ($c) {
    return new FSS\Controllers\ShelterClientFundingSourceController($c);
};
$container['Shelter_client_identity_preferenceController'] = function ($c) {
    return new FSS\Controllers\ShelterClientIdentityPreferenceController($c);
};
$container['State_dataController'] = function ($c) {
    return new FSS\Controllers\StateDataController($c);
};
$container['User_roleController'] = function ($c) {
    return new FSS\Controllers\UserRoleController($c);
};
$container['User_viewController'] = function ($c) {
    return new FSS\Controllers\UserViewController($c);
};
$container['VeteranController'] = function ($c) {
    return new FSS\Controllers\VeteranController($c);
};

