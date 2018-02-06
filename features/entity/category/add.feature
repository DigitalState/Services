@app @entity @category @add
Feature: Add categories
  In order to add categories
  As a system identity
  I should be able to send api requests related to categories

  Background:
    Given I am authenticated as the "system" identity

  @createSchema @loadFixtures
  Scenario: Add a category
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/categories" with body:
    """
    {
      "owner": "BusinessUnit",
      "ownerUuid": "83bf8f26-7181-4bed-92f3-3ce5e4c286d7",
      "slug": "slug-add",
      "title": {
        "en": "Title - add",
        "fr": "Titre - add"
      },
      "description": {
        "en": "Description - add",
        "fr": "Description - add"
      },
      "presentation": {
        "en": "Presentation - add",
        "fr": "Presentation - add"
      },
      "data": {
        "en": {
          "test": "test - add"
        },
        "fr": {
          "test": "test - add"
        }
      },
      "enabled": true,
      "weight": 1,
      "version": 1
    }
    """
    Then the response status code should be 201
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should exist
    And the JSON node "id" should be equal to the number 2
    And the JSON node "uuid" should exist
    And the JSON node "createdAt" should exist
    And the JSON node "updatedAt" should exist
    And the JSON node "deletedAt" should exist
    And the JSON node "deletedAt" should be null
    And the JSON node "owner" should exist
    And the JSON node "owner" should be equal to the string "BusinessUnit"
    And the JSON node "ownerUuid" should exist
    And the JSON node "ownerUuid" should be equal to the string "83bf8f26-7181-4bed-92f3-3ce5e4c286d7"
    And the JSON node "slug" should exist
    And the JSON node "slug" should be equal to the string "slug-add"
    And the JSON node "title" should exist
    And the JSON node "title.en" should exist
    And the JSON node "title.en" should be equal to "Title - add"
    And the JSON node "title.fr" should exist
    And the JSON node "title.fr" should be equal to "Titre - add"
    And the JSON node "description" should exist
    And the JSON node "description.en" should exist
    And the JSON node "description.en" should be equal to "Description - add"
    And the JSON node "description.fr" should exist
    And the JSON node "description.fr" should be equal to "Description - add"
    And the JSON node "presentation" should exist
    And the JSON node "presentation.en" should exist
    And the JSON node "presentation.en" should be equal to "Presentation - add"
    And the JSON node "presentation.fr" should exist
    And the JSON node "presentation.fr" should be equal to "Presentation - add"
    And the JSON node "data" should exist
    And the JSON node "data.en" should exist
    And the JSON node "data.en.test" should exist
    And the JSON node "data.en.test" should be equal to "test - add"
    And the JSON node "data.fr" should exist
    And the JSON node "data.fr.test" should exist
    And the JSON node "data.fr.test" should be equal to "test - add"
    And the JSON node "enabled" should exist
    And the JSON node "enabled" should be true
    And the JSON node "weight" should exist
    And the JSON node "weight" should be equal to the number 1
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 1

  @dropSchema
  Scenario: Read the added category
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?id=2"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items
