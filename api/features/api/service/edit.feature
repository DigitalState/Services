@api @service @edit
Feature: Edit services

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Edit a service
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/services/7293e6d1-48e2-4761-b9c6-f77258cbe31a" with body:
    """
    {
      "createdAt": "2000-01-01 12:00:00",
      "ownerUuid": "325e1004-8516-4ca9-a4d3-d7505bd9a7fe",
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
    And the JSON node "createdAt" should be equal to the string "2000-01-01T12:00:00+00:00"
    And the JSON node "ownerUuid" should be equal to the string "325e1004-8516-4ca9-a4d3-d7505bd9a7fe"
    And the JSON node "slug" should be equal to the string "report-pothole-edit"
    And the JSON node "title.en" should be equal to "Report a Pothole - edit"
    And the JSON node "title.fr" should be equal to "Signaler un nids de poule - edit"
    And the JSON node "description.en" should be equal to "Description - edit"
    And the JSON node "description.fr" should be equal to "Description - edit"
    And the JSON node "presentation.en" should be equal to "Presentation - edit"
    And the JSON node "presentation.fr" should be equal to "Presentation - edit"
    And the JSON node "data.en.test" should be equal to "test - edit"
    And the JSON node "data.fr.test" should be equal to "test - edit"
    And the JSON node "enabled" should be false
    And the JSON node "weight" should be equal to the number 1
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Confirm the edited service
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services/7293e6d1-48e2-4761-b9c6-f77258cbe31a"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "createdAt" should be equal to the string "2000-01-01T12:00:00+00:00"
    And the JSON node "ownerUuid" should be equal to the string "325e1004-8516-4ca9-a4d3-d7505bd9a7fe"
    And the JSON node "slug" should be equal to the string "report-pothole-edit"
    And the JSON node "title.en" should be equal to "Report a Pothole - edit"
    And the JSON node "title.fr" should be equal to "Signaler un nids de poule - edit"
    And the JSON node "description.en" should be equal to "Description - edit"
    And the JSON node "description.fr" should be equal to "Description - edit"
    And the JSON node "presentation.en" should be equal to "Presentation - edit"
    And the JSON node "presentation.fr" should be equal to "Presentation - edit"
    And the JSON node "data.en.test" should be equal to "test - edit"
    And the JSON node "data.fr.test" should be equal to "test - edit"
    And the JSON node "enabled" should be false
    And the JSON node "weight" should be equal to the number 1
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Edit a service's read-only properties
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/services/7293e6d1-48e2-4761-b9c6-f77258cbe31a" with body:
    """
    {
      "id": 9999,
      "uuid": "002a4b0e-6f73-408f-8b04-3295a758feff",
      "updatedAt":"2000-01-01T12:00:00+00:00",
      "deletedAt":"2000-01-01T12:00:00+00:00",
      "tenant": "20401625-f398-467b-ad31-955575f22d1e"
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "7293e6d1-48e2-4761-b9c6-f77258cbe31a"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Confirm the unedited service
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services/7293e6d1-48e2-4761-b9c6-f77258cbe31a"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "7293e6d1-48e2-4761-b9c6-f77258cbe31a"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

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
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
