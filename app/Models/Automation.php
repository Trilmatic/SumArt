<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AutomationSource;
use Hashids\Hashids;

class Automation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'hash', 'name', 'frequency', 'type'];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($record) {
            $hashids = new Hashids(env('AUTOMATION_HASH_KEY', 1), 8);
            $record->hash = $hashids->encode($record->id);
            $record->save();
        });
    }

    public function sources()
    {
        return $this->hasMany(AutomationSource::class, 'automation_id', 'id');
    }
}
