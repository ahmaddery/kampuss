<?php

namespace App\Traits;

use App\Services\ActivityLogger;
use Illuminate\Database\Eloquent\Model;

trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        static::created(function (Model $model) {
            if (self::shouldLogActivity($model, 'created')) {
                ActivityLogger::logCrud('created', $model, [
                    'attributes' => $model->getAttributes()
                ]);
            }
        });

        static::updated(function (Model $model) {
            if (self::shouldLogActivity($model, 'updated')) {
                $changes = $model->getChanges();
                if (!empty($changes)) {
                    ActivityLogger::logCrud('updated', $model, [
                        'old' => $model->getOriginal(),
                        'attributes' => $model->getAttributes(),
                        'changes' => $changes
                    ]);
                }
            }
        });

        static::deleted(function (Model $model) {
            if (self::shouldLogActivity($model, 'deleted')) {
                ActivityLogger::logCrud('deleted', $model, [
                    'attributes' => $model->getAttributes()
                ]);
            }
        });
    }

    /**
     * Determine if activity should be logged for this model and event.
     */
    protected static function shouldLogActivity(Model $model, string $event): bool
    {
        // Skip logging for ActivityLog model itself to prevent infinite loop
        if ($model instanceof \App\Models\ActivityLog) {
            return false;
        }

        // Check if model has specific events to log
        if (property_exists($model, 'logOnlyEvents')) {
            return in_array($event, $model->logOnlyEvents);
        }

        // Check if model has events to skip
        if (property_exists($model, 'skipLogEvents')) {
            return !in_array($event, $model->skipLogEvents);
        }

        // Log all events by default
        return true;
    }

    /**
     * Get the description for the log entry.
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        $modelName = class_basename($this);
        
        $descriptions = [
            'created' => "Membuat {$modelName} baru",
            'updated' => "Mengupdate {$modelName}",
            'deleted' => "Menghapus {$modelName}",
        ];

        $description = $descriptions[$eventName] ?? "Melakukan {$eventName} pada {$modelName}";

        // Add title/name if exists
        if (isset($this->title)) {
            $description .= ": {$this->title}";
        } elseif (isset($this->name)) {
            $description .= ": {$this->name}";
        } elseif (isset($this->judul)) {
            $description .= ": {$this->judul}";
        }

        return $description;
    }
}
