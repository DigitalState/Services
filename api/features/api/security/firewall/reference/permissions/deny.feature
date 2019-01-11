@api @security @firewall @reference @permissions @deny
Feature: Deny access to non-authenticated users to permissions reference endpoints

  @upMigrations @loadFixtures @downMigrations
  Scenario: Browse permissions reference
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/reference/permissions"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
