<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AutomationSource;
use App\Queries\Activity\GetAutomationActivity;
use Hashids\Hashids;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Automation extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['user_id', 'hash', 'name', 'frequency', 'time_at', 'type'];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($record) {
            $hashids = new Hashids(env('AUTOMATION_HASH_KEY', 1), 8);
            $hash = $hashids->encode($record->id);
            activity()->withoutLogs(function () use ($record, $hash) {
                DB::transaction(callback: static fn () => $record->update(
                    [
                        'hash' => $hash,
                    ]
                ), attempts: 2,);
            });
        });
    }

    public function sources()
    {
        return $this->hasMany(AutomationSource::class, 'automation_id', 'id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'frequency', 'time_at', 'type', 'hash'])->dontSubmitEmptyLogs();
        // Chain fluent methods for configuration options
    }

    public function activity()
    {
        $handler = new GetAutomationActivity();
        return $handler->handle($this)->orderBy('updated_at', 'desc')->limit(100)->get();
    }
}
