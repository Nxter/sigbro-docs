# sigbro-auth

Documentation for the SIGBRO Auth

## What is SIGBRO Auth?

SIGBRO Auth is a method to log in to online Ardor wallets and UIs. The user visits the website, clicks on a link in the
mobile browser OR scans a QR code from an external screen with the SIGBRO app. Then the user is logged in automatically,
and the website admin knows that the user owns the Ardor account without the user ever exposing the passphrase.

Using SIGBRO Auth requires running the SIGBRO mobile app (available
for [Android](https://play.google.com/store/apps/details?id=org.nxter.sigbro)
and [iOS](https://apps.apple.com/dk/app/sigbro/id1579909308)) on the user's device.

There is NO entering passphrases or email addresses or other personal information into the website, so users can safely
use any public computer and internet connection with SIGBRO Auth.

### What it does

https://youtu.be/6W2ulKWrIG8

This video is of an early development version of the app.

### Log in with QR code

https://youtu.be/QfOnpWN3o58

This video demonstrates login via QR code with an early version of the app.

### Log in with a deeplink

https://youtu.be/mCIBhPmGpqY

This video demonstrates login from a mobile browser with an early version of the app.

## Use case examples

How you use SIGBRO Auth depends on the use case.

### Explorers

An “account explorer” service would grab and show information about the user’s account from the blockchain. For example,
on https://wallet.nxter.org, you can log in with SIGBRO Auth and view your account name and different token balances.
There could easily be added NFT’s to the site, token trading history, sent messages, the forging balance, dividends
received, or any other information that is stored on the blockchain.

### Wallets / Web UI’s

Another service might want to also let the user make transactions. This is where SIGBRO’s ability to check and sign
transactions locally for the user is handy. After SIGBRO Auth login, the server can generate an unsigned transaction
json for any kind of Ardor blockchain transaction and show it as a deeplink (or button) or as a QR code for the user.
The user then gets to check the details of the transaction in the SIGBRO app and approve the transaction. The app always
shows correct transaction details.

For a service with a responsive website, this use will 1) remove responsibility for keeping users’ passphrases safe for
the service owner, 2) offer better security for the user (local signing, passphrase encrypted on phone, so a website
hack can’t exploit it), 3) offer easy passwordless login (use fingerprint to open SIGBRO), 4) secure the user (and
service) against transferring funds to a hacker who has changed the website code, because the SIGBRO app will always
show the real transaction details to the user, 5) by using Auth and SIGBRO deeplink you can apply for getting a link to
your service/UI integrated directly into the SIGBRO app, so that SIGBRO users can visit from the app directly from
within the SIGBRO app UI and without even logging in. You'll get their login token sent automatically.

### Anything else

Using Ardor account ID’s and SIGBRO Auth opens for rather limitless possibilities, as service providers can use it with
the inbuilt Ardor platform features and even add their own smart contracts to the blockchain, and trigger them with
SIGBRO. After auth, the server can, for example, scan for membership properties, like a corona-pass and its status,
search for tokens that represent a ticket or user/citizen rights, rebate points to a store, etc., and then automatically
give the user access to the privileges this data dictates.

Currently, the SIGBRO Team works on ways to (optionally) link Ardor ID’s to trusted information about the individuals
and companies that own accounts, so that SIGBRO Auth in the foreseeable future can be used for digital signing of
documents, shareholder meetings, multi-sig, and voting, and so that users can check whose accounts they interact with,
in order to avoid scams. If you want to learn more, you’re welcome to contact the SIGBRO Team.

## How does SIGBRO Auth work?

Your server generates a UUID4 (Universally Unique Identifier) for every login attempt and sends it to SIGBRO backend. On
behalf of the user, the SIGBRO app locally signs the UUID4 with the user’s unique passphrase (secretPhrase) and
generates a [cryptographic token](https://ardordocs.jelurida.com/Tokens#Generate_Token), which it returns to the central
server. The server decodes and checks this [cryptographic token](https://ardordocs.jelurida.com/Tokens#Decode_Token) and
gets the user’s Ardor account ID (Reed Solomon). Because the user can only generate the token with the account’s
secretPhrase (and only log in to the SIGBRO app with the passphrase), the server can trust that the user is indeed the
owner (or controller) of that particular Ardor account.

## How to use Sigbro AUTH API

[cURL example](example_curl.md)

## WordPress plugin for the SIGBRO AUTH

You may find the plugin on the [GitHub](https://github.com/Nxter/wp-sigbro-auth2). You have to create zip file with the
plugin files and upload it (zip archive) to the WordPress. The plugin has 3 shortcodes.

### Disclaimer

The JS & PHP code included hardcoded password for AES encryption. This is not a good practice, and should be changed.

### sigbro-auth

```shell
[sigbro-auth redirect="/profile"]
```

This shortcode will show the QR-code and redirect the user to the profile page after log-in.

### sigbro-info

```shell
[sigbro-info redirect="/error"]
```

This shortcode will check if the user is logged in and show the user information, else redirect to the error page.

### sigbro-logout

```shell
[sigbro-logout redirect="/"]
```

This shortcode will log out the user and redirect to the home page.

