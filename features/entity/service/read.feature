@app @entity @service @read
Feature: Read services
  In order to read services
  As a system identity
  I should be able to send api requests related to services

  Background:
    Given I am authenticated as the "system" identity

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
    And the JSON node "ownerUuid" should be equal to the string "83bf8f26-7181-4bed-92f3-3ce5e4c286d7"
    And the JSON node "slug" should exist
    And the JSON node "slug" should be equal to the string "report-pothole"
    And the JSON node "title" should exist
    And the JSON node "title.en" should exist
    And the JSON node "title.en" should be equal to "Report a Pothole"
    And the JSON node "title.fr" should exist
    And the JSON node "title.fr" should be equal to "Signaler un nids de poule"
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
    And the JSON node "categories" should exist
    And the JSON node "scenarios" should exist
    And the JSON node "enabled" should exist
    And the JSON node "enabled" should be true
    And the JSON node "weight" should exist
    And the JSON node "weight" should be equal to the number 0
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 2
