<?php
namespace FSS\Controllers;

/**
 * The ControllerInterface will help ensure
 * uniformity among the controller classes and guarantee
 * that the required functions exist for the HTTP
 * endpoints.
 *
 * It should be implemented by every Controller.
 *
 * @author Dewayne
 *        
 */
interface ControllerInterface
{

    /**
     * The create function is responsible for adding a record
     * as indicated in the controller that implements this interface.
     *
     * @param unknown $request
     * @param unknown $response
     * @param unknown $args
     */
    public function create($request, $response, $args);

    /**
     * The read function will return one record.
     *
     * @param unknown $request
     * @param unknown $response
     * @param unknown $args
     */
    public function read($request, $response, $args);

    /**
     * The readAll function will return all records.
     *
     * @param unknown $request
     * @param unknown $response
     * @param unknown $args
     */
    public function readAll($request, $response, $args);

    /**
     * The readAllWithFilter will return record that match
     * the given criteria.
     *
     * @param unknown $request
     * @param unknown $response
     * @param unknown $args
     */
    public function readAllWithFilter($request, $response, $args);

    /**
     * The update function will update the given record
     *
     * @param unknown $request
     * @param unknown $response
     * @param unknown $args
     */
    public function update($request, $response, $args);

    /**
     * The delete function will delete the given record.
     *
     * @param unknown $request
     * @param unknown $response
     * @param unknown $args
     */
    public function delete($request, $response, $args);
}
