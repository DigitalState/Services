@api @system @tenant @browse
Feature: Browse tenants

  Background:
    Given I am authenticated as the "system" user

  Scenario: Browse all tenants
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/system/tenants"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 3,
      "maxItems": 3,
      "items": {
        "type": "object",
        "properties": {
          "id": {
            "type": "integer"
          },
          "uuid": {
            "type": "string",
            "pattern": "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}"
          },
          "createdAt": {
            "type": "string"
          },
          "updatedAt": {
            "type": "string"
          },
          "version": {
            "type": "integer"
          }
        }
      },
      "required": [
        "id",
        "uuid",
        "createdAt",
        "updatedAt",
        "version"
      ]
    }
    """

  Scenario: Browse paginated tenants
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/system/tenants?_page=1&_limit=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse tenants with a specific id
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/system/tenants?id=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse tenants with specific ids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/system/tenants?id[0]=1&id[1]=2"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """

  Scenario: Browse tenants with a specific uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/system/tenants?uuid=b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse tenants with specific uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/system/tenants?uuid[0]=b6ac25fe-3cd6-4100-a054-6bba2fc9ef18&uuid[1]=92000deb-b847-4838-915c-b95d2b28e960"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2
    }
    """
