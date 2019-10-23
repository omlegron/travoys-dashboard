<?php

namespace App\Http\Controllers\ManajemenData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Auth\Role;
use Carbon;

class InputGangguanController extends Controller
{
    protected $routes = 'manajemen.input-gangguan-sistem';
    protected $link = 'manajemen/input-gangguan-sistem/';

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
                'data' => 'tanggal',
                'name' => 'tanggal',
                'label' => 'Tanggal',
                'sortable' => true,
            ],
            [
                'data' => 'jenis',
                'name' => 'jenis',
                'label' => 'Jenis Peralatan',
                'sortable' => true,
            ],
            [
                'data' => 'nama',
                'name' => 'nama',
                'label' => 'Nama Peralatan',
                'sortable' => true,
            ],
            [
                'data' => 'rele',
                'name' => 'rele',
                'label' => 'Rele',
                'sortable' => true,
            ],
            [
                'data' => 'status',
                'name' => 'status',
                'label' => 'Status',
                'sortable' => true,
                'className' => 'text-center',

            ],
            [
                'data' => 'created_at',
                'name' => 'created_at',
                'label' => 'Created At',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'action',
                'name' => 'action',
                'label' => 'Aksi',
                'searchable' => false,
                'sortable' => false,
                'width' => '120px',
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
                'tanggal' => '13-09-2019',
                'jenis' => 'AVS',
                'nama' => 'Trafo',
                'rele' => 'EF',
                'status' => 'Open',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin',                
            ],
            (object) [
                'id' => 1,
                'tanggal' => '15-09-2019',
                'jenis' => 'AVS',
                'nama' => 'Trafo',
                'rele' => 'EF',
                'status' => 'Open',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin'
            ],
            (object) [
                'id' => 1,
                'tanggal' => '14-10-2019',
                'jenis' => 'AVS',
                'nama' => 'Trafo',
                'rele' => 'EF',
                'status' => 'Open',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin'
            ],
            (object) [
                'id' => 1,
                'tanggal' => '25-09-2019',
                'jenis' => 'AVS',
                'nama' => 'Trafo',
                'rele' => 'EF',
                'status' => 'Open',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin'
            ],
            (object) [
                'id' => 1,
                'tanggal' => '22-09-2019',
                'jenis' => 'AVS',
                'nama' => 'Trafo',
                'rele' => 'EF',
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
               ->editColumn('status', function($record){
                    $status = '';
                    $status .= '<span class="badge badge-pill bg-success">'.$record->status.'</span>';
                    return $status;
               })
               ->editColumn('created_at', function($record){
                    return $record->created_at->diffForHumans();
               })
                   ->addColumn('action', function($record) use ($routes,$link) {
                    $buttons = '';

                    //  $buttons .= $this->makeButton([
                    //     'type' => 'url',
                    //     'class' => 'btn btn-sm bg-primary url button',
                    //     'tooltip' => 'Buat Beban Sistem',
                    //     'label' => '<i class="fa fa-exchange icon"></i>',
                    //     'id'   => $record->id,
                    //     'url'   => url($link.'buat-beban/'.$record->id),
                    // ]);

                    $buttons .= $this->makeButton([
                        'type' => 'url',
                        'class' => 'btn btn-sm bg-success url button',
                        'id'   => $record->id,
                        'url'   => url($link.$record->id.'/edit'),
                    ]);
                    $buttons .= $this->makeButton([
                        'type' => 'delete',
                        'class' => 'btn btn-sm bg-danger delete button',
                        'id'   => $record->id,
                    ]);
                

                    return $buttons;
               })
                ->rawColumns(['action','total_waktu','total_durasi','status'])
               ->make(true);
    }

    public function index()
    {
        return $this->render('modules.manajemen-data.input-gangguan.index',['mockup' => true]);
    }

    public function create()
    {
        return $this->render('modules.manajemen-data.input-gangguan.create');
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
        return $this->render('modules.manajemen-data.input-gangguan.edit', ['record' => $records]);
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
        return $this->render('modules.manajemen-data.input-gangguan.show', ['record' => $records]);
    }

    public function createBeban()
    {
        return $this->render('modules.manajemen-data.input-gangguan.create-sistem');
    }
}
