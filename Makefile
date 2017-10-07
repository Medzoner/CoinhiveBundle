CONSOLE=php bin/console
COMPOSER=php -d "apc.enable_cli=0" ../composer.phar
PHPUNIT=php bin/phpunit

init: git-clone install

install: git-subup composer-install cache-clear assets db cache-clear

update: git-update git-subup composer-install db-update cache-clear composer-optimize test-unit

### GIT ###
git-subup:
	git submodule update --init

git-update:
	git fetch origin
	git stash
	git pull
	git stash pop || :

### COMPOSER ###
composer-install:
	$(COMPOSER) install

composer-update:
	$(COMPOSER) update

composer-autoload:
	$(COMPOSER) dumpautoload

composer-optimize:
	$(COMPOSER) dumpautoload --optimize

composer-script-update:
	$(COMPOSER) run-script post-install-cmd

### version ###
version-patch:
	$(eval version := $(shell $(SUDO) $(CONSOLE) app:version:bump --patch=1))
	git add app/config/version.yml
	git commit -m "[RELEASE] version $(version)"

version-feature:
	$(eval version := $(shell $(SUDO) $(CONSOLE) app:version:bump --minor=1))
	git add app/config/version.yml
	git commit -m "[RELEASE] version $(version)"

.PHONY: version-patch version-feature

### CONSOLE ###
cache-clear:
	$(CONSOLE) cache:clear
	$(CONSOLE) cache:clear --env=prod

assets:
	$(CONSOLE) assets:install --symlink

assetic:
	$(CONSOLE) assetic:dump --env=prod

db-update:
	$(CONSOLE) doctrine:schema:update --force

### TESTS ###
test-phpunit:
	$(PHPUNIT)

test-unit:
	$(PHPUNIT) --testsuite unit_tests