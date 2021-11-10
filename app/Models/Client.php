<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    const PER_PAGE = 5;

    public static function rules(): array
    {
        return [
            'name'  => ['required', 'string', 'min:1', 'max:60'],
            'email' => ['required', 'string', 'min:6', 'max:60', 'unique:clients'],
            'image' => ['required', 'image', 'mimes:jpeg,jpg'],
        ];
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
