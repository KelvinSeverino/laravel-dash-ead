<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $users = $this->service->getAll(
            filter: $request->get('filter', '')
        );

        return view('admin.users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function show($id)
    {
        if(!$user = $this->service->findById($id)){
            return back();
        }

        return view('admin.users.show', compact('user'));
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $this->service->create($data);

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        if(!$user = $this->service->findById($id)){
            return redirect()->back();
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->only(['name', 'email']);

        if($request->password)
            $data['password'] = bcrypt($request->password);

        if(!$this->service->update($id, $data)){
            return back();
        }

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return redirect()->route('users.index');
    }

    public function changeImage($id)
    {
        if(!$user = $this->service->findById($id)){
            return back();
        }

        return view('admin.users.changeImage', compact('user'));
    }

    public function uploadFile(Request $request)
    {
        dd($request->all());
    }
}
