<?php
namespace FSS\Utilities;
use Interop\Container\ContainerInterface;

/**
 * The Cache class provides caching 
 * through the opcache functionality
 * in PHP.  THis should only be used 
 * for objects and arrays.
 * 
 * @author Dewayne
 *
 */
class Cache
{

    // The DI container, referenced in the constructor.
    private $container;

    /**
     * The constructor.  It makes the DI container available.
     * 
     * @param ContainerInterface $c
     */
    public function __construct(ContainerInterface $c)
    {
        $this->container = $c;
        // if($this->container['settings']['debug']) {
        // }
    }

    /**
     * Makes a cache item.
     * 
     * @param string $key
     * @param unknown $val
     */
    public function set(string $key, $val)
    {
        $val = var_export($val, true);
        
        // HHVM fails at __set_state, so just use object cast for now
        $val = str_replace('stdClass::__set_state', '(object)', $val);
        
        // Write to temp file first to ensure atomicity
        $tmp = "/tmp/$key." . uniqid('', true) . '.tmp';
        
        file_put_contents($tmp, '<?php $val = ' . $val . ';', LOCK_EX);
        
        rename($tmp, "/tmp/$key");
        
        $this->container['logger']->debug("Cached $key.");
    }

    /**
     * Returns either the cached item at the specified $key or
     * false.
     * 
     * @param string $key
     * @return unknown|boolean
     */
    public function get(string $key)
    {
        // Arbitrarily setting max ttl to one hour for these cache items
        $ttl = 3600;
        $val = null;
        $this->container['logger']->debug("Retrieving cache item $key.");
        if (file_exists("/tmp/$key") && 
            ((time() - filemtime("/tmp/$key")) > $ttl)) { 
            opcache_invalidate("/tmp/$key", true);
            unlink("/tmp/$key");
            $this->container['logger']
                ->debug("TTL exceeded. Cache item $key invalidated.");
        }
        @include "/tmp/$key";
        return isset($val) ? $val : false;
    }
}
?>