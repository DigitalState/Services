@api @config @browse
Feature: Browse configs
  In order to browse configs
  As a system identity
  I should be able to send api requests related to configs

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  @upMigrations @loadFixtures @downMigrations
  Scenario: Browse all configs
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/configs"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
