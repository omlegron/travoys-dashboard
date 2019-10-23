<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Auth\Role;
use Carbon;

class LaporanRekapIncidentController extends Controller
{
    protected $routes = 'laporan.rekap-incident';
    protected $link = 'laporan/rekap-incident/';

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
            // [
            //     'data' => 'jam',
            //     'name' => 'jam',
            //     'label' => 'Jam',
            //     'sortable' => true,
            //     'className' => 'text-center',
            // ],
            // [
            //     'data' => 'user',
            //     'name' => 'user',
            //     'label' => 'User',
            //     'sortable' => true,
            //     'className' => 'text-center',
            // ],
            [
                'data' => 'log',
                'name' => 'log',
                'label' => 'Log',
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
                'tanggal' => '2019-09-13',
                'log' => 'Terjadi Kecelakaan',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin',                
            ],
            (object) [
                'id' => 1,
                'tanggal' => '2019-09-13',
                'log' => 'Mencatat Kecelakaan',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin'
            ],
            (object) [
                'id' => 1,
                'tanggal' => '2019-09-13',
                'log' => 'Melihat Laporan',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin'
            ],
            (object) [
                'id' => 1,
                'tanggal' => '2019-09-13',
                'log' => 'Melakukan Tindakan',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin'
            ],
            (object) [
                'id' => 1,
                'tanggal' => '2019-12-13',
                'log' => 'Mengekspor Laporan',
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
            ->editColumn('gambar', function($record){
                $gambar = '';
                $gambar .= '<img src="'.asset('img/no-images.png').'" class="ui centered tiny rounded image" style="width:100px">';
                return $gambar;
            })
               ->addColumn('action', function($record) use ($routes,$link) {
                $buttons = '';

                $buttons .= $this->makeButton([
                    'type' => 'url',
                    'class' => 'btn btn-sm bg-primary url button',
                    'tooltip' => 'Show Editor',
                    'label' => '<i class="fa fa-exchange icon"></i>',
                    'id'   => $record->id,
                    'url'   => url($link.'show-editor/'.$record->id),
                ]);
                $buttons .= $this->makeButton([
                    'type' => 'edit',
                    'class' => 'btn btn-sm bg-success edit button',
                    'id'   => $record->id,
                    // 'url'   => url($link.$record->id.'/edit'),
                ]);
                $buttons .= $this->makeButton([
                    'type' => 'delete',
                    'class' => 'btn btn-sm bg-danger delete button',
                    'id'   => $record->id,
                ]);
            

                return $buttons;
            })
            ->rawColumns(['action', 'gambar'])
            ->make(true);
    }

    public function index()
    {
        return $this->render('modules.laporan.rekap-incident.index',['mockup' => true]);
    }

    public function create()
    {
        return $this->render('modules.laporan.rekap-incident.create');
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
        return $this->render('modules.laporan.rekap-incident.edit', ['record' => $records]);
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
        return $this->render('modules.laporan.rekap-incident.show', ['record' => $records]);
    }
}
