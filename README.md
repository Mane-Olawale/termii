# Termii Client

A simple Object Oriented PHP Client for Termii SMS API.

Uses [Termii API](http://developer.termii.com/).


## Requirements

* PHP >= 7.2
* Guzzlehttp ~6|~7

## Installation

Via [Composer](https://getcomposer.org).

### PHP 7.2+:

```bash
composer require mane-olawale/termii
```


You now have Termii Client installed in *vendor/mane-olawale/termii*

And an handy autoload file to include in your project in *vendor/autoload.php*


## Basic usage of `Termii client`

```php
<?php

// This file is generated by Composer
require_once __DIR__ . '/vendor/autoload.php';

use ManeOlawale\Termii\Client;

// Create a new Client instance
$client = new Client('{api_key}');

// Create a new Client instance and set options
$client = new Client('{api_key}', [
            'sender_id' => 'Olawale',
            'channel' => 'generic',
            "attempts" => 10,
            "time_to_live" => 30,
            "length" => 6,
            "placeholder" => '{token}',
            'pin_type' => 'ALPHANUMERIC',
            'message_type' => 'ALPHANUMERIC',
            'type' => 'plain',
        ]);

$client->sms->send('2347041945964', 'Hello World!');

// You can change any option later

$client->fillOptions([
            "attempts" => 5,
            "time_to_live" => 20,
            "length" => 4,
            "placeholder" => '{pin}',
        ]);

```


## Sender

### Getting Sender ID list

Uses [Sender ID](https://developer.termii.com/sender-id).

```php
<?php

// This file is generated by Composer
require_once __DIR__ . '/vendor/autoload.php';

use ManeOlawale\Termii\Client;

$client = new Client('{api_key}');

$client->sender->list();

```
> **Note:** We didn`t add the Sender id and channel becuase they are optional and they can always be passed later on the client object or the SMS API handler.


### Request Sender ID

Uses [Request Sender ID](https://developer.termii.com/sender-id#request-sender-id).

```php
<?php

// This file is generated by Composer
require_once __DIR__ . '/vendor/autoload.php';

use ManeOlawale\Termii\Client;

$client = new Client('{api_key}');

$client->sender->request('Olawale', 'Friendship based Notifications', 'Mane Olawale');

```


## SMS

### Send Message

Uses [Switch - Messaging](http://developer.termii.com/messaging/).

```php
<?php

    // This file is generated by Composer
    require_once __DIR__ . '/vendor/autoload.php';

    use ManeOlawale\Termii\Client;

    $client = new Client('{api_key}', [
            'sender_id' => '{sender_id}',
            'channel' => '{channel}',
        ]);

    return $client->sms->send('2347041945964', 'Testing');

```
**Custom Sender ID or Channel**
```php
<?php

    // This file is generated by Composer
    require_once __DIR__ . '/vendor/autoload.php';

    use ManeOlawale\Termii\Client;

    $client = new Client('{api_key}', [
            'sender_id' => '{sender_id}',
            'channel' => '{channel}',
        ]);

    return $client->sms->send('2347041945964', 'Hello World', 'Olawale', 'generic');

    // OR probably omit sender id or channel

    return $client->sms->send('2347041945964', 'Hello World', null, 'generic');

```

### Send Number

Uses [Switch - Number](http://developer.termii.com/number/).

```php
<?php

    // This file is generated by Composer
    require_once __DIR__ . '/vendor/autoload.php';

    use ManeOlawale\Termii\Client;

    $client = new Client('{api_key}');

    return $client->sms->number('2347041945964', 'Hello World');

```

### Template

Uses [Switch - Template](http://developer.termii.com/templates/).

```php
<?php

    // This file is generated by Composer
    require_once __DIR__ . '/vendor/autoload.php';

    use ManeOlawale\Termii\Client;

    $client = new Client('{api_key}');

    return $client->sms->template('2347041945964', '{template_id}', [
            'product_name' => 'Termii',
            'otp' => '120435',
            'expiry_time' => '10 minutes'
    ], '{device_id}');

```


## Token

### Send Token

Uses [Send Token](http://developer.termii.com/send-token/).

```php
<?php

    // This file is generated by Composer
    require_once __DIR__ . '/vendor/autoload.php';

    use ManeOlawale\Termii\Client;

    $client = new Client('{api_key}', [
            'sender_id' => '{sender_id}',
            'channel' => '{channel}',
        ]);

    // You can choose to omit the pin options if you have set them when creating the client instance
    return $client->token->sendToken('2347041945964', '{token} is your friendship verification token', [
        "attempts" => 10,
        "time_to_live" => 30,
        "length" => 6,
        "placeholder" => '{token}',
        'type' => 'NUMERIC',
    ]);

```
**Custom Sender ID or Channel**
```php
<?php

    // This file is generated by Composer
    require_once __DIR__ . '/vendor/autoload.php';

    use ManeOlawale\Termii\Client;

    $client = new Client('{api_key}', [
            'sender_id' => '{sender_id}',
            'channel' => '{channel}',
        ]);

    return $client->token->sendToken('2347041945964', '{token} is your friendship verification token', [
        "attempts" => 10,
        "time_to_live" => 30,
        "length" => 6,
        "placeholder" => '{token}',
        'type' => 'NUMERIC',
    ], 'Olawale', 'generic');

    // OR probably omit sender id or channel

    return $client->token->sendToken('2347041945964', '{token} is your friendship verification token', [
        "attempts" => 10,
        "time_to_live" => 30,
        "length" => 6,
        "placeholder" => '{token}',
        'type' => 'NUMERIC',
    ], null, 'generic');

```

### Verify Token

Uses [Verify Token](http://developer.termii.com/verify-token/).

```php
<?php

    // This file is generated by Composer
    require_once __DIR__ . '/vendor/autoload.php';

    use ManeOlawale\Termii\Client;

    $client = new Client('{api_key}');

    return $client->token->verify('a2d671d7-e4fd-41d5-9b13-30c192309306', '123456');

```
**For men and women of few words**
```php
<?php

    // This file is generated by Composer
    require_once __DIR__ . '/vendor/autoload.php';

    use ManeOlawale\Termii\Client;

    $client = new Client('{api_key}');

    // Returns True if token is verified else returns false
    return $client->token->verified('a2d671d7-e4fd-41d5-9b13-30c192309306', '123456');

    // Returns True if token fails to verify else returns false
    return $client->token->failed('a2d671d7-e4fd-41d5-9b13-30c192309306', '123456');

    // Returns True if token exists but has expired else returns false
    return $client->token->expired('a2d671d7-e4fd-41d5-9b13-30c192309306', '123456');

```


### Send In App Token

Uses [Send In App Token](http://developer.termii.com/in-app-token/).

```php
<?php

    // This file is generated by Composer
    require_once __DIR__ . '/vendor/autoload.php';

    use ManeOlawale\Termii\Client;

    $client = new Client('{api_key}');

    return $client->token->sendInAppToken('2347041945964', [
        "attempts" => 10,
        "time_to_live" => 30,
        "length" => 6,
    ]);

```


## Account insights

### Balance

Uses [Balance](http://developer.termii.com/balance/).

```php
<?php

    // This file is generated by Composer
    require_once __DIR__ . '/vendor/autoload.php';

    use ManeOlawale\Termii\Client;

    $client = new Client('{api_key}');

    return $client->insights->balance();

```


### Inbox

Uses [Inbox](http://developer.termii.com/history/).

```php
<?php

    // This file is generated by Composer
    require_once __DIR__ . '/vendor/autoload.php';

    use ManeOlawale\Termii\Client;

    $client = new Client('{api_key}');

    return $client->insights->inbox();

    /**
     * Get only the data of a specific message by passing its message_id
    */
    return $client->insights->inbox('43224343447041945964');

```

### Search

Uses [Search](http://developer.termii.com/search/).

```php
<?php

    // This file is generated by Composer
    require_once __DIR__ . '/vendor/autoload.php';

    use ManeOlawale\Termii\Client;

    $client = new Client('{api_key}');

    return $client->insights->search('2347041945964');

```
> The search Api is used majorly for checking if a number is DND active, so there are two helper functions to ease the check

```php
<?php

    // This file is generated by Composer
    require_once __DIR__ . '/vendor/autoload.php';

    use ManeOlawale\Termii\Client;

    $client = new Client('{api_key}');

    return $client->insights->isDnd('2347041945964');

    // OR

    return $client->insights->isNotDnd('2347041945964');

```


### Status

Uses [Status](http://developer.termii.com/status/).

```php
<?php

    // This file is generated by Composer
    require_once __DIR__ . '/vendor/autoload.php';

    use ManeOlawale\Termii\Client;

    $client = new Client('{api_key}');

    return $client->insights->number('2347041945964');

```