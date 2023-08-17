<?php

namespace App\Http\Requests\Web\Registration;

use App\Http\Controllers\WebAjax\Registration\Dto\RegistrationData;
use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'             => 'required|min:3',
            'email'            => 'required|email',
            'password'         => 'required|min:8|confirmed',
        ];
    }

    public function getData(): RegistrationData
    {
        return (new RegistrationData())
            ->setName($this->get('name'))
            ->setEmail($this->get('email'))
            ->setPassword($this->get('password'));
    }
}
