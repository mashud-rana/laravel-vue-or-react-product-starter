<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscriberRequest extends FormRequest
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
            'first_name'            => ['required', 'string', 'max:100'],
            'last_name'             => ['required', 'string', 'max:100'],
            'email'                 => ['required', 'string', 'email', 'max:190', Rule::unique('users')->ignore($this->subscriber)],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
            'phone'                 => ['nullable', 'max:25', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'gender'                => ['nullable', 'in:0,1,2'],
            'avatar'                => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:300'],
            'status'                => ['required'],

            'dob'                   => ['nullable', 'date'],

            'about'                 => ['nullable', 'string'],

            'country'               => ['nullable', 'string', 'max:190'],
            'state'                 => ['nullable', 'string', 'max:190'],
            'city'                  => ['nullable', 'string', 'max:190'],
            'address'               => ['nullable', 'string', 'max:190'],
            'zip_code'              => ['nullable', 'string', 'max:190'],

            'facebook'              => ['nullable', 'string', 'max:190'],
            'twitter'               => ['nullable', 'string', 'max:190'],
            'linkedin'              => ['nullable', 'string', 'max:190'],
            'instagram'             => ['nullable', 'string', 'max:190'],
            'youtube'               => ['nullable', 'string', 'max:190'],
            'website'               => ['nullable', 'string', 'max:190'],

        ];

        if ($this->subscriber) {
            $rules['password']              = ['nullable', 'string', 'min:8', 'confirmed'];
            $rules['password_confirmation'] = ['nullable', 'string', 'min:8'];
        }

        return $rules;
    }
}

