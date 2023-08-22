<?php

namespace App\Http\Controllers\Web\Lot\Silver\View\Dto;

class SilverLotViewDto
{
    private int         $id;
    private string      $amount;
    private string      $minimum;
    private string      $price;
    private ?string     $description = null;
    private string      $type;
    private UserViewDto $creator;
    private string      $location;
    private string      $server;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getMinimum(): string
    {
        return $this->minimum;
    }

    public function setMinimum(string $minimum): self
    {
        $this->minimum = $minimum;

        return $this;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCreator(): UserViewDto
    {
        return $this->creator;
    }

    public function setCreator(UserViewDto $creator): self
    {
        $this->creator = $creator;

        return $this;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getServer(): string
    {
        return $this->server;
    }

    public function setServer(string $server): self
    {
        $this->server = $server;

        return $this;
    }
}
