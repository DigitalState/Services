@database @migration
Feature: Load migrations

    Scenario: Loading database migrations in reverse on an up-to-date database
    Given I have a console at "/srv/api"
    When I run the command "php bin/console doctrine:migration:migrate first --no-interaction"
    # Dashes represents the summary section in a successfully executed migration output
    Then I should get the following output on line "-5":
      """
        ------------------------
      """

  Scenario: Loading database migrations on a blank database
    Given I have a console at "/srv/api"
    When I run the command "php bin/console doctrine:migration:migrate --no-interaction"
    # Dashes represents the summary section in a successfully executed migration output
    Then I should get the following output on line "-5":
      """
        ------------------------
      """

  Scenario: Updating database schema based on entity metadata should yield nothing
    Given I have a console at "/srv/api"
    When I run the command "php bin/console doctrine:schema:update --dump-sql"
    Then I should get the following output on line "2":
      """
       [OK] Nothing to update - your database is already in sync with the current entity metadata.
      """
