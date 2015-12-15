# SDII-Project
###Configuration Information:
Administrator Paswords:
- Superadmin username: thecreator; password: morganfreeman
- Admin username: jaredfogle; password: gaze11e

###To backup the database, run this command:
```
mysqldump limbo_db > limbo_db_backup.sql
```
- More information about database backups can be found at: http://www.liquidweb.com/kb/how-to-back-up-mysql-databases-from-the-command-line/

To configure this project correctly, you will need to make a few changes to your local machine:

1. Change the path that images save to in Site/php_includes/upload.php

$target_dir = "C:/Program Files (x86)/EasyPHP-DevServer-14.1VC11/data/localweb/SDII-Project/Site/php_includes/uploads/";
