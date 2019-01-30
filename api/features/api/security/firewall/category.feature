@api @security @firewall @category
Feature: Deny access to non-authenticated users to category endpoints

  Scenario: Browse categories
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Read a category
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories/70f36469-a65c-4d81-ae15-d66a2ef90df0"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Add a category
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/categories" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Edit a category
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/categories/70f36469-a65c-4d81-ae15-d66a2ef90df0" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Delete a category
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/categories/70f36469-a65c-4d81-ae15-d66a2ef90df0"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON