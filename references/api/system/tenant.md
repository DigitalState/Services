# Tenant

The system tenant api endpoints allow authorized users to read, modify and delete tenants.

For more information about the architecture and core concepts of system tenants, you may consult the [Tenant component documentation](https://github.com/DigitalState/Core/blob/develop/documentation/tenant/index.md).

## Table of Contents

- [Get List](#get-list)
- [Get Item](#get-item)
- [Add Item](#add-item)
- [Edit Item](#edit-item)
- [Delete Item](#delete-item)

## Get List

This endpoint returns the list of tenants.

### Method

GET `/system/tenants`

### Headers

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| Accept | string | The accepted returned content types. __Optional.__ Default: `application/ld+json`. Options: `application/json`, `application/ld+json`. | `Accept: application/json` |
| Authorization | string | The basic auth credentials. __Required.__ | `Authorization: Basic c3lzdGVtOnN5c3RlbQ==` |

### Parameters

#### Query Parameters

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| id | integer | Filter tenants by the given id. __Optional.__ | `id=1`<br><br>`id[]=1&id[]=2` |
| uuid | string | Filter tenants by the given uuid. __Optional.__ | `uuid=d928b020-94f6-4928-a510-04fc49d5a174`<br><br>`uuid[]=d928b020-94f6-4928-a510-04fc49d5a174&uuid[]=f9412502-67de-4c1f-b4cf-12a92df58a5a` |
| createdAt[before] | string | Filter tenants that were created before the given date. __Optional.__ | `createdAt[before]=2018-07-20T13:19:30.181Z` |
| createdAt[after] | string | Filter tenants that were created after the given date. __Optional.__ | `createdAt[after]2018-07-20T13:19:30.181Z` |
| updatedAt[before] | string | Filter tenants that were updated before the given date. __Optional.__ | `updatedAt[before]=2018-07-20T13:19:30.181Z` |
| updatedAt[after] | string | Filter tenants that were updated after the given date. __Optional.__ | `updatedAt[after]=2018-07-20T13:19:30.181Z` |
| page | integer | The current page in the pagination. __Optional.__ Default: `1`. | `page=2` |
| limit | integer | The number of items per page. __Optional.__ Default: `10`. | `limit=25` |

### Response

#### 200 OK

A JSON array of objects. Each object contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| id | integer | The tenant id. |
| uuid | string | The tenant uuid. |
| createdAt | string | The date the tenant was created on. |
| updatedAt | string | The date the tenant was update at. |
| data | object | The tenant initialization data. |
| version | integer | The tenant version. This value is used for optimistic locking. |

### Example

#### Request

*Method:*

__GET__ /system/tenants

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
    "uuid": "d928b020-94f6-4928-a510-04fc49d5a174",
    "createdAt": "2018-07-31T14:57:10+00:00",
    "updatedAt": "2018-07-31T14:57:10+00:00",
    "data": {},
    "version": 1
  }
]
```

## GET Item

This endpoint returns a specific tenant.

### Headers

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| Accept | string | The accepted returned content types. __Optional.__ Default: `application/ld+json`. Options: `application/json`, `application/ld+json`. | `Accept: application/json` |
| Authorization | string | The basic auth credentials. __Required.__ | `Authorization: Basic c3lzdGVtOnN5c3RlbQ==` |

### Method

GET `/system/tenants/{uuid}`

### Parameters

#### Path Parameters

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| uuid | string | The uuid of the tenant. __Required.__ | `d928b020-94f6-4928-a510-04fc49d5a174` |

### Response

#### 200 OK

A JSON object that contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| id | integer | The tenant id. |
| uuid | string | The tenant uuid. |
| createdAt | string | The date the tenant was created on. |
| updatedAt | string | The date the tenant was update at. |
| data | object | The tenant initialization data. |
| version | integer | The tenant version. This value is used for optimistic locking. |

#### 404 Not Found

The tenant with the given uuid does not exist.

### Example

#### Request

*Method:*

__GET__ `/system/tenants/d928b020-94f6-4928-a510-04fc49d5a174`

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
  "uuid": "d928b020-94f6-4928-a510-04fc49d5a174",
  "createdAt": "2018-07-31T14:57:10+00:00",
  "updatedAt": "2018-07-31T14:57:10+00:00",
  "data": {},
  "version": 1
}
```

## Add Item

This endpoint adds a tenant to the list.

### Headers

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| Content-Type | string | The accepted returned content types. Options: `application/json`. | `Content-Type: application/json` |
| Accept | string | The accepted returned content types. __Optional.__ Default: `application/ld+json`. Options: `application/json`, `application/ld+json`. | `Accept: application/json` |
| Authorization | string | The basic auth credentials. __Required.__ | `Authorization: Basic c3lzdGVtOnN5c3RlbQ==` |

### Method

POST `/system/tenants`

### Parameters

#### Body

A JSON object that contains the following properties:

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| uuid | string | The tenant uuid. __Optional.__ Default: auto-generated. | `d928b020-94f6-4928-a510-04fc49d5a174` |
| data | object | The tenant initialization data. __Required.__ | `{}` |
| version | integer | The tenant version. This value is used for optimistic locking. __Required.__ | `1` |

### Response

#### 200 OK

A JSON object that contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| id | integer | The tenant id. |
| uuid | string | The tenant uuid. |
| createdAt | string | The date the tenant was created on. |
| updatedAt | string | The date the tenant was update at. |
| data | object | The tenant initialization data. |
| version | integer | The tenant. This value is used for optimistic locking. |

#### 400 Bad Request

There were some validation errors.

### Example

#### Request

*Method:*

__POST__ `/system/tenants`

*Headers:*

```yaml
Content-Type: application/json
Accept: application/json
Authorization: Basic c3lzdGVtOnN5c3RlbQ==
```

*Body:*

```json
{
  "data": {},
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
  "uuid": "d928b020-94f6-4928-a510-04fc49d5a174",
  "createdAt": "2018-07-19T12:08:30+00:00",
  "updatedAt": "2018-07-19T12:08:30+00:00",
  "data": {},
  "version": 1
}
```

## Edit Item

This endpoint edits a specific tenant.

### Method

PUT `/system/tenants/{uuid}`

### Headers

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| Content-Type | string | The accepted returned content types. Options: `application/json`. | `Content-Type: application/json` |
| Accept | string | The accepted returned content types. __Optional.__ Default: `application/ld+json`. Options: `application/json`, `application/ld+json`. | `Accept: application/json` |
| Authorization | string | The basic auth credentials. __Required.__ | `Authorization: Basic c3lzdGVtOnN5c3RlbQ==` |

### Parameters

#### Path Parameters

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| uuid | string | The uuid of the tenant. __Required.__ | `d928b020-94f6-4928-a510-04fc49d5a174` |

#### Body

A JSON object that contains the following properties:

| Name | Type | Description | Example |
| :--- | :---- | :---------- | :------ |
| uuid | string | The tenant uuid. __Optional.__ | `d928b020-94f6-4928-a510-04fc49d5a174` |
| data | object | The tenant initialization. __Optional.__ | `{}` |
| version | integer | The tenant version. This value is used for optimistic locking. __Required.__ | `1` |

### Response

#### 200 OK

A JSON object that contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| id | integer | The tenant id. |
| uuid | string | The tenant uuid. |
| createdAt | string | The date the tenant was created on. |
| updatedAt | string | The date the tenant was update at. |
| data | object | The tenant initialization data. |
| version | integer | The tenant version. This value is used for optimistic locking. |

#### 400 Bad Request

There were some validation errors.

### Example

#### Request

*Method:*

__PUT__ `/system/tenants/d928b020-94f6-4928-a510-04fc49d5a174`

*Headers:*

```yaml
Content-Type: application/json
Accept: application/json
Authorization: Basic c3lzdGVtOnN5c3RlbQ==
```

*Body:*

```json
{
  "data": {},
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
  "uuid": "d928b020-94f6-4928-a510-04fc49d5a174",
  "createdAt": "2018-07-31T14:57:10+00:00",
  "updatedAt": "2018-08-01T12:30:15+00:00",
  "data": {},
  "version": 2
}
```

## Delete Item

This endpoint deletes a specific tenant from the list.

### Method

DELETE `/system/tenants/{uuid}`

### Headers

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| Authorization | string | The basic auth credentials. __Required.__ | `Authorization: Basic c3lzdGVtOnN5c3RlbQ==` |

### Parameters

#### Path Parameters

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| uuid | string | The uuid of the tenant. __Required.__ | `d928b020-94f6-4928-a510-04fc49d5a174` |

### Response

#### 204 No Content

The request was successful and returns no content.

### Example

#### Request

*Method:*

__DELETE__ `/system/tenants/d928b020-94f6-4928-a510-04fc49d5a174`

#### Response

*Code:*

`204 No Content`

*Body:*

```

```
