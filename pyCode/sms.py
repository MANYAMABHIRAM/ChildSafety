from twilio.rest import Client
import os

# Access the environment variables
account_sid = os.getenv('TWILIO_ACCOUNT_SID')
auth_token = os.getenv('TWILIO_AUTH_TOKEN')
my_phone = os.getenv('TWILIO_PHONE_NUMBER')

def sendSms():
    client = Client(account_sid, auth_token)
    message = client.messages.create(
        body="Your child has left the school premises",
        from_=my_phone,
        to='+919640343114'
    )

# sendSms()  # Uncomment to send the SMS
