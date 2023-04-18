<?php

namespace App\Models\Validators;

use Illuminate\Support\Facades\Validator as FacadeValidator;
use Illuminate\Validation\Validator;

class StarValidator
{
    /**
     * Get the Star validator for an incoming store request.
     *
     * @param array $data The data to validate.
     *
     * @return \Illuminate\Validation\Validator
     */
    public static function store(array $data): Validator
    {
        $rules = [
            'first_name' => 'required|min:2|max:15',
            'last_name' => 'required|min:2|max:15',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'description' => 'max:6000'
        ];

        return FacadeValidator::make($data, $rules);
    }

    /**
     * Get the Star validator for an incoming update request.
     *
     * @param array $data The data to validate.
     *
     * @return \Illuminate\Validation\Validator
     */
    public static function update(array $data): Validator
    {
        $rules = [
            'first_name' => 'required|min:2|max:15',
            'last_name' => 'required|min:2|max:15',
             //No longer required if the user don't want to update it.
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
            'description' => 'max:6000'
        ];

        return FacadeValidator::make($data, $rules);
    }
}
