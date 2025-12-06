# Cheatsheet

## Cmds

### Extract token in one go

```bash
curl -s -X POST 127.0.0.1:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"USER","password":"PASS"}' \
  | jq -r '.token.token' | clip
```

19|hcpJTMCA1lYxXDNAsc01LkPLKeKTC8IytTGhCFzx3877136a

### Get

```bash
curl -s -X GET 127.0.0.1:8000/api/kids/1 \
  -H "Authorization: Bearer TOKEN" \
  | jq .
```

### Update

```bash
curl -s -X PATCH 127.0.0.1:8000/api/kids/1 \
  -H "Authorization: TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"wiseLevel":"Un peu casse bonbon"}' \
  | jq .
```

