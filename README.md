# Two Factor Authentication Test
In this repo you can find a test to generate and check codes the 2FA way. Use google authenticator app or any other to test this.

The 2FA class uses code from [This Repo](https://github.com/PHPGangsta/GoogleAuthenticator)

This is pure for experimental and learning purposes. Don't use the code as it currently is in any production environment.

## Running the application
To run the application use any PHP 7 or higher server. Simply run it from the src folder.

## Extra's
You can at a secret key as URL parameter to maintain a specific secret key. example:
``http://localhost/?secret=AFDA2X2RSDAYVRSW7W4LKFY6TNRDDJZR``
