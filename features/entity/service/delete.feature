@app @entity @service @delete
Feature: Delete services
  In order to delete services
  As a system identity
  I should be able to send api requests related to services

  Background:
    Given I am authenticated as a "system" identity

  @createSchema @loadFixtures @dropSchema
  Scenario: Delete a service
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/services/7293e6d1-48e2-4761-b9c6-f77258cbe31a"
    Then the response status code should be 204
    And the response should be empty
