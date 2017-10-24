<?php
namespace App\Core\Http\Middleware;
use App\Domains\Access\Repositories\Contracts\RoleRepository;
use Closure;
class VerifyUserRole
{
    private $role;
    public function __construct(RoleRepository $role)
    {
        $this->role = $role;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $autorizedUsers = [
            '00545841240','50984926291','289505'
        ];

        if (auth()->check()){
            if (auth()->user()->roles()->count() <= 0){
                if (in_array(auth()->user()->username,$autorizedUsers)){
                    auth()->user()->roles()->attach($this->role->find(1));
                }else{
                    auth()->user()->roles()->attach($this->role->find(3));
                }
            }
        }
        return $next($request);
    }
}