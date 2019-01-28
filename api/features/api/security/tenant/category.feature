@api @security @tenant @category
Feature: Deny access to categories belonging to other tenants

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Browse categories from your own tenant
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "items": {
        "type": "object",
        "properties": {
          "tenant": {
            "type": "string",
            "pattern": "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"
          }
        }
      },
      "required": [
        "tenant"
      ]
    }
    """

  Scenario: Read a category from an other tenant
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories/c38e51f6-fdd7-4a92-9eb1-a663d9650c89"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Edit a category from an other tenant
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/categories/c38e51f6-fdd7-4a92-9eb1-a663d9650c89" with body:
    """
    {}
    """
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Delete a category from another tenant
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/categories/c38e51f6-fdd7-4a92-9eb1-a663d9650c89"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
