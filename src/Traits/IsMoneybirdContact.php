<?php

namespace Janyk\LaravelMoneybirdSync\Traits;

use Illuminate\Support\Facades\Log;
use Janyk\LaravelMoneybirdSync\Exceptions\MoneybirdSyncException;
use Picqer\Financials\Moneybird\Connection;
use Picqer\Financials\Moneybird\Exceptions\ApiException;
use Picqer\Financials\Moneybird\Moneybird;

trait IsMoneybirdContact
{
    public static function bootIsMoneybirdContact(): void
    {
        // Register the event listeners
        static::created(function ($model) {
            $model->createOrUpdateMoneybirdContact();
        });

        static::updated(function ($model) {
            $model->createOrUpdateMoneybirdContact();
        });
    }

    public function createOrUpdateMoneybirdContact(): bool
    {
        $moneybird = new Moneybird($this->getMoneybirdConnection());
        $contact = $moneybird->contact();

        // Check if there is a
        if ($id = $this->getMoneybirdId()) {
            $contact = $contact->find($id);
        }

        // Loop over all fields that are available
        $fields = config('moneybird-sync.fields');

        foreach ($fields as $moneybirdKey => $modelKey) {
            if (empty($modelKey)) {
                continue;
            }

            $contact->{$moneybirdKey} = $this->{$modelKey};
        }

        // Set the customer ID including the set prefix
        $contact->customer_id = config('moneybird-sync.customer_id_prefix') . $this->{$fields['customer_id']};

        // Try saving the contact
        try {
            $response = $contact->save();

            $this->setMoneybirdId($response->id);
        } catch (ApiException $exception) {
            throw new MoneybirdSyncException($exception->getMessage());
        }

        return true;
    }

    private function getMoneybirdConnection(): Connection
    {
        return app(\Picqer\Financials\Moneybird\Connection::class);
    }

    private function getMoneybirdId(): ?string
    {
        return $this->{config('moneybird-sync.fields.moneybird_id')};
    }

    private function setMoneybirdId(string $id): bool
    {
        $this->{config('moneybird-sync.fields.moneybird_id')} = $id;

        return $this->saveQuietly();
    }

    private abstract function saveQuietly(array $options = []);
}
