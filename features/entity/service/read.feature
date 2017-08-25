@app @entity @service @read
Feature: Read services
  In order to read services
  As a system identity
  I should be able to send api requests related to services

  Background:
    Given I am authenticated as a "system" identity

  @createSchema @loadFixtures @dropSchema
  Scenario: Read a service
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services/7293e6d1-48e2-4761-b9c6-f77258cbe31a"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should exist
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should exist
    And the JSON node "uuid" should be equal to the string "7293e6d1-48e2-4761-b9c6-f77258cbe31a"
    And the JSON node "createdAt" should exist
    And the JSON node "updatedAt" should exist
    And the JSON node "deletedAt" should exist
    And the JSON node "deletedAt" should be null
    And the JSON node "owner" should exist
    And the JSON node "owner" should be equal to the string "BusinessUnit"
    And the JSON node "ownerUuid" should exist
    And the JSON node "ownerUuid" should be equal to the string "14da4a8c-aee1-43b3-bbac-e3e81a853e0e"
    And the JSON node "slug" should exist
    And the JSON node "slug" should be equal to the string "report-pothole"
    And the JSON node "title" should exist
#    And the JSON node "title" should be equal to "todo"
    And the JSON node "description" should exist
#    And the JSON node "description" should be equal to "todo"
    And the JSON node "presentation" should exist
#    And the JSON node "presentation" should be equal to "todo"
    And the JSON node "categories" should exist
    And the JSON node "scenarios" should exist
    And the JSON node "enabled" should exist
    And the JSON node "enabled" should be true
    And the JSON node "weight" should exist
    And the JSON node "weight" should be equal to the number 0
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 2
