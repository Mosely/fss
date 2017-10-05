<?php
namespace FSS\Controllers;

use FSS\Models\Report;
use FSS\Models\ReportColumn;
use FSS\Models\Dynamic;
use Interop\Container\ContainerInterface;
use \Exception;

/**
 * The controller for report-related actions.
 *
 * Implements the ControllerInterface.
 *
 * @author Dewayne
 *
 */
class ReportController implements ControllerInterface {
    
    // The DI container reference.
    private $container;
    
    /**
     * The constructor that sets the DI Container reference and
     * enable query logging if debug mode is true in settings.php
     *
     * @param ContainerInterface $c
     */
    public function __construct(ContainerInterface $c)
    {
        $this->container = $c;
        if ($this->container['settings']['debug']) {
            $this->container['logger']->debug(
                "Enabling query log for the Report Controller.");
            $this->container['db']::enableQueryLog();
        }
    }
    
    public function read($request, $response, $args)
    {
        $id = $args['id'];
        $args['filter'] = "id";
        $args['value'] = $id;
        
        $this->container['logger']->debug("Reading report with id of $id");
        
        return $this->readAllWithFilter($request, $response, $args);
    }

    public function readAllWithFilter($request, $response, $args)
    {
        
    }

    public function create($request, $response, $args)
    {
        
    }

    public function update($request, $response, $args)
    {
        
    }

    public function delete($request, $response, $args)
    {
        
    }

    public function readAll($request, $response, $args)
    {
        
    }
}