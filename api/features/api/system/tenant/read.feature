@api @system @tenant @read
Feature: Read tenants

  Background:
    Given I am authenticated as the "system" user

  Scenario: Read a service
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/system/tenants/b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should exist
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should exist
    And the JSON node "uuid" should be equal to the string "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"
    And the JSON node "createdAt" should exist
    And the JSON node "updatedAt" should exist
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 1
