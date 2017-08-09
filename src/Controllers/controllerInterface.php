<?php
namespace FSS\Controllers;

interface ControllerInterface
{

    public function create($request, $response, $args);

    public function read($request, $response, $args);

    public function readAll($request, $response, $args);

    public function readAllWithFilter($request, $response, $args);

    public function update($request, $response, $args);

    public function delete($request, $response, $args);
}