<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\User;

class UserServices extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = app()->make(User::class);
    }

    // get
    public function getAll()
    {
        return $this->user->orderBy('created_at', 'DESC')->get();
    }
    // getOne
    public function getOne($id)
    {
        return $this->user->find($id);
    }
    // Save User
    public function create($data)
    {
        return $this->user->create($data);
    }

    // Update User
    public function update($request, $id)
    {
        $data = $request->except('password_confirmation');
        if(is_null($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }
        if (! empty($data['image'])) {
            $data = $this->uploadFile($request, $data);
        }
        return $this->user->find($id)->update($data);
    }

    public function uploadFile($request, $data)
    {
        if ($request->hasFile('image')) {
            $destinationPath = 'public/images/user';
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($destinationPath, $imageName);

            $data['image'] = $imageName;
        }
        return $data;
    }

    public function delete($id)
    {
        return $this->user->find($id)->delete();
    }
}
