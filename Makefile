.DEFAULT_GOAL := all
SHELL := /bin/bash

demo:
	php run.php -

test:
	vendor/bin/phpunit --config tests/phpunit/phpunit.xml

all: test demo

.PHONY: demo test all
