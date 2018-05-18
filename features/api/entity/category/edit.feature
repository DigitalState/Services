@app @api @entity @category @edit
Feature: Edit categories
  In order to edit categories
  As a system identity
  I should be able to send api requests related to categories

  Background:
    Given I am authenticated as the "System" identity from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  @createSchema @loadFixtures
  Scenario: Edit a category
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/categories/70f36469-a65c-4d81-ae15-d66a2ef90df0" with body:
    """
    {
      "ownerUuid": "325e1004-8516-4ca9-a4d3-d7505bd9a7fe",
      "slug": "infrastructure-edit",
      "title": {
        "en": "Infrastructure - edit",
        "fr": "Infrastructure - edit"
      },
      "description": {
        "en": "Description - edit",
        "fr": "Description - edit"
      },
      "presentation": {
        "en": "Presentation - edit",
        "fr": "Presentation - edit"
      },
      "data": {
        "en": {
          "test": "test - edit"
        },
        "fr": {
          "test": "test - edit"
        }
      },
      "enabled": false,
      "weight": 1
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "ownerUuid" should be equal to the string "325e1004-8516-4ca9-a4d3-d7505bd9a7fe"
    And the JSON node "slug" should be equal to the string "infrastructure-edit"
    And the JSON node "title" should exist
    And the JSON node "title.en" should exist
    And the JSON node "title.en" should be equal to "Infrastructure - edit"
    And the JSON node "title.fr" should exist
    And the JSON node "title.fr" should be equal to "Infrastructure - edit"
    And the JSON node "description" should exist
    And the JSON node "description.en" should exist
    And the JSON node "description.en" should be equal to "Description - edit"
    And the JSON node "description.fr" should exist
    And the JSON node "description.fr" should be equal to "Description - edit"
    And the JSON node "presentation" should exist
    And the JSON node "presentation.en" should exist
    And the JSON node "presentation.en" should be equal to "Presentation - edit"
    And the JSON node "presentation.fr" should exist
    And the JSON node "presentation.fr" should be equal to "Presentation - edit"
    And the JSON node "data" should exist
    And the JSON node "data.en" should exist
    And the JSON node "data.en.test" should exist
    And the JSON node "data.en.test" should be equal to "test - edit"
    And the JSON node "data.fr" should exist
    And the JSON node "data.fr.test" should exist
    And the JSON node "data.fr.test" should be equal to "test - edit"
    And the JSON node "enabled" should be false
    And the JSON node "weight" should be equal to the number 1
    And the JSON node "tenant" should exist
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Confirm the edited category
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories/70f36469-a65c-4d81-ae15-d66a2ef90df0"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "ownerUuid" should be equal to the string "325e1004-8516-4ca9-a4d3-d7505bd9a7fe"
    And the JSON node "slug" should be equal to the string "infrastructure-edit"
    And the JSON node "title" should exist
    And the JSON node "title.en" should exist
    And the JSON node "title.en" should be equal to "Infrastructure - edit"
    And the JSON node "title.fr" should exist
    And the JSON node "title.fr" should be equal to "Infrastructure - edit"
    And the JSON node "description" should exist
    And the JSON node "description.en" should exist
    And the JSON node "description.en" should be equal to "Description - edit"
    And the JSON node "description.fr" should exist
    And the JSON node "description.fr" should be equal to "Description - edit"
    And the JSON node "presentation" should exist
    And the JSON node "presentation.en" should exist
    And the JSON node "presentation.en" should be equal to "Presentation - edit"
    And the JSON node "presentation.fr" should exist
    And the JSON node "presentation.fr" should be equal to "Presentation - edit"
    And the JSON node "data" should exist
    And the JSON node "data.en" should exist
    And the JSON node "data.en.test" should exist
    And the JSON node "data.en.test" should be equal to "test - edit"
    And the JSON node "data.fr" should exist
    And the JSON node "data.fr.test" should exist
    And the JSON node "data.fr.test" should be equal to "test - edit"
    And the JSON node "enabled" should be false
    And the JSON node "weight" should be equal to the number 1
    And the JSON node "tenant" should exist
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Edit a category's read-only properties
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/categories/70f36469-a65c-4d81-ae15-d66a2ef90df0" with body:
    """
    {
      "id": 9999,
      "uuid": "25cfe5bb-b52d-4d33-9b54-5ed189cbcd2c",
      "createdAt":"2000-01-01T12:00:00+00:00",
      "updatedAt":"2000-01-01T12:00:00+00:00",
      "deletedAt":"2000-01-01T12:00:00+00:00",
      "tenant": "95fecff7-b6c0-4a70-8896-b2f6f02da801"
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "70f36469-a65c-4d81-ae15-d66a2ef90df0"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Confirm the unedited category
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories/70f36469-a65c-4d81-ae15-d66a2ef90df0"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "70f36469-a65c-4d81-ae15-d66a2ef90df0"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  @dropSchema
  Scenario: Edit a category with an invalid optimistic lock
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/categories/70f36469-a65c-4d81-ae15-d66a2ef90df0" with body:
    """
    {
      "enabled": true,
      "version": 1
    }
    """
    Then the response status code should be 500
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
    And the response should be in JSON
