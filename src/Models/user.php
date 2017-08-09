<?php

namespace FSS\Models;

use \Illuminate\Database\Eloquent\Model;

class User extends CommonModel
{
    protected $table = 'user';
    
    public function validatePassword($password) {
        $r1 = '/[A-Z]/';  //Uppercase
        $r2 = '/[a-z]/';  //lowercase
        $r3 = '/[!@#$%^&*()\-_=+{};:,<.>]/';  // 'special char'
        $r4 = '/[0-9]/';  //numbers
        
        if(preg_match_all($r1, $password) < 1) return false;
        if(preg_match_all($r2, $password) < 1) return false;
        if(preg_match_all($r3, $password) < 1) return false;
        if(preg_match_all($r4, $password) < 1) return false;
        if(strlen($password) < 6) return false;
        return true;
    }
    
    public function verifyPassword($password, $passwordHash) {
        if(!password_verify($password, $passwordHash)){
            throw new \Exception("Incorrect password.");
        }
    }
    
    public function authenticate($userData, $container, $table) {
        try {

            foreach($userData as $key => $val){
                parent::validateColumn($table, $key, $container);
            }

            $user = User::select('password', 'id', 'username', 'is_disabled')
                ->where('username', '=', $userData['username'])
                ->firstOrFail();
            
            $container['logger']->debug("User login query: ", $container['db']::getQueryLog());
                
            if($user->is_disabled != 0) {
                throw new \Exception("Your account has been disabled.");
            }
            
            User::verifyPassword($userData['password'], $user->password);
            
            return strtolower($user->id);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new \Exception("Username is incorrect.");
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    /**
     * Get the person record that has this user.
     */
    public function person()
    {
        return $this->belongsTo('FSS\Models\Person', 'id', 'id');
    }
    //getters and setters if you want and other logic
}
