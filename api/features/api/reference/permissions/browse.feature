@api @reference @permission @browse
Feature: Browse permissions

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  @upMigrations @loadFixtures @downMigrations
  Scenario: Browse all permissions
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/reference/permissions"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
