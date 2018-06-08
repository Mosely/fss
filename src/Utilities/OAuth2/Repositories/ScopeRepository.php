<?php
namespace FSS\Utilities\OAuth2\Repositories;

use FSS\Utilities\OAuth2\Entities\ScopeEntity;
use \League\OAuth2\Server\Entities\ClientEntityInterface;
use \League\OAuth2\Server\Entities\ScopeEntityInterface;
use \League\OAuth2\Server\Repositories\ScopeRepositoryInterface;
use FSS\Models\UserRole;
use FSS\Models\RoleTableAccess;

class ScopeRepository implements ScopeRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function finalizeScopes(
        array $scopes, 
        string $grantType = null, 
        ClientEntityInterface $clientEntity = null, 
        string $userIdentifier = null) : array
    {
        $roles = UserRole::where('user_id', '=', $userIdentifier)->get(['role_id']);
        $accessibleTables = [];
        $scopes = []; // Make sure scopes are always determined by the backend
        
        foreach($roles as $role) {
            $accessibleTablesPerRole = 
                RoleTableAccess::where('role_id', '=', $role->role_id)->get(['table_name']);
            foreach($accessibleTablesPerRole as $table) {
                if(!in_array($table, $accessibleTables)) {
                    $accessibleTables[] = $table;
                }
            }
        }
        
        foreach($accessibleTables as $table) {
            $scope = new ScopeEntity();
            $scope->setIdentifier($table);
            $scopes[] = $scope;
        }
        
        return $scopes;
    }

    /**
     * {@inheritdoc}
     */
    public function getScopeEntityByIdentifier(string $identifier) : ScopeEntityInterface
    {
        $tables = [];
        $allTables = RoleTableAccess::where('role_id', '=', '1')->get(['table_name']);
        foreach($allTables as $table) {
            $tables[] = $table->table_name;
        }
        
        if (!in_array($identifier, $tables)) {
            return;
        }
        
        $scope = new ScopeEntity();
        $scope->setIdentifier($identifier);
        
        return $scope;
    }
}