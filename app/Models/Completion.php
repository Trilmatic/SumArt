<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Hashids\Hashids;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Completion extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['user_id', 'hash', 'prompt', 'result', 'prompt_tokens', 'completion_tokens', 'error', 'finish_reason', 'automation_id'];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($record) {
            $hashids = new Hashids(env('COMPLETION_HASH_KEY', 1), 8);
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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['hash', 'prompt', 'result', 'error', 'automation_id'])->dontSubmitEmptyLogs();
    }
}
