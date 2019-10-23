<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Master\Event;
use Carbon;

use App\Http\Requests\Master\EventRequest;

class EventController extends Controller
{
    protected $routes = 'master.event';
    protected $link = 'master/event/';
    function __construct()
    {
        $this->setRoutes($this->routes);
        // Header Grid Datatable
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
                'data' => 'title',
                'name' => 'title',
                'label' => 'Title',
                'sortable' => true,
            ],
            [
                'data' => 'description',
                'name' => 'description',
                'label' => 'Description',
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

    public function grid(Request $request)
    {
        $records = Event::select('*');

        if (!isset(request()->order[0]['column'])) {
            $records->orderBy('created_at', 'desc');
        }

        // Filters
        if ($name = $request->name) {
            $records->where('title', 'like', '%' . $name . '%');
        }

        $routes = $this->routes;
        $link = $this->link;
        return DataTables::of($records)
               ->addColumn('num', function($record) {
                    return request()->start;
               })
               ->editColumn('created_at', function($record){
                    return $record->created_at->diffForHumans();
               })
                ->editColumn('created_by', function($record){
                    return $record->createdBy();
               })
               ->addColumn('action', function($record) use ($routes,$link) {
                $buttons = '';

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
        return $this->render('modules.master.event.index',['mockup' => true]);
    }

    public function create()
    {
        return $this->render('modules.master.event.create');
    }

    public function store(EventRequest $request)
    {
        $record = Event::saveData($request);
        return response([
            'success' => true
        ]);
    }

    public function edit($id)
    {
        $records = Event::findOrFail($id);
        return $this->render('modules.master.event.edit', ['record' => $records]);
    }

    public function update(EventRequest $request)
    {
        $record = Event::saveData($request);
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
