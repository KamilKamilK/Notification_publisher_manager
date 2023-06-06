### Notification Manager

This application was build to show how to send notifications throw different channels.
Notification is send after you register to application.

There are 3 channels available:
`email` notification send to MailTrap
`SMS` notification send to Twilio
`chat` notification send to Slack

Set available channels in NOTIFICATION_PROVIDERS variable. Separate them with ';'.

If one of available channel fails to send notification, another channel is automatically initiated.

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run `docker compose up -d` (the logs will be displayed in the current shell)
3. Run `symfony serve -d` 
4. Open `https://localhost` in your favorite web browser

## Custom variables description
###
Available notification providers :email;SMS;chat

There is two way to send notifications.

1st way send one notification.
The way provider names are set describes the importance of sending
NOTIFICATION_PROVIDERS='email;SMS;chat' means that email notification will be sent first.

2nd way to send one or more notifications depends on the provider array.
If you set providers in NOTIFICATION_PROVIDERS_ARRAY notifications will be sent to all written providers.
NOTIFICATION_PROVIDERS_ARRAY=email;chat

!!! You have to choose only one way !!!
!!! If you complete the NOTIFICATION PROVIDERS leave the NOTIFICATION PROVIDERS ARRAY blank!!!


Set up notification providers you want to use:
`NOTIFICATION_PROVIDERS`='email;SMS;chat'

Set up notification providers you want to use:
`NOTIFICATION_PROVIDERS_ARRAY`=email;chat
###

Set up email address from which notifications will be send.
`SENDER_EMAIL_ADRRESS`='example@gmail.com'

Paste slack webhook endpoint generated in SLACK api.
`SLACK_WEBHOOK_ENDPOINT`='https://hooks.slack.com/services/**********/**********/*********OhqSPpo6nH5be'

Paste slack sender name which will be visible for message receiver.
`SLACK_SENDER`='Notification APP'

Paste account_SID, authorization token you can find in you Twilio account
`TWILIO_ACCOUNT_SID`=''
`TWILIO_AUTH_TOKEN`=''
Paste phone number you receive after setup Twilio account 
`TWILIO_PHONE_NUMBER`=''

Paste Mailer dsn you can find in accout details on MailTrap.
Example: smtp://username:password@sandbox.smtp.mailtrap.io:port
`MAILER_DSN`=smtp://*********:********@sandbox.smtp.mailtrap.io:****?encryption=tls&auth_mode=login

Create example recipient to whom you going to send message 
`RECIPIENT_NAME`=Kamil
`RECIPIENT_EMAIL`=example@gmail.com
`RECIPIENT_PHONE`=13612649514
**Enjoy!**
