@api @service @delete
Feature: Delete services
  In order to delete services
  As a system identity
  I should be able to send api requests related to services

  Background:
    Given I am authenticated as the "System" identity from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  @upMigrations @loadFixtures
  Scenario: Delete a service
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/services/7293e6d1-48e2-4761-b9c6-f77258cbe31a"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Read the deleted service
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services/7293e6d1-48e2-4761-b9c6-f77258cbe31a"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"

  @downMigrations
  Scenario: Delete a deleted service
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services/7293e6d1-48e2-4761-b9c6-f77258cbe31a"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"

