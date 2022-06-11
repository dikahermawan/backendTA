<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserdataFormRequest extends FormRequest
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
        $rules = [
            'nama' => [
                'required',
                'string',
                'max:200'
            ],
            'email' => [
                'required',
                'string',
                'max:100'
            ],
            'role' => [
                'required',
                'string',
                'max:50'
            ],
            'image' => [
                'nullable',
                'mimes:jpeg,jpg,png'
            ],
            'meta_title' => [
                'required',
                'string',
                'max:200'
            ],
            'meta_description' => [
                'required',
                'string',
            ],
            'meta_keyword' => [
                'required',
                'string',
            ],
            'navbar_status' => [
                'nullable',
            ],
            'status' => [
                'nullable',
            ],
        ];
        return $rules;
    }
}
