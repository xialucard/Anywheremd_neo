<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class DoctorFormRequest extends FormRequest
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
        $doctor = request()->route('doctor');
        // print "<pre>";
        // print_r($clinic);
        // print "</pre>";
        // exit();
        $rules = [
            'doctors.f_name' => ['required'],
            'doctors.m_name' => ['required'],
            'doctors.l_name' => ['required'],
            'doctors.email' => ['required', 'unique:users,email'],
        ];
        if(in_array($this->method(), ['PATCH'])){
            $rules = [
                'doctors.f_name' => ['required'],
                'doctors.m_name' => ['required'],
                'doctors.l_name' => ['required'],
                'doctors.email' => ['required', 'unique:users,email,' . $doctor->id],
                
            ];
        }
        return $rules;
    }
}
