<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Utils;

use App\Utils\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    private $validator;

    protected function setUp(): void
    {
        $this->validator = new Validator();
    }

    public function testValidateUsername()
    {
        $test = 'username';

        $this->assertSame($test, $this->validator->validateUsername($test));
    }

    public function testValidateUsernameEmpty()
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The username can not be empty.');
        $this->validator->validateUsername(null);
    }

    public function testValidateUsernameInvalid()
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The username must contain only lowercase latin characters and underscores.');
        $this->validator->validateUsername('INVALID');
    }

    public function testValidatePassword()
    {
        $test = 'password';

        $this->assertSame($test, $this->validator->validatePassword($test));
    }

    public function testValidatePasswordEmpty()
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The password can not be empty.');
        $this->validator->validatePassword(null);
    }

    public function testValidatePasswordInvalid()
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The password must be at least 6 characters long.');
        $this->validator->validatePassword('12345');
    }

    public function testValidateEmail()
    {
        $test = '@';

        $this->assertSame($test, $this->validator->validateEmail($test));
    }

    public function testValidateEmailEmpty()
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The email can not be empty.');
        $this->validator->validateEmail(null);
    }

    public function testValidateEmailInvalid()
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The email should look like a real email.');
        $this->validator->validateEmail('invalid');
    }

    public function testValidateFullName()
    {
        $test = 'Full Name';

        $this->assertSame($test, $this->validator->validateFullName($test));
    }

    public function testValidateFullNameEmpty()
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The full name can not be empty.');
        $this->validator->validateFullName(null);
    }
}
