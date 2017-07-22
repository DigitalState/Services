@entity @service @delete
Feature: Delete services
  In order to delete services
  As the admin identity
  I should be able to send api requests related to services

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures @dropSchema
  Scenario: Delete service
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/services/920f17d8-ee25-456e-aa56-33771951dc81"
    Then the response status code should be 204
    And the response should be empty
