<?php

namespace App\Domains\Payment\ValueObject;

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

    /**
     * Create a Money from float, converting to integer in the process
     *
     * @param float $value Expected format DD.dd (2 decimal houses)
     * @return Money
     */
    public static function createFrom(float $value): Money
    {
        return new self(($value * 100));
    }

    public function __toString(): string
    {
        return $this->ammount;
    }
}
