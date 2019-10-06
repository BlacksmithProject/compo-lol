dev-from-scratch: composer remove-useless-files database

composer:
	-rm -rf ./vendor
	-a | composer install

database:
	-bin/console d:d:d --force
	bin/console d:d:c
	-y | bin/console doctrine:migrations:migrate

diff:
	bin/console doctrine:migrations:diff

remove-useless-files:
	rm -rf ./config/routes
	rm -rf ./src/Controller
	rm -rf ./src/Entity
	rm -rf ./src/Migrations
	rm -rf ./src/Repository

pretty:
	./vendor/bin/pretty

pretty-fix:
	./vendor/bin/pretty fix

stan:
	./vendor/bin/phpstan analyse -l 7 src

test:
	./vendor/bin/phpunit

infection:
	./vendor/bin/infection --threads=4

test-CI:
	./vendor/bin/phpunit --coverage-clover=coverage.clover

CI: stan test-CI

release:
	git add CHANGELOG.md && git commit -m "release(v$(VERSION))" && git tag v$(VERSION) && git push && git push --tags

.PHONY: dev-from-scratch composer database diff remove-useless-files pretty pretty-fix stan test infection test-CI CI release