@entity @category @browse
Feature: Browse categories
  In order to browse categories
  As an admin identity
  I should be able to send api requests related to categories

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures
  Scenario: Browse all categories
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse paginated categories
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?page=1&limit=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse categories with a specific id
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?id=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse categories with specific ids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?id[0]=1&id[1]=2"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse categories with a specific uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?uuid=920f17d8-ee25-456e-aa56-33771951dc81"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse categories with specific uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?uuid[0]=920f17d8-ee25-456e-aa56-33771951dc81&uuid[1]=1f04aa3a-82f7-4103-afb3-0e1029915ec4"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse categories with a specific owner
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?owner=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse categories with specific owners
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?owner[0]=BusinessUnit&owner[1]=Staff"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse categories with a specific owner uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?ownerUuid=f2b7c698-80b9-413f-ad7e-eeaf6aa048e5"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse categories with specific owner uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?ownerUuid[0]=f2b7c698-80b9-413f-ad7e-eeaf6aa048e5&ownerUuid[1]=44a24145-c302-496f-808e-10a3cfee633d"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse categories with a specific before created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?createdAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse categories with a specific after created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?createdAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse categories with a specific before updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?updatedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse categories with a specific after updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?updatedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse categories with a specific before deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?deletedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse categories with a specific after deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?deletedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse categories that are enabled
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?enabled=true"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse categories that are disabled
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?enabled=false"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 0 items

  Scenario: Browse categories that has keywords for title
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?title=Pothole"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse categories that has case-insensitive keywords for title
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?title=pothole"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse categories that has keywords for description
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?description=Pothole"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse categories that has case-insensitive keywords for description
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?description=pothole"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse categories that has keywords for presentation
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?presentation=Pothole"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse categories that has case-insensitive keywords for presentation
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?presentation=pothole"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse categories ordered by id asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[id]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse categories ordered by id desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[id]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse categories ordered by created date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[createdAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse categories ordered by created date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[createdAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse categories ordered by updated date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[updatedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse categories ordered by updated date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[updatedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse categories ordered by deleted date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[deletedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse categories ordered by deleted date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[deletedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse categories ordered by owner asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[owner]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse categories ordered by owner desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[owner]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

#  Scenario: Browse categories ordered by title asc
#    When I add "Accept" header equal to "application/json"
#    And I send a "GET" request to "/categories?order[title]=asc"
#    Then the response status code should be 200
#    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
#    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

#  Scenario: Browse categories ordered by title desc
#    When I add "Accept" header equal to "application/json"
#    And I send a "GET" request to "/categories?order[title]=desc"
#    Then the response status code should be 200
#    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
#    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse categories ordered by weight asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[weight]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  @dropSchema
  Scenario: Browse categories ordered by weight desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/categories?order[weight]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items
