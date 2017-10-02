@app @entity @category @edit
Feature: Edit categories
  In order to edit categories
  As a system identity
  I should be able to send api requests related to categories

  Background:
    Given I am authenticated as a "system" identity

  @createSchema @loadFixtures
  Scenario: Edit a category
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/categories/70f36469-a65c-4d81-ae15-d66a2ef90df0" with body:
    """
    {
      "ownerUuid": "0350944c-3d60-4d19-b74f-48865ea91339",
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
    And the JSON node "ownerUuid" should be equal to the string "0350944c-3d60-4d19-b74f-48865ea91339"
    And the JSON node "slug" should be equal to the string "infrastructure-edit"
#    And the JSON node "title" should be equal to "todo"
#    And the JSON node "description" should be equal to "todo"
#    And the JSON node "presentation" should be equal to "todo"
#    And the JSON node "data" should be equal to "todo"
    And the JSON node "enabled" should be false
    And the JSON node "weight" should be equal to the number 1

  Scenario: Confirm the edited category
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories/70f36469-a65c-4d81-ae15-d66a2ef90df0"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "ownerUuid" should be equal to the string "0350944c-3d60-4d19-b74f-48865ea91339"
    And the JSON node "slug" should be equal to the string "infrastructure-edit"
#    And the JSON node "title" should be equal to "todo"
#    And the JSON node "description" should be equal to "todo"
#    And the JSON node "presentation" should be equal to "todo"
#    And the JSON node "data" should be equal to "todo"
    And the JSON node "enabled" should be false
    And the JSON node "weight" should be equal to the number 1

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
      "deletedAt":"2000-01-01T12:00:00+00:00"
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
