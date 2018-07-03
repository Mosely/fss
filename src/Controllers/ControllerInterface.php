<?php
namespace FSS\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

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
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function create(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface;

    /**
     * The read function will return one record.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function read(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface;

    /**
     * The readAll function will return all records.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface;

    /**
     * The readAllWithFilter will return record that match
     * the given criteria.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function readAllWithFilter(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface;

    /**
     * The update function will update the given record
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function update(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface;

    /**
     * The delete function will delete the given record.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface;
}
