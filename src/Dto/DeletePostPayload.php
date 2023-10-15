<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
