@app @entity @category @browse
Feature: Browse categories
  In order to browse categories
  As a system identity
  I should be able to send api requests related to categories

  Background:
    Given I am authenticated as the "system" identity

  @createSchema @loadFixtures
  Scenario: Browse all categories
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse paginated categories
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?page=1&limit=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories with a specific id
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?id=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories with specific ids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?id[0]=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories with a specific uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?uuid=70f36469-a65c-4d81-ae15-d66a2ef90df0"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories with specific uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?uuid[0]=70f36469-a65c-4d81-ae15-d66a2ef90df0"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories with a specific owner
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?owner=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories with specific owners
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?owner[0]=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories with a specific owner uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?ownerUuid=83bf8f26-7181-4bed-92f3-3ce5e4c286d7"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories with specific owner uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?ownerUuid[0]=83bf8f26-7181-4bed-92f3-3ce5e4c286d7"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories with a specific before created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?createdAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories with a specific after created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?createdAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories with a specific before updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?updatedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories with a specific after updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?updatedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories with a specific before deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?deletedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories with a specific after deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?deletedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories that are enabled
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?enabled=true"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories that are disabled
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?enabled=false"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories that has keywords for title
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?title=Infrastructure"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories that has case-insensitive keywords for title
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?title=infrastructure"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories that has keywords for description
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?description=Description"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories that has case-insensitive keywords for description
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?description=description"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories that has keywords for presentation
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?presentation=Presentation"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories that has case-insensitive keywords for presentation
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?presentation=presentation"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories ordered by id asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[id]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories ordered by id desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[id]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories ordered by created date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[createdAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories ordered by created date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[createdAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories ordered by updated date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[updatedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories ordered by updated date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[updatedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories ordered by deleted date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[deletedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories ordered by deleted date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[deletedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories ordered by owner asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[owner]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse categories ordered by owner desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[owner]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

#  Scenario: Browse categories ordered by title asc
#    When I add "Accept" header equal to "application/json"
#    And I send a "GET" request to "/categories?order[title]=asc"
#    Then the response status code should be 200
#    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
#    And the response should be in JSON
#    And the response should be a collection
#    And the response collection should count 1 items

#  Scenario: Browse categories ordered by title desc
#    When I add "Accept" header equal to "application/json"
#    And I send a "GET" request to "/categories?order[title]=desc"
#    Then the response status code should be 200
#    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
#    And the response should be in JSON
#    And the response should be a collection
#    And the response collection should count 1 items

  Scenario: Browse categories ordered by weight asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[weight]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  @dropSchema
  Scenario: Browse categories ordered by weight desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[weight]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items
