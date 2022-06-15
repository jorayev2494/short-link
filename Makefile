.DEFAULT_GOAL := help

COMPOSE_FILE_PATH := ./docker/docker-compose.yml

init:			## Init Project
	@make init_project
	@make init_docker

init_project:	## Init Laravel
	@cp .env.example .env

init_docker:	## Init Docker
	@cp ./docker/.env.example ./docker/.env

install:
	@make init
	@make up
	@make vendor_install
	@make migrate_seed
	@make node_i
	@make node_production
	@make ps
	@make help

up:			## Up project
	@docker-compose --file $(COMPOSE_FILE_PATH) up --build -d

restart:	## Restart project
	@docker-compose --file $(COMPOSE_FILE_PATH) restart

down:		## Down project
	docker-compose --file $(COMPOSE_FILE_PATH) down

bash:		## Project bash terminal
	@docker-compose --file $(COMPOSE_FILE_PATH) exec php-fpm bash

ps:			## Show project process
	@docker-compose --file $(COMPOSE_FILE_PATH) ps

cc:			## Clear cache
	@docker-compose --file $(COMPOSE_FILE_PATH) exec php-fpm ./artisan optimize:clear

migrate:			## Migratge
	@docker-compose --file $(COMPOSE_FILE_PATH) exec php-fpm ./artisan migrate

migrate_seed:		## Migrate and Seed
	@docker-compose --file $(COMPOSE_FILE_PATH) exec php-fpm ./artisan migrate:refresh --seed

vendor_install:		## Composer install
	@docker-compose --file $(COMPOSE_FILE_PATH) exec php-fpm composer install --ignore-platform-reqs
	@docker-compose --file $(COMPOSE_FILE_PATH) exec php-fpm ./artisan key:generate

node_bash:		## Project Node bash terminal
	@docker-compose --file $(COMPOSE_FILE_PATH) exec node bash

node_i:		## Front-end npm install
	@docker-compose --file $(COMPOSE_FILE_PATH) exec node npm i

node_wath:		## Front-end npm wath
	@docker-compose --file $(COMPOSE_FILE_PATH) exec node npm wath

node_production:		## Front-end npm deploy
	@docker-compose --file $(COMPOSE_FILE_PATH) exec node npm run production

.PHONY: help
help:		## Show Project commands
	@#echo ${Cyan}"\t\t This project 'Link Shorter' REST API Server!"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'
	@echo ${Red}"----------------------------------------------------------------------"
	@make server_info
	
server_info:
	@echo Application url: http://127.0.0.1:8083