<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{

    protected $fillable = ['name', 'status'];

    /**
     * Boot method to handle cascading deletes.
     */
    protected static function boot(): void
    {
        parent::boot();
        static::deleting(static function ($project) {
            $project->timesheets()->delete();
            $project->attributes()->delete();
            $project->users()->detach();
        });
    }

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_user');
    }

    /**
     * @return HasMany
     */
    public function timesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class);
    }

    /**
     * @return HasMany
     */
    public function attributes(): HasMany
    {
        return $this->hasMany(AttributeValue::class, 'project_id');
    }
}
