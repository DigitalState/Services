# Config

The config api endpoints allow authorized users to read and modify application configurations.

The complete list of configs available can be found [here](../configurations.md).

## Table of Contents

- [Get List](#get-list)
- [Get Item](#get-item)
- [Edit Item](#edit-item)

## Get List

This endpoint returns the list of configurations.

### Method

GET `/configs`

### Headers

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| Accept | string | The accepted returned content types. __Optional.__ Default: `application/ld+json`. Options: `application/json`, `application/ld+json`. | `Accept: application/json` |
| Authorization | string | The JWT token. __Required.__ | `Authorization: eyJhbGciOi.eyJyb2xlcy[...].Ds34hb80Mf[...]` |

### Parameters

#### Query Parameters

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| id | integer | Filter configs by the given id. __Optional.__ | `id=1`<br><br>`id[]=1&id[]=2` |
| uuid | string | Filter configs by the given uuid. __Optional.__ | `uuid=1f0a13f5-7705-4b2d-b454-aa4d9ddb9c77`<br><br>`uuid[]=1f0a13f5-7705-4b2d-b454-aa4d9ddb9c77&uuid[]=25569e61-ff21-4128-8ef1-dd77e0a85f5a` |
| owner | string | Filter configs by the given owner. __Optional.__ | `owner=BusinessUnit`<br><br>`owner[]=BusinessUnit&owner[]=Staff` |
| ownerUuid | string | Filter configs by the given owner uuid. __Optional.__ | `ownerUuid=5f4108bb-fa74-4c93-9bb1-9e37d9302640`<br><br>`ownerUuid[]=5f4108bb-fa74-4c93-9bb1-9e37d9302640&ownerUuid[]=0092e830-e411-47cf-b7ef-c19cc79ba8cb` |
| key | string | Filter configs by the given key. __Optional.__ | `key=app.mail.host`<br><br>`key[]=app.mail.host&key[]=app.mail.post` |
| createdAt[before] | string | Filter configs that were created before the given date. __Optional.__ | `createdAt[before]=2018-07-20T13:19:30.181Z` |
| createdAt[after] | string | Filter configs that were created after the given date. __Optional.__ | `createdAt[after]=2018-07-20T13:19:30.181Z` |
| updatedAt[before] | string | Filter configs that were updated before the given date. __Optional.__ | `updatedAt[before]=2018-07-20T13:19:30.181Z` |
| updatedAt[after] | string | Filter configs that were updated after the given date. __Optional.__ | `updatedAt[after]=2018-07-20T13:19:30.181Z` |
| enabled | boolean | Filter configs by given enabled status. __Optional.__ | `enabled=true` |
| page | integer | The current page in the pagination. __Optional.__ Default: `1`. | `page=2` |
| limit | integer | The number of items per page. __Optional.__ Default: `10`. | `limit=25` |
| order[id] | string | Order configs by id. __Optional.__ Options: `asc`, `desc`. | `order[id]=asc` |
| order[createdAt] | string | Order configs by creation date. __Optional.__ Options: `asc`, `desc`. | `order[createdAt]=asc` |
| order[updatedAt] | string | Order configs by modification date. __Optional.__ Options: `asc`, `desc`. | `order[updatedAt]=asc` |
| order[owner] | string | Order configs by owner. __Optional.__ | `order[owner]=asc` |
| order[key] | string | Order configs by key. __Optional.__ | `order[key]=asc` |

### Response

#### 200 OK

The request was successful and returns a JSON array of objects. Each object contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| id | integer | The config id. |
| uuid | string | The config uuid. |
| createdAt | string | The date the config was created on. |
| updatedAt | string | The date the config was updated at. |
| owner | string | The config owner. |
| ownerUuid | string | The config owner uuid. |
| key | string | The config key. This value is unique. |
| value | mixed | The config value. This value may be an array, object, integer, boolean or string. |
| enabled | boolean | Whether the config is enabled or not. |
| version | integer | The config version. This value is used for optimistic locking. |
| tenant | string | The config tenant uuid. |

### Example

#### Request

*Method:*

__GET__ /configs

*Headers:*

```yaml
Accept: application/json
```

#### Response

*Code:*

`200 OK`

*Body:*

```json
[
  {
    "id": 1,
    "uuid": "1f0a13f5-7705-4b2d-b454-aa4d9ddb9c77",
    "createdAt": "2018-07-18T19:20:18+00:00",
    "updatedAt": "2018-07-18T19:20:18+00:00",
    "owner": "BusinessUnit",
    "ownerUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
    "key": "app.mail.host",
    "value": "localhost",
    "enabled": true,
    "version": 1,
    "tenant": "d928b020-94f6-4928-a510-04fc49d5a174"
  },
  {
    "id": 2,
    "uuid": "25569e61-ff21-4128-8ef1-dd77e0a85f5a",
    "createdAt": "2018-07-18T19:20:18+00:00",
    "updatedAt": "2018-07-18T19:20:18+00:00",
    "owner": "BusinessUnit",
    "ownerUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
    "key": "app.mail.port",
    "value": 25,
    "enabled": true,
    "version": 1,
    "tenant": "d928b020-94f6-4928-a510-04fc49d5a174"
  }
]
```

## GET Item

This endpoint returns a specific configuration.

### Method

GET `/configs/{uuid}`

### Headers

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| Accept | string | The accepted returned content types. __Optional.__ Default: `application/ld+json`. Options: `application/json`, `application/ld+json`. | `Accept: application/json` |
| Authorization | string | The JWT token. __Required.__ | `Authorization: eyJhbGciOi.eyJyb2xlcy[...].Ds34hb80Mf[...]` |

### Parameters

#### Path Parameters

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| uuid | string | The uuid of the config. __Required.__ | `1f0a13f5-7705-4b2d-b454-aa4d9ddb9c77` |

### Response

#### 200 OK

The request was successful and returns a JSON object that contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| id | integer | The config id. |
| uuid | string | The config uuid. |
| createdAt | string | The date the config was created on. |
| updatedAt | string | The date the config was updated at. |
| owner | string | The config owner. |
| ownerUuid | string | The config owner uuid. |
| key | string | The config key. This value is unique. |
| value | mixed | The config value. This value may be an array, object, integer, boolean or string. |
| enabled | boolean | Whether the config is enabled or not. |
| version | integer | The config version. This value is used for optimistic locking. |
| tenant | string | The config tenant uuid. |

#### 404 Not Found

The request was unsuccessful and returns a JSON object that contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| type | string | The error type. |
| title | string | The error title message. |
| detail | string | The error detail description. |

### Example

#### Request

*Method:*

__GET__ `/configs/1f0a13f5-7705-4b2d-b454-aa4d9ddb9c77`

*Headers:*

```yaml
Accept: application/json
```

#### Response

*Code:*

`200 OK`

*Body:*

```json
{
  "id": 1,
  "uuid": "1f0a13f5-7705-4b2d-b454-aa4d9ddb9c77",
  "createdAt": "2018-07-18T19:20:18+00:00",
  "updatedAt": "2018-07-18T19:20:18+00:00",
  "owner": "BusinessUnit",
  "ownerUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
  "key": "app.mail.host",
  "value": "localhost",
  "enabled": true,
  "version": 1,
  "tenant": "d928b020-94f6-4928-a510-04fc49d5a174"
}
```

## Edit Item

This endpoint edits a specific configuration.

### Method

PUT `/configs/{uuid}`

### Headers

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| Content-Type | string | The accepted returned content types. Options: `application/json`. | `Content-Type: application/json` |
| Accept | string | The accepted returned content types. __Optional.__ Default: `application/ld+json`. Options: `application/json`, `application/ld+json`. | `Accept: application/json` |
| Authorization | string | The JWT token. __Required.__ | `Authorization: eyJhbGciOi.eyJyb2xlcy[...].Ds34hb80Mf[...]` |

### Parameters

#### Path Parameters

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| uuid | string | The uuid of the config. __Required.__ | `1f0a13f5-7705-4b2d-b454-aa4d9ddb9c77` |

#### Body

A JSON object that contains the following properties:

| Name | Value | Description | Example |
| :--- | :---- | :---------- | :------ |
| uuid | string | The config uuid. __Optional.__ | `1f0a13f5-7705-4b2d-b454-aa4d9ddb9c77` |
| owner | string | The config owner. __Required.__ | `BusinessUnit` |
| ownerUuid | string | The config owner uuid. __Required.__ | `5f4108bb-fa74-4c93-9bb1-9e37d9302640` |
| key | string | The config key. This value is unique. __Required.__ | `app.mail.host` |
| value | mixed | The config value. This value may be an array, object, integer, boolean or string. __Required.__ | `localhost` |
| enabled | boolean | Whether the config is enabled or not. __Required.__ | true |
| version | integer | The config version. This value is used for optimistic locking. __Required.__ | `1` |

### Response

#### 200 OK

The request was successful and returns a JSON object that contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| id | integer | The config id. |
| uuid | string | The config uuid. |
| createdAt | string | The date the config was created on. |
| updatedAt | string | The date the config was update at. |
| owner | string | The config owner. |
| ownerUuid | string | The config owner uuid. |
| key | string | The config key. This value is unique. |
| value | mixed | The config value. This value may be an array, object, integer, boolean or string. |
| enabled | boolean | Whether the config is enabled or not. |
| version | integer | The config version. This value is used for optimistic locking. |
| tenant | string | The config tenant uuid. |

#### 400 Bad Request

The request was unsuccessful and returns a JSON object that contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| type | string | The error type. |
| title | string | The error title message. |
| detail | string | The error compiled violations. |
| violations | array | The array of violations. |

### Example

#### Request

*Method:*

__PUT__ `/configs/1f0a13f5-7705-4b2d-b454-aa4d9ddb9c77`

*Headers:*

```yaml
Content-Type: application/json
Accept: application/json
```

*Body:*

```json
{
  "enabled": false,
  "version": 1
}
```

#### Response

*Code:*

`200 OK`

*Body:*

```json
{
  "id": 1,
  "uuid": "1f0a13f5-7705-4b2d-b454-aa4d9ddb9c77",
  "createdAt": "2018-07-18T19:20:18+00:00",
  "updatedAt": "2018-07-19T19:21:29+00:00",
  "owner": "BusinessUnit",
  "ownerUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
  "key": "app.mail.host",
  "value": "localhost",
  "enabled": false,
  "version": 2,
  "tenant": "d928b020-94f6-4928-a510-04fc49d5a174"
}
```
