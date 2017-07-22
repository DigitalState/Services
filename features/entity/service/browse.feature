@entity
@service
@browse
Feature: Browse services
  In order to browse services
  As the admin identity
  I should be able to send api requests related to services

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema
  @loadFixtures
  Scenario: Browse all services
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON

  Scenario: Browse services with a specific id
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services" with parameters:
      | id | 1 |
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON

  Scenario: Browse services with specific ids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services" with parameters:
      | id | [1,2] |
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON

  Scenario: Browse services with specific a uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services" with parameters:
      | uuid | 920f17d8-ee25-456e-aa56-33771951dc81 |
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON

  @dropSchema
  Scenario: Browse services with specific uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services" with parameters:
      | id | [920f17d8-ee25-456e-aa56-33771951dc81,1f04aa3a-82f7-4103-afb3-0e1029915ec4] |
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON