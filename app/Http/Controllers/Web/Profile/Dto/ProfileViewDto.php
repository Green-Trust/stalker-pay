<?php

namespace App\Http\Controllers\Web\Profile\Dto;

class ProfileViewDto
{
    private string $name;
    private string $avatar;
    private string $uuid;
    private string $uuidColor;
    private string $registrationDate;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getUuidColor(): string
    {
        return $this->uuidColor;
    }

    public function setUuidColor(string $uuidColor): self
    {
        $this->uuidColor = $uuidColor;

        return $this;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getRegistrationDate(): string
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(string $registrationDate): self
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }
}
