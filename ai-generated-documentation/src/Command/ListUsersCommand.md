## ListUsersCommand.php Documentation

**1. Overview:**

This PHP file defines a Symfony console command named `app:list-users` that lists all registered users in the application. It allows limiting the number of displayed users and optionally sending the user list as an email report to a specified address.

**2. Package/Module Name:** App\Command

**3. Class/File Name:** ListUsersCommand.php

**4. Detailed Documentation:**


* **Class: `ListUsersCommand`**
    - This class extends Symfony's `Command` class and defines the logic for the `app:list-users` command. 

    - **Constructor (`__construct`)**:
        -  Takes dependencies as parameters:
            - `$mailer`: An instance of `MailerInterface` used to send emails.
            - `$emailSender`: A string representing the email address from which notifications are sent. This is injected via a dependency injection attribute (`#[Autowire('%app.notifications.email_sender%')]`).
            - `$users`: An instance of `UserRepository`, providing access to user data in the application's database.

    - **`configure()` Method**:
        - Configures command options:
            - `max-results`: Limits the number of displayed users (default is 50).
            - `send-to`: Specifies an email address to receive the user list report.

    - **`execute()` Method**:
        - This method is executed when the command is run. It performs the following steps:
            1. Retrieves the `max-results` value from the input options.
            2. Uses `$this->users->findBy([], ['id' => 'DESC'], $maxResults)` to fetch all users sorted by ID in descending order, limiting the result set based on `max-results`.
            3. Creates a closure function (`createUserArray`) that transforms each user object into an array containing their ID, full name, username, email, and roles.
            4. Uses `array_map` to apply the `createUserArray` closure to the fetched users, creating an array of arrays representing the user data.
            5. Creates a `SymfonyStyle` instance for interacting with the console output.
            6. Displays the user data as a table using `io->table`.
            7. Stores the table content in `$usersAsATable` variable.
            8. Retrieves the `send-to` email address from input options.
            9. If `$email` is set, calls `sendReport()` to send an email containing the user list report.

    - **`sendReport()` Method**:
        - Takes the user data table (`$contents`) and recipient email address (`$recipient`) as parameters.
        - Creates a new `Email` object:
            - Sets the sender to `$this->emailSender`.
            - Sets the recipient to `$recipient`.
            - Sets the subject to "app:list-users report" with the current date and time.
            - Sets the email body to the user data table content (`$contents`).
        - Sends the email using `$this->mailer->send($email)`.



**5. Pseudo Code:**

```
// Class: ListUsersCommand

// Method: execute(InputInterface $input, OutputInterface $output)
  1. Get max_results from input options.
  2. Fetch all users sorted by ID in descending order, limiting the result set to max_results using UserRepository->findBy().
  3. Create a function createUserArray that transforms each user object into an array containing:
     - User ID
     - Full Name
     - Username
     - Email
     - Roles
  4. Apply createUserArray to all fetched users using array_map, creating an array of arrays representing the user data.
  5. Create a SymfonyStyle instance for interacting with the console output.
  6. Display the user data as a table using io->table().
  7. Store the table content in $usersAsATable variable.
  8. Get send_to email address from input options.
  9. If send_to is set:
     - Call sendReport() function, passing $usersAsATable and $recipient email address.

// Method: sendReport(string $contents, string $recipient)
  1. Create a new Email object:
     - Set sender to $this->emailSender.
     - Set recipient to $recipient.
     - Set subject to "app:list-users report" with the current date and time.
     - Set email body to $contents (user data table).
  2. Send the email using $this->mailer->send($email).



```

**6. Dependencies and Libraries:**


* **Symfony Component**: This code relies heavily on Symfony components, particularly:
    - `Console` component for defining and executing console commands.
    - `DependencyInjection` component for dependency injection (`#[Autowire]`).
    - `Mailer` component for sending emails.

* **Doctrine ORM**: The code uses a `UserRepository` which suggests the use of Doctrine ORM for database interactions.



