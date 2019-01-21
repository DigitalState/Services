@api @system @health @browse
Feature: Browse health statuses

  Background:
    Given I am authenticated as the "system" user

  Scenario: Browse all health statuses
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/system/health"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
