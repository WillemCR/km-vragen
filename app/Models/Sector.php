<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sector extends Model
{
    protected $fillable = ['sbi_code', 'name']; // Pas dit aan als je andere velden hebt

    /**
     * Get all of the users for the Sector
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    public function Question(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
