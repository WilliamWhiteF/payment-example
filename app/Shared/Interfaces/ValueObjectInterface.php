<?php

namespace App\Shared\Interfaces;

interface ValueObjectInterface {
    public function get(): mixed;
    public function equals(mixed $value): bool;
    public function __toString(): string;
};
