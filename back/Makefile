DOCKER_COMPOSE  = docker-compose

EXEC_PHP        = $(DOCKER_COMPOSE) exec -T php 
EXEC_JS         = $(DOCKER_COMPOSE) exec -T node

SYMFONY         = $(EXEC_PHP) symfony console
COMPOSER        = $(EXEC_PHP) composer
YARN            = $(EXEC_JS) yarn

##
## Project
## -------
##

build:
	@$(DOCKER_COMPOSE) pull --parallel --quiet --ignore-pull-failures 2> /dev/null
	$(DOCKER_COMPOSE) build --pull

kill:
	$(DOCKER_COMPOSE) kill
	$(DOCKER_COMPOSE) down --volumes --remove-orphans

install: ## Install and start the project
install: docker-compose.override.yml build start


reset: ## Stop and start a fresh install of the project
reset: kill install

start: ## Start the project
	$(DOCKER_COMPOSE) up -d --remove-orphans --no-recreate

stop: ## Stop the project
	$(DOCKER_COMPOSE) stop

clean: ## Stop the project and remove generated files
clean: kill
	rm -rf docker-compose.override.yml

db:
	$(SYMFONY) doctrine:schema:update --force

migration:
	$(SYMFONY) make:migration

migrate:
	$(SYMFONY) doctrine:migrations:migrate

.PHONY: build kill install reset start stop clean db

docker-compose.override.yml: docker-compose.override.yml.dist
	@if [ -f docker-compose.override.yml ]; \
	then\
		echo '\033[1;41m/!\ The docker-compose.override.yml.dist file has changed. Please check your docker-compose.override.yml file (this message will not be displayed again).\033[0m';\
		touch docker-compose.override.yml;\
		exit 1;\
	else\
		echo cp docker-compose.override.yml.dist docker-compose.override.yml;\
		cp docker-compose.override.yml.dist docker-compose.override.yml;\
	fi

.DEFAULT_GOAL := help

help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

.PHONY: help






stan:
	./vendor/bin/phpstan analyse --ansi --no-progress --error-format=table
	
cs:
	./vendor/bin/phpcs ./src -p -s -v --colors --no-cache

csfix:
	./vendor/bin/phpcbf ./src --disable-cache

phan:
	./vendor/bin/phan -d ./src

churn:
	./vendor/bin/churn run ./src

md:
	./vendor/bin/phpmd ./src ansi phpmd.xml

ins:
	./vendor/bin/phpinsights

deptrac:
	./vendor/bin/deptrac analyse depfile.yaml --no-cache

dep-uml:
	./vendor/bin/dephpend uml --output=uml.png ./src

dep-dsm:
	./vendor/bin/dephpend dsm ./src > dependencies.html

dep-metrics:
	./vendor/bin/dephpend metrics ./src

metrics:
	./vendor/bin/phpmetrics --report-html="./report" ./src
	