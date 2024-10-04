CONTAINER_NAME = filesharing-nginx

up:
	docker compose up -d
	docker compose ps -a

down:
	docker compose down
	docker compose ps -a

restart:
	docker compose restart

logs:
	docker compose logs -f

build:
	docker compose build

ps:
	docker compose ps -a

start: build up

.PHONY: up down restart logs build ps start
