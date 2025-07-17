## Validator.php Documentation

**1. Overview:**

This PHP file defines a `Validator` class that provides basic validation functions for common data types like usernames, passwords, emails, and full names. It demonstrates how to create simple classes as services within a Symfony application.

**2. Package/module name:** App\Utils

**3. Class/file name:** Validator.php

**4. Detailed Documentation:**

   - **`validateUsername(?string $username): string`**:
     - **Description:** Validates a given username string. 
     - **Parameters:**
       - `$username`: The username to validate (optional, can be null).
     - **Return Values:** The validated username as a string.
     - **Important Logic:**
       - Checks if the username is empty. If so, throws an `InvalidArgumentException`.
       - Uses a regular expression (`^[a-z_]+$`) to ensure the username contains only lowercase letters and underscores. Throws an `InvalidArgumentException` if it doesn't match.

   - **`validatePassword(?string $plainPassword): string`**:
     - **Description:** Validates a given password string. 
     - **Parameters:**
       - `$plainPassword`: The password to validate (optional, can be null).
     - **Return Values:** The validated password as a string.
     - **Important Logic:**
       - Checks if the password is empty. If so, throws an `InvalidArgumentException`.
       - Uses `Symfony\Component\String\u` to trim whitespace and check if the password length is at least 6 characters. Throws an `InvalidArgumentException` if it's shorter.

   - **`validateEmail(?string $email): string`**:
     - **Description:** Validates a given email address string. 
     - **Parameters:**
       - `$email`: The email address to validate (optional, can be null).
     - **Return Values:** The validated email address as a string.
     - **Important Logic:**
       - Checks if the email is empty. If so, throws an `InvalidArgumentException`.
       - Uses `Symfony\Component\String\u` to check if the email contains an "@" symbol. Throws an `InvalidArgumentException` if it's missing.

   - **`validateFullName(?string $fullName): string`**:
     - **Description:** Validates a given full name string. 
     - **Parameters:**
       - `$fullName`: The full name to validate (optional, can be null).
     - **Return Values:** The validated full name as a string.
     - **Important Logic:**
       - Checks if the full name is empty. If so, throws an `InvalidArgumentException`.

**5. Pseudo Code:**



```
// Class: Validator

// Method: validateUsername(username)
  1. Check if username is empty:
    - If true, throw InvalidArgumentException("The username can not be empty.")
  2. Check if username matches the pattern /^[a-z_]+$/:
    - If false, throw InvalidArgumentException("The username must contain only lowercase latin characters and underscores.")
  3. Return validated username

// Method: validatePassword(plainPassword)
  1. Check if plainPassword is empty:
    - If true, throw InvalidArgumentException("The password can not be empty.")
  2. Check if plainPassword length is at least 6 characters:
    - If false, throw InvalidArgumentException("The password must be at least 6 characters long.")
  3. Return validated plainPassword

// Method: validateEmail(email)
  1. Check if email is empty:
    - If true, throw InvalidArgumentException("The email can not be empty.")
  2. Check if email contains "@":
    - If false, throw InvalidArgumentException("The email should look like a real email.")
  3. Return validated email

// Method: validateFullName(fullName)
  1. Check if fullName is empty:
    - If true, throw InvalidArgumentException("The full name can not be empty.")
  2. Return validated fullName 


```



**Dependencies and Libraries:**

* **Symfony\Component\Console\Exception\InvalidArgumentException**: This exception class is used for throwing validation errors. It's part of the Symfony Console component.
* **Symfony\Component\String\u**: This utility class provides string manipulation functions, including trimming whitespace and checking for specific characters.



