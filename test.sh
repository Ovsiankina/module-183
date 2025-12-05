#!/usr/bin/env bash

# Quick integration script for the Kids API.
# Usage: API_URL=http://127.0.0.1:8000/api bash test.sh

set -u

API_URL="${API_URL:-http://127.0.0.1:8000/api}"
JSON_HEADER="Content-Type: application/json"

# Internal buffers for the last response body/status.
REPLY_BODY=""
REPLY_STATUS=""
extract_match() {
    # Usage: extract_match "<body>" "<pcre pattern>"
    echo "$1" | grep -oP "$2" | head -n1
}

request() {
    local method="$1"
    local path="$2"
    local data="${3:-}"
    local token="${4:-}"

    echo "### $method $path"
    local auth_headers=()
    [ -n "$token" ] && auth_headers+=(-H "Authorization: Bearer $token")

    local raw
    if [ -n "$data" ]; then
        raw=$(curl -s -w "\n%{http_code}" -X "$method" "$API_URL$path" -H "$JSON_HEADER" "${auth_headers[@]}" -d "$data")
    else
        raw=$(curl -s -w "\n%{http_code}" -X "$method" "$API_URL$path" -H "$JSON_HEADER" "${auth_headers[@]}")
    fi

    REPLY_STATUS="${raw##*$'\n'}"
    REPLY_BODY="${raw%$'\n'*}"

    echo "HTTP $REPLY_STATUS"
    echo "$REPLY_BODY"
    echo
}

echo "# 1) Login as pere@noel.com"
request POST "/auth/login" '{"email":"pere@noel.com","password":"salut"}'
MASTER_TOKEN=$(extract_match "$REPLY_BODY" '(?<="token":")[^"]+')
echo "Master token acquired (prefix): ${MASTER_TOKEN:0:16}..."
echo

echo "# 2) Create a kid (wise) via PUT /kids"
KID_NAME="Integration Kid $RANDOM"
CREATE_PAYLOAD=$(
    cat <<EOF
{
  "name": "$KID_NAME",
  "birthDate": "2020-12-02",
  "address": "1 Test Street",
  "zipCode": "1234",
  "city": "Testville",
  "wishList": "A wooden train and a teddy bear",
  "wiseLevel": "Très sage"
}
EOF
)
request PUT "/kids/store" "$CREATE_PAYLOAD" "$MASTER_TOKEN"
NEW_KID_ID=$(extract_match "$REPLY_BODY" '(?<="id":)[0-9]+')
echo "Created kid id: $NEW_KID_ID"
echo
#
# echo "# 3) Create an unwise kid (wise level 4) via PUT /kids"
# UNWISE_NAME="Unwise Kid $RANDOM"
# UNWISE_PAYLOAD=$(cat <<EOF
# {
#   "name": "$UNWISE_NAME",
#   "birthDate": "2019-11-02",
#   "address": "9 Coal Street",
#   "zipCode": "9999",
#   "city": "Coalville",
#   "wishList": "Charbon",
#   "wiseLevel": "Un vrai petit mer****"
# }
# EOF
# )
# request PUT "/kids" "$UNWISE_PAYLOAD" "$MASTER_TOKEN"
# UNWISE_KID_ID=$(extract_match "$REPLY_BODY" '(?<="id":)[0-9]+')
# echo "Created unwise kid id: $UNWISE_KID_ID"
# echo
#
# echo "# 4) List kids (public) via GET /kids"
# request GET "/kids"
#
# echo "# 5) Show the created kid via GET /kids/{id}"
# if [ -n "$NEW_KID_ID" ]; then
#   request GET "/kids/$NEW_KID_ID" "" "$MASTER_TOKEN"
# else
#   echo "No kid id captured from creation response; skipping show."
#   echo
# fi
#
# echo "# 6) Update wiseLevel via PATCH /kids/{id}"
# if [ -n "$NEW_KID_ID" ]; then
#   request PATCH "/kids/$NEW_KID_ID" '{"wiseLevel":"Un vrai petit mer****"}' "$MASTER_TOKEN"
# else
#   echo "No kid id captured from creation response; skipping update."
#   echo
# fi
#
# echo "# 7) Delete the created kid via DELETE /kids/{id}"
# if [ -n "$NEW_KID_ID" ]; then
#   request DELETE "/kids/$NEW_KID_ID" "" "$MASTER_TOKEN"
# else
#   echo "No kid id captured from creation response; skipping delete."
#   echo
# fi
#
# echo "# 8) Attempt to create a kids:read:unwise token"
# UNWISE_TOKEN_NAME="kids-read-unwise-$RANDOM"
# UNWISE_TOKEN=""
# request POST "/tokens" "$(cat <<EOF
# {
#   "name": "$UNWISE_TOKEN_NAME",
#   "abilities": ["kids:read:unwise"]
# }
# EOF
# )" "$MASTER_TOKEN"
#
# if [ "$REPLY_STATUS" = "201" ]; then
#   UNWISE_TOKEN=$(extract_match "$REPLY_BODY" '(?<="plainTextToken":")[^"]+')
#   echo "kids:read:unwise token created (prefix): ${UNWISE_TOKEN:0:16}..."
# else
#   echo "Token creation failed (expected to pass once ability is allowed); skipping unwise-only read tests."
# fi
# echo
#
# echo "# 9) Use kids:read:unwise token (if available) to GET an unwise kid"
# if [ -n "$UNWISE_TOKEN" ] && [ -n "$UNWISE_KID_ID" ]; then
#   request GET "/kids/$UNWISE_KID_ID" "" "$UNWISE_TOKEN"
# else
#   echo "Skipping unwise-only read because the token was not created."
#   echo
# fi
