# Changelog

## 0.13.2 ()

- Bug [Migration] Fix serialization bug for parameter and config migration

## 0.13.1 (2018-10-19)

- Bug [App] Fix racing issue related to `secret` app parameter being null early in the execution

## 0.13.0 (2018-10-17)

- Feature [Core] Upgrade digitalstate/core dependency to 0.13.0

## 0.12.0 (2018-10-10)

- Feature [Core] Upgrade digitalstate/core dependency to 0.12.0
- Feature [Tenant] Introduce tenant unloaders
- Feature [Web] Introduce test entrypoint
- Feature [System] Enable system behat context
- Feature [Config] Enable encryption for config and parameter entities

## 0.11.0

- Feature [Test] Refactor continious integration
- Upgrade [Core] Upgrade digitalstate/core dependency to 0.11.0

## 0.10.0

- Feature [Discovery] Standardize discovery service names
- Upgrade [Core] Upgrade digitalstate/core dependency to 0.10.0

## 0.9.0

- Upgrade [Core] Upgrade digitalstate/core dependency to 0.9.0
- Feature [Doctrine] Add sequence reset for fixtures
- Feature [Behat] Convert from sqlite to postgres in test environment
- Bug [Mailer] Add missing mailer port config
