<?php
namespace FSS\Models;
use \Exception;

/**
 * The user model.
 * 
 * @author Dewayne
 *
 */
class User extends AbstractModel
{
    // The table for this model
    protected $table = 'user';
    
    // There's no need to return these five 
    // columns with every request. Going to
    // override the $hidden from AbstractModel
    protected $hidden = [
        'created_at',
        'updated_at',
        'updated_by',
        'password', 
        'password_created_at'
    ];

    /**
     * Checks to see if the password follows rules.
     * 
     * @param string $password
     * @return boolean
     */
    public function validatePassword(string $password)
    {
        // TODO Think about a way to dynamically load regex from a 
        // config.
        $r1 = '/[A-Z]/'; // Uppercase
        $r2 = '/[a-z]/'; // lowercase
        $r3 = '/[!@#$%^&*()\-_=+{};:,<.>]/'; // 'special char'
        $r4 = '/[0-9]/'; // numbers
        
        if (preg_match_all($r1, $password) < 1)
            return false;
        if (preg_match_all($r2, $password) < 1)
            return false;
        if (preg_match_all($r3, $password) < 1)
            return false;
        if (preg_match_all($r4, $password) < 1)
            return false;
        if (strlen($password) < 6)
            return false;
        return true;
    }
    
    /**
     * Verifies that the password matches the given password hash.
     * 
     * @param string $password
     * @param string $passwordHash
     * @throws Exception
     */
    public function verifyPassword(string $password, string $passwordHash)
    {
        if (! password_verify($password, $passwordHash)) {
            throw new Exception("Incorrect password.");
        }
    }
    
    /**
     * This will try to authenticate a user 
     * 
     * @param unknown $userData
     * @param unknown $container
     * @param string $table
     * @throws Exception
     * @return string
     */
    public function authenticate($userData, $container, string $table)
    {
        try {
            
            foreach ($userData as $key => $val) {
                parent::validateColumn($table, $key, $container);
            }
            
            $user = User::select('password', 'id', 'username', 'is_disabled')
                ->where('username', '=', $userData['username'])
                ->firstOrFail();
            
            $container['logger']
                ->debug("User login query: ", 
                $container['db']::getQueryLog());
            
            if ($user->is_disabled != 0) {
                throw new Exception("Your account has been disabled.");
            }
            
            User::verifyPassword($userData['password'], $user->password);
            
            return strtolower($user->id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new Exception("Username is incorrect.");
        } catch (Exception $e) {
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
    // getters and setters if you want and other logic
}
