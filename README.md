# sigbro-auth
Documentation for the SIGBRO Auth

**What is SIGBRO Auth?**

SIGBRO Auth is a method to log in to online Ardor wallets and UIs. The user clicks on a link on the mobile website OR scans a QR code from an external screen with the SIGBRO app. Then the user is logged in automatically, and the website owner knows that the user owns the Ardor account without ever exposing the passphrase. 

The wallet admin can now save the accountRS and find additional information about the account in the blockchain.
Using SIGBRO Auth requires running the SIGBRO mobile app (available for Android here: https://play.google.com/store/apps/details?id=org.nxter.sigbro). 

There is NO entering passphrases or email addresses or other personal information, so users can safely use any public computer and internet connection with SIGBRO Auth.

What it does

https://youtu.be/6W2ulKWrIG8

This video is of an early development version of the app.

Log in with QR code

https://youtu.be/QfOnpWN3o58

This video demonstrates login via QR code with an early version of the app.

Log in with a deeplink

https://youtu.be/mCIBhPmGpqY

This video demonstrates login from a mobile browser with an early version of the app.

**Use case examples**

How you use SIGBRO Auth depends on the use case.

AccountID

Maybe the Ardor account is enough to know - and that’s included in the token itself. The account can be coupled with other user information that is not on the blockchain but on the central server. For example, a Wordpress installation could know if the user's account is an admin or an author, his username, and which articles he wrote. Nxter Magazine is a live example. There is a SIGBRO Auth Wordpress plugin available (https://github.com/Nxter/nxter-sigbro-auth), which makes it easy to implement)

Explorers

An “account explorer” service would grab and show information about the user’s account from the blockchain. For example, on https://wallet.nxter.org, you can log in with SIGBRO Auth and view your account name and different token balances. There could easily be added NFT’s to the site, token trading history, sent messages, the forging balance, dividends received, or any other information that is stored on the blockchain.

Wallets / Web UI’s

Another service might want to also let the user make transactions. This is where SIGBRO’s ability to check and sign transactions locally for the user is handy. After SIGBRO Auth login, the server can generate an unsigned transaction json for any kind of Ardor blockchain transaction and show it as a deeplink (or button) or as a QR code for the user. The user then gets to check the details of the transaction in the SIGBRO app and approve the transaction. The app always shows correct transaction details.

For a service with a responsive website, this use will 1) remove responsibility for keeping users’ passphrases safe for the service owner, 2) offer better security for the user (local signing, passphrase encrypted on phone, so a website hack can’t exploit it), 3) offer easy passwordless login (use fingerprint to open SIGBRO), 4) secure the user (and service) against transferring funds to a hacker who has changed the website code, because the SIGBRO app will always show the real transaction details to the user, 5) by using Auth and SIGBRO deeplinking you can apply for getting a link to your service/UI integrated directly into the SIGBRO app, so that SIGBRO users can visit from the app directly from within the SIGBRO app UI and without even logging in. You'll get their login token sent automatically.

Anything else

Using Ardor account ID’s and SIGBRO Auth opens for rather limitless possibilities, as service providers can use it with the inbuilt Ardor platform features and even add their own smart contracts to the blockchain, and trigger them with SIGBRO. After auth, the server can, for example, scan for membership properties, like a corona-pass and its status, search for tokens that represent a ticket or user/citizen rights, rebate points to a store, etc., and then automatically give the user access to the privileges this data dictates.

Currently, the SIGBRO Team works on ways to (optionally) link Ardor ID’s to trusted information about the individuals and companies that own accounts, so that SIGBRO Auth in the foreseeable future can be used for digital signing of documents, shareholder meetings, multi-sig, and voting, and so that users can check whose accounts they interact with, in order to avoid scams. If you want to learn more, you’re welcome to contact the SIGBRO Team.

**How does SIGBRO Auth work?**

Your server generates a UUID4 (Universally Unique Identifier) for every login attempt and sends it to SIGBRO. On behalf of the user, the SIGBRO app locally signs the UUID4 with the user’s unique passphrase (secretPhrase) and generates a cryptographic token (https://ardordocs.jelurida.com/Tokens#Generate_Token), which it returns to the central server. The server decodes and checks this cryptographic token (https://ardordocs.jelurida.com/Tokens#Decode_Token) and gets the user’s Ardor account ID (Reed Solomon). Because the user can only generate the token with the account’s secretPhrase (and only log in to the SIGBRO app with the passphrase), the server can trust that the user is indeed the owner (or controller) of that particular Ardor account.


## How to use Sigbro AUTH API

1. Generate new unique UUID4 and send it to Sigbro Auth API:
```shell
curl -s https://random.api.nxter.org/api/auth/new -d '{"uuid":"F73185DC-D760-4E6E-BAE7-43861601C6F8"}'
# {"result":"ok","msg":"The new record `F73185DC-D760-4E6E-BAE7-43861601C6F8` was saved."}
```

2. Using the same UUID4 generate URL `sigbro://F73185DC-D760-4E6E-BAE7-43861601C6F8` and make QR-code. Put it on your login form. You may also use this url as a **deeplink** for mobile devices. The SIGBRO Mobile app will handle it and automatically open.

3. Start loop with 5 sec delay between iterations and wait until a user scans & signs this QR-code. 
```shell
curl -s https://random.api.nxter.org/api/auth/status -d '{"uuid":"F73185DC-D760-4E6E-BAE7-43861601C6F8"}'
# {"result":"wait","msg":"Waiting for the token","accountRS":"","token":"","uuid":""}
```
When the user signs this UUID4 you will receive: 
```shell
# {"result":"ok","msg":"The token for the key `F73185DC-D760-4E6E-BAE7-43861601C6F8` was generated.","accountRS":"ARDOR-W5ZG-ZXXA-8DK9-HZXTD","token":"qmd1ea9g7d31lsdtnqgs3d5r0j81flht0q5ooe3k4rj1bom49g4eurmqghmn7706ienm6cem830q9ltgh1e4ct9gqvooar31cl67h1djpiague3jboi1qb6llrr0sfoju434457glki37s5o9l0ijrsvqfthof3n","uuid":"F73185DC-D760-4E6E-BAE7-43861601C6F8"}    
```

4. Now you have the user's `token` and `accountRS` and you **must** check the token via the Ardor API (you may use any available node, or download and run your own Ardor NRS from https://www.jelurida.com/ardor/downloads): 
```shell
curl -s "https://random.api.nxter.org/ardor?requestType=decodeToken&website=F73185DC-D760-4E6E-BAE7-43861601C6F8&token=qmd1ea9g7d31lsdtnqgs3d5r0j81flht0q5ooe3k4rj1bom49g4eurmqghmn7706ienm6cem830q9ltgh1e4ct9gqvooar31cl67h1djpiague3jboi1qb6llrr0sfoju434457glki37s5o9l0ijrsvqfthof3n"

# {
#     "account": "17719342362906202094",
#     "accountRS": "ARDOR-W5ZG-ZXXA-8DK9-HZXTD",
#     "requestProcessingTime": 1,
#     "timestamp": 105646319,
#     "valid": true
# }
```

5. Now you may use `accountRS` as a login on your site. That is it. 
