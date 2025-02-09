A simple repo for stocking my work on php.

Objective is to upgrade my skill on php and laravel for staying up to date.

If you want to use this stuff and need help create an issue directly on the repo.

-----

# For symfony

## dev

The nginx docker have no purpose in dev since we can use the port mapping directly via the php docker (`8000:8000`).

If you need to launch `symfony server:ca:install` you need to do it has root.

The recommended way of doing that is the following: `docker exec -u root -it labPhp-app /bin/bash`.

If you want to launch the dev server you need to tell symfony to listen on `0.0.0.0` since you want to connect via your host machine and not the localhost of the docker: `symfony serve --listen-ip=0.0.0.0 -d`.

or in one line: `docker exec -it labPhp-app /bin/bash -c "cd lab-symfony7 && symfony serve --listen-ip=0.0.0.0 -d"`

## prod

Use the nginx docker and setup in `docker-compose/nginx/lab-conf` the right path for the web server root folder (`www/lab/lab-symfony/public`).

# XDEBUG

The xdebug config only need your host machine IP on the `Dockerfile`.

Maybe later I'll find a way to do this automatically (maybe).
