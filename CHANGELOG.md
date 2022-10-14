# Changelog

All notable changes to `laravel-query-builder-to-clickhouse` will be documented in this file

## 1.0.0 - 2022-05-15

- initial release

## 1.1.0 - 2022-06-24

- Using iamprageeth/laravel-clickhouse (folked version of bavix/laravel-clickhouse)

## 1.2.0 - 2022-06-25

- Added method to switch to buffer table when using query builder

## 1.3.0 - 2022-07-19

- Removed sorting records in bulk insert. This will improve performance in bulk insert

## 1.4.0 - 2022-10-14

- Added ClickHouse Base Model
- Moved executing sql on clickhouse to trait
- Moved custom eloquent builder to package
- Changed buffer method to useSuffix. More sense now

## 1.5.0 - 2022-10-14
- Fixed Question Mark Github Issue#1
