<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = new User();
    }

    public function testGetFullName(): void
    {
        $fullName = 'Jane Doe';
        $this->assertEmpty($this->user->getFullName());
        $this->user->setFullName($fullName);
        self::assertSame($fullName, $this->user->getFullName());
    }

    public function testGetEmail(): void
    {
        $email = 'test@symfony.com';
        $this->assertEmpty($this->user->getEmail());
        $this->user->setEmail($email);
        self::assertSame($email, $this->user->getEmail());
    }

    public function testGetRoles(): void
    {
        $role = ['ROLE_ADMIN'];
        self::assertContains('ROLE_USER', $this->user->getRoles());
        $this->user->setRoles($role);
        self::assertContains('ROLE_ADMIN', $this->user->getRoles());
    }

    public function testGetPassword(): void
    {
        $password = 'password';
        $this->assertEmpty($this->user->getPassword());
        $this->user->setPassword($password);
        self::assertSame($password, $this->user->getPassword());
    }
}
