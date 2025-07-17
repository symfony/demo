## PostRepository.php Documentation

**1. Overview:**

This PHP file defines a custom Doctrine repository named `PostRepository` for interacting with blog posts in a Symfony application. It extends the base `ServiceEntityRepository` class and provides specialized methods for querying and retrieving post information, including pagination, searching, and filtering by tags.

**2. Package/module name:** App\Repository

**3. Class/file name:** PostRepository.php

**4. Detailed Documentation:**

   - **Constructor (`__construct`)**:
     - **Description:** Initializes the repository with a Doctrine manager registry.
     - **Parameters:** `ManagerRegistry $registry`: The Doctrine manager registry used to interact with the database.
     - **Return Values:** None.
     - **Important Logic:** Calls the parent constructor to set up the repository with the specified entity class (`Post`).

   - **`findLatest(int $page = 1, ?Tag $tag = null)`**:
     - **Description:** Retrieves a paginated list of the latest published blog posts. Optionally filters by a specific tag.
     - **Parameters:**
       - `$page`: The page number for pagination (default: 1).
       - `$tag`: An optional `Tag` object to filter posts by.
     - **Return Values:** A `Paginator` object containing the paginated list of posts.
     - **Important Logic:**
       - Builds a Doctrine query builder (`createQueryBuilder`) to select posts, their authors, and associated tags.
       - Filters posts based on publication date (`publishedAt <= :now`), ordering them by descending publication date.
       - If a `Tag` object is provided, further filters the results to include only posts with that tag.
       - Uses the `Paginator` class to handle pagination and return the requested page of results.

   - **`findBySearchQuery(string $query, int $limit = Paginator::PAGE_SIZE)`**:
     - **Description:** Searches for blog posts based on a given search query string.
     - **Parameters:**
       - `$query`: The search query string.
       - `$limit`: The maximum number of results to return (default: `Paginator::PAGE_SIZE`).
     - **Return Values:** An array of matching `Post` objects.
     - **Important Logic:**
       - Extracts individual search terms from the query string using `extractSearchTerms`.
       - Builds a Doctrine query builder (`createQueryBuilder`) and adds "OR" conditions for each term, searching within post titles.
       - Orders results by descending publication date and limits the result set to the specified `$limit`.

   - **`extractSearchTerms(string $searchQuery)`**:
     - **Description:** Processes a search query string to extract individual search terms.
     - **Parameters:** `$searchQuery`: The input search query string.
     - **Return Values:** An array of unique, trimmed search terms with a minimum length of 2 characters.
     - **Important Logic:**
       - Cleans the search query by removing extra spaces and trimming whitespace.
       - Splits the query into individual terms based on spaces.
       - Filters out terms that are too short (less than 2 characters).



**5. Pseudo Code:**

```
// Class: PostRepository

// Method: __construct(ManagerRegistry $registry)
  1. Call parent constructor with provided registry.

// Method: findLatest(int $page = 1, ?Tag $tag = null)
  1. Create a new Doctrine query builder for 'Post' entity.
  2. Add select clauses for 'author' and 'tags'.
  3. Join 'p.author' with 'a' alias and 'p.tags' with 't' alias.
  4. Filter posts where 'publishedAt' is less than or equal to current date/time.
  5. Order results by 'publishedAt' in descending order.
  6. If $tag is provided:
     - Add a WHERE clause to filter posts based on the tag.
  7. Use Paginator class to paginate the query results based on $page.
  8. Return the paginated result.

// Method: findBySearchQuery(string $query, int $limit = Paginator::PAGE_SIZE)
  1. Extract search terms from the $query string using extractSearchTerms function.
  2. If no search terms are found, return an empty array.
  3. Create a Doctrine query builder for 'Post' entity.
  4. For each extracted search term:
     - Add an OR condition to the query builder, searching for the term in post titles.
  5. Order results by 'publishedAt' in descending order.
  6. Limit the result set to $limit.
  7. Execute the query and return the resulting array of Post objects.

// Method: extractSearchTerms(string $searchQuery)
  1. Clean the search query string by removing extra spaces and trimming whitespace.
  2. Split the query into individual terms based on spaces.
  3. Filter out terms that are too short (less than 2 characters).
  4. Return an array of unique, trimmed search terms.



```

**6. Dependencies and Libraries:**


- **Doctrine ORM:** This repository heavily relies on Doctrine ORM for interacting with the database. It uses query builders and entity management provided by Doctrine.
- **Symfony Components:** The `Paginator` class used in this repository is part of the Symfony components library. 
- **String Library (u):**  The code utilizes a string manipulation function from Symfony's String component (`u($searchQuery)->replaceMatches('/[[:space:]]+/', ' ')->trim()->split(' ')`).



