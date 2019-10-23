<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Auth\Role;
use Carbon;

class DashboardController extends Controller
{
    protected $routes = 'dashboard';
    protected $link = 'dashboard/';

    function __construct()
    {
        $this->setRoutes($this->routes);
        $this->setLink($this->link);
        
    }

    public function index()
    {
        return $this->render('modules.dashboard.index',['mockup' => true]);
    }

    public function create()
    {
        return $this->render('modules.dashboard.create');
    }

    public function store()
    {
        return response([
            'success' => true
        ]);
    }

    public function edit(Role $role)
    {
        $records = [];
        return $this->render('modules.dashboard.edit', ['record' => $records]);
    }

    public function update(Role $role)
    {
        return response([
            'success' => true
        ]);
    }

    public function destroy(Role $role)
    {
        return response([
            'success' => true
        ]);
    }

    public function showEditor(Request $request){
        $records = [];
        return $this->render('modules.dashboard.show', ['record' => $records]);
    }

    public function createBeban()
    {
        return $this->render('modules.dashboard.create-sistem');
    }
}
