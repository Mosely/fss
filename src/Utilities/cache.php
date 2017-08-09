<?php

namespace FSS\Utilities;

class Cache 
{
    private $container;
    
    public function __construct($c) {
        $this->container = $c;
        //if($this->container['settings']['debug']) {
        //}
    }
    public function set($key, $val) {
        
        $val = var_export($val, true);
        
        // HHVM fails at __set_state, so just use object cast for now
        $val = str_replace('stdClass::__set_state', '(object)', $val);
        
        // Write to temp file first to ensure atomicity
        $tmp = "/tmp/$key." . uniqid('', true) . '.tmp';
        
        file_put_contents($tmp, '<?php $val = ' . $val . ';', LOCK_EX);
        
        rename($tmp, "/tmp/$key");
        
        $this->container['logger']->debug("Cached $key.");
    }
    
    public function get($key) {
        $this->container['logger']->debug("Retrieving cache item $key.");
        if((time() - filemtime("/tmp/$key")) > 3600 ) {  // Arbitrarily setting max ttl to one hour for these cache items
            opcache_invalidate("/tmp/$key", true);
            unlink("/tmp/$key");
            $this->container['logger']->debug("TTL exceeded. Cache item $key invalidated.");
        }
        @include "/tmp/$key";
        return isset($val) ? $val : false;
    }
}
?>