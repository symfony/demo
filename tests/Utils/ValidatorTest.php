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
    private $object;

    public function __construct()
    {
        parent::__construct();

        $this->object = new Validator();
    }

    public function testValidateUsername()
    {
        $test = 'username';

        $this->assertSame($test, $this->object->validateUsername($test));
    }

    public function testValidateUsernameEmpty()
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The username can not be empty.');
        $this->object->validateUsername(null);
    }

    public function testValidateUsernameInvalid()
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The username must contain only lowercase latin characters and underscores.');
        $this->object->validateUsername('INVALID');
    }

    public function testValidatePassword()
    {
        $test = 'password';

        $this->assertSame($test, $this->object->validatePassword($test));
    }

    public function testValidatePasswordEmpty()
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The password can not be empty.');
        $this->object->validatePassword(null);
    }

    public function testValidatePasswordInvalid()
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The password must be at least 6 characters long.');
        $this->object->validatePassword('12345');
    }

    public function testValidateEmail()
    {
        $test = '@';

        $this->assertSame($test, $this->object->validateEmail($test));
    }

    public function testValidateEmailEmpty()
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The email can not be empty.');
        $this->object->validateEmail(null);
    }

    public function testValidateEmailInvalid()
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The email should look like a real email.');
        $this->object->validateEmail('invalid');
    }

    public function testValidateFullName()
    {
        $test = 'Full Name';

        $this->assertSame($test, $this->object->validateFullName($test));
    }

    public function testValidateFullNameEmpty()
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The full name can not be empty.');
        $this->object->validateFullName(null);
    }
}
