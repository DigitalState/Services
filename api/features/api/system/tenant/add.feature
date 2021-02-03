@api @system @tenant @add
Feature: Add tenant

  Background:
    Given I am authenticated as the "system" user

  Scenario: Add a tenant
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/system/tenants" with body:
    """
    {
      "createdAt": "2000-01-01 12:00:00",
      "uuid": "3b0f1019-e9b6-458d-b9ad-fd60c079ee7b",
      "data": {
          "user": {
              "system": {
                  "uuid": "5cc6ed87-7fa0-4f49-b14c-85ff44078858",
                  "password": "password"
              },
              "anonymous": {
                  "uuid": "ad20e2f8-bdf7-4f31-b8c8-2f61c92d1473",
                  "password": "password"
              },
              "admin": {
                  "uuid": "2bf35b9d-a7d5-4bfd-bd7a-e69435f14a0c",
                  "password": "password"
              }
          },
          "identity": {
              "system": {
                  "uuid": "7667171d-da68-4940-938d-088d1644c789"
              },
              "anonymous": {
                  "uuid": "52242e77-8703-412d-a815-c0fe652022d2"
              },
              "admin": {
                  "uuid": "34a529ae-73f8-4549-be6c-75a964109cb9"
              }
          },
          "business_unit": {
              "administration": {
                  "uuid": "dfdc7e82-82b2-429e-b564-c9161083615b"
              }
          },
          "role": {
              "administrator": {
                  "uuid": "73070c31-5e65-40f0-b1cb-536d0f81f1bc"
              }
          },
          "tenant": {
              "uuid": "cd358ded-5c17-445e-a80c-871f551937bf"
          },
          "config": {
              "app.spa.admin": {
                  "value": "http://admin.ds"
              },
              "app.spa.portal": {
                  "value": "http://portal.ds"
              }
          }
      },
      "version": 1
    }
    """
    Then the response status code should be 201
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should exist
    And the JSON node "id" should be equal to the number 4
    And the JSON node "uuid" should exist
    And the JSON node "uuid" should be equal to "3b0f1019-e9b6-458d-b9ad-fd60c079ee7b"
    And the JSON node "createdAt" should exist
    And the JSON node "createdAt" should be equal to the string "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should exist
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 1

  Scenario: Read the added tenant
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/system/tenants?id=4"
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
