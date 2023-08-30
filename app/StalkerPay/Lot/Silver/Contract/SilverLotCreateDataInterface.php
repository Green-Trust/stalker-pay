<?php

namespace App\StalkerPay\Lot\Silver\Contract;

interface SilverLotCreateDataInterface
{
    public function getAmount(): int;
    public function getMinimum(): int;
    public function getDescription(): ?string;
    public function getType(): string;
    public function getCreatorId(): int;
    public function getLocationId(): int;
    public function getServerId(): int;
    public function getPrice(): float;
}
