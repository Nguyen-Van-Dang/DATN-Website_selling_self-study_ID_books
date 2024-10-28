<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'newMessage' => 'required|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'newMessage.max' => 'Message không được vượt quá 500 ký tự.'
        ];
    }
}
