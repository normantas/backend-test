.DEFAULT_GOAL := all
SHELL := /bin/bash

test:
	vendor/bin/phpunit --config tests/phpunit/phpunit.xml

behat:
	vendor/bin/behat -n -v

all: test behat

.PHONY: demo test behat all
