<?php

namespace Janyk\LaravelMoneybirdSync\Commands;

use Illuminate\Console\Command;
use Janyk\LaravelMoneybirdSync\Exceptions\MoneybirdSyncException;
use Janyk\LaravelMoneybirdSync\Traits\IsMoneybirdContact;

class PushContactCommand extends Command
{
    public $signature = 'moneybird:push {--id= : The ID of the contact model}';

    public $description = 'Push a model or all models as contacts to Moneybird';

    public function handle(): int
    {
        $model = config('moneybird-sync.model');

        if (! class_exists($model) || ! in_array(IsMoneybirdContact::class, class_uses_recursive($model))) {
            $this->error("The model {$model} either does not exist or does not have the IsMoneybirdContact trait applied.");

            return self::FAILURE;
        }

        if (! $this->option('id') && ! $this->confirm("Are you sure you want to push all models ({$model}) to Moneybird?", false)) {
            return self::FAILURE;
        }

        $contacts = $this->option('id') ?
            collect($model::find($this->option('id'))) :
            $model::all();

        $contacts->each(function ($contact): void {
            $this->line("Pushing customer {$contact->id} to Moneybird");

            try {
                $contact->createOrUpdateMoneybirdContact();
            } catch (MoneybirdSyncException $exception) {
                $this->error("Pushing {$contact->id} failed: {$exception->getMessage()}");
            }
        });

        return self::SUCCESS;
    }
}
