<?php
namespace App\Http\Middleware;

use Closure;
use Lavamenu;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Lavamenu::make('sideMenu', function ($menu) {
            $menu->add('Dashboard', 'dashboard')
                 ->data('icon', 'fa fa-home')
                 ->data('with-header', true)
                 ->active('dashboard/*');
            
            /* Single Line Diagram */
            $menu->add('Master Data', '#')
                 ->data('icon', 'fa fa-database icon')
                 ->data('with-header', true)
                 ->active('master/*');

            $menu->masterData
                 ->add('Data Event', 'master/event');
        });

        Lavamenu::make('footMenu', function ($menu) {
            /* User */
                $menu->add('Logout', 'javascript:void(0)')
                     ->data('icon', 'fa fa-sign-out')
                     // ->data('perms', 'setting user')
                     ->data('with-header', false)
                     ->link->attr(['class' => 'logout']);
                // $menu->user->add('Profile', 'profile')
                    // ->data('perms', 'setting user')
                    // ;
                // $menu->user->add('Logout', 'javascript:void(0)')
                    // ->data('perms', 'setting user')
                    // ->link->attr(['class' => 'logout']);
            /* End of User */

            $menu->add('Setting', 'setting')
                 // ->data('perms', 'setting role')
                 ->data('icon', 'fa fa-cog')
                 ->active('setting/*');
        });

        return $next($request);
    }
}
