<?php

use App\Shared\Interfaces\ValueObjectInterface;

class Money implements ValueObjectInterface
{
    public function __construct(
        private readonly int $ammount
    ) {}

    public function get(): int
    {
        return $this->ammount;
    }

    public function equals(mixed $ammount): bool
    {
        return $this->get() === $ammount;
    }

    public function __toString(): string
    {
        return $this->ammount;
    }
}
