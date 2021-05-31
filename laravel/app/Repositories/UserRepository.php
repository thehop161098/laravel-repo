<?php

/**
 * Wallet CLO
 * PHP version 7.0
 *
 * @category Repositories
 * @package  UserRepository
 * @author   luan.nguyen <vltlnguy@mediba.jp>
 * @license  mediba inc. http://www.mediba.jp
 * @link     none
 */

namespace App\Repositories;


use App\Models\User;
use App\Repositories\Contracts\UserRepository as UserRepositoryContract;


class UserRepository extends AppRepository implements UserRepositoryContract
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }


    public function getList()
    {
        $this->perPage = 20;

        $selects = [
            '*'
        ];

        return $this->model
            ->from($this->model->tableName())
            ->select($selects)
            ->orderBy('id', 'DESC')
            ->paginate($this->perPage);
    }

   
    // public function getUser($sId)
    // {
    //     $selects = [
    //         '*'
    //     ];
    //     return $this->model
    //         ->select($selects)
    //         ->where('id', $sId)
    //         ->first();
    // }

   
    // public function insertUser($request)
    // {
    //     $oUser = $this->newInstance();
    //     $oUser->login_id = $request->login_id;
    //     $oUser->login_pwd = hash('sha512', $request->login_pwd);
    //     $oUser->permission = $request->permission;
    //     $oUser->delete_flg = 0;

    //     if ($oUser->save()) {
    //         return $oUser;
    //     }
    //     return false;
    // }

   
    // public function updateUser($oUser, $request)
    // {
    //     $oUser->permission = $request->permission;
    //     $oUser->failure_count = 0;
    //     $oUser->login_pwd = hash('sha512', $request->login_pwd);

    //     if ($oUser->save()) {
    //         return $oUser;
    //     }
    //     return false;
    // }

   
    // public function deleteUser($oUser)
    // {
    //     $columnDeletedAt = $oUser->getDeletedAtColumn();
    //     $time = $oUser->freshTimestamp();
    //     $oUser->delete_flg = 1;
    //     $oUser->{$columnDeletedAt} = $oUser->fromDateTime($time);
    //     if ($oUser->save()) {
    //         return $oUser;
    //     }
    //     return false;
    // }

    // --------------------------------- Service -----------------------

    // getOne
    public function getOne($id)
    {
        return $this->model->find($id);
    }
    // Save User
    public function create($data)
    {
        return $this->model->create($data);
    }

    // Update User
    public function update($request, $id)
    {
        $data = $request->except('password_confirmation');
        if (is_null($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }
        if (!empty($data['image'])) {
            $data = $this->uploadFile($request, $data);
        }
        return $this->model->find($id)->update($data);
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
        return $this->model->find($id)->delete();
    }
}
