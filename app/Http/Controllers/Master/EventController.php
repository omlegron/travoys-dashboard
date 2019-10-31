<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Master\Event;
use App\Models\Master\EventUsers;
use Carbon;

use App\Http\Requests\Master\EventRequest;

use Illuminate\Support\Facades\Crypt;

class EventController extends Controller
{
    protected $routes = 'master.event';
    protected $link = 'master/event/';
    private $userStruct = [
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
                'data' => 'user_id',
                'name' => 'user_id',
                'label' => 'Users',
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
    ];

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
                'width' => '120px',
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
                    'type' => 'url',
                    'class' => 'btn btn-sm bg-primary edit button',
                    'tooltip' => 'Detail Users',
                    'label' => '<i class="fa fa-users text-light"></i>',
                    'id'   => $record->id,
                    'url'   => url($link.'users/'.$record->id.''),
                ]);

                // $buttons .= $this->makeButton([
                //     'type' => 'custom',
                //     'class' => 'btn btn-sm bg-warning others modal button',
                //     'tooltip' => 'Add Users',
                //     'id'   => $record->id,
                //     'attributes'   => array('url' => url($link.$record->id.'/add-users')),
                // ]);

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

    public function destroy($id)
    {
        Event::destroy($id);
        return response([
            'success' => true
        ]);
    }

    public function scan($id)
    {
        return $this->render('modules.master.event.scan',[
            'trans_id' => $id
        ]);
    }

    public function postScan(Request $request){
        
        $decrypted = Crypt::decryptString($request->barcode);
        $data = json_decode($decrypted);

        $cekRec = EventUsers::where('user_id',$data->user)->first();
        if(isset($cekRec)){
            header('HTTP/1.1 800 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'User Sudah Ada')));
        }else{
            $request['user_id'] = $data->user;
            $request['timestamp'] = $data->time;
            $record = EventUsers::saveData($request);
            return response([
                'success' => true
            ]);
        }
    }

    // FOR USERS
    public function users($id){
        return $this->render('modules.master.event.users.index',[
            'tableStruct' => $this->userStruct,
            'trans_id' => $id
        ]);
    }

    public function gridUsers(Request $request){
        $records = EventUsers::select('*');

        if (!isset(request()->order[0]['column'])) {
            $records->orderBy('created_at', 'desc');
        }

        // Filters
        if ($name = $request->name) {
            $records->where('title', 'like', '%' . $name . '%');
        }

        if ($trans_id = $request->trans_id) {
            $records->where('trans_id', $trans_id);
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
               ->editColumn('user_id', function($record){
                    return $record->user->name;
               })
                ->editColumn('created_by', function($record){
                    return $record->createdBy();
               })
               ->addColumn('action', function($record) use ($routes,$link) {
                $buttons = '';

                $buttons .= $this->makeButton([
                    'type' => 'delete',
                    'class' => 'btn btn-sm bg-danger delete button',
                    'id'   => $record->id,
                    'datas'   => array('url' => url('master/event/delete-event-users/'.$record->id)),
                ]);
            

                return $buttons;
           })
            ->rawColumns(['action'])
           ->make(true);
    }

    public function createUsers($id)
    {
        return $this->render('modules.master.event.users.create',['trans_id' => $id]);
    }

    public function storeUsers(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required'
        ]);

        $record = EventUsers::saveData($request);
        return response([
            'success' => true
        ]);
    }

    public function destroyUsers($id)
    {
        EventUsers::destroy($id);
        return response([
            'success' => true
        ]);
    }
}
