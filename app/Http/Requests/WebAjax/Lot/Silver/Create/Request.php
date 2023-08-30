<?php

namespace App\Http\Requests\WebAjax\Lot\Silver\Create;

use App\Http\Controllers\WebAjax\Lot\Silver\Create\Dto\SilverLotCreateData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Request extends FormRequest
{
    public function rules(): array
    {
        return [
            'amount'   => 'required|min:1',
            'minimum'  => 'required|min:1',
            'price'    => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'type'     => 'required',
            'location' => 'required',
            'server'   => 'required',
        ];
    }

    public function getData(): SilverLotCreateData
    {
        return (new SilverLotCreateData())
            ->setAmount($this->get('amount'))
            ->setMinimum($this->get('minimum'))
            ->setPrice($this->get('price'))
            ->setType($this->get('type'))
            ->setCreatorId(Auth::id())
            ->setLocationId($this->get('location'))
            ->setServerId($this->get('server'));
    }
}
