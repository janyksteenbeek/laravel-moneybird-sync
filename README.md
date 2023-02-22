# laravel-moneybird-sync
**One-way synchronization of contact fields in your Laravel application towards the Moneybird accounting software.**

[![Latest Version on Packagist](https://img.shields.io/packagist/v/janyksteenbeek/laravel-moneybird-sync.svg?style=flat-square)](https://packagist.org/packages/janyksteenbeek/laravel-moneybird-sync)
[![Total Downloads](https://img.shields.io/packagist/dt/janyksteenbeek/laravel-moneybird-sync.svg?style=flat-square)](https://packagist.org/packages/janyksteenbeek/laravel-moneybird-sync)
[![PHPStan](https://github.com/janyksteenbeek/laravel-moneybird-sync/actions/workflows/phpstan.yml/badge.svg)](https://github.com/janyksteenbeek/laravel-moneybird-sync/actions/workflows/phpstan.yml)

## Installation

You can install the package via composer:

```bash
composer require janyksteenbeek/laravel-moneybird-sync
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="moneybird-sync-config"
```

Set all the required values in the config file or in your environment variables. See section "Setup" for more information.

Next, add the trait to your User model:

```php
use Janyk\LaravelMoneybirdSync\Traits\IsMoneybirdContact;

class User extends Authenticatable
{
    use IsMoneybirdContact;
}
```


## Setup instructions

1. Follow the installation instructions to include the package in your application.
2. Before you can use this package, you need to register your application with Moneybird. Registration is a one-time event for the developer and can be done [here](https://moneybird.com/user/applications/new). Make sure you register an application for personal use.
3. After registering your application, you will receive an access token. This token is used to authenticate your application with Moneybird. Set this token in your environment variables as `MONEYBIRD_TOKEN`.
4. Navigate back to your application page and copy the `Client ID` and `Client secret` to your environment variables as `MONEYBIRD_CLIENT_ID` and `MONEYBIRD_CLIENT_SECRET`. 
5. `MONEYBIRD_ADMINISTRATION_ID` is the ID of the administration you want to sync with. You can find this ID in the URL of your Moneybird administration. For example, if the URL of your administration is `https://moneybird.com/123456789/sales_invoices`, the ID is `123456789`. Be sure to set this ID in your environment variables.
6. Make sure you have a `User` model in your application. This model should have a `moneybird_id` column. This column will be used to store the Moneybird ID of the contact.
7. Make sure the other fields you want to sync with Moneybird are present on your `User` model. You can change these mapping of those fields in the config file.
8. Add the `IsMoneybirdContact` trait to your `User` model.


## Security Vulnerabilities

If you are an outside collaborator and discover a security vulnerability within this repository, please send an e-mail to our security team via [security-external@webmethod.nl](mailto:security-external@webmethod.nl). **Do not use GitHub Issues** to report security vulnerabilities. All security vulnerabilities will be promptly addressed. Please adhere to the [Webmethod Coordinated Vulnerability Disclosure guidelines](https://www.webmethod.nl/juridisch/responsible-disclosure) at all times.


## Credits

- [Janyk Steenbeek](https://github.com/janyksteenbeek)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Disclaimer

This package is not affiliated with or endorsed by Moneybird B.V. or any of its affiliates. The use of the trademark Moneybird is solely for the purpose of identifying the company and its products. Moneybird is a registered trademark of Moneybird B.V. and all rights pertaining to the trademark are the exclusive property of the trademark owner. Any references to Moneybird are made strictly for identification purposes and do not imply any endorsement or sponsorship by Moneybird B.V.



