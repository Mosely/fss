<?php
namespace FSS\Controllers;

//require '../src/Models/address.php';
//require '../src/Models/city_data.php';
//require '../src/Models/state_data.php';
//require '../src/Models/county_data.php';

use FSS\Models\Address;

class AddressController implements ControllerInterface
{

    private $container;

    public function __construct($c)
    {
        $this->container = $c;
        if ($this->container['settings']['debug']) {
            $this->container['logger']->debug("Enabling query log for the Address Controller.");
            $this->container['db']::enableQueryLog();
        }
    }

    public function read($request, $response, $args)
    {
        $id = $args['id'];
        $args['filter'] = "id";
        $args['value'] = $id;
        
        // $this->container['logger']->info("Reading address with id of $id");
        $this->container['logger']->debug("Reading address with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    public function readAll($request, $response, $args)
    {
        $records = Address::with([
            'city_data',
            'state_data',
            'county_data'
        ])->get();
        $this->container['logger']->debug("All addresses query: ", $this->container['db']::getQueryLog());
        // $records = Address::all();
        return $response->withJson([
            "success" => true,
            "message" => "All Addresses returned",
            "data" => $records
        ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public function readAllWithFilter($request, $response, $args)
    {
        $filter = $args['filter'];
        $value = $args['value'];
        
        try {
            Address::validateColumn('address', $filter, $this->container);
            $records = Address::with([
                'city_data',
                'state_data',
                'county_data'
            ])->where($filter, $value)->get();
            $this->container['logger']->debug("Address filter query: ", $this->container['db']::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson([
                    "success" => true,
                    "message" => "No Address found",
                    "data" => $records
                ], 404);
            }
            return $response->withJson([
                "success" => true,
                "message" => "Filtered Addresses by $filter",
                "data" => $records
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return $response->withJson([
                "success" => false,
                "message" => "Error occured: " . $e->getMessage()
            ], 400);
        }
    }

    public function create($request, $response, $args)
    {
        // Make sure the frontend only puts the name attribute on form elements that actually contain data for the record.
        $recordData = $request->getParsedBody();
        try {
            foreach ($recordData as $key => $val) {
                Address::validateColumn('address', $key, $this->container);
            }
            $recordId = Address::insertGetId($recordData);
            $this->container['logger']->debug("Address create query: ", $this->container['db']::getQueryLog());
            return $response->withJson([
                "success" => true,
                "message" => "Address $recordId has been created."
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return $response->withJson([
                "success" => false,
                "message" => "Error occured: " . $e->getMessage()
            ], 400);
        }
    }

    public function update($request, $response, $args)
    {
        //$id = $args['id'];
        $recordData = $request->getParsedBody();
        try {
            $updateData = [];
            foreach ($recordData as $key => $val) {
                Address::validateColumn('address', $key, $this->container);
                $updateData = array_merge($updateData, [
                    $key => $val
                ]);
            }
            $recordId = Address::update($updateData);
            $this->container['logger']->debug("Address update query: ", $this->container['db']::getQueryLog());
            return $response->withJson([
                "success" => true,
                "message" => "Updated Address $recordId"
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return $response->withJson([
                "success" => false,
                "message" => "Error occured: " . $e->getMessage()
            ], 400);
        }
    }

    public function delete($request, $response, $args)
    {
        $id = $args['id'];
        try {
            $record = Address::findOrFail($id);
            $record->delete();
            $this->container['logger']->debug("Address delete query: ", $this->container['db']::getQueryLog());
            return $response->withJson([
                "success" => true,
                "message" => "Deleted Address $id"
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return $response->withJson([
                "success" => false,
                "message" => "Address not found"
            ], 404);
        }
    }
}
