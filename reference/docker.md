# Docker

The DigitalState Abstract microservice docker information.

## Table of Contents

- [Docker Compose](#docker-compose)
- [Images](#images)

## Docker Compose

### Environment variables

The environment variables used by the docker-compose files.

_Note: The majority of variables found in the list below are used to override image-level environment variables._

| Name | Description | Default |
| :--- | :---------- | :------ |
| `COMPOSE_CONVERT_WINDOWS_PATHS` | The docker-compose windows path compatibility config. | `true` |
| `COMPOSE_PROJECT_NAME` | The docker-compose project name. This is used to properly namespace docker containers in the event where you are running multiple instances. | `ds_microservice` |
| `DIRECTORY` | The base directory the docker-compose files are located. This is used to properly configure the base directory for DockerForWindows and DockerForMac based machines. | `.` |
| `DATABASE_NAME` | See [POSTGRES_DB](#database_image). | `api` |
| `DATABASE_USER` | See [POSTGRES_USER](#database_image). | `api` |
| `DATABASE_PASSWORD` | See [POSTGRES_PASSWORD](#database_image). | `!ChangeMe!` |
| `API_NAME` | See [APP](#api_image). | `microservice` |
| `API_ENV` | See [APP_ENV](#api_image). | `dev` |
| `API_SECRET` | See [APP_SECRET](#api_image). | `!ChangeMe!` |
| `API_NAMESPACE` | See [APP_NAMESPACE](#api_image). | `ds` |
| `API_TRUSTED_PROXIES` | See [TRUSTED_PROXIES](#api_image). | `10.0.0.0/8,172.16.0.0/12,192.168.0.0/16` |
| `API_TRUSTED_HOSTS` | See [TRUSTED_HOSTS](#api_image). | `localhost,api` |
| `API_DATABASE_URL` | See [DATABASE_URL](#api_image). | `postgres://api:!ChangeMe!@database/api` |
| `API_CORS_ALLOW_ORIGIN` | See [CORS_ALLOW_ORIGIN](#api_image). | `^https?://localhost(:[0-9]+)?$` |
| `API_DISCOVERY_HOST` | See [DISCOVERY_HOST](#api_image). | `127.0.0.1:8500` |
| `API_DISCOVERY_CREDENTIAL` | See [DISCOVERY_CREDENTIAL](#api_image). | `!ChangeMe!` |
| `API_ENCRYPTION` | See [ENCRYPTION](#api_image). | `!ChangeMe!` |
| `API_SYSTEM_USERNAME` | See [SYSTEM_USERNAME](#api_image). | `!ChangeMe!` |
| `API_SYSTEM_PASSWORD` | See [SYSTEM_PASSWORD](#api_image). | `!ChangeMe!` |

## Images

### Database Image

#### Environment Variables

| Name | Description | Default |
| :--- | :---------- | :------ |
| `POSTGRES_DB` | The name of the database to be created by default. | `api` |
| `POSTGRES_USER` | The user to be created by default. | `api` |
| `POSTGRES_PASSWORD` | The password for the default user. | `!ChangeMe!` |

#### Volumes

| Path | Description |
| :--- | :---------- |
| `/var/lib/postgresql/data` | The database data directory. |

### Api Image

#### Environment Variables

| Name | Description | Default |
| :--- | :---------- | :------ |
| `APP` | The microservice app name. This value is used to tag various resources, such as log records, to properly identify such resources in a microservice architecture.  | `microservice` |
| `APP_ENV` | The app runtime environment.  | `dev` |
| `APP_SECRET` | The app secret. See [Symfony reference](https://symfony.com/doc/current/reference/configuration/framework.html#secret) | `!ChangeMe!` |
| `APP_NAMESPACE` | The app namespace. This value is used by various core components to help namespace multiple instances. | `ds` |
| `TRUSTED_PROXIES` | The trusted proxies by the web entrypoint. | `10.0.0.0/8,172.16.0.0/12,192.168.0.0/16` |
| `TRUSTED_HOSTS` | The trusted hosts by the web entrypoint. | `localhost,api` |
| `DATABASE_URL` | The database connection string. | `postgres://api:!ChangeMe!@database/api` |
| `CORS_ALLOW_ORIGIN` | The cors rules. | `^https?://localhost(:[0-9]+)?$` |
| `DISCOVERY_HOST` | The discovery host. This value is used by the discovery core component. | `127.0.0.1:8500` |
| `DISCOVERY_CREDENTIAL` | The discovery credential. This value is used by the discovery core component. | `!ChangeMe!` |
| `ENCRYPTION` | The secret encryption key. | `!ChangeMe!` |
| `SYSTEM_USERNAME` | The system username. | `!ChangeMe!` |
| `SYSTEM_PASSWORD` | The system password. | `!ChangeMe!` |

#### Volumes

| Path | Description |
| :--- | :---------- |
| `/srv/api/config/jwt/key` | The jwt private key. |
| `/srv/api/config/jwt/key.pub` | The jwt public key. |
| `/srv/api/var/logs` | The logs directory. |
| `/srv/api/var/cache` | The cache directory. |
