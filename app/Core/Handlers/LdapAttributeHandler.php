<?
namespace App\Core\Handlers;

use App\Domains\Access\User as EloquentUser;
use Adldap\Models\User as LdapUser;

class LdapAttributeHandler
{
    /**
     * Synchronizes ldap attributes to the specified model.
     *
     * @param LdapUser     $ldapUser
     * @param EloquentUser $eloquentUser
     *
     * @return void
     */
    public function handle(LdapUser $ldapUser, EloquentUser $eloquentUser)
    {
        $eloquentUser->username = $ldapUser->getAccountName();
        //$eloquentUser->name = $ldapUser->getDisplayName();
        //$eloquentUser->email = strtolower($ldapUser->getUserPrincipalName());
        //$eloquentUser->orgao = convert_dn($ldapUser->getDn());
    }
}