@api @security @acl @service
Feature: Validate acl permissions on service endpoints

  Scenario: Browse all services with permission scope `owner = BusinessUnit`
    Given I am authenticated as the "system@system.ds" user with identity role "3762b831-1bb7-438d-9747-1b8657e59877" from the tenant "64c82518-017d-4fb2-9fcf-3926da3616e6"
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 2,
      "maxItems": 2,
      "items": {
        "type": "object",
        "properties": {
          "uuid": {
            "type": "string",
            "enum": [
              "3302e49b-03b0-40c9-8845-4243ca2c0051",
              "dcdbbb1b-0762-4254-a1c5-33080749d5b3"
            ]
          }
        }
      }
    }
    """

  Scenario: Browse all services with permission scope `data.en.attribute = "string"`
    Given I am authenticated as the "system@system.ds" user with identity role "de3d2dea-ab7c-472d-85f0-c7df3db8a690" from the tenant "64c82518-017d-4fb2-9fcf-3926da3616e6"
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1,
      "items": {
        "type": "object",
        "properties": {
          "uuid": {
            "type": "string",
            "enum": [
              "3302e49b-03b0-40c9-8845-4243ca2c0051"
            ]
          }
        }
      }
    }
    """
