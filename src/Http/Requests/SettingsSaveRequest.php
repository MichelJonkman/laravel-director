<?php

namespace MichelJonkman\Director\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsSaveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'settings' => ['required', 'array']
        ];
    }
}
