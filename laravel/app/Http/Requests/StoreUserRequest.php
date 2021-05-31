<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url' => 'required',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required_with:password_confirmation|min:6',
            'password_confirmation' => 'required_with:password|same:password',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'image' => 'required|file|max:5120|mimes:jpg,png,jpeg',
            'select_box' => 'required',
            'checked' => 'accepted',
        ];
    }
}
