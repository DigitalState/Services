@api @config @edit
Feature: Edit configs

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Edit a config
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/configs/4804b00d-cc69-4a2b-98c2-f8a0d9404764" with body:
    """
    {
      "value": "system2@system.ds",
      "version": 1
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "value" should be equal to the string "system2@system.ds"
    And the JSON node "version" should be equal to the number 2

  Scenario: Confirm the edited config
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/configs/4804b00d-cc69-4a2b-98c2-f8a0d9404764"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "value" should be equal to the string "system2@system.ds"
    And the JSON node "version" should be equal to the number 2

  Scenario: Edit a config's read-only properties
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/configs/4804b00d-cc69-4a2b-98c2-f8a0d9404764" with body:
    """
    {
      "id": 9999,
      "uuid": "1ac1b01e-4934-4b89-8a43-7d17a849be61",
      "createdAt":"2000-01-01T12:00:00+00:00",
      "updatedAt":"2000-01-01T12:00:00+00:00",
      "owner": "System",
      "ownerUuid": "5f8630dd-4739-4573-bcf6-9133416e4311",
      "key": "ds_api.user.username2",
      "version": 2,
      "tenant": "93377748-2abb-4e33-9027-5d8a5c281a41"
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "4804b00d-cc69-4a2b-98c2-f8a0d9404764"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "owner" should be equal to "BusinessUnit"
    And the JSON node "ownerUuid" should be equal to "325e1004-8516-4ca9-a4d3-d7505bd9a7fe"
    And the JSON node "key" should be equal to "ds_api.user.username"
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Confirm the unedited config
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/configs/4804b00d-cc69-4a2b-98c2-f8a0d9404764"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "4804b00d-cc69-4a2b-98c2-f8a0d9404764"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "owner" should be equal to "BusinessUnit"
    And the JSON node "ownerUuid" should be equal to "325e1004-8516-4ca9-a4d3-d7505bd9a7fe"
    And the JSON node "key" should be equal to "ds_api.user.username"
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Edit a config with an invalid optimistic lock
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/configs/4804b00d-cc69-4a2b-98c2-f8a0d9404764" with body:
    """
    {
      "ownerUuid": "8a1e280b-cd3b-4c1e-be62-f2e74b77e350",
      "version": 1
    }
    """
    Then the response status code should be 500
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
