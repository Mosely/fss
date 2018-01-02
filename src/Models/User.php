<?php
namespace FSS\Models;

use \Exception;
use Monolog\Logger;
use Illuminate\Database\Capsule\Manager;
use FSS\Utilities\Cache;

/**
 * The "user" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="User",
 *         @SWG\Property(name="id", type="integer", required=true),
 *         @SWG\Property(name="username", type="string", required=true),
 *         @SWG\Property(name="email", type="string", required=true),
 *         @SWG\Property(name="password", type="string", required=true),
 *         @SWG\Property(name="password_created_at", type="integer", required=true),
 *         @SWG\Property(name="is_disabled", type="boolean", required=true),
 *         @SWG\Property(name="created_at", type="integer", required=false),
 *         @SWG\Property(name="updated_at", type="integer", required=false),
 *         @SWG\Property(name="updated_by", type="integer", required=true)
 *         )
 */
class User extends AbstractModel
{

    protected $table = "user";

    protected $primaryKey = "id";

    protected $fillable = array(
        'username',
        'email',
        'password',
        'password_created_at',
        'is_disabled',
        'updated_by'
    );

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
    public function validatePassword(string $password): bool
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
        if (password_verify($password, $passwordHash)) {
            if (password_needs_rehash($passwordHash, PASSWORD_DEFAULT)) {
                // If so, create a new hash, and replace the old one
                $newHash = password_hash($password, PASSWORD_DEFAULT);
                $updateData = [];
                $updateData['password'] = $newHash;
                User::update($updateData);
            }
        } else {
            throw new Exception("Incorrect password.");
        }
    }

    /**
     * This will try to authenticate a user
     *
     * @param array $userData
     * @param Logger $logger
     * @param Cache $cache
     * @param Manager $db
     * @param string $table
     * @throws Exception
     * @return string
     */
    public function authenticate(array $userData, Logger $logger, Cache $cache,
        Manager $db, string $table): string
    {
        try {
            
            foreach ($userData as $key => $val) {
                parent::validateColumn($key, $logger, $cache, $db);
                $logger->debug("POST values: ",
                    $key . " => " . $val);
            }
            
            $user = User::select('password', 'id', 'username', 'is_disabled')->where(
                'username', '=', $userData['username'])->firstOrFail();
            
            $logger->debug("User login query: ", $db::getQueryLog());
            
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

    public function ShelterClient()
    {
        return $this->hasMany('FSS\Models\ShelterClient');
    }

    public function UserRole()
    {
        return $this->hasMany('FSS\Models\UserRole');
    }

    public function ShelterClientAdditionalStaff()
    {
        return $this->hasOne('FSS\Models\ShelterClientAdditionalStaff');
    }
    // getters and setters if you want and other logic
}
