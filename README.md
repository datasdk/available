# DataSDK Available

Availability model, trait, migration and contract for polymorphic availability periods.

## Installation

```bash
composer require datasdk/available
```

## Migrations

The service provider loads package migrations automatically.

```bash
php artisan migrate
```

## Config

Publish the config file when you need to customize it:

```bash
php artisan vendor:publish --provider="DataSDK\Available\AvailableServiceProvider" --tag=config
```
