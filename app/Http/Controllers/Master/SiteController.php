<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Auth\Role;
use Carbon;

class SiteController extends Controller
{
    protected $routes = 'master.data-site';

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
                'data' => 'created_at',
                'name' => 'created_at',
                'label' => 'Created At',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'created_by',
                'name' => 'created_by',
                'label' => 'Created By',
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
        // $records = Role::when($name = request()->name, function($q) use ($name) {
        //                     $q->where('name', 'like', '%'.$name.'%');
        //                 })
        //                 ->select('*');
        $records = collect([
            (object) [
                'id' => 1,
                'name' => 'Site 1',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin',                
            ],
            (object) [
                'id' => 1,
                'name' => 'Site 2',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin'
            ],
            (object) [
                'id' => 1,
                'name' => 'Site 3',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin'
            ],
            (object) [
                'id' => 1,
                'name' => 'Site 4',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin'
            ],
            (object) [
                'id' => 1,
                'name' => 'Site 5',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin'
            ],
        ]);

        // if (!isset(request()->order[0]['column'])) {
        //     $records->orderBy('created_at', 'desc');
        // }

        //Filters
        // if ($name = $request->name) {
        //     $records->where('name', 'like', '%' . $name . '%');
        // }

        $routes = $this->routes;

        return DataTables::of($records)
               ->addColumn('num', function($record) {
                    return request()->start;
               })
               ->editColumn('created_at', function($record){
                    return $record->created_at->diffForHumans();
               })
                   ->addColumn('action', function($record) use ($routes) {
                    $buttons = '';

                    $buttons .= $this->makeButton([
                        'type' => 'edit',
                        'class' => 'btn btn-sm bg-success edit button',
                        'id'   => $record->id,
                    ]);

                    $buttons .= $this->makeButton([
                        'type' => 'delete',
                        'class' => 'btn btn-sm bg-danger m-l delete button',
                        'id'   => $record->id,
                    ]);
                

                    return $buttons;
               })
               ->make(true);
    }

    public function index()
    {
        return $this->render('modules.master.site.index',['mockup' => true]);
    }

    public function create()
    {
        return $this->render('modules.master.site.create');
    }

    public function store()
    {
        return response([
            'success' => true
        ]);
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

        return $this->render('modules.master.site.detail', ['record' => $role, 'perms' => $perms]);
    }

    public function edit(Role $role)
    {
        $records = [];
        return $this->render('modules.master.site.edit', ['record' => $records]);
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

}
