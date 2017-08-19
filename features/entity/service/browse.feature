@entity @service @browse
Feature: Browse services
  In order to browse services
  As an admin identity
  I should be able to send api requests related to services

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures
  Scenario: Browse all services
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse paginated services
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?page=1&limit=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse services with a specific id
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?id=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse services with specific ids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?id[0]=1&id[1]=2"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services with a specific uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?uuid=7293e6d1-48e2-4761-b9c6-f77258cbe31a"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse services with specific uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?uuid[0]=7293e6d1-48e2-4761-b9c6-f77258cbe31a&uuid[1]=cdfbc069-c2f6-4a66-b477-7f9e289f6beb"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services with a specific owner
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?owner=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services with specific owners
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?owner[0]=BusinessUnit&owner[1]=Staff"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services with a specific owner uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?ownerUuid=14da4a8c-aee1-43b3-bbac-e3e81a853e0e"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services with specific owner uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?ownerUuid[0]=14da4a8c-aee1-43b3-bbac-e3e81a853e0e"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services with a specific before created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?createdAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services with a specific after created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?createdAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services with a specific before updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?updatedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services with a specific after updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?updatedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services with a specific before deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?deletedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services with a specific after deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?deletedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services that are enabled
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?enabled=true"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services that are disabled
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?enabled=false"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 0 items

  Scenario: Browse services that has keywords for title
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?title=Pothole"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse services that has case-insensitive keywords for title
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?title=pothole"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse services that has keywords for description
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?description=Description"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse services that has case-insensitive keywords for description
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?description=description"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse services that has keywords for presentation
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?presentation=Presentation"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse services that has case-insensitive keywords for presentation
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?presentation=presentation"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse services ordered by id asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?order[id]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services ordered by id desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?order[id]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services ordered by created date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?order[createdAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services ordered by created date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?order[createdAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services ordered by updated date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?order[updatedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services ordered by updated date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?order[updatedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services ordered by deleted date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?order[deletedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services ordered by deleted date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?order[deletedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services ordered by owner asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?order[owner]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services ordered by owner desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?order[owner]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

#  Scenario: Browse services ordered by title asc
#    When I add "Accept" header equal to "application/json"
#    And I send a "GET" request to "/services?order[title]=asc"
#    Then the response status code should be 200
#    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
#    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

#  Scenario: Browse services ordered by title desc
#    When I add "Accept" header equal to "application/json"
#    And I send a "GET" request to "/services?order[title]=desc"
#    Then the response status code should be 200
#    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
#    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse services ordered by weight asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?order[weight]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  @dropSchema
  Scenario: Browse services ordered by weight desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/services?order[weight]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items
