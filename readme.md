This is source of one of the sites I used to run 'Send Me Jobs Today'

This site has two purpose. Act as a job search plateform and run automated jobs by email system. There is two way a user can be stored in system, direct signup which is registration directly from the site or by uploading CSV file to the database using following: `php artisan CsvToDb --filename=FILENAME.csv` File should be stored under /storage/app folder. 

Data must be in follwing format when uploading CSV:
`email, name, , location, job title`

Once they data is uploaded, their status is marked as 2. Which is user is currently inactive. This requires you to manually run SQL query to activate the user: `update users set status = 1 where status = 2 limit 100`. (I never got around building interface to do that). The reason for marking user as inactive  is ESP, suddenly sending emails to a lot of uses can cause emails to be seen as spam. Hence we activate users in chunks depending on performance.

Jobs by Email requires following setup:
- Install Supervisor `sudo apt-get install supervisor`
- Install beanstalkd `sudo apt-get install beanstalkd`. Read how to add configs to supervisor here https://laravel.com/docs/5.8/queues#supervisor-configuration
- Setup Cronjob that runs artisan command: ex. `*/5 * * * * cd /var/www/html/website/ && php artisan schedule:run >> /d$`

Misc:
- Run: `php artisan migrate seed`.
- Add configs to `.env` file.
- App won't send emails on Sat and Sunday as there's not much activity in job market these days.
- Currently the webhook is only set to work with Mailgun. If you're using any other service for example Sendgrid, write your own webhook code to handle bounces, complaints etc..
- System only works with AdView API at the moment. You'll need a publisher account with AdView.