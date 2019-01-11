@api @security @firewall @config @deny
Feature: Deny access to non-authenticated users to config endpoints

  @upMigrations @loadFixtures
  Scenario: Browse configs
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/configs"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Read a config
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/configs/6017bd99-3751-41b0-bc1c-bd629a46a335"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Add a config
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/configs" with body:
    """
    {}
    """
    Then the response status code should be 405
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Edit a config
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/configs/6017bd99-3751-41b0-bc1c-bd629a46a335" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  @downMigrations
  Scenario: Delete a config
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/configs/6017bd99-3751-41b0-bc1c-bd629a46a335"
    Then the response status code should be 405
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
