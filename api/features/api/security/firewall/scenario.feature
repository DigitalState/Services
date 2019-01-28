@api @security @firewall @scenario
Feature: Deny access to non-authenticated users to scenario endpoints

  Scenario: Browse scenarios
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/scenarios"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Read a scenario
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/scenarios/2cb7402d-2a1d-49b3-af2a-3cf378193ffa"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Add a scenario
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/scenarios" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Edit a scenario
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/scenarios/2cb7402d-2a1d-49b3-af2a-3cf378193ffa" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Delete a scenario
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/scenarios/2cb7402d-2a1d-49b3-af2a-3cf378193ffa"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON