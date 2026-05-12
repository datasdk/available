# Available

This package provides an `Available` model and trait that can be used to add a polymorphic availability period to any Eloquent model.

## Installation

```bash
composer require datasdk/available
```

## Usage On A Model

Add the trait to the model that should support availability:

```php
use MyProject\Available\Traits\Available;

class Event extends Model
{
    use Available;
}
```

The trait stores availability records through the following model:

```php
use MyProject\Available\Models\Available;
```

## Relationships

`available()`

Returns the related availability record as a `morphOne` relationship.

```php
$event->available;
```

`availability()`

Returns the inverse polymorphic relationship from the availability model.

## Methods

`set_available(array $dates)`

Creates or updates the availability period for the model.

```php
$event->set_available([
    'from' => '2026-06-01 09:00:00',
    'to' => '2026-06-01 17:00:00',
]);
```

If both `from` and `to` are empty, the model is marked as always available.

`set_available_from($from)`

Sets only the start datetime.

```php
$event->set_available_from('2026-06-01 09:00:00');
```

`set_available_to($to)`

Sets only the end datetime.

```php
$event->set_available_to('2026-06-01 17:00:00');
```

## Query Scopes

`available()`

Returns models that are available now.

```php
Event::available()->get();
```

`availableFrom($from)`

Returns models based on a start datetime.

```php
Event::availableFrom('2026-06-01')->get();
```

`availableTo($to)`

Returns models based on an end datetime.

```php
Event::availableTo('2026-06-30')->get();
```

`availableAt($date)`

Returns models that are available at a specific datetime.

```php
Event::availableAt('2026-06-15 12:00:00')->get();
```

`availableAtDate($date)`

Works like `availableAt`, but compares only the date part.

```php
Event::availableAtDate('2026-06-15')->get();
```

`availableBetween($from, $to)`

Returns models whose availability overlaps a datetime range.

```php
Event::availableBetween('2026-06-01', '2026-06-30')->get();
```

`availableBetweenDate($from, $to)`

Returns models whose availability overlaps a date range without comparing time.

```php
Event::availableBetweenDate('2026-06-01', '2026-06-30')->get();
```
