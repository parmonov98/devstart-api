<?php

namespace App\DTO\BaseDTO;

abstract class AbstractDTO implements \JsonSerializable {
    public static abstract function fromArray(array $data): static;
}
