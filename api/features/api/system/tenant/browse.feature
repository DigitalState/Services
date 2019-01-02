@api @system @tenant @browse
Feature: Browse tenants
  In order to browse tenants
  As the system user
  I should be able to send api requests related to tenants

  Background:
    Given I am authenticated as the "system" user

  @upMigrations @loadFixtures @downMigrations
  Scenario: Browse all tenants
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/system/tenants"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And print last JSON response
