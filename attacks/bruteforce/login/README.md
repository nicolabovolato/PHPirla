# Bruteforce Login page

This attack will bruteforce the login page. It relies on the fact that the user gets redirected from the login page if the login was successful.

## Steps

-   Run the bruteforce script

    `docker build -t python-bruteforce .`

    `docker run -it --rm --name python-bruteforce -v ${PWD}:/usr/src/app -w /usr/src/app -e TARGET=localhost:80/login.php -e USERNAME=admin -e WORDLIST=wordlist.txt python-bruteforce python script.py`

-   If the password for the user is in the wordlist it will be printed on screen

## Mitigation

-   Limit failed login attempts
-   Enforce strong password policy
-   Use Two factor authentication
