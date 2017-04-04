Feature: Report
  Scenario: when data exists
    Given 'testdata.json' is imported
     When ask for 'download' from unit '1' on '2017-02-22 10:00:00'
     Then reports:
		| Date       | Mean    | Median  | Minimum | Maximum | Sample Size |
		| 2017-02-25 | 1214400 | 1214400 | 1214400 | 1214400 | 1           |
		| 2017-02-26 | 1208610 | 1208610 | 1208610 | 1208610 | 1           |
		| 2017-02-27 | 1214470 | 1214470 | 1214470 | 1214470 | 1           |
		| 2017-02-28 | 1234190 | 1234190 | 1234190 | 1234190 | 1           |
