<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Auth\Role;

class RoleController extends Controller
{
    protected $routes = 'setting.roles';

    function __construct()
    {
        $this->setRoutes($this->routes);
        // Header Grid Datatable
        $this->setTableStruct([
            [
                'data' => 'num',
                'name' => 'num',
                'label' => '#',
                'orderable' => false,
                'searchable' => false,
                'className' => 'text-center',
                'width' => '20px',
            ],
            /* --------------------------- */
            [
                'data' => 'name',
                'name' => 'name',
                'label' => 'Name',
                'sortable' => true,
            ],
            [
                'data' => 'users',
                'name' => 'users',
                'label' => 'User Assigned',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'perms',
                'name' => 'perms',
                'label' => 'Permissions',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'created_at',
                'name' => 'created_at',
                'label' => 'Created At',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'updated_at',
                'name' => 'updated_at',
                'label' => 'Updated At',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'action',
                'name' => 'action',
                'label' => 'Aksi',
                'searchable' => false,
                'sortable' => false,
                'width' => '90px',
                'className' => 'text-center'
            ]
        ]);
    }

    public function grid()
    {
        $records = Role::when($name = request()->name, function($q) use ($name) {
                            $q->where('name', 'like', '%'.$name.'%');
                        })
                        ->select('*');
        $routes = $this->routes;

        return DataTables::of($records)
               ->addColumn('num', function($record) {
                    return request()->start;
               })
               ->addColumn('perms', function($record) {
                    return $record->permissions->count().' Permissions';
               })
               ->addColumn('users', function($record) {
                    return $record->users->count().' Users';
               })
               ->editColumn('created_at', function($record){
                    return $record->created_at->diffForHumans();
               })
               ->editColumn('updated_at', function($record){
                    return $record->updated_at->diffForHumans();
               })
               ->addColumn('action', function($record) use ($routes) {
                    $buttons = '';

                    $buttons .= $this->makeButton([
                        'type'    => 'url',
                        'class'   => $record->isSuperAdmin() ? '' : 'm-r',
                        'label'   => '<i class="fa fa-check-square text-success"></i>',
                        'tooltip' => 'Assign Permissions',
                        'url'  => route($routes.'.show', $record->id),
                    ]);

                    if(!$record->isSuperAdmin()){
                        $buttons .= $this->makeButton([
                            'type' => 'edit',
                            'id'   => $record->id,
                        ]);

                        $buttons .= $this->makeButton([
                            'type' => 'delete',
                            'id'   => $record->id,
                        ]);
                    }

                    return $buttons;
               })
               ->make(true);
    }

    public function index()
    {
        return $this->render('settings.role.index');
    }

    public function create()
    {
        return $this->render('settings.role.create');
    }

    public function store()
    {
        return Role::create(request(['name']));
    }

    public function show(Role $role)
    {
        $perms = [
            'Home' => [
                'home' => ['read'],
            ],
            
            // Dashboard
            'Dashboard' => [
                'dashboard pkse'        => ['read'],
                'dashboard kecukupan'   => ['read'],
                'dashboard titipan'     => ['read'],
                'dashboard outflow'     => ['read'],
                'dashboard inflow'      => ['read'],
                'dashboard pemusnahan'  => ['read'],
                'dashboard khazanah'    => ['read'],
                'dashboard backlog'     => ['read'],
                'dashboard remise'      => ['read'],
                'dashboard keliling'    => ['read'],
                'dashboard msuk'        => ['read'],
                'dashboard uyd'         => ['read'],
                'dashboard survei'         => ['read'],
            ],

            // Data
            'Data' => [
                'data posisikas'   => ['create', 'read', 'update', 'delete'],
                'data outflow'     => ['create', 'read', 'update', 'delete'],
                'data inflow'      => ['create', 'read', 'update', 'delete'],
                'data pemusnahan'  => ['create', 'read', 'update', 'delete'],
                'data uyd'         => ['create', 'read', 'update', 'delete'],
                'data uyd pecahan' => ['create', 'read', 'update', 'delete'],
                'data proyeksi'    => ['create', 'read', 'update', 'delete'],
                'data survei'      => ['create', 'read', 'update', 'delete'],
                'data remise'      => ['create', 'read', 'update', 'delete'],
            ],

            // Master
            'Master' => [
                'master pecahan'   => ['create', 'read', 'update', 'delete'],
                'master kdk'       => ['create', 'read', 'update', 'delete'],
                'master rekening'  => ['create', 'read', 'update', 'delete'],
                'master satker'    => ['create', 'read', 'update', 'delete'],
                'master kapasitas' => ['create', 'read', 'update', 'delete'],
                'master plafond'   => ['create', 'read', 'update', 'delete'],
            ],

            // Setting
            'Setting' => [
                'setting user'      => ['create', 'read', 'update', 'delete'],
                'setting role'      => ['create', 'read', 'update', 'delete']
            ]
        ];

        return $this->render('settings.role.detail', ['record' => $role, 'perms' => $perms]);
    }

    public function edit(Role $role)
    {
        return $this->render('settings.role.edit', ['record' => $role]);
    }

    public function update(Role $role)
    {
        $role->update(request(['name']));

        if($perms = request()->perms){
            app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

            $role->syncPermissions(array_keys($perms));
            // dd(array_keys($perms));
        }

        return $role;
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json([
            'success' => true
        ]);
    }

}
