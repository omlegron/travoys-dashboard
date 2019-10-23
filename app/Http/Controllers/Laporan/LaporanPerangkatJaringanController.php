<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Auth\Role;
use Carbon;

class LaporanPerangkatJaringanController extends Controller
{
    protected $routes = 'laporan.perangkat-jaringan';
    protected $link = 'laporan/perangkat-jaringan/';

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
                'data' => 'name',
                'name' => 'name',
                'label' => 'Nama',
                'sortable' => true,
            ],
            [
                'data' => 'tipe',
                'name' => 'tipe',
                'label' => 'Tipe Perangkat',
                'sortable' => true,
            ],
            
            [
                'data' => 'type',
                'name' => 'type',
                'label' => 'tipe',
                'sortable' => true,
            ],
            [
                'data' => 'koordinat',
                'name' => 'koordinat',
                'label' => 'Koordinat',
                'sortable' => true,
            ],
            [
                'data' => 'daerah',
                'name' => 'daerah',
                'label' => 'Daerah',
                'sortable' => true,
            ],
            [
                'data' => 'merk',
                'name' => 'merk',
                'label' => 'Merk',
                'sortable' => true,
            ],
            [
                'data' => 'tipe_peralatan',
                'name' => 'tipe_peralatan',
                'label' => 'Tipe Peralatans',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'sn',
                'name' => 'sn',
                'label' => 'SN',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'area',
                'name' => 'area',
                'label' => 'Area',
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
                'name' => 'GI AMLAPURA',
                'tipe' => 'Gardu',
                'type' => '-',
                'koordinat' => '-',
                'daerah' => '-',
                'merk' => '-',
                'tipe_peralatan' => '-',
                'sn' => '-',
                'area' => 'BATUR',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin',                
            ],
            (object) [
                'id' => 1,
                'name' => 'GI ANTOSARI',
                'tipe' => 'Gardu',
                'type' => '-',
                'koordinat' => '-',
                'daerah' => '-',
                'merk' => '-',
                'tipe_peralatan' => '-',
                'sn' => '-',
                'area' => 'BATAN',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin'
            ],
            (object) [
                'id' => 1,
                'name' => 'GI BATURITI',
                'tipe' => 'Gardu',
                'type' => '-',
                'koordinat' => '-',
                'daerah' => '-',
                'merk' => '-',
                'tipe_peralatan' => '-',
                'sn' => '-',
                'area' => 'BATAN',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin'
            ],
            (object) [
                'id' => 1,
                'name' => 'GI GIANYAR',
                'tipe' => 'Gardu',
                'type' => '-',
                'koordinat' => '-',
                'daerah' => '-',
                'merk' => '-',
                'tipe_peralatan' => '-',
                'sn' => '-',
                'area' => 'BATAN',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin'
            ],
            (object) [
                'id' => 1,
                'name' => 'GI GILIMANUK',
                'tipe' => 'Gardu',
                'type' => '-',
                'koordinat' => '-',
                'daerah' => '-',
                'merk' => '-',
                'tipe_peralatan' => '-',
                'sn' => '-',
                'area' => 'BATAN',
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
                    $buttons = '-';

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
        return $this->render('modules.laporan.data-perangkat.index',['mockup' => true]);
    }

    public function create()
    {
        return $this->render('modules.laporan.data-perangkat.create');
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
        return $this->render('modules.laporan.data-perangkat.edit', ['record' => $records]);
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
