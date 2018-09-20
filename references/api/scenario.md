# Scenario

The scenario api endpoints allow authorized users to read, modify and delete scenarios.

## Table of Contents

- [Get List](#get-list)
- [Get Item](#get-item)
- [Add Item](#add-item)
- [Edit Item](#edit-item)
- [Delete Item](#delete-item)

## Get List

This endpoint returns the list of scenarios.

### Method

GET `/scenarios`

### Parameters

#### Query Parameters

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| id | integer | Filter scenarios by the given id. __Optional.__ | `id=1`<br><br>`id[]=1&id[]=2` |
| uuid | string | Filter scenarios by the given uuid. __Optional.__ | `uuid=04acd353-4737-4543-a9b5-e16f2aca2449`<br><br>`uuid[]=04acd353-4737-4543-a9b5-e16f2aca2449&uuid[]=8f51f42c-c095-418c-ba6e-73c8f193353f` |
| createdAt[before] | string | Filter scenarios that were created before the given date. __Optional.__ | `createdAt[before]=2018-07-20T13:19:30.181Z` |
| createdAt[after] | string | Filter scenarios that were created after the given date. __Optional.__ | `createdAt[after]2018-07-20T13:19:30.181Z` |
| updatedAt[before] | string | Filter scenarios that were updated before the given date. __Optional.__ | `updatedAt[before]=2018-07-20T13:19:30.181Z` |
| updatedAt[after] | string | Filter scenarios that were updated after the given date. __Optional.__ | `updatedAt[after]=2018-07-20T13:19:30.181Z` |
| deletedAt[before] | string | Filter scenarios that were deleted before the given date. __Optional.__ | `updatedAt[before]=2018-07-20T13:19:30.181Z` |
| deletedAt[after] | string | Filter scenarios that were deleted after the given date. __Optional.__ | `updatedAt[after]=2018-07-20T13:19:30.181Z` |
| owner | string | Filter scenarios by the given owner. __Optional.__ | `owner=BusinessUnit`<br><br>`owner[]=BusinessUnit&owner[]=Staff` |
| ownerUuid | string | Filter scenarios by the given owner uuid. __Optional.__ | `ownerUuid=5f4108bb-fa74-4c93-9bb1-9e37d9302640`<br><br>`ownerUuid[]=5f4108bb-fa74-4c93-9bb1-9e37d9302640&ownerUuid[]=0092e830-e411-47cf-b7ef-c19cc79ba8cb` |
| type | string | Filter scenarios by exact type. __Optional.__ | `type=bpm`<br><br>`type[]=bpm&type[]=info` |
| slug | string | Filter scenarios by exact slug. __Optional.__ | `slug=slug-1`<br><br>`slug[]=slug-1&slug[]=slug-2` |
| title | string | Filter scenarios by partial title. __Optional.__ | `Title 1`<br><br>`` |
| description | string | Filter scenarios by partial description. __Optional.__ | `Description 1` |
| presentation | string | Fitler scenarios by partial presentation. __Optional.__ | `Presentation 1` |
| enabled | boolean | Filter scenarios by enabled status. __Optional.__ | `enabled=true` |
| service.uuid | string | Filter scenarios by uuid of service the scenarios is associated with. __Optional.__ | `categories.uuid=9f9aeb3f-69aa-42f4-b028-2432a3317eea`<br><br>`categories.uuid[]=9f9aeb3f-69aa-42f4-b028-2432a3317eea&categories.uuid[]=7fc7a5e4-5ed0-43b1-a983-f7af9a7f446f` |
| page | integer | The current page in the pagination. __Optional.__ Default: `1`. | `page=2` |
| limit | integer | The number of items per page. __Optional.__ Default: `10`. | `limit=25` |
| order[id] | string | Order scenarios by id. __Optional.__ Options: `asc`, `desc`. | `order[id]=asc` |
| order[createdAt] | string | Order scenarios by creation date. __Optional.__ Options: `asc`, `desc`. | `order[createdAt]=asc` |
| order[updatedAt] | string | Order scenarios by modification date. __Optional.__ Options: `asc`, `desc`. | `order[updatedAt]=asc` |
| order[deletedAt] | string | Order scenarios by deletion date. __Optional.__ Options: `asc`, `desc`. | `order[deletedAt]=asc` |
| order[owner] | string | Order scenarios by owner. __Optional.__ | `order[owner]=asc` |
| order[type] | string | Order scenarios by type. __Optional.__ | `order[type]=asc` |
| order[title] | string | Order scenarios by title. __Optional.__ | `order[title]=asc` |
| order[description] | string | Order scenarios by description. __Optional.__ | `order[description]=asc` |
| order[presentation] | string | Order scenarios by presentation. __Optional.__ | `order[presentation]=asc` |

### Response

#### 200 OK

The request was successful and returns a JSON array of objects. Each object contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| id | integer | The scenario id. |
| uuid | string | The scenario uuid. |
| createdAt | string | The date the scenario was created on. |
| updatedAt | string | The date the scenario was updated at. |
| deletedAt | string | The date the scenario was deleted at. |
| owner | string | The scenario owner. |
| ownerUuid | string | The scenario owner uuid. |
| type | string | The scenario type. |
| slug | string | The scenario unique slug. |
| title | object | The object of translated scenario titles. |
| description | object | The object of translated scenario descriptions. |
| presentation | object | The object of translated scenario presentations. |
| enabled | boolean | The scenario enabled status. |
| version | integer | The scenario version. This value is used for optimistic locking. |
| tenant | string | The scenario tenant uuid. |

### Example

#### Request

*Method:*

__GET__ /scenarios

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
    "uuid": "04acd353-4737-4543-a9b5-e16f2aca2449",
    "createdAt": "2018-09-19T14:26:26+00:00",
    "updatedAt": "2018-09-19T14:26:26+00:00",
    "deletedAt": null,
    "owner": "BusinessUnit",
    "ownerUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
    "service": "/services/2069c3a1-c401-4f9b-8a15-1a179c9cd8f2",
    "type": "bpm",
    "config": {
        "bpm": "camunda",
        "process_definition_key": "bpmn-1"
    },
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
    "data": {},
    "enabled": true,
    "weight": 0,
    "version": 1,
    "tenant": "d928b020-94f6-4928-a510-04fc49d5a174"
  }
]
```

## GET Item

This endpoint returns a specific scenario.

### Method

GET `/scenarios/{uuid}`

### Parameters

#### Path Parameters

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| uuid | string | The uuid of the scenario. __Required.__ | `04acd353-4737-4543-a9b5-e16f2aca2449` |

### Response

#### 200 OK

The request was successful and returns a JSON object that contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| id | integer | The scenario id. |
| uuid | string | The scenario uuid. |
| createdAt | string | The date the scenario was created on. |
| updatedAt | string | The date the scenario was updated at. |
| deletedAt | string | The date the scenario was deleted at. |
| owner | string | The scenario owner. |
| ownerUuid | string | The scenario owner uuid. |
| type | string | The scenario type. |
| slug | string | The scenario unique slug. |
| title | object | The object of translated scenario titles. |
| description | object | The object of translated scenario descriptions. |
| presentation | object | The object of translated scenario presentations. |
| enabled | boolean | The scenario enabled status. |
| version | integer | The scenario version. This value is used for optimistic locking. |
| tenant | string | The scenario tenant uuid. |

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

__GET__ `/scenarios/04acd353-4737-4543-a9b5-e16f2aca2449`

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
  "uuid": "04acd353-4737-4543-a9b5-e16f2aca2449",
  "createdAt": "2018-09-19T14:26:26+00:00",
  "updatedAt": "2018-09-19T14:26:26+00:00",
  "deletedAt": null,
  "owner": "BusinessUnit",
  "ownerUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
  "service": "/services/2069c3a1-c401-4f9b-8a15-1a179c9cd8f2",
  "type": "bpm",
  "config": {
      "bpm": "camunda",
      "process_definition_key": "bpmn-1"
  },
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
  "data": {},
  "enabled": true,
  "weight": 0,
  "version": 1,
  "tenant": "d928b020-94f6-4928-a510-04fc49d5a174"
}
```

## Add Item

This endpoint adds a scenario to the list.

### Method

POST `/scenarios`

### Parameters

#### Body

A JSON object that contains the following properties:

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| uuid | string | The scenario uuid. __Optional.__ Default: auto-generated. | `04acd353-4737-4543-a9b5-e16f2aca2449` |
| owner | string | The scenario owner. __Required.__ | `BusinessUnit` |
| ownerUuid | string | The scenario owner uuid. __Optional.__ Default: `null`. | `5f4108bb-fa74-4c93-9bb1-9e37d9302640` |
| slug | string | The scenario unique slug. __Required.__ | `slug-1` |
| title | object |  The object of translated scenario titles. __Required.__ | `{ "en": "Title 1" }` |
| description | object | The object of translated scenario descriptions. __Required.__ | `{ "en": "Description 1" }` |
| presentation | object | The object of translated scenario presentations. __Required.__ | `{ "en": "Presentation 1" }` |
| enabled | boolean |  The scenario enabled status. __Required.__ | `true` |
| version | integer | The scenario version. This value is used for optimistic locking. __Required.__ | `1` |

### Response

#### 200 OK

The request was successful and returns a JSON object that contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| id | integer | The scenario id. |
| uuid | string | The scenario uuid. |
| createdAt | string | The date the scenario was created on. |
| updatedAt | string | The date the scenario was updated at. |
| deletedAt | string | The date the scenario was deleted at. |
| owner | string | The scenario owner. |
| ownerUuid | string | The scenario owner uuid. |
| type | string | The scenario type. |
| slug | string | The scenario unique slug. |
| title | object | The object of translated scenario titles. |
| description | object | The object of translated scenario descriptions. |
| presentation | object | The object of translated scenario presentations. |
| enabled | boolean | The scenario enabled status. |
| version | integer | The scenario version. This value is used for optimistic locking. |
| tenant | string | The scenario tenant uuid. |

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

__POST__ `/scenarios`

*Headers:*

```yaml
Accept: application/json
```

*Body:*

```json
{
  "owner": "BusinessUnit",
  "ownerUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
  "service": "/services/2069c3a1-c401-4f9b-8a15-1a179c9cd8f2",
  "type": "bpm",
  "config": {
      "bpm": "camunda",
      "process_definition_key": "bpmn-1"
  },
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
  "data": {},
  "enabled": true,
  "weight": 0,
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
  "uuid": "04acd353-4737-4543-a9b5-e16f2aca2449",
  "createdAt": "2018-09-19T14:26:26+00:00",
  "updatedAt": "2018-09-19T14:26:26+00:00",
  "deletedAt": null,
  "owner": "BusinessUnit",
  "ownerUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
  "service": "/services/2069c3a1-c401-4f9b-8a15-1a179c9cd8f2",
  "type": "bpm",
  "config": {
      "bpm": "camunda",
      "process_definition_key": "bpmn-1"
  },
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
  "data": {},
  "enabled": true,
  "weight": 0,
  "version": 1,
  "tenant": "d928b020-94f6-4928-a510-04fc49d5a174"
}
```

## Edit Item

This endpoint edits a specific scenario.

### Method

PUT `/scenarios/{uuid}`

### Parameters

#### Path Parameters

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| uuid | string | The uuid of the scenario. __Required.__ | `04acd353-4737-4543-a9b5-e16f2aca2449` |

#### Body

A JSON object that contains the following properties:

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| uuid | string | The scenario uuid. __Optional.__ Default: auto-generated. | `04acd353-4737-4543-a9b5-e16f2aca2449` |
| owner | string | The scenario owner. __Required.__ | `BusinessUnit` |
| ownerUuid | string | The scenario owner uuid. __Optional.__ Default: `null`. | `5f4108bb-fa74-4c93-9bb1-9e37d9302640` |
| slug | string | The scenario unique slug. __Required.__ | `slug-1` |
| title | object |  The object of translated scenario titles. __Required.__ | `{ "en": "Title 1" }` |
| description | object | The object of translated scenario descriptions. __Required.__ | `{ "en": "Description 1" }` |
| presentation | object | The object of translated scenario presentations. __Required.__ | `{ "en": "Presentation 1" }` |
| enabled | boolean |  The scenario enabled status. __Required.__ | `true` |
| version | integer | The scenario version. This value is used for optimistic locking. __Required.__ | `1` |

### Response

#### 200 OK

The request was successful and returns a JSON object that contains the following properties:

| Name | Type | Description |
| :--- | :--- | :---------- |
| id | integer | The scenario id. |
| uuid | string | The scenario uuid. |
| createdAt | string | The date the scenario was created on. |
| updatedAt | string | The date the scenario was updated at. |
| deletedAt | string | The date the scenario was deleted at. |
| owner | string | The scenario owner. |
| ownerUuid | string | The scenario owner uuid. |
| type | string | The scenario type. |
| slug | string | The scenario unique slug. |
| title | object | The object of translated scenario titles. |
| description | object | The object of translated scenario descriptions. |
| presentation | object | The object of translated scenario presentations. |
| enabled | boolean | The scenario enabled status. |
| version | integer | The scenario version. This value is used for optimistic locking. |
| tenant | string | The scenario tenant uuid. |

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

__PUT__ `/scenarios/04acd353-4737-4543-a9b5-e16f2aca2449`

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
  "uuid": "04acd353-4737-4543-a9b5-e16f2aca2449",
  "createdAt": "2018-09-19T14:26:26+00:00",
  "updatedAt": "2018-09-19T14:26:26+00:00",
  "deletedAt": null,
  "owner": "BusinessUnit",
  "ownerUuid": "5f4108bb-fa74-4c93-9bb1-9e37d9302640",
  "service": "/services/2069c3a1-c401-4f9b-8a15-1a179c9cd8f2",
  "type": "bpm",
  "config": {
      "bpm": "camunda",
      "process_definition_key": "bpmn-1"
  },
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
  "data": {},
  "enabled": true,
  "weight": 0,
  "version": 1,
  "tenant": "d928b020-94f6-4928-a510-04fc49d5a174"
}
```

## Delete Item

This endpoint deletes a specific scenario from the list.

### Method

DELETE `/scenarios/{uuid}`

### Parameters

#### Path Parameters

| Name | Type | Description | Example |
| :--- | :--- | :---------- | :------ |
| uuid | string | The uuid of the scenario. __Required.__ | `04acd353-4737-4543-a9b5-e16f2aca2449` |

### Response

#### 204 No Content

The request was successful and returns no content.

### Example

#### Request

*Method:*

__DELETE__ `/scenarios/04acd353-4737-4543-a9b5-e16f2aca2449`

#### Response

*Code:*

`204 No Content`

*Body:*

```

```
