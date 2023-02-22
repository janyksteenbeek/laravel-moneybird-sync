<?php

return [
    /**
     * The model that should be synced with Moneybird.
     * This model should use the IsMoneybirdCustomer trait.
     *
     * @phpstan-ignore-next-line
     */
    'model' => \App\Models\User::class,

    /**
     * The mapping of the Moneybird fields on your model.
     * 'moneybird_field' => 'model_field'
     *
     * @see https://developer.moneybird.com/api/contacts/#post_contacts
     */
    'fields' => [
        'moneybird_id' => env('MONEYBIRD_FIELD:moneybird_id', 'moneybird_id'),
        'customer_id' => env('MONEYBIRD_FIELD:customer_id', 'id'),
        'company_name' => env('MONEYBIRD_FIELD:company_name', 'company_name'),
        'firstname' => env('MONEYBIRD_FIELD:firstname', 'first_name'),
        'lastname' => env('MONEYBIRD_FIELD:lastname', 'last_name'),
        'address1' => env('MONEYBIRD_FIELD:address1', 'address'),
        'zipcode' => env('MONEYBIRD_FIELD:zipcode', 'zipcode'),
        'city' => env('MONEYBIRD_FIELD:city', 'city'),
        'country' => env('MONEYBIRD_FIELD:country', 'country_code'),
        'tax_number' => env('MONEYBIRD_FIELD:tax_number', 'tax_number'),
        'chamber_of_commerce' => env('MONEYBIRD_FIELD:chamber_of_commerce', 'chamber_of_commerce'),
        'send_invoices_to_email' => env('MONEYBIRD_FIELD:send_invoices_to_email', 'email'),
        'send_estimates_to_email' => env('MONEYBIRD_FIELD:send_estimates_to_email', 'email'),
    ],

    /**
     * The Moneybird administration id.
     */
    'administration_id' => env('MONEYBIRD_ADMINISTRATION_ID'),

    /**
     * The Moneybird client id.
     */
    'client_id' => env('MONEYBIRD_CLIENT_ID'),

    /**
     * The Moneybird client secret.
     */
    'client_secret' => env('MONEYBIRD_CLIENT_SECRET'),

    /**
     * The Moneybird personal developer token.
     *
     * @see https://moneybird.com/user/applications
     */
    'token' => env('MONEYBIRD_TOKEN'),

    /**
     * The prefix for the customer id.
     * This is used to prevent conflicts with other customers.
     */
    'customer_id_prefix' => env('MONEYBIRD_CUSTOMER_ID_PREFIX'),
];
