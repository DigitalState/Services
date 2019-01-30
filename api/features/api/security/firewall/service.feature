@api @security @firewall @service
Feature: Deny access to non-authenticated users to service endpoints

  Scenario: Browse services
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Read a service
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services/7293e6d1-48e2-4761-b9c6-f77258cbe31a"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Add a service
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/services" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Edit a service
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/services/7293e6d1-48e2-4761-b9c6-f77258cbe31a" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Delete a service
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/services/7293e6d1-48e2-4761-b9c6-f77258cbe31a"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON