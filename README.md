# SamKnows Technical Test (PHP/MySQL)

## Setup

This application need database to run, please see [config file](./conf.php).

It was restricted to use Docker, but for development,
easiest way to get MySql up and running is:
```
docker run -v $(pwd)/schema:/docker-entrypoint-initdb.d -p13306:3306 -e MYSQL_ROOT_PASSWORD=my-secret-pw mysql
```

[Composer](https://getcomposer.org/) has to be installed,
and the dependencies have to be fetched:
```
	$ composer install
```

## Usage

To aggregate data from the input file use `import` sub-command:
```
	$ php run.php import
```

Use `report` sub-command to see results of a specific hour of the month,
provide unit ID, metric type, and a timestamp of that hour as arguments:
```
	$ php run.php report '1' 'download' '2017-02-22 10:00:00'
	+-----------+---------+---------+---------+---------+-------------+
	| Date      | Mean    | Median  | Minimum | Maximum | Sample Size |
	+-----------+---------+---------+---------+---------+-------------+
	| 2017-2-27 | 4659940 | 4659940 | 4659940 | 4659940 | 1           |
	| 2017-2-26 | 4666410 | 4666410 | 4666410 | 4666410 | 1           |
	| 2017-2-28 | 4663050 | 4663050 | 4663050 | 4663050 | 1           |
	| 2017-2-25 | 4665030 | 4665030 | 4665030 | 4665030 | 1           |
	+-----------+---------+---------+---------+---------+-------------+
```

To run unit tests:
```
	vendor/bin/phpunit --config tests/phpunit/phpunit.xml
```

To run behat integration test:
```
	$vendor/bin/behat -n -v
```

If you have `Make` installed, you can run tests using it.

## My comments

I have several comments about the test task:

- It took me much longer than suggested 2 hours, hence the requirements.
- Something is still left to do, like DI Container integration, input parameters validation.
- The solution has not been properly manually tested, due to the lack of time.
- If that was a real project I would had asked for clarifications on the task.
- I was not able to use PHPStorm, without which refactoring PHP is difficult, as a result
  all files are now resting in the same namespace.
- It was started in TDD manner originally, however I had to stop writing tests
  at some point to save time
  (considering that nobody will have to maintain this app anyway).
- Generally I find this task interesting, and I wish I could work on it longer.
- If the due date could be prolonged, I would implement many improvements in design,
  as well as the quality of the code, or at least I would like to be able to explain
  what would I change if I had more time.
