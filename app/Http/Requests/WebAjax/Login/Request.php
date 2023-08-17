<?php

namespace App\Http\Requests\WebAjax\Login;

use App\Http\Controllers\WebAjax\Login\ValueObject\UserLoginData;
use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    public function rules(): array
    {
        return [
            'email'    => 'required|email',
            'password' => 'required',
        ];
    }

    public function getData(): UserLoginData
    {
        return new UserLoginData(
            $this->get('email'),
            $this->get('password')
        );
    }
}
