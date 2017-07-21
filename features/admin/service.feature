Feature: Manage services
  In order to manage services
  As an admin identity
  I should be able to execute various services api requests

  Background:
    Given I am authenticated as an "Admin" identity

  @createSchema
  @loadFixtures
  Scenario: Browse services
    When I add "Accept" header equal to "application/json"
    When I send a "GET" request to "/services"
    Then the response status code should be 200
    Then the response should be in JSON
    Then the header "Content-Type" should be equal to "application/json; charset=utf-8"

  @dropSchema
  Scenario: Read service
    When I add "Accept" header equal to "application/json"
    When I send a "GET" request to "/services/920f17d8-ee25-456e-aa56-33771951dc81"
    Then the response status code should be 200
    Then the response should be in JSON
    Then the header "Content-Type" should be equal to "application/json; charset=utf-8"
