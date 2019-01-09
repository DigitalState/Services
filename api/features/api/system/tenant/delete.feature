@api @system @tenant @delete
Feature: Delete tenants
  In order to delete tenants
  As the system user
  I should be able to send api requests related to tenants

  Background:
    Given I am authenticated as the "system" user

  @upMigrations @loadFixtures
  Scenario: Delete a tenant
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/system/tenants/92000deb-b847-4838-915c-b95d2b28e960"
    Then the response status code should be 204
    And the response should be empty

  @downMigrations
  Scenario: Read the deleted tenant
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/system/tenants/92000deb-b847-4838-915c-b95d2b28e960"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
