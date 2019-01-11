@api @security @firewall @system @tenant @deny
Feature: Deny access to non-authenticated users to system tenant endpoints

  @upMigrations @loadFixtures
  Scenario: Browse tenants
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/system/tenants"
    Then the response status code should be 401
#    And the header "Content-Type" should be equal to "application/json"
#    And the response should be in JSON

  Scenario: Read an access
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/system/tenants/92000deb-b847-4838-915c-b95d2b28e960"
    Then the response status code should be 401
#    And the header "Content-Type" should be equal to "application/json"
#    And the response should be in JSON

  Scenario: Add an access
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/system/tenants" with body:
    """
    {}
    """
    Then the response status code should be 401
#    And the header "Content-Type" should be equal to "application/json"
#    And the response should be in JSON

  Scenario: Edit an access
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/system/tenants/92000deb-b847-4838-915c-b95d2b28e960" with body:
    """
    {}
    """
    Then the response status code should be 401
#    And the header "Content-Type" should be equal to "application/json"
#    And the response should be in JSON

  @downMigrations
  Scenario: Delete an access
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/system/tenants/92000deb-b847-4838-915c-b95d2b28e960"
    Then the response status code should be 401
#    And the header "Content-Type" should be equal to "application/json"
#    And the response should be in JSON