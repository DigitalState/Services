@api @access @add
Feature: Add accesses

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Add an access
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/accesses" with body:
    """
    {
      "owner": "BusinessUnit",
      "ownerUuid": "325e1004-8516-4ca9-a4d3-d7505bd9a7fe",
      "assignee": "Anonymous",
      "assigneeUuid": "ad1a4ee4-b707-4135-b8e9-498286d5830c",
      "permissions": [],
      "version": 1
    }
    """
    Then the response status code should be 201
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should exist
    And the JSON node "id" should be equal to the number 19
    And the JSON node "uuid" should exist
    And the JSON node "createdAt" should exist
    And the JSON node "updatedAt" should exist
    And the JSON node "owner" should exist
    And the JSON node "owner" should be equal to the string "BusinessUnit"
    And the JSON node "ownerUuid" should exist
    And the JSON node "ownerUuid" should be equal to the string "325e1004-8516-4ca9-a4d3-d7505bd9a7fe"
    And the JSON node "permissions" should exist
    And the JSON node "permissions" should have 0 elements
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 1
    And the JSON node "tenant" should exist
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Read the added access
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses?id=19"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    { "type": "array", "minItems": 1, "maxItems": 1 }
    """
