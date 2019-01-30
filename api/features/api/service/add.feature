@api @service @add
Feature: Add services

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Add a service
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/services" with body:
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
          "value": "value - add"
        },
        "fr": {
          "value": "value - add"
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
    And the JSON node "id" should be equal to the number 5
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
    And the JSON node "data.en.value" should exist
    And the JSON node "data.en.value" should be equal to "value - add"
    And the JSON node "data.fr" should exist
    And the JSON node "data.fr.value" should exist
    And the JSON node "data.fr.value" should be equal to "value - add"
    And the JSON node "categories" should exist
    And the JSON node "scenarios" should exist
    And the JSON node "enabled" should exist
    And the JSON node "enabled" should be true
    And the JSON node "weight" should exist
    And the JSON node "weight" should be equal to the number 1
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 1
    And the JSON node "tenant" should exist
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Read the added service
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?id=5"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """
