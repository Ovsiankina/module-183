# Cheatsheet

## Cmds


### Extract token in one go
```bash
curl -s -X POST 127.0.0.1:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"USER","password":"PASS"}' \
  | jq -r '.token.token' | clip
```


```bash
curl -s -X GET 127.0.0.1:8000/api/kids/1 \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  | jq .
```
