<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConditionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'info' => ['required'],
            'light_white' => ['required'],
            'light_red' => ['required'],
            'temperature' => ['required'],
            'temp_delta_top' => ['required'],
            'temp_delta_bot' => ['required'],
            'humidity' => ['required'],
            'hum_delta_top' => ['required'],
            'hum_delta_bot' => ['required'],
        ];
    }
}
