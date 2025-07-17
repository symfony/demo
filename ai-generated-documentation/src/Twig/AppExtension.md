## AppExtension.php Documentation

**1. Overview:**

This PHP file defines a Twig extension named `AppExtension` for the Symfony framework. This extension provides a custom Twig function called `locales` that returns an array of enabled locales with their names in their respective languages. 

**2. Package/module name:** Symfony

**3. Class/file name:** AppExtension.php

**4. Detailed Documentation:**

   - **Class: `AppExtension`**
     -  This class extends `Twig\Extension\AbstractExtension` and provides a custom Twig function called `locales`. 

   - **Method: `__construct(array $enabledLocales)`**
      - **Description:** Initializes the extension with an array of enabled locale codes. This array is injected by the Symfony service container.
      - **Parameters:**
         - `$enabledLocales`: An array of strings representing the enabled locale codes (e.g., 'en', 'fr', 'es').
      - **Return Values:** None

   - **Method: `getFunctions()`**
      - **Description:** Returns an array of Twig functions provided by this extension. In this case, it returns a single function called `locales`.
      - **Parameters:** None
      - **Return Values:** An array containing a single `TwigFunction` object for the `locales` function.

   - **Method: `getLocales()`**
      - **Description:** Returns an array of enabled locales with their names in their respective languages. 
      - **Parameters:** None
      - **Return Values:** An array of arrays, where each inner array represents a locale and contains the following keys: 'code' (string) - The locale code, 'name' (string) - The name of the locale in its own language.
      - **Important Logic:** 
         - It first checks if the `$locales` property is already populated. If it is, it returns the existing array.
         - Otherwise, it iterates through the `$enabledLocales` array and uses `Locales::getName()` from the Symfony Intl component to retrieve the locale name in its own language. 
         - It stores each locale code and its corresponding name in the `$locales` property and returns this array.

**5. Pseudo Code:**



```
// Class: AppExtension

// Method: __construct(array $enabledLocales)
  1. Store the provided $enabledLocales array in a class property (e.g., $this->enabledLocales).

// Method: getFunctions()
  1. Create an array of Twig functions.
  2. Add a new Twig function named 'locales' that calls the 'getLocales' method.
  3. Return the array of Twig functions.

// Method: getLocales()
  1. Check if the $this->locales property is already populated.
    - If yes, return the existing $this->locales array.
  2. Initialize an empty array to store locale data (e.g., $this->locales = []).
  3. Iterate through each locale code in the $this->enabledLocales array.
    - For each locale code:
      - Use Locales::getName() to retrieve the locale name in its own language.
      - Create a new array containing the 'code' and 'name' of the locale.
      - Add this new array to the $this->locales array.
  4. Return the populated $this->locales array. 



```

**Dependencies and Libraries:**

* **Symfony Intl Component:** Used for retrieving locale names in their respective languages.


