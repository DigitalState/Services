@api @security @firewall @system @health @deny
Feature: Deny access to non-authenticated users to system health endpoints

  @upMigrations @loadFixtures @downMigrations
  Scenario: Browse health checks
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/system/health"
    Then the response status code should be 401
#    And the header "Content-Type" should be equal to "application/json"
#    And the response should be in JSON
