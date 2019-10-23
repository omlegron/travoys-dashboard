<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

use App\Http\Requests\Setting\UserRequest;
use App\Models\Auth\User;

class UserController extends Controller
{
    protected $routes = 'setting.users';

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
                'data' => 'email',
                'name' => 'email',
                'label' => 'Email',
                'sortable' => true,
            ],
            [
                'data' => 'role',
                'name' => 'role',
                'label' => 'Role',
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
                'data' => 'updated_at',
                'name' => 'updated_at',
                'label' => 'Updated At',
                'className' => 'text-center',
                'sortable' => true,
            ],
            [
                'data' => 'action',
                'name' => 'action',
                'label' => 'Aksi',
                'searchable' => false,
                'sortable' => false,
                'width' => '80px',
                'className' => 'text-center'
            ]
        ]);
    }

    public function grid()
    {
        $records = User::when($name = request()->name, function($q) use ($name) {
                            $q->where('name', 'like', '%'.$name.'%');
                        })
                        ->when($email = request()->email, function($q) use ($email) {
                            $q->where('email', 'like', '%'.$email.'%');
                        })
                        ->select('*');

        return DataTables::of($records)
               ->addColumn('num', function($record) {
                    return request()->start;
               })
               ->addColumn('role', function($record) {
                    return $record->roles->first()
                         ? $record->roles->first()->name
                         : '-';
               })
               ->editColumn('created_at', function($record){
                    return $record->created_at->diffForHumans();
               })
               ->editColumn('updated_at', function($record){
                    return $record->updated_at->diffForHumans();
               })
               ->addColumn('action', function($record) {
                    $buttons = '';

                    $buttons .= $this->makeButton([
                        'type' => 'edit',
                        'id'   => $record->id,
                    ]);
                    if($record->id !== auth()->user()->id){
                        $buttons .= $this->makeButton([
                            'type' => 'delete',
                            'id'   => $record->id,
                        ]);
                    }

                    return $buttons;
               })
               ->make(true);
    }

    public function index()
    {
        return $this->render('settings.user.index');
    }

    public function create()
    {
        return $this->render('settings.user.create');
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $user->assignRole($request->role);

        return $user;
    }

    public function show(User $user)
    {
        return $user->toJson();
    }

    public function edit(User $user)
    {
        return $this->render('settings.user.edit', ['record' => $user]);
    }

    public function update(UserRequest $request, User $user)
    {
        $attrs = [
            'name' => $request['name'],
            'email' => $request['email'],
        ];
        
        if($pass = $request->password){
            $attrs['password'] = Hash::make($pass);
        }

        $user->update($attrs);
        $user->assignRole($request->role);

        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'success' => true
        ]);
    }

}
