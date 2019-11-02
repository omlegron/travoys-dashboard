<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Master\TarifTransJawa;
use App\Models\Auth\Role;
use Carbon;

use App\Http\Requests\Master\TarifTransJawaRequest;

class DashboardController extends Controller
{
    protected $routes = 'dashboard';
    protected $link = 'dashboard/';

    function __construct()
    {
        $this->setRoutes($this->routes);
        $this->setLink($this->link);
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
                'data' => 'asal_tujuan',
                'name' => 'asal_tujuan',
                'label' => 'Asal-Tujuan',
                'className' => 'text-center',
                'sortable' => true,
                'width' => '2000px',
            ],
            [
                'data' => 'Pandaan-Malang',
                'name' => 'Pandaan-Malang',
                'label' => 'Pandaan-Malang',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'Gempol',
                'name' => 'Gempol',
                'label' => 'Gempol',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'Pasuruan',
                'name' => 'Pasuruan',
                'label' => 'Pasuruan',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'Grati-Probolinggo Timur',
                'name' => 'Grati-Probolinggo Timur',
                'label' => 'Grati-Probolinggo Timur',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'Sidoarjo',
                'name' => 'Sidoarjo',
                'label' => 'Sidoarjo',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'Surabaya',
                'name' => 'Surabaya',
                'label' => 'Surabaya',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'Mojokerto-GT Mojokerto Barat',
                'name' => 'Mojokerto-GT Mojokerto Barat',
                'label' => 'Mojokerto-GT Mojokerto Barat',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'Kertosono-GT Nganjuk',
                'name' => 'Kertosono-GT Nganjuk',
                'label' => 'Kertosono-GT Nganjuk',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'Madiun',
                'name' => 'Madiun',
                'label' => 'Madiun',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'Ngawi',
                'name' => 'Ngawi',
                'label' => 'Ngawi',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'Sragen',
                'name' => 'Sragen',
                'label' => 'Sragen',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'Solo-Yogya Via GT Colomadu',
                'name' => ' Solo-Yogya Via GT Colomadu',
                'label' => '    Solo-Yogya Via GT Colomadu',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'Boyolali',
                'name' => 'Boyolali',
                'label' => 'Boyolali',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'Ungaran',
                'name' => 'Ungaran',
                'label' => 'Ungaran',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'Semarang',
                'name' => 'Semarang',
                'label' => 'Semarang',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'Batang',
                'name' => 'Batang',
                'label' => 'Batang',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'Pemalang',
                'name' => 'Pemalang',
                'label' => 'Pemalang',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'Brebes Timur',
                'name' => 'Brebes Timur',
                'label' => 'Brebes Timur',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'Pejagan',
                'name' => 'Pejagan',
                'label' => 'Pejagan',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'Cirebon-GT Ciperna',
                'name' => 'Cirebon-GT Ciperna',
                'label' => 'Cirebon-GT Ciperna',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'Palimanan',
                'name' => 'Palimanan',
                'label' => 'Palimanan',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'Cikampek',
                'name' => 'Cikampek',
                'label' => 'Cikampek',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'Merak Via JORR',
                'name' => 'Merak Via JORR',
                'label' => 'Merak Via JORR',
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

    public function grid(Request $request)
    {
        $records = TarifTransJawa::select('*');
        /**
         * undocumented constant
         **/

        $routes = $this->routes;
        $link = $this->link;
        return DataTables::of($records)
               ->addColumn('num', function($record) {
                    return request()->start;
               })
               ->addColumn('action', function($record) use ($routes,$link) {
                $buttons = '';

                $buttons .= $this->makeButton([
                    'type' => 'edit',
                    'class' => 'btn btn-sm bg-success edit button',
                    'id'   => $record->id,
                    'url'   => url($link.$record->id.'/edit'),
                ]);

                // $buttons .= $this->makeButton([
                //     'type' => 'url',
                //     'class' => 'btn btn-sm bg-primary edit button',
                //     'tooltip' => 'Detail Users',
                //     'label' => '<i class="fa fa-users text-light"></i>',
                //     'id'   => $record->id,
                //     'url'   => url($link.'tarif_transjawa/'.$record->id.''),
                // ]);

                $buttons .= $this->makeButton([
                    'type' => 'custom',
                    'class' => 'btn btn-sm bg-warning others modal button',
                    'tooltip' => 'Add Users',
                    'id'   => $record->id,
                    'attributes'   => array('url' => url($link.$record->id.'/add-tarif_transjawa')),
                ]);

                $buttons .= $this->makeButton([
                    'type' => 'delete',
                    'class' => 'btn btn-sm bg-danger delete button',
                    'id'   => $record->id,
                ]);
            

                return $buttons;
           })
            ->rawColumns(['action'])
           ->make(true);
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
