=== Sigbro Auth 2.0===
Contributors: scor2k
Tags: sigbro, nxter
Donate link: https://www.nxter.org/sigbro
Requires at least: 5.0
Tested up to: 5.9
Requires PHP: 7.1
License: MIT
License URI: https://opensource.org/licenses/MIT

Wordpress plugin which add the ability for any user to log in to the Wordpress site without using Wordpress authorization mechanism. 
The user won't have the access to the wordpress profile

==== How to use ====

1. To the auth page add shortcut `[sigbro-auth redirect="/?page_id=10"]`

2. After authorization user will be redirected to the "/?page_id=10"

Profit!

=== Print Account ===

1. Insert shortcut `[sigbro-info redirect="/"]`. We will use redirect parameter for users without authorization.

=== Logout ===

1. Insert shortcut `[sigbro-logout redirect="/"]`.

