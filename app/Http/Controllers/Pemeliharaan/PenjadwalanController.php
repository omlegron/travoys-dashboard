<?php

namespace App\Http\Controllers\Pemeliharaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Auth\Role;
use Carbon;

class PenjadwalanController extends Controller
{
    protected $routes = 'pemeliharaan.jadwal-pemeliharaan';
    protected $link = 'pemeliharaan/jadwal-pemeliharaan/';

    function __construct()
    {
        $this->setRoutes($this->routes);
        $this->setLink($this->link);
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
                'data' => 'date',
                'name' => 'date',
                'label' => 'Tanggal',
                'sortable' => true,
            ],
            [
                'data' => 'rayon',
                'name' => 'rayon',
                'label' => 'Rayon',
                'sortable' => true,
            ],
            [
                'data' => 'jenis_peralatan',
                'name' => 'jenis_peralatan',
                'label' => 'Jenis Peralatan',
                'sortable' => true,
            ],
            [
                'data' => 'nama_peralatan',
                'name' => 'nama_peralatan',
                'label' => 'Nama Peralatan',
                'sortable' => true,
            ],
            [
                'data' => 'jenis',
                'name' => 'jenis',
                'label' => 'Jenis',
                'sortable' => true,
            ],
            [
                'data' => 'status',
                'name' => 'status',
                'label' => 'Status',
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
                'date' => '10/10/2019',
                'rayon' => 'Rayon Bangli',
                'jenis_peralatan' => 'AVS SUBAMIA',
                'nama_peralatan' => 'Trafo A1',
                'jenis' => 'Pemeliharaan KeyPoint',
                'status' => 'Open',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin',                
            ],
            (object) [
                'id' => 1,
                'date' => '10/10/2019',
                'rayon' => 'Rayon Gianyar',
                'jenis_peralatan' => 'AVS SUBAMIA',
                'nama_peralatan' => 'Trafo A2',
                'jenis' => 'Pemeliharaan GI',
                'status' => 'Open',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin'
            ],
            (object) [
                'id' => 1,
                'date' => '10/10/2019',
                'rayon' => 'Rayon Gilimanuk',
                'jenis_peralatan' => 'AVS SUBAMIA',
                'nama_peralatan' => 'Trafo A21',
                'jenis' => 'Pemeliharaan KeyPoint',
                'status' => 'Open',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin'
            ],
            (object) [
                'id' => 1,
                'date' => '10/10/2019',
                'rayon' => 'Rayon Karangasem',
                'jenis_peralatan' => 'AVS SUBAMIA',
                'nama_peralatan' => 'Trafo A1',
                'jenis' => 'Pemeliharaan KeyPoint',
                'status' => 'Open',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin'
            ],
            (object) [
                'id' => 1,
                'date' => '10/10/2019',
                'rayon' => 'Rayon Bangli',
                'jenis_peralatan' => 'AVS SUBAMIA',
                'nama_peralatan' => 'Trafo A1',
                'jenis' => 'Pemeliharaan KeyPoint',
                'status' => 'Open',
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
        $link = $this->link;
        return DataTables::of($records)
               ->addColumn('num', function($record) {
                    return request()->start;
               })
               ->editColumn('created_at', function($record){
                    return $record->created_at->diffForHumans();
               })
                   ->addColumn('action', function($record) use ($routes,$link) {
                    $buttons = '';

                    $buttons .= $this->makeButton([
                        'type' => 'url',
                        'class' => 'btn btn-sm bg-success url button',
                        'id'   => $record->id,
                        'url'   => url($link.$record->id.'/edit'),
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
        return $this->render('modules.pemeliharaan.penjadwalan.index',['mockup' => true]);
    }

    public function create()
    {
        return $this->render('modules.pemeliharaan.penjadwalan.create');
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
        return $this->render('modules.pemeliharaan.penjadwalan.edit', ['record' => $records]);
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
