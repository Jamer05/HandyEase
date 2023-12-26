Admin

id (PK)
username
password

Authorizer

id (PK)
firstname
lastname
request (FK)
phone
location
city
username
password
email
adminuser
otp
image
p_p

Chats

chat_id (PK)
from_id
to_id
message
opened
create_at

Conversation

conversation_id (PK)
user_1
user_2

Customer

id (PK)
firstname
lastname
phone
email
area
city

Finance

transno (PK)
cid
amount
wid (FK)
wage
aid (FK)
request
cust_name
auth_name
worker_name
tdate

Service

id (PK)
username
request
dateofreq
aflag
transflag
authid (FK)
status
price
types
brand
technology
info

Users

user_id (PK)
name
username
password
p_p
last_seen
staff
email

Worker

id (PK)
firstname
lastname
username
password
phone
profession
authid (FK)
adminuser
location
area
email
active