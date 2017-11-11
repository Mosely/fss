<?php
namespace FSS\Controllers;

use FSS\Models\ShelterClientAdditionalStaff;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Logger;
use Illuminate\Database\Capsule\Manager;
use FSS\Utilities\Cache;
use \Exception;

/**
 * The controller for
 * shelter_client_additional_staff-related actions.
 *
 * Implements the ControllerInterface.
 *
 * Borrows from addressController
 *
 * @author Marshal
 *        
 */
class ShelterClientAdditionalStaffController implements ControllerInterface
{

    // The dependencies.
    private $logger;

    private $db;

    private $cache;

    private $debug;

    /**
     * The constructor that sets The dependencies and
     * enable query logging if debug mode is true in settings.php
     *
     * @param Logger $logger
     * @param Manager $db
     * @param Cache $cache
     * @param bool $debug
     */
    public function __construct(Logger $logger, Manager $db, Cache $cache,
        bool $debug)
    {
        $this->logger = $logger;
        $this->db = $db;
        $this->cache = $cache;
        $this->debug = $debug;
        if ($this->debug) {
            $this->logger->debug(
                "Enabling query log for the ShelterClientAdditionalStaff Controller.");
            $this->db::enableQueryLog();
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::read()
     */
    public function read(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $args['filter'] = "id";
        $args['value'] = $id;
        
        $this->logger->debug(
            "Reading ShelterClientAdditionalStaff with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAll()
     */
    public function readAll(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $records = ShelterClientAdditionalStaff::all();
        $this->logger->debug("All ShelterClientAdditionalStaff query: ",
            $this->db::getQueryLog());
        // $records = Shelter_client_additional_staff::all();
        return $response->withJson(
            [
                "success" => true,
                "message" => "All ShelterClientAdditionalStaff returned",
                "data" => $records
            ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::readAllWithFilter()
     */
    public function readAllWithFilter(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $filter = $args['filter'];
        $value = $args['value'];
        
        try {
            ShelterClientAdditionalStaff::validateColumn(
                'ShelterClientAdditionalStaff', $filter, $this->logger,
                $this->cache, $this->db);
            $records = ShelterClientAdditionalStaff::where($filter, $value)->limit(200)->get();
            $this->logger->debug("ShelterClientAdditionalStaff filter query: ",
                $this->db::getQueryLog());
            if ($records->isEmpty()) {
                return $response->withJson(
                    [
                        "success" => true,
                        "message" => "No ShelterClientAdditionalStaff found",
                        "data" => $records
                    ], 404);
            }
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Filtered ShelterClientAdditionalStaff by $filter",
                    "data" => $records
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "Error occured: " . $e->getMessage()
                ], 400);
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::create()
     */
    public function create(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        // Make sure the frontend only puts the name attribute
        // on form elements that actually contain data
        // for the record.
        $recordData = $request->getParsedBody();
        try {
            foreach ($recordData as $key => $val) {
                ShelterClientAdditionalStaff::validateColumn(
                    'ShelterClientAdditionalStaff', $key, $this->logger,
                    $this->cache, $this->db);
            }
            $recordId = ShelterClientAdditionalStaff::insertGetId($recordData);
            $this->logger->debug("ShelterClientAdditionalStaff create query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "ShelterClientAdditionalStaff $recordId has been created."
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "Error occured: " . $e->getMessage()
                ], 400);
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::update()
     */
    public function update(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        // $id = $args['id'];
        $recordData = $request->getParsedBody();
        try {
            $updateData = [];
            foreach ($recordData as $key => $val) {
                ShelterClientAdditionalStaff::validateColumn(
                    'ShelterClientAdditionalStaff', $key, $this->logger,
                    $this->cache, $this->db);
                $updateData = array_merge($updateData,
                    [
                        $key => $val
                    ]);
            }
            $recordId = ShelterClientAdditionalStaff::update($updateData);
            $this->logger->debug("ShelterClientAdditionalStaff update query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Updated ShelterClientAdditionalStaff $recordId"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "Error occured: " . $e->getMessage()
                ], 400);
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \FSS\Controllers\ControllerInterface::delete()
     */
    public function delete(ServerRequestInterface $request,
        ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        try {
            $record = ShelterClientAdditionalStaff::findOrFail($id);
            $record->delete();
            $this->logger->debug("ShelterClientAdditionalStaff delete query: ",
                $this->db::getQueryLog());
            return $response->withJson(
                [
                    "success" => true,
                    "message" => "Deleted ShelterClientAdditionalStaff $id"
                ], 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            return $response->withJson(
                [
                    "success" => false,
                    "message" => "ShelterClientAdditionalStaff not found"
                ], 404);
        }
    }
}
