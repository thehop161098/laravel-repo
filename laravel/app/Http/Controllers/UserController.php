<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserServices;
use App\Http\Requests\StoreUserRequest;
use App\Repositories\UserRepository as UserRepositoryContract;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserRepositoryContract $repoUser)
    {
        $this->repoUser = $repoUser;
    }

    public function index()
    {
        $users = $this->repoUser->getList();
        return view('user.index', compact('users'));
    }

    public function create(Request $request)
    {
        $oldUser = [];
        if ($request->session()->has('dataUser')) {
            $oldUser = $request->session()->get('dataUser');
        }

        return view('user.create', compact('oldUser'));
    }

    public function review(StoreUserRequest $request)
    {
        $data = $request->all();
        $userNew = $this->repoUser->uploadFile($request, $data);
        $request->session()->put('dataUser', $userNew);
        return view('user.review', ['data' => $userNew]);
    }

    public function store(Request $request)
    {
        // Save
        $data = $request->session()->get('dataUser');
        unset($data['password_confirmation']);
        $data['password'] = bcrypt($data['password']);

        $user = $this->repoUser->create($data);

        if (!empty($user)) {
            $request->session()->forget('dataUser');
        }
        session()->flash('message', 'Successfully Saved');
        return redirect()->route('user.index');
    }

    public function show(Request $request, $id)
    {
        $user = $this->repoUser->getOne($id);
        return view('user.show', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->repoUser->update($request, $id);
        return redirect()->route('user.index');
    }

    public function delete(Request $request, $id)
    {
        $this->repoUser->delete($id);
        return redirect()->route('user.index');
    }
}
