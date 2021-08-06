# Laravel Developer Test API

## Get Person information including families tree
### GET: /api/people/{personId}
```
Params: null
Response: {
    "id": 21,
    "name": "Johnny",
    "families": []
}
```

## Create Person
### POST: /api/people
```
Params: {
  name: 'Johnny',
}
Response: {
    "name": "Johnny",
    "id": 21
}
```

## Create Family
### POST: /api/families
```
Params: {
  name: 'Rodenas',
}
Response: {
    "name": "Rodenas",
    "id": 3
}
```

## Associates a Person to a Family
### PUT: /api/families/{familyId}/people/{personId}
#### (Idempotent)
```
Params: null
Response: "Person added to family successfully"
```
