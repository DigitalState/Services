@api @security @firewall @system @health @deny
Feature: Deny access to non-authenticated users to system health endpoints

  Scenario: Browse health checks
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/system/health"
    Then the response status code should be 401
