<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class ActivityLogger
{
    protected $logName;
    protected $description;
    protected $subject;
    protected $causer;
    protected $properties = [];
    protected $status = 'success';

    /**
     * Set log name/category.
     */
    public function log(string $logName): self
    {
        $this->logName = $logName;
        return $this;
    }

    /**
     * Set description.
     */
    public function withDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Set subject model.
     */
    public function performedOn(Model $model): self
    {
        $this->subject = $model;
        return $this;
    }

    /**
     * Set causer model.
     */
    public function causedBy(Model $causer): self
    {
        $this->causer = $causer;
        return $this;
    }

    /**
     * Set properties.
     */
    public function withProperties(array $properties): self
    {
        $this->properties = array_merge($this->properties, $properties);
        return $this;
    }

    /**
     * Set status.
     */
    public function withStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Save the activity log.
     */
    public function save(): ActivityLog
    {
        $causer = $this->causer ?: Auth::user();

        return ActivityLog::create([
            'log_name' => $this->logName,
            'description' => $this->description,
            'subject_type' => $this->subject ? get_class($this->subject) : null,
            'subject_id' => $this->subject ? $this->subject->getKey() : null,
            'causer_type' => $causer ? get_class($causer) : null,
            'causer_id' => $causer ? $causer->getKey() : null,
            'properties' => $this->properties,
            'batch_uuid' => Str::uuid(),
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
            'url' => Request::fullUrl(),
            'method' => Request::method(),
            'status' => $this->status,
        ]);
    }

    /**
     * Quick method to log authentication activities.
     */
    public static function logAuth(string $description, User $user = null, string $status = 'success'): ActivityLog
    {
        $causer = $user ?: Auth::user();
        $logger = (new self())
            ->log('auth')
            ->withDescription($description)
            ->withStatus($status);
            
        if ($causer instanceof Model) {
            $logger->causedBy($causer);
        }
        
        return $logger->save();
    }

    /**
     * Quick method to log CRUD activities.
     */
    public static function logCrud(string $action, Model $model, array $properties = []): ActivityLog
    {
        $modelName = class_basename($model);
        $logName = strtolower($modelName);
        
        $descriptions = [
            'created' => "Membuat {$modelName} baru",
            'updated' => "Mengupdate {$modelName}",
            'deleted' => "Menghapus {$modelName}",
            'restored' => "Mengembalikan {$modelName}",
            'viewed' => "Melihat {$modelName}",
        ];

        $description = $descriptions[$action] ?? "Melakukan {$action} pada {$modelName}";

        if (isset($model->name)) {
            $description .= ": {$model->name}";
        } elseif (isset($model->title)) {
            $description .= ": {$model->title}";
        } elseif (isset($model->judul)) {
            $description .= ": {$model->judul}";
        }

        $logger = (new self())
            ->log($logName)
            ->withDescription($description)
            ->performedOn($model)
            ->withProperties($properties);
            
        $user = Auth::user();
        if ($user instanceof Model) {
            $logger->causedBy($user);
        }
        
        return $logger->save();
    }

    /**
     * Quick method to log system activities.
     */
    public static function logSystem(string $description, array $properties = []): ActivityLog
    {
        return (new self())
            ->log('system')
            ->withDescription($description)
            ->withProperties($properties)
            ->save();
    }

    /**
     * Quick method to log failed activities.
     */
    public static function logError(string $description, array $properties = []): ActivityLog
    {
        return (new self())
            ->log('error')
            ->withDescription($description)
            ->withProperties($properties)
            ->withStatus('failed')
            ->save();
    }
}
