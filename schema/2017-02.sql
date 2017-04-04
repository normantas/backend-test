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
