<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UserFormRequest extends FormRequest
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
        $user = request()->route('user');

        $rules = [
            'users.f_name' => ['required'],
            'users.m_name' => ['required'],
            'users.l_name' => ['required'],
            'users.email' => ['required', 'max:255', 'unique:users'],
        ];
        if(in_array($this->method(), ['PATCH'])){
            $rules = [
                'users.f_name' => ['required'],
                'users.m_name' => ['required'],
                'users.l_name' => ['required'],
                'users.email' => ['required', 'max:255', 'unique:users,email,' . $user->id],
            ];
        }
        return $rules;
    }
}
