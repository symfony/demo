<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final class DeletePostPayload
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $token,
    ) {
    }
}
