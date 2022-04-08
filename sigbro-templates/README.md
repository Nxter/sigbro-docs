# SIGBRO TEMPLATES

Documentation for the SIG BRO TEMPLATES

## What is SIGBRO TEMPLATES?

The easy way to prepare a transaction and show it for the end user on the site as a QR-code. It might be sendMoney
transaction with the pre-defined recipient and amount address.

## How does SIGBRO TEMPLATES work?

* You prepare payload with specific template to the SIGBRO TEMPLATES API endpoint.
* You will receive a unique UUID.
* You generate URL with UUID and generate QR code with the URL.

BINGO!

## Which transactions are supported?

* sendMoney
* leaseBalance
* transferAsset
* sendMessage

### sendMoney

#### Prepare payload

```json
{
  "template": {
    "network": "test",
    "chain": 2,
    "requestType": "sendMoney",
    "recipientRS": "ARDOR-NYJW-6M4F-6LG2-76FR5",
    "amount": 100000,
    "message": "I love you, Sigbro Mobile"
  }
}
```

The message will be sent unencrypted. Any user can read it.

The possible networks are: (test or test2), (main or main2), (test3).

#### Send request to the SIGBRO TEMPLATES API endpoint

```bash
export URL="https://sigbro-template.api.nxter.org/api/v1/add/"

curl -XPOST $URL -H "Content-Type: application/json" -d '{"template": {"network": "test", "chain": 2, "requestType": "sendMoney", "recipientRS": "ARDOR-NYJW-6M4F-6LG2-76FR5", "amount": 100000, "message": "I love you, Sigbro Mobile"}}'

{"result": "ok", "msg": "Data saved", "uuid": "c56356e0-d08f-4f38-8913-60f5df6c8216"}
```

#### Generate URL with UUID

Prepare the URL: `https://dl.sigbro.com/tmpl/c56356e0-d08f-4f38-8913-60f5df6c8216/`. You have to use the same UUID you got
from the server.

### leaseBalance

```json
{
  "template": {
    "network": "main2",
    "chain": 1,
    "requestType": "leaseBalance",
    "recipientRS": "ARDOR-NYJW-6M4F-6LG2-76FR5",
    "period": 1440
  }
}
```

### transferAsset

```json
{
  "template": {
    "network": "test",
    "chain": 2,
    "requestType": "transferAsset",
    "recipientRS": "ARDOR-NYJW-6M4F-6LG2-76FR5",
    "asset": "6792074505226605314",
    "quantityQNT": 1
  }
}
```

### sendMessage

```json
{
  "template": {
    "network": "test",
    "chain": 2,
    "requestType": "sendMessage",
    "recipientRS": "ARDOR-NYJW-6M4F-6LG2-76FR5",
    "message": "I love you, Sigbro Mobile"
  }
}
```
