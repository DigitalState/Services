@entity @category @read
Feature: Read categories
  In order to read categories
  As an admin identity
  I should be able to send api requests related to categories

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures @dropSchema
  Scenario: Read a category
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories/7095e66e-ed2f-469a-b173-15c866899d67"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should exist
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should exist
    And the JSON node "uuid" should be equal to the string "7095e66e-ed2f-469a-b173-15c866899d67"
    And the JSON node "createdAt" should exist
    And the JSON node "updatedAt" should exist
    And the JSON node "deletedAt" should exist
    And the JSON node "deletedAt" should be null
    And the JSON node "owner" should exist
    And the JSON node "owner" should be equal to the string "BusinessUnit"
    And the JSON node "ownerUuid" should exist
    And the JSON node "ownerUuid" should be equal to the string "f2b7c698-80b9-413f-ad7e-eeaf6aa048e5"
    And the JSON node "slug" should exist
    And the JSON node "slug" should be equal to the string "public-works"
    And the JSON node "title" should exist
#    And the JSON node "title" should be equal to "todo"
    And the JSON node "description" should exist
#    And the JSON node "description" should be equal to "todo"
    And the JSON node "presentation" should exist
#    And the JSON node "presentation" should be equal to "todo"
    And the JSON node "enabled" should exist
    And the JSON node "enabled" should be true
    And the JSON node "weight" should exist
    And the JSON node "weight" should be equal to the number 0
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 1
