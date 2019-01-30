@api @scenario @read
Feature: Read scenarios

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Read a scenario
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/scenarios/2cb7402d-2a1d-49b3-af2a-3cf378193ffa"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should exist
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should exist
    And the JSON node "uuid" should be equal to the string "2cb7402d-2a1d-49b3-af2a-3cf378193ffa"
    And the JSON node "createdAt" should exist
    And the JSON node "updatedAt" should exist
    And the JSON node "deletedAt" should exist
    And the JSON node "deletedAt" should be null
    And the JSON node "owner" should exist
    And the JSON node "owner" should be equal to the string "BusinessUnit"
    And the JSON node "ownerUuid" should exist
    And the JSON node "ownerUuid" should be equal to the string "83bf8f26-7181-4bed-92f3-3ce5e4c286d7"
    And the JSON node "service" should exist
    And the JSON node "type" should exist
    And the JSON node "type" should be equal to the string "bpm"
    And the JSON node "config" should exist
    And the JSON node "config.bpm" should exist
    And the JSON node "config.bpm" should be equal to the string "camunda"
    And the JSON node "config.process_definition_key" should exist
    And the JSON node "config.process_definition_key" should be equal to the string "pothole-report"
    And the JSON node "slug" should exist
    And the JSON node "slug" should be equal to the string "online"
    And the JSON node "title" should exist
    And the JSON node "title.en" should exist
    And the JSON node "title.en" should be equal to "Report a Pothole Online"
    And the JSON node "title.fr" should exist
    And the JSON node "title.fr" should be equal to "Signaler un nids de poule en-ligne"
    And the JSON node "description" should exist
    And the JSON node "description.en" should exist
    And the JSON node "description.en" should be equal to "Description ..."
    And the JSON node "description.fr" should exist
    And the JSON node "description.fr" should be equal to "Description ..."
    And the JSON node "presentation" should exist
    And the JSON node "presentation.en" should exist
    And the JSON node "presentation.en" should be equal to "Presentation ..."
    And the JSON node "presentation.fr" should exist
    And the JSON node "presentation.fr" should be equal to "Presentation ..."
    And the JSON node "data" should exist
    And the JSON node "data.en" should exist
    And the JSON node "data.fr" should exist
    And the JSON node "enabled" should exist
    And the JSON node "enabled" should be true
    And the JSON node "weight" should exist
    And the JSON node "weight" should be equal to the number 0
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 1
    And the JSON node "tenant" should exist
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"
