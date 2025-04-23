<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ClinicFormRequest extends FormRequest
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
        $clinic = request()->route('clinic');
        // print "<pre>";
        // print_r($clinic);
        // print "</pre>";
        // exit();
        $rules = [
            'clinics.name' => ['required', 'unique:clinics'],
            'clinics.user.email' => ['required', 'max:255', 'unique:users,email'],
        ];
        if(in_array($this->method(), ['PATCH'])){
            $rules = [
                'clinics.name' => ['required', 'unique:clinics,name,' . $clinic->id],
                
            ];
        }
        return $rules;
    }
}
