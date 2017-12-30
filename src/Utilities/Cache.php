<?php
namespace FSS\Utilities;

use Monolog\Logger;

/**
 * The Cache class provides caching
 * through the opcache functionality
 * in PHP.
 *
 * This should only be used
 * for objects and arrays.
 *
 * @author Dewayne
 *        
 */
class Cache
{

    // The logger, referenced in the constructor.
    private $logger;

    /**
     * The constructor.
     * It makes the Logger available.
     *
     * @param Logger $c
     */
    public function __construct(Logger $c)
    {
        $this->logger = $c;
        // if($this->container['settings']['debug']) {
        // }
    }

    /**
     * Makes a Cache item.
     *
     * @param string $key
     * @param object $val
     */
    public function set(string $key, $val)
    {
        $val = var_export($val, true);
        
        // Write to temp file first to ensure atomicity
        $tmp = "/tmp/$key." . uniqid('', true) . '.tmp';
        
        file_put_contents($tmp, '<?php $val = ' . $val . ';', LOCK_EX);
        
        rename($tmp, "/tmp/$key");
        
        $this->logger->debug("Cached $key.");
    }

    /**
     * Returns either the cached item at the specified $key or
     * false.
     *
     * @param string $key
     * @return object|boolean
     */
    public function get(string $key)
    {
        // Arbitrarily setting max ttl to one hour for these Cache items
        $ttl = 3600;
        $val = null;
        $this->logger->debug("Retrieving Cache item $key.");
        if (file_exists("/tmp/$key") &&
             ((time() - filemtime("/tmp/$key")) > $ttl)) {
            opcache_invalidate("/tmp/$key", true);
            unlink("/tmp/$key");
            $this->logger->debug("TTL exceeded. Cache item $key invalidated.");
        }
        @include "/tmp/$key";
        return isset($val) ? $val : false;
    }
}
?>