.PHONY: test
test: cs stan unit

.PHONY: cs
cs: vendor/bin
	vendor/bin/php-cs-fixer fix --allow-risky=yes --dry-run --verbose src/

.PHONY: fix
fix: vendor/bin
	vendor/bin/php-cs-fixer fix --allow-risky=yes --verbose src/

.PHONY: stan
stan: vendor/bin
	vendor/bin/phpstan analyse --level=7 src/

.PHONY: unit
unit: vendor/bin
	bin/phpunit

vendor/bin:
	composer install
