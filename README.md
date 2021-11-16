# PHP&lt;i/&gt;rla

<style scoped>
        .hero {
            margin: 5em auto;
            font-family: sans-serif;
            font-size: 1.5em;
            width: 50%;
            text-align: center;
        }
        .hero > *:first-child {
            padding: 1em;
            border: 0.25em solid;
        }
</style>

<div class="hero">
    <h1>PHP&lt;/i&gt;rla</h1>
    <p><u>The safest bank in the world</u></p>
</div>

Displaying some xss vulnerabilities on the average PHP website.

## Run the app

### `docker-compose up -d` and [open the browser](http://localhost:5000)

## Attacks

- [Steal cookie of a user](./attacks/reflected-xss/get-user-cookie)
- [Steal cookie of all users](./attacks/reflected-xss/get-user-cookie)
- [Transfer funds to your account](./attacks/stored-xss/transfer-funds)
