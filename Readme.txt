To use the upload function, please set the php.ini as follows:

file_uploads=On
max_execution_time=6000
max_input_time=6000
max_input_vars=2500
memory_limit=128M
output_buffering=4096
post_max_size=2000M
upload_max_filesize=2000M
upload_tmp_dir=""(default)

Make sure the permissions of the images,video and music folder is
is 777 (rwxrwxrwx).

To create the database, please use the code provided in databasecode-finalversion.txt

To connect to the database, change the hostname, username, database name and password in 
public/database.php and includes/db_connection.php
