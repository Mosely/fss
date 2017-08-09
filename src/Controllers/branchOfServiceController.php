<?php
namespace FSS\Controllers;

//require '../src/Models/branch_of_service.php';

use FSS\Models\Branch_of_service;

class BranchOfServiceController
{

    private $container;

    public function __construct($c)
    {
        $this->container = $c;
        if ($this->container['settings']['debug']) {
            $this->container['logger']->debug("Enabling query log for the Branch Of Service Controller.");
            $this->container['db']::enableQueryLog();
        }
    }

    public function readBranchOfService($request, $response, $args)
    {
        $id = $args['id'];
        $args['filter'] = "id";
        $args['value'] = $id;
        return $this->readAllBranchesOfServiceWithFilter($request, $response, $args);
    }

    public function readAllBranchesOfService($request, $response, $args)
    {
        $records = Branch_of_service::all();
        return $response->withJson([
            "success" => true,
            "message" => "All branches_of_service returned",
            "data" => $records
        ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public function readAllBranchesOfServiceWithFilter($request, $response, $args)
    {
        $filter = $args['filter'];
        $value = $args['value'];
        
        try {
            Branch_of_service::validateColumn('branch_of_service', $filter, $this->container);
            $records = Branch_of_service::where($filter, $value)->get();
            if ($records->isEmpty()) {
                return $response->withJson([
                    "success" => true,
                    "message" => "No branches_of_service found",
                    "data" => $records
                ], 404);
            }
            return $response->withJson([
                "success" => true,
                "message" => "Filtered branches_of_service by $filter",
                "data" => $records
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return $response->withJson([
                "success" => false,
                "message" => "Error occured: " . $e->getMessage()
            ], 400);
        }
    }

    public function createBranchOfService($request, $response, $args)
    {
        // Make sure the frontend only puts the name attribute on form elements that actually contain data for the record.
        $recordData = $request->getParsedBody();
        try {
            foreach ($recordData as $key => $val) {
                Branch_of_service::validateColumn('branch_of_service', $key, $this->container);
            }
            $recordId = Branch_of_service::insertGetId($recordData);
            return $response->withJson([
                "success" => true,
                "message" => "Branch_of_service $recordId has been created."
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return $response->withJson([
                "success" => false,
                "message" => "Error occured: " . $e->getMessage()
            ], 400);
        }
    }

    public function updateBranchOfService($request, $response, $args)
    {
        //$id = $args['id'];
        $recordData = $request->getParsedBody();
        try {
            $updateData = [];
            foreach ($recordData as $key => $val) {
                Branch_of_service::validateColumn('branch_of_service', $key, $this->container);
                $updateData = array_merge($updateData, [
                    $key => $val
                ]);
            }
            $recordId = Branch_of_service::update($updateData);
            return $response->withJson([
                "success" => true,
                "message" => "Updated Branch_of_service $recordId"
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return $response->withJson([
                "success" => false,
                "message" => "Error occured: " . $e->getMessage()
            ], 400);
        }
    }

    public function deleteBranchOfService($request, $response, $args)
    {
        $id = $args['id'];
        try {
            $record = Branch_of_service::findOrFail($id);
            $record->delete();
            return $response->withJson([
                "success" => true,
                "message" => "Deleted Branch_of_service $id"
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return $response->withJson([
                "success" => false,
                "message" => "Branch_of_service not found"
            ], 404);
        }
    }
}
