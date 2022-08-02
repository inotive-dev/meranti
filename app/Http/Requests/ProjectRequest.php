<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'client_id' => 'required',
            'name' => 'required|max:100',
            'length' => 'required|max:100',
            'breadth' => 'required|max:100',
            'depth' => 'required|max:100',
            'klass' => 'required|max:100'
        ];
        
        return $rules;
    }
    
    public function messages() {
        $customMessages = [
            'required' => 'Kolom wajib di isi.',
            'max' => 'Panjang text tidak boleh lebih dari 100 karakter.'
        ];
        
        return $customMessages;
    }
}
