CREATE DATABASE IF NOT EXISTS skdb;

USE skdb;

CREATE TABLE hour_summary (
    unit SMALLINT,
    metric TINYINT,
    year SMALLINT,
    month TINYINT,
    day TINYINT,
    hour TINYINT,
    mean FLOAT,
    median FLOAT,
    minimum FLOAT,
    maximum FLOAT,
    sample_size INT
);

ALTER TABLE `hour_summary` ADD INDEX `index_unit_metric_hour` (`unit`,`metric`,`hour`);
