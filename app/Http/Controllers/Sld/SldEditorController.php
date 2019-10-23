<?php

namespace App\Http\Controllers\Sld;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Auth\Role;
use Carbon;

class SldEditorController extends Controller
{
    protected $routes = 'sld.editor';
    protected $link = 'sld/editor/';

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
                'data' => 'nama',
                'name' => 'nama',
                'label' => 'Nama Sld',
                'sortable' => true,
            ],
            [
                'data' => 'gambar',
                'name' => 'gambar',
                'label' => 'Gambar',
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
                'nama' => 'Sld line diagram',
                'gambar' => 'img',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin',                
            ],
            (object) [
                'id' => 1,
                'nama' => 'Sld line diagram 1',
                'gambar' => 'img',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin'
            ],
            (object) [
                'id' => 1,
                'nama' => 'Sld line diagram 2',
                'gambar' => 'img',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin'
            ],
            (object) [
                'id' => 1,
                'nama' => 'Sld line diagram 3',
                'gambar' => 'img',
                'created_at' => Carbon::parse('2019-07-19 19:33:26'),
                'created_by' => 'Admin'
            ],
            (object) [
                'id' => 1,
                'nama' => 'Sld line diagram 4',
                'gambar' => 'img',
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
               ->make(true);
    }

    public function index()
    {
        return $this->render('modules.sld.editor.index',['mockup' => true]);
    }

    public function create()
    {
        return $this->render('modules.sld.editor.create');
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
        return $this->render('modules.sld.editor.edit', ['record' => $records]);
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
        return $this->render('modules.sld.editor.show', ['record' => $records]);
    }

}
