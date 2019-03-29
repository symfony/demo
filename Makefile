DOCKER_COMPOSE?=docker-compose
EXEC?=$(DOCKER_COMPOSE) exec app
CONSOLE=php bin/console
PHPCSFIXER?=$(EXEC) php -d memory_limit=1024m vendor/bin/php-cs-fixer

.DEFAULT_GOAL := help
.PHONY: help start stop restart install uninstall reset clear-cache shell clear clean
.PHONY: db-diff db-migrate db-rollback db-fixtures db-validate
.PHONY: watch assets assets-build
.PHONY: tests lint lint-symfony lint-yaml lint-twig lint-xliff php-cs php-cs-fix security-check test-schema test-all
.PHONY: deps
.PHONY: build up perm docker-compose.override.yml

help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'


##
## Project setup
##---------------------------------------------------------------------------

start:                                                                                                 ## Start docker containers
	$(DOCKER_COMPOSE) start

stop:                                                                                                  ## Stop docker containers
	$(DOCKER_COMPOSE) stop

restart:                                                                                               ## Restart docker containers
	$(DOCKER_COMPOSE) restart

install: docker-compose.override.yml build up deps perm                                                ## Create and start docker containers

uninstall: stop                                                                                        ## Remove docker containers
	$(DOCKER_COMPOSE) rm -vf

reset: uninstall install                                                                               ## Remove and re-create docker containers

clear-cache: perm
	$(EXEC) $(CONSOLE) cache:clear --no-warmup
	$(EXEC) $(CONSOLE) cache:warmup

shell:                                                                                                 ## Run app container in interactive mode
	$(EXEC) /bin/bash

clear: perm                                                                                            ## Remove all the cache, the logs, the sessions and the built assets
	$(EXEC) rm -rf var/cache/*
	rm -rf var/log/*
	rm -rf public/build
	rm -f var/.php_cs.cache

clean: clear                                                                                           ## Clear and remove dependencies
	rm -rf vendor node_modules


##
## Database
##---------------------------------------------------------------------------

db-diff: vendor                                                                                        ## Generate a migration by comparing your current database to your mapping information
	$(EXEC) $(CONSOLE) doctrine:migration:diff

db-migrate: vendor                                                                                     ## Migrate database schema to the latest available version
	$(EXEC) $(CONSOLE) doctrine:migration:migrate -n

db-rollback: vendor                                                                                    ## Rollback the latest executed migration
	$(EXEC) $(CONSOLE) doctrine:migration:migrate prev -n

db-fixtures: vendor                                                                                    ## Apply doctrine fixtures
	$(EXEC) $(CONSOLE) doctrine:fixtures:load -n

db-validate: vendor                                                                                    ## Check the ORM mapping
	$(EXEC) $(CONSOLE) doctrine:schema:validate


##
## Assets
##---------------------------------------------------------------------------

watch: node_modules                                                                                    ## Watch the assets and build their development version on change
	$(EXEC) yarn watch

assets: node_modules                                                                                   ## Build the development version of the assets
	$(EXEC) yarn dev

assets-build: node_modules                                                                             ## Build the production version of the assets
	$(EXEC) yarn build


##
## Tests
##---------------------------------------------------------------------------

tests:                                                                                                 ## Run all the PHP tests
	$(EXEC) bin/phpunit

lint: lint-symfony php-cs                                                                              ## Run lint on Twig, YAML, XLIFF, and PHP files

lint-symfony: lint-yaml lint-twig lint-xliff                                                           ## Lint Symfony (Twig and YAML) files

lint-yaml:                                                                                             ## Lint YAML files
	$(EXEC) $(CONSOLE) lint:yaml config

lint-twig:                                                                                             ## Lint Twig files
	$(EXEC) $(CONSOLE) lint:twig templates

lint-xliff:                                                                                            ## Lint Translation files
	$(EXEC) $(CONSOLE) lint:xliff translations

php-cs: vendor                                                                                         ## Lint PHP code
	$(PHPCSFIXER) fix --diff --dry-run --no-interaction -v

php-cs-fix: vendor                                                                                     ## Fix PHP code to follow the convention
	$(PHPCSFIXER) fix

security-check: vendor                                                                                 ## Check for vulnerable dependencies
	$(EXEC) vendor/bin/security-checker security:check

test-schema: vendor                                                                                    ## Test the doctrine Schema
	$(EXEC) $(CONSOLE) doctrine:schema:validate --skip-sync -vvv --no-interaction

test-all: lint test-schema security-check tests                                                        ## Lint all, run schema and security check, then unit and functionnal tests


##
## Dependencies
##---------------------------------------------------------------------------

deps: vendor assets                                                                                    ## Install the project dependencies


##


# Internal rules

build:
	$(DOCKER_COMPOSE) pull --ignore-pull-failures
	$(DOCKER_COMPOSE) build --force-rm

up:
	$(DOCKER_COMPOSE) up -d --remove-orphans

perm:
	$(EXEC) chmod -R 777 var public/build node_modules vendor
	$(EXEC) chown -R www-data:root var public/build node_modules vendor

docker-compose.override.yml:
ifneq ($(wildcard docker-compose.override.yml),docker-compose.override.yml)
	@echo docker-compose.override.yml do not exists, copy docker-compose.override.yml.dist to create it, and fill it.
	exit 1
endif


# Rules from files

vendor: composer.lock
	$(EXEC) composer install -n

composer.lock: composer.json
	@echo composer.lock is not up to date.

node_modules: yarn.lock
	$(EXEC) yarn install

yarn.lock: package.json
	@echo yarn.lock is not up to date.
