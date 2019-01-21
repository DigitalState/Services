@api @security @firewall @statistic @deny
Feature: Deny access to non-authenticated users to statistic endpoints

  Scenario: Browse statistics
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/statistics"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
