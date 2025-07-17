## Paginator.php Documentation

**1. Overview:**

This PHP file defines a `Paginator` class that facilitates pagination for Doctrine ORM queries. It allows you to retrieve paginated results from a database query, calculate page numbers, and access individual pages of data. 

**2. Package/module name:** App\Pagination

**3. Class/file name:** Paginator.php

**4. Detailed Documentation:**


* **Class: `Paginator`**
    -  This class is responsible for handling pagination logic for Doctrine ORM queries. It takes a Doctrine QueryBuilder as input and allows you to retrieve paginated results, calculate page numbers, and access individual pages of data.

   * **Constructor (`__construct`)**:
      - **Description:** Initializes the Paginator object with a Doctrine QueryBuilder and an optional page size.
      - **Parameters:**
         - `$queryBuilder`: A DoctrineQueryBuilder instance representing the query to be paginated.
         - `$pageSize` (optional): The number of results to display per page. Defaults to 10 if not provided.
      - **Return Values:** None

   * **Method: `paginate($page = 1)`**:
      - **Description:** Paginates the query and sets up the paginator object with the specified page number.
      - **Parameters:**
         - `$page`: The desired page number (defaults to 1).
      - **Return Values:** Returns the current instance of the Paginator object.
      - **Important Logic:**
         - Calculates the starting result index based on the current page and page size.
         - Sets the firstResult and maxResults properties of the Doctrine QueryBuilder to limit the query results.
         - Creates a DoctrinePaginator instance using the modified query.
         - Retrieves the paginated results as an iterator and stores them in the `$results` property.
         - Calculates the total number of results (`$numResults`) using the DoctrinePaginator.

   * **Method: `getCurrentPage()`**:
      - **Description:** Returns the current page number.
      - **Parameters:** None
      - **Return Values:** The current page number as an integer.

   * **Method: `getLastPage()`**:
      - **Description:** Calculates and returns the last page number based on the total results and page size.
      - **Parameters:** None
      - **Return Values:** The last page number as an integer.

   * **Method: `getPageSize()`**:
      - **Description:** Returns the current page size (number of results per page).
      - **Parameters:** None
      - **Return Values:** The page size as an integer.

   * **Method: `hasPreviousPage()`**:
      - **Description:** Checks if there is a previous page available.
      - **Parameters:** None
      - **Return Values:** True if there is a previous page, false otherwise.

   * **Method: `getPreviousPage()`**:
      - **Description:** Returns the number of the previous page.
      - **Parameters:** None
      - **Return Values:** The number of the previous page as an integer.

   * **Method: `hasNextPage()`**:
      - **Description:** Checks if there is a next page available.
      - **Parameters:** None
      - **Return Values:** True if there is a next page, false otherwise.

   * **Method: `getNextPage()`**:
      - **Description:** Returns the number of the next page.
      - **Parameters:** None
      - **Return Values:** The number of the next page as an integer.

   * **Method: `hasToPaginate()`**:
      - **Description:** Checks if pagination is necessary (i.e., there are more results than the page size).
      - **Parameters:** None
      - **Return Values:** True if pagination is required, false otherwise.

   * **Method: `getNumResults()`**:
      - **Description:** Returns the total number of results from the query.
      - **Parameters:** None
      - **Return Values:** The total number of results as an integer.

   * **Method: `getResults()`**:
      - **Description:** Returns the paginated results as a Traversable object.
      - **Parameters:** None
      - **Return Values:** A Traversable object containing the paginated results.



**5. Pseudo Code:**


```
// Class: Paginator

// Method: __construct(queryBuilder, pageSize)
  1. Initialize currentPage to 1
  2. Store queryBuilder in instance variable
  3. Set pageSize using provided value or default (10)

// Method: paginate(page)
  1. Check if page is valid (greater than 0)
    - If not, set page to 1
  2. Calculate firstResult based on current page and pageSize
  3. Modify queryBuilder with firstResult and maxResults
  4. Create DoctrinePaginator instance using modified queryBuilder
  5. Store paginated results from DoctrinePaginator in $results property
  6. Calculate total number of results using DoctrinePaginator and store it in $numResults

// Method: getCurrentPage()
  1. Return currentPage value

// Method: getLastPage()
  1. Calculate last page based on total results and pageSize
  2. Return calculated last page

// Method: getPageSize()
  1. Return pageSize value

// Method: hasPreviousPage()
  1. Check if currentPage is greater than 1
    - If true, return true; otherwise, return false

// Method: getPreviousPage()
  1. Calculate previous page number (max(1, currentPage - 1))
  2. Return calculated previous page number

// Method: hasNextPage()
  1. Check if currentPage is less than last page
    - If true, return true; otherwise, return false

// Method: getNextPage()
  1. Calculate next page number (min(last page, currentPage + 1))
  2. Return calculated next page number

// Method: hasToPaginate()
  1. Check if total results are greater than pageSize
    - If true, return true; otherwise, return false

// Method: getNumResults()
  1. Return $numResults value

// Method: getResults()
  1. Return $results (paginated data)



```


**6. Dependencies and Libraries:**

* **Doctrine ORM:** This class relies heavily on Doctrine ORM for database interaction and pagination functionality. 
    - **Alternatives:** Other ORM libraries like Eloquent (Laravel), Hibernate (Java), or SQLAlchemy (Python) could be used as alternatives depending on the chosen programming language.



