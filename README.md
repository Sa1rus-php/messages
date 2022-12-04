
# Test task (Comments)

What needs to be done to start the project

1)You must clone laradock

- git clone https://github.com/Laradock/laradock.git

2)Setup env file in laradock folder

- cp .env.example .env

In env file you have to change the settings

- APP_CODE_PATH_HOST=../messages

- PHP_VERSION=8.1

- COMPOSE_PROJECT_NAME=messages

- WORKSPACE_INSTALL_SUPERVISOR=true

- WORKSPACE_INSTALL_PYTHON=true

Next step you have to create config to supervisor in php-worker/supervisord.d/

Create file - laravel-worker.conf and setup it 

- [program:laravel_horizon]
- process_name=%(program_name)s_%(process_num)02d
- command=php /var/www/artisan horizon
- autostart=true
- autorestart=true
- redirect_stderr=true
- user=laradock
- stdout_logfile=/var/www/storage/horizon.log
- stdout_logfile_maxbytes=10MB
- logfile_backups=14
- stopwaitsecs=3600

Now set up the project env

Mysql access: 

- host - mysql
- port - 3306
- database - default
- user - root
- pass - root

Change QUEUE_CONNECTION=sync to QUEUE_CONNECTION=redis

Redis access: 

- host - redis
- password - secret_redis
- port - 6379

Now you need to run docker

- docker-compose up -d nginx mysql phpmyadmin redis workspace 

To enter the php docker container 

- docker exec -it messages-workspace-1 bash 

Now let's install all the necessary dependencies IN DOCKER CONTAINER

- composer install 

Perform all necessary migrations IN DOCKER CONTAINER

- php artisan migrate

Then connect supervisor and horizon

- supervisorctl reread
- supervisorctl update
- supervisorctl start horizon


Link to horizon - http://localhost/horizon