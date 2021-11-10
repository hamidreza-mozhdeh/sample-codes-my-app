<?php

namespace App\Models;

use App\Scopes\ActiveAdminScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\Rules\Password;

class Admin extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    const PER_PAGE = 5;

    const STATUS_INACTIVE   = 0;
    const STATUS_ACTIVE     = 1;

    protected $appends = [
        'full_name'
    ];

    public static function rules(): array
    {
        return [
            'first_name'    => ['required', 'string', 'min:2', 'max:60'],
            'surname'       => ['required', 'string', 'min:2', 'max:60'],
            'email'         => ['required', 'email', 'confirmed', 'min:6', 'max:60', 'unique:admins'],
            'password'      => ['required', 'string', 'confirmed', Password::min(6)],
            'status'        => [
                'integer',
                'in:' . implode(',', [Admin::STATUS_INACTIVE, Admin::STATUS_ACTIVE])
            ],
        ];
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->surname}";
    }

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }
}
