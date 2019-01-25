@api @metadata @read
Feature: Read metadata

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Read a service
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/metadata/abe3bd7f-b0d4-4b77-97fa-f188a5b500a4"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should exist
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should exist
    And the JSON node "uuid" should be equal to the string "abe3bd7f-b0d4-4b77-97fa-f188a5b500a4"
    And the JSON node "createdAt" should exist
    And the JSON node "updatedAt" should exist
    And the JSON node "deletedAt" should exist
    And the JSON node "owner" should exist
    And the JSON node "owner" should be equal to the string "BusinessUnit"
    And the JSON node "ownerUuid" should exist
    And the JSON node "ownerUuid" should be equal to the string "325e1004-8516-4ca9-a4d3-d7505bd9a7fe"
    And the JSON node "title" should exist
    And the JSON node "title.en" should exist
    And the JSON node "title.en" should be equal to "Acl Scopes"
    And the JSON node "title.fr" should exist
    And the JSON node "title.fr" should be equal to "Portée acl"
    And the JSON node "slug" should exist
    And the JSON node "slug" should be equal to "acl-scopes"
    And the JSON node "type" should exist
    And the JSON node "type" should be equal to "acl"
    And the JSON node "data" should exist
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 1
    And the JSON node "tenant" should exist
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"
