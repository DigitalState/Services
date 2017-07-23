@entity @category @add
Feature: Add categories
  In order to add categories
  As an admin identity
  I should be able to send api requests related to categories

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures @dropSchema
  Scenario: Add a category
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/categories" with body:
    """
    {
      "owner": "BusinessUnit",
      "ownerUuid": "f386d8a2-cb86-4ec8-a615-6f174461cc2d",
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
    And the JSON node "ownerUuid" should be equal to the string "f386d8a2-cb86-4ec8-a615-6f174461cc2d"
    And the JSON node "slug" should exist
    And the JSON node "slug" should be equal to the string "slug-add"
    And the JSON node "title" should exist
#    And the JSON node "title" should be equal to "todo"
    And the JSON node "description" should exist
#    And the JSON node "description" should be equal to "todo"
    And the JSON node "presentation" should exist
#    And the JSON node "presentation" should be equal to "todo"
    And the JSON node "enabled" should exist
    And the JSON node "enabled" should be true
    And the JSON node "weight" should exist
    And the JSON node "weight" should be equal to the number 1
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 1
