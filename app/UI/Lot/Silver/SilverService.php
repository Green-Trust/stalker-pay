<?php

namespace App\UI\Lot\Silver;

use App\StalkerPay\Lot\Silver\Enum\TypeEnum as SilverTypeEnum;

class SilverService
{
    public function getAllTypes(): array
    {
        return [
            SilverTypeEnum::Barter->value        => 'Бартер',
            SilverTypeEnum::BulletinBoard->value => 'Доска объявлений',
        ];
    }

    public function getType(string $type): string
    {
        $map = $this->getAllTypes();

        return $map[$type] ?? '';
    }
}
