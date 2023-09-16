# Installation

## Setup
1. Add the host setting to /etc/hosts
```
127.0.0.1 yaraku.local
```
1. Clone source code: `git clone https://github.com/dragon99k/yaraku-code_challenge.git`
1. Build the docker containers by running `docker-compose build` in the project root.
1. Run `docker-compose up -d`.
1. Run `docker-compose exec app composer install`.
1. Copy .env: `cp src/.env.example src/.env`
1. Migration: `docker-compose exec app php artisan migrate`
1. Access the Laravel instance on `http://yaraku.local` (If there is a "Permission denied" error, run `docker-compose exec app chown -R www-data storage`).

# Usage

### Run PHPCS

```sh
./tools/phpcs.sh
# add fix option
./tools/phpcs.sh --fix
```