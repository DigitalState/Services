# Metadata

The metadata api endpoints allow authorized users to read, modify and delete metadata resources.

For more information about the architecture and core concepts of metadata resources, you may consult the [Metadata component documentation](https://github.com/DigitalState/Core/blob/develop/documentation/metadata/index.md).

## Table of Contents

- [Get List](#get-list)
- [Get Item](#get-item)
- [Add Item](#add-item)
- [Edit Item](#edit-item)
- [Delete Item](#delete-item)

## Get List

This endpoint returns the list of metadata resources.

### Method

GET `/metadatas`

### Headers

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| Accept | string | The accepted returned content types. __Optional.__ Default: `application/ld+json`. Options: `application/json`, `application/ld+json`. | `Accept: application/json` |
| Authorization | string | The JWT token. __Required.__ | `Authorization: eyJhbGciOi.eyJyb2xlcy[...].Ds34hb80Mf[...]` |

### Parameters

#### Query Parameters

| Name | Type | Description | Example |
| ---- | ---- | ----------- | ------- |
| id | integer | Filter metadata resources by the given id. __Optional.__ | `id=1`<br><br>`id[]=1&id[]=2` |
| uuid | string | Filter metadata resources by the given uuid. __Optional.__ | `uuid=941b9d4e-d0e5-41df-a62e-97db05559dac`<br><br>`uuid[]=941b9d4e-d0e5-41df-a62e-97db05559dac&uuid[]=70e6171c-c1ea-47d1-b24c-4b93328908fc` |
| createdAt[before] | string | Filter metadata resources that were created before the given date. __Optional.__ | `createdAt[before]=2018-07-20T13:19:30.181Z` |
| createdAt[after] | string | Filter metadata resources that were created after the given date. __Optional.__ | `createdAt[after]2018-07-20T13:19:30.181Z` |
| updatedAt[before] | string | Filter metadata resources that were updated before the given date. __Optional.__ | `updatedAt[before]=2018-07-20T13:19:30.181Z` |
| updatedAt[after] | string | Filter metadata resources that were updated after the given date. __Optional.__ | `updatedAt[after]=2018-07-20T13:19:30.181Z` |
| owner | string | Filter metadata resources by the given owner. __Optional.__ | `owner=BusinessUnit`<br><br>`owner[]=BusinessUnit&owner[]=Staff` |
| ownerUuid | string | Filter metadata resources by the given owner uuid. __Optional.__ | `ownerUuid=c11c546e-bd01-47cf-97da-e25388357b5a`<br><br>`ownerUuid[]=c11c546e-bd01-47cf-97da-e25388357b5a&ownerUuid[]=a9d68bf7-5000-49fe-8b00-33dde235b327` |
| title | string | Filter metadata resources by the given partial title. __Optional.__ | `title=OAuth`<br><br>`title[]=OAuth&title[]=Registration` |
| slug | string | Filter metadata resources by the given slug. __Optional.__ | `slug=oauth-providers`<br><br>`slug[]=oauth-providers&slug[]=registration` |
| type | string | Filter metadata resources by the given type. __Optional.__ | `type=authentication`<br><br>`type[]=authentication&type[]=user` |
| page | integer | The current page in the pagination. __Optional.__ Default: `1`. | `page=2` |
| limit | integer | The number of items per page. __Optional.__ Default: `10`. | `limit=25` |
| order[id] | string | Order metadata resources by id. __Optional.__ Options: `asc`, `desc`. | `order[id]=asc` |
| order[createdAt] | string | Order metadata resources by creation date. __Optional.__ Options: `asc`, `desc`. | `order[createdAt]=asc` |
| order[updatedAt] | string | Order metadata resources by modification date. __Optional.__ Options: `asc`, `desc`. | `order[updatedAt]=asc` |
| order[owner] | string | Order metadata resources by owner. __Optional.__ | `order[owner]=asc` |
| order[title] | string | Order metadata resources by title. __Optional.__ | `order[title]=asc` |
| order[type] | string | Order metadata resources by type. __Optional.__ | `order[type]=asc` |
| order[slug] | string | Order metadata resources by slug. __Optional.__ | `order[slug]=asc` |

### Response

#### 200 OK

The request was successful and returns a JSON array of objects. Each object contains the following properties:

| Name | Type | Description |
| ---- | ---- | ----------- |
| id | integer | The metadata resource id. |
| uuid | string | The metadata resource uuid. |
| createdAt | string | The date the metadata resource was created on. |
| updatedAt | string | The date the metadata resource was updated at. |
| owner | string | The metadata resource owner. |
| ownerUuid | string | The metadata resource owner uuid. |
| title | object | The metadata resource title. |
| slug | string | The metadata resource slug. This value is unique. |
| type | string | The metadata resource type. |
| data | json | The metadata resource data. |
| version | integer | The config version. This value is used for optimistic locking. |
| tenant | string | The config tenant uuid. |

### Example

#### Request

*Method:*

__GET__ /metadatas

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
    "uuid": "941b9d4e-d0e5-41df-a62e-97db05559dac",
    "createdAt": "2018-07-18T19:20:17+00:00",
    "updatedAt": "2018-07-18T19:20:17+00:00",
    "owner": "BusinessUnit",
    "ownerUuid": "c11c546e-bd01-47cf-97da-e25388357b5a",
    "title": {
      "en": "OAuth Providers"
    },
    "slug": "oauth-providers",
    "type": "authentication",
    "data": [
      "Github",
      "Google",
      "Twitter"
    ],
    "version": 1,
    "tenant": "e5a2120d-6bf7-4c58-a900-bac1e55e986b"
  }
]
```

## GET Item

This endpoint returns a specific metadata resource.

### Method

GET `/metadatas/{uuid}`

### Headers

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| Accept | string | The accepted returned content types. __Optional.__ Default: `application/ld+json`. Options: `application/json`, `application/ld+json`. | `Accept: application/json` |
| Authorization | string | The JWT token. __Required.__ | `Authorization: eyJhbGciOi.eyJyb2xlcy[...].Ds34hb80Mf[...]` |

### Parameters

#### Path Parameters

| Name | Type | Description | Example |
| ---- | ---- | ----------- | ------- |
| uuid | string | The uuid of the metadata resource. __Required.__ | `941b9d4e-d0e5-41df-a62e-97db05559dac` |

### Response

#### 200 OK

The request was successful and returns a JSON object that contains the following properties:

| Name | Type | Description |
| ---- | ---- | ----------- |
| id | integer | The metadata resource id. |
| uuid | string | The metadata resource uuid. |
| createdAt | string | The date the metadata resource was created on. |
| updatedAt | string | The date the metadata resource was updated at. |
| owner | string | The metadata resource owner. |
| ownerUuid | string | The metadata resource owner uuid. |
| title | object | The metadata resource title. |
| slug | string | The metadata resource slug. This value is unique. |
| type | string | The metadata resource type. |
| data | json | The metadata resource data. |
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

__GET__ `/metadatas/941b9d4e-d0e5-41df-a62e-97db05559dac`

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
  "uuid": "941b9d4e-d0e5-41df-a62e-97db05559dac",
  "createdAt": "2018-07-18T19:20:17+00:00",
  "updatedAt": "2018-07-18T19:20:17+00:00",
  "owner": "BusinessUnit",
  "ownerUuid": "c11c546e-bd01-47cf-97da-e25388357b5a",
  "title": {
    "en": "OAuth Providers"
  },
  "slug": "oauth-providers",
  "type": "authentication",
  "data": [
    "Github",
    "Google",
    "Twitter"
  ],
  "version": 1,
  "tenant": "e5a2120d-6bf7-4c58-a900-bac1e55e986b"
}
```

## Add Item

This endpoint adds an metadata resource to the list.

### Method

POST `/metadatas`

### Headers

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| Content-Type | string | The accepted returned content types. Options: `application/json`. | `Content-Type: application/json` |
| Accept | string | The accepted returned content types. __Optional.__ Default: `application/ld+json`. Options: `application/json`, `application/ld+json`. | `Accept: application/json` |
| Authorization | string | The JWT token. __Required.__ | `Authorization: eyJhbGciOi.eyJyb2xlcy[...].Ds34hb80Mf[...]` |

### Parameters

#### Body

A JSON object that contains the following properties:

| Name | Type | Description | Example |
| ---- | ---- | ----------- | ------- |
| uuid | string | The metadata resource uuid. __Optional.__ Default: auto-generated. | `cf687347-6bba-4137-b180-9f581f5cba84` |
| owner | string | The metadata resource owner. __Required.__ | `BusinessUnit` |
| ownerUuid | string | The metadata resource owner uuid. __Optional.__ Default: `null`. | `c11c546e-bd01-47cf-97da-e25388357b5a` |
| title | object | The metadata resource title. __Required.__ | `{ "en": "OAuth Providers" }` |
| slug | string | The metadata resource slug. This value is unique. __Required.__ | `oauth-providers` |
| type | string | The metadata resource type. __Required.__ | `authentication` |
| data | json | The metadata resource data. __Optional.__ Default: `{}` | `["Github", "Google", "Twitter"]` |
| version | integer | The metadata resource version. This value is used for optimistic locking. __Required.__ | `1` |

### Response

#### 200 OK

The request was successful and returns a JSON object that contains the following properties:

| Name | Type | Description |
| ---- | ---- | ----------- |
| id | integer | The metadata resource id. |
| uuid | string | The metadata resource uuid. |
| createdAt | string | The date the metadata resource was created on. |
| updatedAt | string | The date the metadata resource was update at. |
| owner | string | The metadata resource owner. |
| ownerUuid | string | The metadata resource owner uuid. |
| title | object | The metadata resource title. |
| slug | string | The metadata resource slug. This value is unique. |
| type | string | The metadata resource type. |
| data | json | The metadata resource data. |
| version | integer | The config version. This value is used for optimistic locking. |
| tenant | string | The config tenant uuid. |

#### 400 Bad Request

The request was unsuccessful and returns a JSON object that contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| type | string | The error type. |
| title | string | The error title message. |
| detail | string | The error detail description. |

### Example

#### Request

*Method:*

__POST__ `/metadatas`

*Headers:*

```yaml
Content-Type: application/json
Accept: application/json
```

*Body:*

```json
{
  "owner": "BusinessUnit",
  "ownerUuid": "c11c546e-bd01-47cf-97da-e25388357b5a",
  "title": {
    "en": "OAuth Providers"
  },
  "slug": "oauth-providers",
  "type": "authentication",
  "data": [
    "Github",
    "Google",
    "Twitter"
  ],
  "version": 1
}
```

#### Response

*Code:*

`200 OK`

*Body:*

```json
{
  "id": 2,
  "uuid": "cf687347-6bba-4137-b180-9f581f5cba84",
  "createdAt": "2018-07-18T19:20:17+00:00",
  "updatedAt": "2018-07-18T19:20:17+00:00",
  "owner": "BusinessUnit",
  "ownerUuid": "c11c546e-bd01-47cf-97da-e25388357b5a",
  "title": {
    "en": "OAuth Providers"
  },
  "slug": "oauth-providers",
  "type": "authentication",
  "data": [
    "Github",
    "Google",
    "Twitter"
  ],
  "version": 1,
  "tenant": "e5a2120d-6bf7-4c58-a900-bac1e55e986b"
}
```

## Edit Item

This endpoint edits a specific metadata resource.

### Method

PUT `/metadatas/{uuid}`

### Headers

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| Content-Type | string | The accepted returned content types. Options: `application/json`. | `Content-Type: application/json` |
| Accept | string | The accepted returned content types. __Optional.__ Default: `application/ld+json`. Options: `application/json`, `application/ld+json`. | `Accept: application/json` |
| Authorization | string | The JWT token. __Required.__ | `Authorization: eyJhbGciOi.eyJyb2xlcy[...].Ds34hb80Mf[...]` |

### Parameters

#### Path Parameters

| Name | Type | Description | Example |
| ---- | ---- | ----------- | ------- |
| uuid | string | The uuid of the metadata resource. __Required.__ | `941b9d4e-d0e5-41df-a62e-97db05559dac` |

#### Body

A JSON object that contains the following properties:

| Name | Value | Description | Example |
| ---- | ----- | ----------- | ------- |
| uuid | string | The metadata resource uuid. __Optional.__ Default: auto-generated. | `941b9d4e-d0e5-41df-a62e-97db05559dac` |
| owner | string | The metadata resource owner. __Required.__ | `BusinessUnit` |
| ownerUuid | string | The metadata resource owner uuid. __Optional.__ Default: `null`. | `c11c546e-bd01-47cf-97da-e25388357b5a` |
| title | object | The metadata resource title. __Required.__ | `{ "en": "OAuth Providers"}` |
| slug | string | The metadata resource slug. This value is unique. __Required.__ | `oauth-providers` |
| type | string | The metadata resource type. __Required.__ | `authentication` |
| data | json | The metadata resource data. __Optional.__ Default: `{}` | `["Github", "Google", "Twitter"]` |
| version | integer | The metadata resource version. This value is used for optimistic locking. __Required.__ | `1` |

### Response

#### 200 OK

The request was successful and returns a JSON object that contains the following properties:

| Name | Value | Description |
| ---- | ----- | ----------- |
| id | integer | The metadata resource id. |
| uuid | string | The metadata resource uuid. |
| createdAt | string | The date the metadata resource was created on. |
| updatedAt | string | The date the metadata resource was update at. |
| owner | string | The metadata resource owner. |
| ownerUuid | string | The metadata resource owner uuid. |
| title | object | The metadata resource title. |
| slug | string | The metadata resource slug. This value is unique. |
| type | string | The metadata resource type. |
| data | json | The metadata resource data. |
| version | integer | The config version. This value is used for optimistic locking. |
| tenant | string | The config tenant uuid. |

#### 400 Bad Request

The request was unsuccessful and returns a JSON object that contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| type | string | The error type. |
| title | string | The error title message. |
| detail | string | The error detail description. |

### Example

#### Request

*Method:*

__PUT__ `/metadatas/941b9d4e-d0e5-41df-a62e-97db05559dac`

*Headers:*

```yaml
Content-Type: application/json
Accept: application/json
```

*Body:*

```json
{
  "data": [
    "Github",
    "Google",
    "Twitter",
    "Yahoo"
  ],
  "version": 1
}
```

#### Response

*Code:*

`200 OK`

*Body:*

```json
{
  "id": 2,
  "uuid": "cf687347-6bba-4137-b180-9f581f5cba84",
  "createdAt": "2018-07-18T19:20:17+00:00",
  "updatedAt": "2018-07-19T12:08:30+00:00",
  "owner": "BusinessUnit",
  "ownerUuid": "c11c546e-bd01-47cf-97da-e25388357b5a",
  "title": {
    "en": "OAuth Providers"
  },
  "slug": "oauth-providers",
  "type": "authentication",
  "data": [
    "Github",
    "Google",
    "Twitter",
    "Yahoo"
  ],
  "version": 2,
  "tenant": "e5a2120d-6bf7-4c58-a900-bac1e55e986b"
}
```

## Delete Item

This endpoint deletes a specific metadata resource from the list.

### Method

DELETE `/metadatas/{uuid}`

### Headers

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| Authorization | string | The JWT token. __Required.__ | `Authorization: eyJhbGciOi.eyJyb2xlcy[...].Ds34hb80Mf[...]` |

### Parameters

#### Path Parameters

| Name | Type | Description | Example |
| ---- | ---- | ----------- | ------- |
| uuid | string | The uuid of the metadata resource. __Required.__ | `941b9d4e-d0e5-41df-a62e-97db05559dac` |

### Response

#### 204 No Content

The request was successful and returns no content.

### Example

#### Request

*Method:*

__DELETE__ `/metadatas/941b9d4e-d0e5-41df-a62e-97db05559dac`

#### Response

*Code:*

`204 No Content`

*Body:*

```

```
