<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Menu\Laravel\Facades\Menu;
use Spatie\Menu\Laravel\Link;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('main-menu', function() {
            return Menu::new()
                       ->addClass('nav')
                       ->link('/home', '<i class="fa fa-home icon"></i><span>Home</span>')
                       ->submenu(
                           Link::to('#', '<span class="pull-right text-muted">
                                            <i class="fa fa-fw fa-angle-right text"></i>
                                            <i class="fa fa-fw fa-angle-down text-active"></i>
                                          </span>

                                          <i class="fa fa-bar-chart-o icon"></i><span>Dashboard</span>
                                ')
                               ->addClass('auto'),
                               // ->setAttributes(['data-toggle' => 'dropdown', 'role' => 'button']),
                           Menu::new()
                               ->addClass('nav nav-sub')
                               ->html('<li class="nav-sub-header">
                                           <a href>
                                               <span>Dashboard</span>
                                           </a>
                                       </li>')
                               ->link('/kas-edar', 'Posisi Kas Siap Edar')
                               ->link('/kecukupan-kas', 'Kecukupan Kas')
                               ->link('/kas-titipan', 'Posisi Kas Titipan')
                               ->link('/out-flow', 'Outflow')
                               ->link('/in-flow', 'Inflow')
                               ->link('/pemusnahan', 'Pemusnahan')
                               ->link('/khazanah', 'Kapasitas Khazanah')
                               ->link('/backlog', 'Backlog')
                               ->link('/remise', 'Remise')
                               ->link('#', 'Kas Keliling')
                               ->link('#', 'Kinerja MSUK')
                               ->link('/uyd', 'UYD')
                       )
                       ->submenu(
                           Link::to('#', '<span class="pull-right text-muted">
                                            <i class="fa fa-fw fa-angle-right text"></i>
                                            <i class="fa fa-fw fa-angle-down text-active"></i>
                                          </span>

                                          <i class="fa fa-database icon"></i><span>Pengelolaan Data</span>
                                ')
                               ->addClass('auto'),
                               // ->setAttributes(['data-toggle' => 'dropdown', 'role' => 'button']),
                           Menu::new()
                               ->addClass('nav nav-sub')
                               ->html('<li class="nav-sub-header">
                                           <a href>
                                               <span>Pengelolaan Data</span>
                                           </a>
                                       </li>')
                               ->link('#', 'Posisi Kas Siap Edar')
                               ->link('#', 'Kecukupan Kas')
                               ->link('#', 'Posisi Kas Titipan')
                               ->link('#', 'Outflow')
                               ->link('#', 'Inflow')
                               ->link('#', 'Pemusnahan')
                               ->link('#', 'Kapasitas Khazanah')
                               ->link('#', 'Backlog')
                               ->link('#', 'Remise')
                               ->link('#', 'Kas Keliling')
                               ->link('#', 'Kinerja MSUK')
                               ->link('#', 'UYD')
                       )
                       ->submenu(
                           Link::to('#', '<span class="pull-right text-muted">
                                            <i class="fa fa-fw fa-angle-right text"></i>
                                            <i class="fa fa-fw fa-angle-down text-active"></i>
                                          </span>

                                          <i class="fa fa-cubes icon"></i><span>Data Master</span>
                                ')
                               ->addClass('auto'),
                               // ->setAttributes(['data-toggle' => 'dropdown', 'role' => 'button']),
                           Menu::new()
                               ->addClass('nav nav-sub')
                               ->html('<li class="nav-sub-header">
                                           <a href>
                                               <span>Data Master</span>
                                           </a>
                                       </li>')
                               ->link('/master/kode-pecahan', 'Kode Pecahan')
                               ->link('#', 'Daftar KDK')
                               ->link('#', 'Sandi Rekening')
                               ->link('#', 'Satker Kas')
                       )
                       ->wrap('nav ui-nav class="navi clearfix"')
                       ->setActiveFromRequest();
        });

        $this->app->singleton('foot-menu', function() {
            return Menu::new()
                       ->addClass('nav')
                       ->submenu(
                           Link::to('#', '<span class="pull-right text-muted">
                                            <i class="fa fa-fw fa-angle-right text"></i>
                                            <i class="fa fa-fw fa-angle-down text-active"></i>
                                          </span>

                                          <i class="fa fa-user icon"></i><span>User</span>
                                ')
                               ->addClass('auto'),
                               // ->setAttributes(['data-toggle' => 'dropdown', 'role' => 'button']),
                           Menu::new()
                               ->addClass('nav nav-sub')
                               ->link('/profile', 'Profile')
                               ->add(Link::to('#', 'Logout')->addClass('logout'))
                       )
                       ->link('/setting', '<i class="fa fa-cog icon"></i><span>Setting</span>')
                       ->wrap('nav ui-bottom-nav class="navi clearfix"')
                       ->setActive('/kas-edar');
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
