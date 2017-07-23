@entity @category @delete
Feature: Delete categories
  In order to delete categories
  As an admin identity
  I should be able to send api requests related to categories

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures @dropSchema
  Scenario: Delete a category
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/categories/7095e66e-ed2f-469a-b173-15c866899d67"
    Then the response status code should be 204
    And the response should be empty
