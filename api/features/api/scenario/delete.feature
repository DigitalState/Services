@api @scenario @delete
Feature: Delete scenarios

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Delete a scenario
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/scenarios/2cb7402d-2a1d-49b3-af2a-3cf378193ffa"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Read the deleted scenario
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/scenarios/2cb7402d-2a1d-49b3-af2a-3cf378193ffa"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"

  Scenario: Delete a deleted scenario
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/scenarios/2cb7402d-2a1d-49b3-af2a-3cf378193ffa"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"

