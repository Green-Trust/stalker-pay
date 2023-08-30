<?php

namespace App\Http\Controllers\Admin\User\Show\Dto;

use Illuminate\Contracts\Support\Htmlable;

class ReportContext
{
    /**
     * @var UserViewDto[]
     */
    private array $users = [];
    private Htmlable $links;

    public function getUsers(): array
    {
        return $this->users;
    }

    public function setUsers(array $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getLinks(): Htmlable
    {
        return $this->links;
    }

    public function setLinks(Htmlable $links): self
    {
        $this->links = $links;

        return $this;
    }
}
