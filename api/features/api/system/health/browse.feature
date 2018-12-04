@api @system @health @browse
Feature: Browse health statuses
  In order to browse health statuses
  As the system user
  I should be able to send api requests related to health statuses

  Background:
    Given I am authenticated as the "system" user

  @upMigrations @loadFixtures @downMigrations
  Scenario: Browse all health statuses
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/system/health"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
