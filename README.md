# Available

Denne pakke indeholder en `Available` model og et trait, der kan bruges til at give en Eloquent model en polymorf tilgængelighedsperiode.

## Installation

```bash
composer require datasdk/available
```

## Brug På En Model

Tilføj traitet på den model, der skal have tilgængelighed:

```php
use MyProject\Available\Traits\Available;

class Event extends Model
{
    use Available;
}
```

Traitet opretter en polymorf relation til:

```php
use MyProject\Available\Models\Available;
```

## Relationer

`available()`

Returnerer den tilknyttede availability-record som en `morphOne` relation.

```php
$event->available;
```

`availability()`

Returnerer den inverse polymorfe relation fra availability-modellen.

## Metoder

`set_available(array $dates)`

Opretter eller opdaterer tilgængeligheden for modellen.

```php
$event->set_available([
    'from' => '2026-06-01 09:00:00',
    'to' => '2026-06-01 17:00:00',
]);
```

Hvis både `from` og `to` er tomme, markeres modellen som altid tilgængelig.

`set_available_from($from)`

Sætter kun starttidspunktet.

```php
$event->set_available_from('2026-06-01 09:00:00');
```

`set_available_to($to)`

Sætter kun sluttidspunktet.

```php
$event->set_available_to('2026-06-01 17:00:00');
```

## Query Scopes

`available()`

Finder modeller der er tilgængelige nu.

```php
Event::available()->get();
```

`availableFrom($from)`

Finder modeller ud fra et starttidspunkt.

```php
Event::availableFrom('2026-06-01')->get();
```

`availableTo($to)`

Finder modeller ud fra et sluttidspunkt.

```php
Event::availableTo('2026-06-30')->get();
```

`availableAt($date)`

Finder modeller der er tilgængelige på et bestemt tidspunkt.

```php
Event::availableAt('2026-06-15 12:00:00')->get();
```

`availableAtDate($date)`

Samme princip som `availableAt`, men sammenligner kun datoen.

```php
Event::availableAtDate('2026-06-15')->get();
```

`availableBetween($from, $to)`

Finder modeller der overlapper et bestemt tidsinterval.

```php
Event::availableBetween('2026-06-01', '2026-06-30')->get();
```

`availableBetweenDate($from, $to)`

Finder modeller der overlapper et datointerval uden at sammenligne tid.

```php
Event::availableBetweenDate('2026-06-01', '2026-06-30')->get();
```
