<?php

namespace App\Http\Controllers\WorkForce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Auth\Role;
use Carbon;

class WorkOrderMonitoringController extends Controller
{
    protected $routes = 'workforce.work-order-monitoring';
    protected $link = 'workforce/work-order-monitoring/';

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
                'data' => 'nomor',
                'name' => 'nomor',
                'label' => 'Nomor',
                'sortable' => true,
            ],
            [
                'data' => 'tanggal_gangguan',
                'name' => 'tanggal_gangguan',
                'label' => 'Tanggal Gangguan / Padam',
                'sortable' => true,
            ],
            [
                'data' => 'area',
                'name' => 'area',
                'label' => 'Area',
                'sortable' => true,
            ],
            [
                'data' => 'rayon',
                'name' => 'rayon',
                'label' => 'Rayon',
                'sortable' => true,
            ],
            [
                'data' => 'site',
                'name' => 'site',
                'label' => 'Site',
                'sortable' => true,
            ],
            [
                'data' => 'kordinat',
                'name' => 'kordinat',
                'label' => 'Kordinat',
                'sortable' => true,
            ],
            [
                'data' => 'total_waktu',
                'name' => 'total_waktu',
                'label' => 'Total Waktu',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'total_durasi',
                'name' => 'total_durasi',
                'label' => 'Total Durasi',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'status',
                'name' => 'status',
                'label' => 'Status',
                'sortable' => true,
                'className' => 'text-center',

            ],
            // [
            //     'data' => 'action',
            //     'name' => 'action',
            //     'label' => 'Aksi',
            //     'searchable' => false,
            //     'sortable' => false,
            //     'width' => '90px',
            //     'className' => 'text-center'
            // ]
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
                'nomor' => 'WO/090910/01',
                'tanggal_gangguan' => '11/07/2019, 00:00:00',
                'area' => 'Batur',
                'rayon' => 'Rayon Kuta',
                'site' => 'Site 1',
                'kordinat' => '-8.61328171392371, 115.34131870424848',
                'total_waktu' => '9092 Second',
                'total_durasi' => '152 Menit',
                'status' => 'New',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin',                
            ],
            (object) [
                'id' => 1,
                'nomor' => 'WO/090910/02',
                'tanggal_gangguan' => '12/07/2019, 00:00:00',
                'area' => 'Bara',
                'rayon' => 'Rayon Denpasar',
                'site' => 'Site 2',
                'kordinat' => '-8.61328171392371, 115.34131870424848',
                'total_waktu' => '12596 Second',
                'total_durasi' => '211 Menit',
                'status' => 'On Progress',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin'
            ],
            (object) [
                'id' => 1,
                'nomor' => 'WO/090910/03',
                'tanggal_gangguan' => '13/07/2019, 00:00:00',
                'area' => 'Batur',
                'rayon' => 'Rayon Denpasar',
                'site' => 'Site 2',
                'kordinat' => '-8.61328171392371, 115.34131870424848',
                'total_waktu' => '12166 Second',
                'total_durasi' => '215 Menit',
                'status' => 'Done',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin'
            ],
            (object) [
                'id' => 1,
                'nomor' => 'WO/090910/04',
                'tanggal_gangguan' => '12/08/2019, 00:00:00',
                'area' => 'Batun',
                'rayon' => 'Rayon Gilimanuk',
                'site' => 'Site 2',
                'kordinat' => '-8.61328171392371, 115.34131870424848',
                'total_waktu' => '12166 Second',
                'total_durasi' => '215 Menit',
                'status' => 'Done',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin'
            ],
            (object) [
                'id' => 1,
                'nomor' => 'WO/090910/05',
                'tanggal_gangguan' => '22/09/2019, 00:00:00',
                'area' => 'Bara',
                'rayon' => 'Rayon Karangasem',
                'site' => 'Site 2',
                'kordinat' => '-8.61328171392371, 115.34131870424848',
                'total_waktu' => '2448 Second',
                'total_durasi' => '295 Menit',
                'status' => 'Done',
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
               ->editColumn('status', function($record){
                    $status = '';
                    if($record->status == 'On Progress'){
                        $status .= '<span class="badge badge-pill badge-info bg-warning">'.$record->status.'</span>';
                    }else{
                        $status .= '<span class="badge badge-pill badge-danger bg-danger">'.$record->status.'</span>';
                    }
                    return $status;
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
               ->rawColumns(['action','total_waktu','total_durasi','status'])
               ->make(true);
    }

    public function index()
    {
        return $this->render('modules.workforce.work-order-monitoring.index',['mockup' => true]);
    }

    public function create()
    {
        return $this->render('modules.workforce.work-order-monitoring.create');
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
        return $this->render('modules.workforce.work-order-monitoring.edit', ['record' => $records]);
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
