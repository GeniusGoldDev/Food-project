<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InstallRequest extends FormRequest
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
            'db.host' => 'required',
            'db.port' => 'required',
            'db.username' => 'required',
            'db.password' => 'nullable',
            'db.database' => 'required',
            'admin.name' => 'required',
            'admin.email' => 'required|email',
            'admin.password' => 'required',
            'store.storeName' => 'required',
            'store.storeEmail' => 'required|email',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            '*.required' => 'The :attribute field is required.',
            '*.required_if' => 'The :attribute field is required when :other is :value.',
            '*.email' => 'The :attribute must be a valid email address.',
            '*.unique' => 'The :attribute has already been taken.',
            '*.confirmed' => 'The :attribute confirmation does not match.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'db.host' => 'Host',
            'db.port' => 'Port',
            'db.username' => 'DB Username',
            'db.password' => 'DB Password',
            'db.database' => 'Datbase',
            'admin.name' => 'Name',
            'admin.email' => 'Email',
            'admin.password' => 'Password',
            'store.storeName' => 'Store Name',
            'store.storeEmail' => 'Store Email',
        ];
    }
}
