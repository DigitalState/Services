# Changelog

## 0.15.0

- Feature [Composer] Upgrade apip dependency to 2.3.6
- Feature [Composer] Upgrade symfony dependency to 4.2.0
- Feature [Fixture] Separate sequence reset fixture from entity fixture
- Feature [Tests] Add wider range of behat tests
- Feature [Api] Rename pagination query parameters to `_page` and `_limit`
- Feature [Config] Config api filter `key` changed from `partial` to `exact` strategy

## 0.14.0 (2018-10-29)

- Feature [Core] Upgrade digitalstate/core dependency to 0.14.0
- Feature [Tenant] Convert tenant data to runtime-only data

## 0.13.2 (2018-10-26)

- Feature [Core] Upgrade digitalstate/core dependency to 0.13.2
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
