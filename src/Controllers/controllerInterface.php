<?php
namespace FSS\Controllers;

interface ControllerInterface
{
/**
 * The create function is responsible for adding a record as indicated in the controller that implements this interface.
 * @param unknown $request
 * @param unknown $response
 * @param unknown $args
 */
    public function create($request, $response, $args);

    public function read($request, $response, $args);

    public function readAll($request, $response, $args);

    public function readAllWithFilter($request, $response, $args);

    public function update($request, $response, $args);

    public function delete($request, $response, $args);
}