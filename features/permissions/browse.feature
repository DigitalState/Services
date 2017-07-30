@permission @browse
Feature: Browse permissions
  In order to browse permissions
  As an admin identity
  I should be able to send api requests related to permissions

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures @dropSchema
  Scenario: Browse all permissions
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/permissions"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
