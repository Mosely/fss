<?php
namespace FSS\Controllers;

use Exception;

/**
 * The parent class for common code for all controllers.
 *
 * @author Dewayne
 *        
 */
abstract class AbstractController
{

    /**
     * This method will parse any number of property=value
     * pairs from the URL.
     * $filters and $values are by
     * reference, and will contain the filters and values.
     *
     * @param array $params
     * @param array $filters
     * @param array $values
     * @throws Exception
     */
    protected function getFilters(array $params, array &$filters, array &$values)
    {
        $filters = [];
        $values = [];
        for ($i = 0; $i < count($params); $i ++) {
            if ($i % 2 == 0) {
                array_push($filters, $params[$i]);
            } else {
                array_push($values, $params[$i]);
            }
        }
        if (count($filters) != count($values)) {
            throw new Exception(
                "Number of values must " .
                     "match number of filtering properties.");
        }
    }
}
?>