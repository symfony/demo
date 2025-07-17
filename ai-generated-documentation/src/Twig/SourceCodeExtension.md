## SourceCodeExtension.php Documentation

**1. Overview:**

This Twig extension provides functions to display source code of controllers and templates used in a Symfony application. It's designed for debugging purposes and is considered advanced due to its complexity. 

**2. Package/module name:** Symfony

**3. Class/file name:** SourceCodeExtension.php

**4. Detailed Documentation:**


* **Class: `SourceCodeExtension`**
    - This class extends `AbstractExtension` and provides two Twig functions: `link_source_file` and `show_source_code`. 

* **Constructor (`__construct`)**:
    -  Takes a `FileLinkFormatter` object, responsible for formatting file links.
    -  Accepts the project directory path using the `%kernel.project_dir%` attribute.
    -  Sets the `projectDir` property after processing the path.

* **Method: `setController(callable $controller)`**:
    - Sets a callable representing the controller function to be displayed in the debug output. 

* **Method: `getFunctions()`**:
    - Returns an array of Twig functions registered by this extension.
        -  `link_source_file`: Generates a link to a source file based on its path and line number.
        -  `show_source_code`: Renders the template `debug/source_code.html.twig`, passing controller and template source code.

* **Method: `linkSourceFile(Environment $twig, string $file, int $line)`**:
    - Description: Generates a link to a source file based on its path and line number.
    - Parameters:
        - `$twig`: The Twig environment object.
        - `$file`: The path to the source file.
        - `$line`: The line number within the file.
    - Return Values: A string containing an HTML link to the source file.
    - Important Logic:
        - Normalizes the file path by removing backslashes and comparing it with the project directory.
        - Uses `FileLinkFormatter` to format the link based on the provided file and line number.
        - Returns an empty string if the link formatting fails.

* **Method: `showSourceCode(Environment $twig, string|TemplateWrapper $template)`**:
    - Description: Renders a template displaying the source code of the controller and the current template.
    - Parameters:
        - `$twig`: The Twig environment object.
        - `$template`: A string or TemplateWrapper representing the current template.
    - Return Values: A string containing the rendered HTML output.
    - Important Logic:
        - Calls `getController()` to retrieve controller source code.
        - Calls `getTemplateSource()` to retrieve template source code.
        - Passes both sources to the `debug/source_code.html.twig` template for rendering.

* **Method: `getController()`:**:
    - Description: Retrieves and formats the source code of the currently executing controller function.
    - Parameters: None.
    - Return Values: An array containing file path, starting line number, and formatted source code. Returns null if no controller is set.
    - Important Logic:
        - Checks if a callable controller is set. If not, returns null.
        - Uses `getCallableReflector()` to obtain information about the controller function.
        - Reads the file containing the controller function.
        - Extracts the relevant code block based on the function's start and end lines.
        - Unindents the extracted code using `unindentCode()`.

* **Method: `getCallableReflector(callable $callable)`**:
    - Description: Retrieves a reflector object for the given callable, handling different callable types (arrays, objects, closures).
    - Parameters:
        - `$callable`: The callable function or method.
    - Return Values: A `ReflectionFunctionAbstract` object representing the callable.

* **Method: `getTemplateSource(TemplateWrapper $template)`**:
    - Description: Retrieves information about the source of the given template.
    - Parameters:
        - `$template`: A TemplateWrapper object representing the template.
    - Return Values: An array containing file path, starting line number, and source code.

* **Method: `unindentCode(string $code)`**:
    - Description: Removes leading whitespace from each line of the given code if it starts with four spaces.
    - Parameters:
        - `$code`: The code string to unindent.
    - Return Values: A string containing the unindented code.



**5. Pseudo Code:**

```
// Class: SourceCodeExtension

// Method: __construct(FileLinkFormatter $fileLinkFormat, string $projectDir)
  1. Initialize `this->fileLinkFormat` with the provided formatter object.
  2. Normalize the project directory path and store it in `this->projectDir`.

// Method: setController(callable $controller)
  1. Store the provided callable in `this->controller`.

// Method: getFunctions()
  1. Create an array of Twig functions.
  2. Add `link_source_file` function to the array.
  3. Add `show_source_code` function to the array.
  4. Return the array of functions.

// Method: linkSourceFile(Environment $twig, string $file, int $line)
  1. Normalize the file path by removing backslashes and comparing it with the project directory.
  2. Use `this->fileLinkFormat` to format a link to the file based on its path and line number.
  3. If formatting fails, return an empty string.
  4. Otherwise, return the formatted link as a string.

// Method: showSourceCode(Environment $twig, string|TemplateWrapper $template)
  1. Call `getController()` to retrieve controller source code.
  2. Call `getTemplateSource()` to retrieve template source code.
  3. Pass both sources to the `debug/source_code.html.twig` template for rendering.
  4. Return the rendered HTML output.

// Method: getController()
  1. Check if a callable controller is set. If not, return null.
  2. Use `getCallableReflector()` to obtain information about the controller function.
  3. Read the file containing the controller function.
  4. Extract the relevant code block based on the function's start and end lines.
  5. Unindent the extracted code using `unindentCode()`.
  6. Return an array containing file path, starting line number, and formatted source code.

// Method: getCallableReflector(callable $callable)
  1. Handle different callable types (arrays, objects, closures).
  2. Return a `ReflectionFunctionAbstract` object representing the callable.

// Method: getTemplateSource(TemplateWrapper $template)
  1. Retrieve information about the source of the given template.
  2. Return an array containing file path, starting line number, and source code.

// Method: unindentCode(string $code)
  1. Remove leading whitespace from each line of the code if it starts with four spaces.
  2. Return the unindented code as a string.



```




