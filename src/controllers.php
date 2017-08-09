<?php
// Since every controller will be using at least one model,
// and since the models all extend CommonModel,
// we'll go ahead and require commonModel.php here.
require __DIR__ . "/../src/Models/commonModel.php";

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
