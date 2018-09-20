# Service

The service api endpoints allow authorized users to read, modify and delete services.

## Table of Contents

- [Get List](#get-list)
- [Get Item](#get-item)
- [Add Item](#add-item)
- [Edit Item](#edit-item)
- [Delete Item](#delete-item)

## Get List

This endpoint returns the list of services.

### Method

GET `/services`

### Parameters

#### Query Parameters

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| id | integer | Filter services by the given id. __Optional.__ | `id=1`<br><br>`id[]=1&id[]=2` |
| uuid | string | Filter services by the given uuid. __Optional.__ | `uuid=2069c3a1-c401-4f9b-8a15-1a179c9cd8f2`<br><br>`uuid[]=2069c3a1-c401-4f9b-8a15-1a179c9cd8f2&uuid[]=3d47f83e-c098-4cff-928f-344f9c33427f` |
| owner | string | Filter services by the given owner. __Optional.__ | `owner=BusinessUnit`<br><br>`owner[]=BusinessUnit&owner[]=Staff` |
| ownerUuid | string | Filter services by the given owner uuid. __Optional.__ | `ownerUuid=5f4108bb-fa74-4c93-9bb1-9e37d9302640`<br><br>`ownerUuid[]=5f4108bb-fa74-4c93-9bb1-9e37d9302640&ownerUuid[]=0092e830-e411-47cf-b7ef-c19cc79ba8cb` |
| createdAt[before] | string | Filter services that were created before the given date. __Optional.__ | `createdAt[before]=2018-07-20T13:19:30.181Z` |
| createdAt[after] | string | Filter services that were created after the given date. __Optional.__ | `createdAt[after]2018-07-20T13:19:30.181Z` |
| updatedAt[before] | string | Filter services that were updated before the given date. __Optional.__ | `updatedAt[before]=2018-07-20T13:19:30.181Z` |
| updatedAt[after] | string | Filter services that were updated after the given date. __Optional.__ | `updatedAt[after]=2018-07-20T13:19:30.181Z` |
| slug | string | Filter services by exact slug. __Optional.__ | `slug=slug-1`<br><br>`slug[]=slug-1&slug[]=slug-2` |
| title | string | Filter services by partial title. __Optional.__ | `Title 1`<br><br>`` |
| description | string | Filter services by partial description. __Optional.__ | `Description 1` |
| presentation | string | Fitler services by partial presentation. __Optional.__ | `Presentation 1` |
| enabled | boolean | Filter services by enabled status. __Optional.__ | `enabled=true` |
| categories.uuid | string | Filter services by uuid of categories the services is associated with. __Optional.__ | `categories.uuid=9f9aeb3f-69aa-42f4-b028-2432a3317eea`<br><br>`categories.uuid[]=9f9aeb3f-69aa-42f4-b028-2432a3317eea&categories.uuid[]=7fc7a5e4-5ed0-43b1-a983-f7af9a7f446f` |
| page | integer | The current page in the pagination. __Optional.__ Default: `1`. | `page=2` |
| limit | integer | The number of items per page. __Optional.__ Default: `10`. | `limit=25` |
| order[id] | string | Order services by id. __Optional.__ Options: `asc`, `desc`. | `order[id]=asc` |
| order[createdAt] | string | Order services by creation date. __Optional.__ Options: `asc`, `desc`. | `order[createdAt]=asc` |
| order[updatedAt] | string | Order services by modification date. __Optional.__ Options: `asc`, `desc`. | `order[updatedAt]=asc` |
| order[deletedAt] | string | Order services by deletion date. __Optional.__ Options: `asc`, `desc`. | `order[deletedAt]=asc` |
| order[owner] | string | Order services by owner. __Optional.__ | `order[owner]=asc` |
| order[type] | string | Order services by type. __Optional.__ | `order[type]=asc` |
| order[title] | string | Order services by title. __Optional.__ | `order[title]=asc` |
| order[description] | string | Order services by description. __Optional.__ | `order[description]=asc` |
| order[presentation] | string | Order services by presentation. __Optional.__ | `order[presentation]=asc` |

### Response

#### 200 OK

The request was successful and returns a JSON array of objects. Each object contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| id | integer | The service id. |
| uuid | string | The service uuid. |
| createdAt | string | The date the service was created on. |
| updatedAt | string | The date the service was updated at. |
| owner | string | The service owner. |
| ownerUuid | string | The service owner uuid. |
| slug | string | The service unique slug. |
| title | object | The object of translated service titles. |
| description | object | The object of translated service descriptions. |
| presentation | object | The object of translated service presentations. |
| enabled | boolean | The service enabled status. |
| version | integer | The service version. This value is used for optimistic locking. |
| tenant | string | The service tenant uuid. |

### Example

#### Request

*Method:*

__GET__ /services

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
    "uuid": "2069c3a1-c401-4f9b-8a15-1a179c9cd8f2",
    "createdAt": "2018-07-31T14:57:10+00:00",
    "updatedAt": "2018-07-31T14:57:10+00:00",
    "owner": "BusinessUnit",
    "ownerUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
    "slug": "slug-1",
    "title": {
      "en": "Title 1",
      "fr": "Titre 1"
    },
    "description": {
      "en": "Description 1",
      "fr": "Description 1"
    },
    "presentation": {
      "en": "Presentation 1",
      "fr": "Présentation 1"
    },
    "enabled": true,
    "version": 1,
    "tenant": "d928b020-94f6-4928-a510-04fc49d5a174"
  },
  {
    "id": 2,
    "uuid": "3d47f83e-c098-4cff-928f-344f9c33427f",
    "createdAt": "2018-07-31T14:57:10+00:00",
    "updatedAt": "2018-07-31T14:57:10+00:00",
    "owner": "BusinessUnit",
    "ownerUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
    "slug": "slug-2",
    "title": {
      "en": "Title 2",
      "fr": "Titre 2"
    },
    "description": {
      "en": "Description 2",
      "fr": "Description 2"
    },
    "presentation": {
      "en": "Presentation 2",
      "fr": "Présentation 2"
    },
    "enabled": true,
    "version": 1,
    "tenant": "d928b020-94f6-4928-a510-04fc49d5a174"
  }
]
```

## GET Item

This endpoint returns a specific service.

### Method

GET `/services/{uuid}`

### Parameters

#### Path Parameters

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| uuid | string | The uuid of the service. __Required.__ | `2069c3a1-c401-4f9b-8a15-1a179c9cd8f2` |

### Response

#### 200 OK

The request was successful and returns a JSON object that contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| id | integer | The service id. |
| uuid | string | The service uuid. |
| createdAt | string | The date the service was created on. |
| updatedAt | string | The date the service was updated at. |
| owner | string | The service owner. |
| ownerUuid | string | The service owner uuid. |
| slug | string | The service unique slug. |
| title | object | The object of translated service titles. |
| description | object | The object of translated service descriptions. |
| presentation | object | The object of translated service presentations. |
| enabled | boolean | The service enabled status. |
| version | integer | The service version. This value is used for optimistic locking. |
| tenant | string | The service tenant uuid. |

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

__GET__ `/services/2069c3a1-c401-4f9b-8a15-1a179c9cd8f2`

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
  "uuid": "2069c3a1-c401-4f9b-8a15-1a179c9cd8f2",
  "createdAt": "2018-07-31T14:57:10+00:00",
  "updatedAt": "2018-07-31T14:57:10+00:00",
  "owner": "BusinessUnit",
  "ownerUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
  "slug": "slug-1",
  "title": {
    "en": "Title 1",
    "fr": "Titre 1"
  },
  "description": {
    "en": "Description 1",
    "fr": "Description 1"
  },
  "presentation": {
    "en": "Presentation 1",
    "fr": "Présentation 1"
  },
  "enabled": true,
  "version": 1,
  "tenant": "d928b020-94f6-4928-a510-04fc49d5a174"
}
```

## Add Item

This endpoint adds a service to the list.

### Method

POST `/services`

### Parameters

#### Body

A JSON object that contains the following properties:

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| uuid | string | The service uuid. __Optional.__ Default: auto-generated. | `dc719883-c593-42e5-8aee-5d9367525273` |
| owner | string | The service owner. __Required.__ | `BusinessUnit` |
| ownerUuid | string | The service owner uuid. __Optional.__ Default: `null`. | `5f4108bb-fa74-4c93-9bb1-9e37d9302640` |
| slug | string | The service unique slug. __Required.__ | `slug-1` |
| title | object |  The object of translated service titles. __Required.__ | `{ "en": "Title 1" }` |
| description | object | The object of translated service descriptions. __Required.__ | `{ "en": "Description 1" }` |
| presentation | object | The object of translated service presentations. __Required.__ | `{ "en": "Presentation 1" }` |
| enabled | boolean |  The service enabled status. __Required.__ | `true` |
| version | integer | The service version. This value is used for optimistic locking. __Required.__ | `1` |

### Response

#### 200 OK

The request was successful and returns a JSON object that contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| id | integer | The service id. |
| uuid | string | The service uuid. |
| createdAt | string | The date the service was created on. |
| updatedAt | string | The date the service was update at. |
| owner | string | The service owner. |
| ownerUuid | string | The service owner uuid. |
| slug | string | The service unique slug. |
| title | object |  The object of translated service titles. |
| description | object |  The object of translated service descriptions. |
| presentation | object |  The object of translated service presentation. |
| enabled | boolean |  The service enabled status. |
| version | integer | The service version. This value is used for optimistic locking. |
| tenant | string | The service tenant uuid. |

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

__POST__ `/services`

*Headers:*

```yaml
Accept: application/json
```

*Body:*

```json
{
  "owner": "BusinessUnit",
  "ownerUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
  "slug": "slug-1",
  "title": {
    "en": "Title 1",
    "fr": "Titre 1"
  },
  "description": {
    "en": "Description 1",
    "fr": "Description 1"
  },
  "presentation": {
    "en": "Presentation 1",
    "fr": "Présentation 1"
  },
  "enabled": true,
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
  "uuid": "2069c3a1-c401-4f9b-8a15-1a179c9cd8f2",
  "createdAt": "2018-07-31T14:57:10+00:00",
  "updatedAt": "2018-07-31T14:57:10+00:00",
  "owner": "BusinessUnit",
  "ownerUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
  "slug": "slug-1",
  "title": {
    "en": "Title 1",
    "fr": "Titre 1"
  },
  "description": {
    "en": "Description 1",
    "fr": "Description 1"
  },
  "presentation": {
    "en": "Presentation 1",
    "fr": "Présentation 1"
  },
  "enabled": true,
  "version": 1,
  "tenant": "d928b020-94f6-4928-a510-04fc49d5a174"
}
```

## Edit Item

This endpoint edits a specific service.

### Method

PUT `/services/{uuid}`

### Parameters

#### Path Parameters

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| uuid | string | The uuid of the service. __Required.__ | `2069c3a1-c401-4f9b-8a15-1a179c9cd8f2` |

#### Body

A JSON object that contains the following properties:

| Name | Type | Description | Example |
| :--- | :---- | :---------- | :------ |
| uuid | string | The service uuid. __Optional.__ Default: auto-generated. | `2069c3a1-c401-4f9b-8a15-1a179c9cd8f2` |
| owner | string | The service owner. __Required.__ | `BusinessUnit` |
| ownerUuid | string | The service owner uuid. __Optional.__ Default: `null`. | `5f4108bb-fa74-4c93-9bb1-9e37d9302640` |
| slug | string | The service unique slug. __Required.__ | `slug-1` |
| title | object |  The object of translated service titles. __Required.__ | `{ "en": "Title 1" }` |
| description | object | The object of translated service descriptions. __Required.__ | `{ "en": "Description 1" }` |
| presentation | object | The object of translated service presentations. __Required.__ | `{ "en": "Presentation 1" }` |
| enabled | boolean |  The service enabled status. __Required.__ | `true` |
| version | integer | The service version. This value is used for optimistic locking. __Required.__ | `1` |

### Response

#### 200 OK

The request was successful and returns a JSON object that contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| id | integer | The service id. |
| uuid | string | The service uuid. |
| createdAt | string | The date the service was created on. |
| updatedAt | string | The date the service was update at. |
| owner | string | The service owner. |
| ownerUuid | string | The service owner uuid. |
| slug | string | The service unique slug. |
| title | object |  The object of translated service titles. |
| description | object |  The object of translated service descriptions. |
| presentation | object |  The object of translated service presentation. |
| enabled | boolean |  The service enabled status. |
| version | integer | The service version. This value is used for optimistic locking. |
| tenant | string | The service tenant uuid. |

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

__PUT__ `/services/2069c3a1-c401-4f9b-8a15-1a179c9cd8f2`

*Headers:*

```yaml
Accept: application/json
```

*Body:*

```json
{
  "title": {
    "en": "Title 2",
    "fr": "Titre 2"
  },
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
  "uuid": "2069c3a1-c401-4f9b-8a15-1a179c9cd8f2",
  "createdAt": "2018-07-31T14:57:10+00:00",
  "updatedAt": "2018-07-31T14:57:10+00:00",
  "owner": "BusinessUnit",
  "ownerUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
  "slug": "slug-1",
  "title": {
    "en": "Title 2",
    "fr": "Titre 2"
  },
  "description": {
    "en": "Description 1",
    "fr": "Description 1"
  },
  "presentation": {
    "en": "Presentation 1",
    "fr": "Présentation 1"
  },
  "enabled": true,
  "version": 1,
  "tenant": "d928b020-94f6-4928-a510-04fc49d5a174"
}
```

## Delete Item

This endpoint deletes a specific service from the list.

### Method

DELETE `/services/{uuid}`

### Parameters

#### Path Parameters

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| uuid | string | The uuid of the service. __Required.__ | `2069c3a1-c401-4f9b-8a15-1a179c9cd8f2` |

### Response

#### 204 No Content

The request was successful and returns no content.

### Example

#### Request

*Method:*

__DELETE__ `/services/2069c3a1-c401-4f9b-8a15-1a179c9cd8f2`

#### Response

*Code:*

`204 No Content`

*Body:*

```

```
