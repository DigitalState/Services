@api @category @delete
Feature: Delete categories

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Delete a category
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/categories/70f36469-a65c-4d81-ae15-d66a2ef90df0"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Read the deleted category
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories/70f36469-a65c-4d81-ae15-d66a2ef90df0"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"

  Scenario: Delete a deleted category
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories/70f36469-a65c-4d81-ae15-d66a2ef90df0"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
