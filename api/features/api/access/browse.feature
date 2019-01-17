@api @access @browse
Feature: Browse accesses

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Browse all accesses
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 9,
      "maxItems": 9,
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
          "owner": {
            "type": "string"
          },
          "ownerUuid": {
            "type": "string",
            "pattern": "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}"
          },
          "assignee": {
            "type": "string"
          },
          "assigneeUuid": {
            "type": ["string", "null"],
            "pattern": "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}"
          },
          "permissions": {
            "type": "array"
          },
          "version": {
            "type": "integer"
          },
          "tenant": {
            "type": "string",
            "pattern": "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}"
          }
        }
      },
      "required": [
        "id",
        "uuid",
        "createdAt",
        "updatedAt",
        "owner",
        "ownerUuid",
        "assignee",
        "assigneeUuid",
        "permissions",
        "version",
        "tenant"
      ]
    }
    """

  Scenario: Browse paginated accesses
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses?_page=1&_limit=1"
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

  Scenario: Browse accesses with a specific id
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses?id=1"
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

  Scenario: Browse accesses with specific ids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses?id[0]=1&id[1]=2"
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

  Scenario: Browse accesses with a specific uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses?uuid=06dd7640-fcd3-4f42-90b6-659caa06d794"
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

  Scenario: Browse accesses with specific uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses?uuid[0]=06dd7640-fcd3-4f42-90b6-659caa06d794&uuid[1]=72569b8a-184f-4e78-be89-8075c14887a0"
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

  Scenario: Browse accesses with a specific owner
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses?owner=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 8,
      "maxItems": 8
    }
    """

  Scenario: Browse accesses with specific owners
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses?owner[0]=BusinessUnit&owner[1]=System"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 9,
      "maxItems": 9
    }
    """

  Scenario: Browse accesses with a specific owner uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses?ownerUuid=325e1004-8516-4ca9-a4d3-d7505bd9a7fe"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 8,
      "maxItems": 8
    }
    """

  Scenario: Browse accesses with specific owner uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses?ownerUuid[0]=325e1004-8516-4ca9-a4d3-d7505bd9a7fe&ownerUuid[1]=aa18b644-a503-49fa-8f53-10f4c1f8e3a1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 9,
      "maxItems": 9
    }
    """

  Scenario: Browse accesses with a specific assignee
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses?assignee=Anonymous"
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

  Scenario: Browse accesses with specific assignees
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses?assignee[0]=Anonymous&assignee[1]=Individual"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 4,
      "maxItems": 4
    }
    """

  Scenario: Browse accesses with a specific assignee uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses?assigneeUuid=ad1a4ee4-b707-4135-b8e9-498286d5830c"
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

  Scenario: Browse accesses with specific assignee uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses?assigneeUuid[0]=ad1a4ee4-b707-4135-b8e9-498286d5830c&assigneeUuid[1]=5da1504c-68a4-4968-a03a-36e6ac39e8f2"
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

  Scenario: Browse accesses with a specific before created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses?createdAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 9,
      "maxItems": 9
    }
    """

  Scenario: Browse accesses with a specific after created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses?createdAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 9,
      "maxItems": 9
    }
    """

  Scenario: Browse accesses with a specific before updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses?updatedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 9,
      "maxItems": 9
    }
    """

  Scenario: Browse accesses with a specific after updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses?updatedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 9,
      "maxItems": 9
    }
    """
