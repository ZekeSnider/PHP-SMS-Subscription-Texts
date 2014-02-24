This is a script that sends sms messages to a group of people. It can automated to send messages every hour/day/etc using cron. The list of people is loaded from mysql and the message are sent using email to sms gateways. I added the most popular US carriers to the gateway list, but you can add your own easily.

The Database table should have the following fields: "Name Number Carrier". The "Name" field is just for reference, it is not used by the script.

I may add a feature to send new additions to the list a welcome message in the future. A unsubscribe feature is never planned because why would anyone ever want to unsubscribe from the great things you're sending?

All you need to do to use this is just add your mysql information and email header/reply-to/etc. Also place a "random.txt" in the directory if you want to the messages to load from a random line in a text file. Otherwise just edit that line.