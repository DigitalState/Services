# Access

The access api endpoints allow authorized users to read, modify and delete access cards.

For more information about the architecture and core concepts of access cards, you may consult the [Security component documentation](https://github.com/DigitalState/Core/blob/develop/documentation/security/acl.md).

## Table of Contents

- [Get List](#get-list)
- [Get Item](#get-item)
- [Add Item](#add-item)
- [Edit Item](#edit-item)
- [Delete Item](#delete-item)

## Get List

This endpoint returns the list of access cards.

### Method

GET `/accesses`

### Headers

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| Accept | string | The accepted returned content types. __Optional.__ Default: `application/ld+json`. Options: `application/json`, `application/ld+json`. | `Accept: application/json` |
| Authorization | string | The JWT token. __Required.__ | `Authorization: eyJhbGciOi.eyJyb2xlcy[...].Ds34hb80Mf[...]` |

### Parameters

#### Query Parameters

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| id | integer | Filter access cards by the given id. __Optional.__ | `id=1`<br><br>`id[]=1&id[]=2` |
| uuid | string | Filter access cards by the given uuid. __Optional.__ | `uuid=dc719883-c593-42e5-8aee-5d9367525273`<br><br>`uuid[]=dc719883-c593-42e5-8aee-5d9367525273&uuid[]=242e3829-9345-469a-a612-f6c432e0b4b1` |
| createdAt[before] | string | Filter access cards that were created before the given date. __Optional.__ | `createdAt[before]=2018-07-20T13:19:30.181Z` |
| createdAt[after] | string | Filter access cards that were created after the given date. __Optional.__ | `createdAt[after]2018-07-20T13:19:30.181Z` |
| updatedAt[before] | string | Filter access cards that were updated before the given date. __Optional.__ | `updatedAt[before]=2018-07-20T13:19:30.181Z` |
| updatedAt[after] | string | Filter access cards that were updated after the given date. __Optional.__ | `updatedAt[after]=2018-07-20T13:19:30.181Z` |
| owner | string | Filter access cards by the given owner. __Optional.__ | `owner=BusinessUnit`<br><br>`owner[]=BusinessUnit&owner[]=Staff` |
| ownerUuid | string | Filter access cards by the given owner uuid. __Optional.__ | `ownerUuid=5f4108bb-fa74-4c93-9bb1-9e37d9302640`<br><br>`ownerUuid[]=5f4108bb-fa74-4c93-9bb1-9e37d9302640&ownerUuid[]=0092e830-e411-47cf-b7ef-c19cc79ba8cb` |
| assignee | string | Filter access cards by the given assignee. __Optional.__ | `assignee=Staff`<br><br>`assignee[]=Individual&assignee[]=Organization` |
| assigneeUuid | string | Filter access cards by the given assignee uuid. __Optional.__ | `assigneeUuid=c8c17ac2-3c41-491d-888c-459f13b97d3c`<br><br>`assigneeUuid[]=c8c17ac2-3c41-491d-888c-459f13b97d3c&assigneeUuid[]=54be68f2-1043-4614-846b-6a1638abae4e` |
| page | integer | The current page in the pagination. __Optional.__ Default: `1`. | `page=2` |
| limit | integer | The number of items per page. __Optional.__ Default: `10`. | `limit=25` |
| order[id] | string | Order access cards by id. __Optional.__ Options: `asc`, `desc`. | `order[id]=asc` |
| order[createdAt] | string | Order access cards by creation date. __Optional.__ Options: `asc`, `desc`. | `order[createdAt]=asc` |
| order[updatedAt] | string | Order access cards by modification date. __Optional.__ Options: `asc`, `desc`. | `order[updatedAt]=asc` |
| order[owner] | string | Order forms by owner. __Optional.__ | `order[owner]=asc` |
| order[assignee] | string | Order forms by assignee. __Optional.__ | `order[assignee]=asc` |

### Response

#### 200 OK

The request was successful and returns a  JSON array of objects. Each object contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| id | integer | The access card id. |
| uuid | string | The access card uuid. |
| createdAt | string | The date the access card was created on. |
| updatedAt | string | The date the access card was updated at. |
| owner | string | The access card owner. |
| ownerUuid | string | The access card owner uuid. |
| assignee | string | The access card assignee. |
| assigneeUuid | string | The access card assignee uuid. |
| permissions | array | The access card granted permissions. |
| version | integer | The access card version. This value is used for optimistic locking. |
| tenant | string | The access card tenant uuid. |

### Example

#### Request

*Method:*

__GET__ /accesses

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
    "uuid": "dc719883-c593-42e5-8aee-5d9367525273",
    "createdAt": "2018-07-31T14:57:10+00:00",
    "updatedAt": "2018-07-31T14:57:10+00:00",
    "owner": "BusinessUnit",
    "ownerUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
    "assignee": "Staff",
    "assigneeUuid": "c8c17ac2-3c41-491d-888c-459f13b97d3c",
    "permissions": [
      {
        "scope": "owner",
        "entity": "BusinessUnit",
        "entityUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
        "key": "config",
        "attributes": ["EDIT"]
      }
    ],
    "version": 1,
    "tenant": "d928b020-94f6-4928-a510-04fc49d5a174"
  },
  {
    "id": 2,
    "uuid": "242e3829-9345-469a-a612-f6c432e0b4b1",
    "createdAt": "2018-07-31T14:57:10+00:00",
    "updatedAt": "2018-07-31T14:57:10+00:00",
    "owner": "BusinessUnit",
    "ownerUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
    "assignee": "Staff",
    "assigneeUuid": "54be68f2-1043-4614-846b-6a1638abae4e",
    "permissions": [
      {
        "scope": "owner",
        "entity": "BusinessUnit",
        "entityUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
        "key": "config",
        "attributes": ["BROWSE", "READ"]
      }
    ],
    "version": 1,
    "tenant": "d928b020-94f6-4928-a510-04fc49d5a174"
  }
]
```

## GET Item

This endpoint returns a specific access card.

### Method

GET `/accesses/{uuid}`

### Headers

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| Accept | string | The accepted returned content types. __Optional.__ Default: `application/ld+json`. Options: `application/json`, `application/ld+json`. | `Accept: application/json` |
| Authorization | string | The JWT token. __Required.__ | `Authorization: eyJhbGciOi.eyJyb2xlcy[...].Ds34hb80Mf[...]` |

### Parameters

#### Path Parameters

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| uuid | string | The uuid of the access card. __Required.__ | `dc719883-c593-42e5-8aee-5d9367525273` |

### Response

#### 200 OK

The request was successful and returns a JSON object that contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| id | integer | The access card id. |
| uuid | string | The access card uuid. |
| createdAt | string | The date the access card was created on. |
| updatedAt | string | The date the access card was updated at. |
| owner | string | The access card owner. |
| ownerUuid | string | The access card owner uuid. |
| assignee | string | The access card assignee. |
| assigneeUuid | string | The access card assignee uuid. |
| permissions | array | The access card granted permissions. |
| version | integer | The access card version. This value is used for optimistic locking. |
| tenant | string | The access card tenant uuid. |

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

__GET__ `/accesses/dc719883-c593-42e5-8aee-5d9367525273`

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
  "uuid": "dc719883-c593-42e5-8aee-5d9367525273",
  "createdAt": "2018-07-31T14:57:10+00:00",
  "updatedAt": "2018-07-31T14:57:10+00:00",
  "owner": "BusinessUnit",
  "ownerUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
  "assignee": "Staff",
  "assigneeUuid": "c8c17ac2-3c41-491d-888c-459f13b97d3c",
  "permissions": [
    {
      "scope": "owner",
      "entity": "BusinessUnit",
      "entityUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
      "key": "config",
      "attributes": ["EDIT"]
    }
  ],
  "version": 1,
  "tenant": "d928b020-94f6-4928-a510-04fc49d5a174"
}
```

## Add Item

This endpoint adds an access card to the list.

### Method

POST `/accesses`

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
| :--- | :--- | :---------- | :------ |
| uuid | string | The access card uuid. __Optional.__ Default: auto-generated. | `dc719883-c593-42e5-8aee-5d9367525273` |
| owner | string | The access card owner. __Required.__ | `BusinessUnit` |
| ownerUuid | string | The access card owner uuid. __Optional.__ Default: `null`. | `5f4108bb-fa74-4c93-9bb1-9e37d9302640` |
| assignee | string | The access card assignee. __Required.__ | `BusinessUnit` |
| assigneeUuid | string | The access card assignee uuid. __Optional.__ Default: `null`. | `c8c17ac2-3c41-491d-888c-459f13b97d3c` |
| permissions | array | The access card granted permissions. __Optional.__ Default: `[]`. |
| version | integer | The access card version. This value is used for optimistic locking. __Required.__ | `1` |

### Response

#### 200 OK

The request was successful and returns a JSON object that contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| id | integer | The access card id. |
| uuid | string | The access card uuid. |
| createdAt | string | The date the access card was created on. |
| updatedAt | string | The date the access card was update at. |
| owner | string | The access card owner. |
| ownerUuid | string | The access card owner uuid. |
| assignee | string | The access card assignee. |
| assigneeUuid | string | The access card assignee uuid. |
| permissions | array | The access card granted permissions. |
| version | integer | The access card version. This value is used for optimistic locking. |
| tenant | string | The access card tenant uuid. |

#### 400 Bad Request

The request was unsuccessful and and returns a JSON object that contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| type | string | The error type. |
| title | string | The error title message. |
| detail | string | The error detail description. |
| violations | array | The array of violations. |

### Example

#### Request

*Method:*

__POST__ `/accesses`

*Headers:*

```yaml
Content-Type: application/json
Accept: application/json
```

*Body:*

```json
{
  "owner": "BusinessUnit",
  "ownerUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
  "assignee": "Staff",
  "assigneeUuid": "c8c17ac2-3c41-491d-888c-459f13b97d3c",
  "permissions": [
    {
      "scope": "owner",
      "entity": "BusinessUnit",
      "entityUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
      "key": "config",
      "attributes": ["EDIT"]
    }
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
  "id": 1,
  "uuid": "dc719883-c593-42e5-8aee-5d9367525273",
  "createdAt": "2018-07-19T12:08:30+00:00",
  "updatedAt": "2018-07-19T12:08:30+00:00",
  "owner": "BusinessUnit",
  "ownerUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
  "assignee": "Staff",
  "assigneeUuid": "c8c17ac2-3c41-491d-888c-459f13b97d3c",
  "permissions": [
    {
      "scope": "owner",
      "entity": "BusinessUnit",
      "entityUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
      "key": "config",
      "attributes": ["EDIT"]
    }
  ],
  "version": 1,
  "tenant": "d928b020-94f6-4928-a510-04fc49d5a174"
}
```

## Edit Item

This endpoint edits a specific access card.

### Method

PUT `/accesses/{uuid}`

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
| uuid | string | The uuid of the access card. __Required.__ | `dc719883-c593-42e5-8aee-5d9367525273` |

#### Body

A JSON object that contains the following properties:

| Name | Type | Description | Example |
| :--- | :---- | :---------- | :------ |
| uuid | string | The access card uuid. __Optional.__ Default: auto-generated. | `dc719883-c593-42e5-8aee-5d9367525273` |
| owner | string | The access card owner. __Required.__ | `BusinessUnit` |
| ownerUuid | string | The access card owner uuid. __Optional.__ Default: `null`. | `5f4108bb-fa74-4c93-9bb1-9e37d9302640` |
| assignee | string | The access card assignee. __Required.__ | `BusinessUnit` |
| assigneeUuid | string | The access card assignee uuid. __Optional.__ Default: `null`. | `c8c17ac2-3c41-491d-888c-459f13b97d3c` |
| permissions | array | The access card granted permissions. __Optional.__ Default: `[]`. |
| version | integer | The access card version. This value is used for optimistic locking. __Required.__ | `1` |

### Response

#### 200 OK

The request was successful and returns a JSON object that contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| id | integer | The access card id. |
| uuid | string | The access card uuid. |
| createdAt | string | The date the access card was created on. |
| updatedAt | string | The date the access card was update at. |
| owner | string | The access card owner. |
| ownerUuid | string | The access card owner uuid. |
| assignee | string | The access card assignee. |
| assigneeUuid | string | The access card assignee uuid. |
| permissions | array | The access card granted permissions. |
| version | integer | The access card version. This value is used for optimistic locking. |
| tenant | string | The access card tenant uuid. |

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

__PUT__ `/accesses/dc719883-c593-42e5-8aee-5d9367525273`

*Headers:*

```yaml
Content-Type: application/json
Accept: application/json
```

*Body:*

```json
{
  "permissions": [
    {
      "scope": "owner",
      "entity": "BusinessUnit",
      "entityUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
      "key": "config",
      "attributes": ["BROWSE", "READ"]
    }
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
  "id": 1,
  "uuid": "dc719883-c593-42e5-8aee-5d9367525273",
  "createdAt": "2018-07-31T14:57:10+00:00",
  "updatedAt": "2018-08-01T12:30:15+00:00",
  "owner": "BusinessUnit",
  "ownerUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
  "assignee": "Staff",
  "assigneeUuid": "c8c17ac2-3c41-491d-888c-459f13b97d3c",
  "permissions": [
    {
      "scope": "owner",
      "entity": "BusinessUnit",
      "entityUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
      "key": "config",
      "attributes": ["BROWSE", "READ"]
    }
  ],
  "version": 1,
  "tenant": "d928b020-94f6-4928-a510-04fc49d5a174"
}
```

## Delete Item

This endpoint deletes a specific access card from the list.

### Method

DELETE `/accesses/{uuid}`

### Headers

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| Authorization | string | The JWT token. __Required.__ | `Authorization: eyJhbGciOi.eyJyb2xlcy[...].Ds34hb80Mf[...]` |

### Parameters

#### Path Parameters

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| uuid | string | The uuid of the access card. __Required.__ | `dc719883-c593-42e5-8aee-5d9367525273` |

### Response

#### 204 No Content

The request was successful and returns no content.

### Example

#### Request

*Method:*

__DELETE__ `/accesses/dc719883-c593-42e5-8aee-5d9367525273`

#### Response

*Code:*

`204 No Content`

*Body:*

```

```
