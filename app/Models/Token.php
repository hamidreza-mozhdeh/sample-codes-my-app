<?php

namespace App\Models;

use App\Scopes\NotExpiredTokenScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Token extends Model
{
    use HasFactory;

    const ValidDays = 30;

    protected static function booted()
    {
        static::addGlobalScope(new NotExpiredTokenScope());
    }

    /**
     * @return BelongsTo
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
