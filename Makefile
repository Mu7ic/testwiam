up:
	@docker compose up -d
down:
	@docker compose stop

hard-rebuild:
	@docker compose build --no-cache
	@docker compose up --build --force-recreate --no-deps -d

exec:
	@docker compose exec app su local -s /bin/bash

refresh:
	@make down
	@make up

composer:
	@make up
	@docker compose exec app composer install

migrate:
	@docker compose exec app php yii migrate
