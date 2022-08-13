<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class DatapetaniFormRequest extends FormRequest
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
            'alamat' => [
                'required',
                'string',
                'max:100'
            ],
            'kontak' => [
                'required',
                'string',
                'max:100'
            ],
            'norek' => [
                'required',
                'string',
                'max:100'
            ],
            'namarek' => [
                'required',
                'string',
                'max:100'
            ],
            'image' => [
                'nullable',
                'mimes:jpeg,jpg,png'
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
