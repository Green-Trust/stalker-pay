<?php

namespace App\Http\Controllers\Admin\User\Show\Dto;

use App\UI\Link\LinkData;

class UserViewDto
{
    private int      $uuid;
    private string   $name;
    private string   $avatar;
    private string   $status;
    private LinkData $changeStatusLink;

    public function getUuid(): int
    {
        return $this->uuid;
    }

    public function setUuid(int $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getChangeStatusLink(): LinkData
    {
        return $this->changeStatusLink;
    }

    public function setChangeStatusLink(LinkData $changeStatusLink): self
    {
        $this->changeStatusLink = $changeStatusLink;

        return $this;
    }
}
