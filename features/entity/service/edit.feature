@app @entity @service @edit
Feature: Edit services
  In order to edit services
  As a system identity
  I should be able to send api requests related to services

  Background:
    Given I am authenticated as a "system" identity

  @createSchema @loadFixtures
  Scenario: Edit a service
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/services/7293e6d1-48e2-4761-b9c6-f77258cbe31a" with body:
    """
    {
      "ownerUuid": "a4b9e265-a7a1-4921-a387-1f2a6bea43f6",
      "slug": "report-pothole-edit",
      "title": {
        "en": "Report a Pothole - edit",
        "fr": "Signaler un nids de poule - edit"
      },
      "description": {
        "en": "Description - edit",
        "fr": "Description - edit"
      },
      "presentation": {
        "en": "Presentation - edit",
        "fr": "Presentation - edit"
      },
      "enabled": false,
      "weight": 1
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "ownerUuid" should be equal to the string "a4b9e265-a7a1-4921-a387-1f2a6bea43f6"
    And the JSON node "slug" should be equal to the string "report-pothole-edit"
#    And the JSON node "title" should be equal to "todo"
#    And the JSON node "description" should be equal to "todo"
#    And the JSON node "presentation" should be equal to "todo"
    And the JSON node "enabled" should be false
    And the JSON node "weight" should be equal to the number 1

  Scenario: Confirm the edited service
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services/7293e6d1-48e2-4761-b9c6-f77258cbe31a"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "ownerUuid" should be equal to the string "a4b9e265-a7a1-4921-a387-1f2a6bea43f6"
    And the JSON node "slug" should be equal to the string "report-pothole-edit"
#    And the JSON node "title" should be equal to "todo"
#    And the JSON node "description" should be equal to "todo"
#    And the JSON node "presentation" should be equal to "todo"
    And the JSON node "enabled" should be false
    And the JSON node "weight" should be equal to the number 1

  Scenario: Edit a service's read-only properties
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/services/7293e6d1-48e2-4761-b9c6-f77258cbe31a" with body:
    """
    {
      "id": 9999,
      "uuid": "002a4b0e-6f73-408f-8b04-3295a758feff",
      "createdAt":"2000-01-01T12:00:00+00:00",
      "updatedAt":"2000-01-01T12:00:00+00:00",
      "deletedAt":"2000-01-01T12:00:00+00:00"
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "7293e6d1-48e2-4761-b9c6-f77258cbe31a"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"

  Scenario: Confirm the unedited service
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services/7293e6d1-48e2-4761-b9c6-f77258cbe31a"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "7293e6d1-48e2-4761-b9c6-f77258cbe31a"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"

  @dropSchema
  Scenario: Edit a service with an invalid optimistic lock
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/services/7293e6d1-48e2-4761-b9c6-f77258cbe31a" with body:
    """
    {
      "enabled": true,
      "version": 1
    }
    """
    Then the response status code should be 500
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
    And the response should be in JSON
