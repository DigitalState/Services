@api @config @browse
Feature: Browse configs

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Browse all configs
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/configs"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 8,
      "maxItems": 8,
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
          "key": {
            "type": "string"
          },
          "value": {
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
        "key",
        "value",
        "version",
        "tenant"
      ]
    }
    """

  Scenario: Browse paginated configs
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/configs?_page=1&_limit=1"
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

  Scenario: Browse configs with a specific id
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/configs?id=1"
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

  Scenario: Browse configs with specific ids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/configs?id[0]=1&id[1]=2"
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

  Scenario: Browse configs with a specific uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/configs?uuid=4804b00d-cc69-4a2b-98c2-f8a0d9404764"
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

  Scenario: Browse configs with specific uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/configs?uuid[0]=4804b00d-cc69-4a2b-98c2-f8a0d9404764&uuid[1]=cd5dc7fd-8e00-4afe-803f-9a5cacee47d4"
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

  Scenario: Browse configs with a specific owner
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/configs?owner=BusinessUnit"
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

  Scenario: Browse configs with specific owners
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/configs?owner[0]=BusinessUnit&owner[1]=System"
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

  Scenario: Browse configs with a specific owner uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/configs?ownerUuid=325e1004-8516-4ca9-a4d3-d7505bd9a7fe"
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

  Scenario: Browse configs with specific owner uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/configs?ownerUuid[0]=325e1004-8516-4ca9-a4d3-d7505bd9a7fe&ownerUuid[1]=aa18b644-a503-49fa-8f53-10f4c1f8e3a1"
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

  Scenario: Browse configs with a specific key
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/configs?key=ds_api.user.password"
    Then print last JSON response
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

  Scenario: Browse configs with specific keys
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/configs?key[0]=ds_api.user.username&key[1]=ds_api.user.password"
    Then print last JSON response
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

  Scenario: Browse configs with a specific before created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/configs?createdAt[before]=2050-01-01"
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

  Scenario: Browse configs with a specific after created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/configs?createdAt[after]=2000-01-01"
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

  Scenario: Browse configs with a specific before updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/configs?updatedAt[before]=2050-01-01"
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

  Scenario: Browse configs with a specific after updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/configs?updatedAt[after]=2000-01-01"
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
