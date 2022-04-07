# SIGBRO TX

Documentation for the SIGBRO TX

## What is SIGBRO TX?

The easy way to use SIGBRO MOBILE on your site.

## How does SIGBRO TX work?

* You send request to any Ardor node with transaction data. No need to specify the passphrase.
* You send unsigned transaction data to the SIGBRO TX server and get UUID back.
* You generate URL with UUID and generate QR code with the URL.

BINGO!

## How to use SIGBRO TX?

### Prepare the transaction data

It's up to you. Only one limitation - SIGBRO TX does not work with encrypted messages. **yet**.

### Send unsigned transaction data to the SIGBRO TX server

```shell
-> % curl -XPOST https://random.api.nxter.org/api/v3/save_tx -H "Content-Type: application/json" -d '{"transactionJSON": {.........}}'
{"msg": "Transaction saved", "result": "ok", "uuid": "8e290458-5667-4184-9eb3-fe8ecce7db54"}
```

### Generate URL with UUID

Prepare the URL: `https://dl.sigbro.com/tx/8e290458-5667-4184-9eb3-fe8ecce7db54/`. You have to use the same UUID you got
from the server.

