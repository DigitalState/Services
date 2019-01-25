@api @metadata @edit
Feature: Edit metadata

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Edit a metadata
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/metadata/abe3bd7f-b0d4-4b77-97fa-f188a5b500a4" with body:
    """
    {
      "owner": "System",
      "ownerUuid": "aa18b644-a503-49fa-8f53-10f4c1f8e3a1",
      "title": {
        "en": "Title - edit",
        "fr": "Titre - edit"
      },
      "slug": "slug-edit",
      "type": "type-edit",
      "data": {
        "value": "value-edit"
      },
      "version": 1
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "owner" should be equal to the string "System"
    And the JSON node "ownerUuid" should be equal to the string "aa18b644-a503-49fa-8f53-10f4c1f8e3a1"
    And the JSON node "title.en" should be equal to the string "Title - edit"
    And the JSON node "title.fr" should be equal to the string "Titre - edit"
    And the JSON node "slug" should be equal to the string "slug-edit"
    And the JSON node "type" should be equal to the string "type-edit"
    And the JSON node "data.value" should be equal to the string "value-edit"
    And the JSON node "version" should be equal to the number 2

  Scenario: Confirm the edited metadata
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/metadata/abe3bd7f-b0d4-4b77-97fa-f188a5b500a4"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "owner" should be equal to the string "System"
    And the JSON node "ownerUuid" should be equal to the string "aa18b644-a503-49fa-8f53-10f4c1f8e3a1"
    And the JSON node "title.en" should be equal to the string "Title - edit"
    And the JSON node "title.fr" should be equal to the string "Titre - edit"
    And the JSON node "slug" should be equal to the string "slug-edit"
    And the JSON node "type" should be equal to the string "type-edit"
    And the JSON node "data.value" should be equal to the string "value-edit"
    And the JSON node "version" should be equal to the number 2

  Scenario: Edit a metadata's read-only properties
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/metadata/abe3bd7f-b0d4-4b77-97fa-f188a5b500a4" with body:
    """
    {
      "id": 9999,
      "uuid": "421aebbb-e62e-4b87-bced-42921456131b",
      "createdAt":"2000-01-01T12:00:00+00:00",
      "updatedAt":"2000-01-01T12:00:00+00:00",
      "version": 2,
      "tenant": "93377748-2abb-4e33-9027-5d8a5c281a41"
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "abe3bd7f-b0d4-4b77-97fa-f188a5b500a4"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Confirm the unedited metadata
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/metadata/abe3bd7f-b0d4-4b77-97fa-f188a5b500a4"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "abe3bd7f-b0d4-4b77-97fa-f188a5b500a4"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Edit a metadata with an invalid optimistic lock
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/metadata/abe3bd7f-b0d4-4b77-97fa-f188a5b500a4" with body:
    """
    {
      "ownerUuid": "8a1e280b-cd3b-4c1e-be62-f2e74b77e350",
      "version": 1
    }
    """
    Then the response status code should be 500
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
