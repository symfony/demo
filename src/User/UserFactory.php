<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\User;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Creates User instances.
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
class UserFactory
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function createUser(string $username, string $email, string $fullname, string $password, array $roles = ['ROLE_USER']): User
    {
        $user = new User();

        $user->setUsername($username);
        $user->setEmail($email);
        $user->setFullName($fullname);
        // See https://symfony.com/doc/current/book/security.html#security-encoding-password
        $user->setPassword($this->passwordEncoder->encodePassword($user, $password));
        $user->setRoles($roles);

        return $user;
    }
}
