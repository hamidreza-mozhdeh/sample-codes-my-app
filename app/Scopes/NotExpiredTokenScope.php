<?php

namespace App\Scopes;

use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class NotExpiredTokenScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  Builder  $builder
     * @param  Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $validDate = Carbon::now()->subDays(Token::ValidDays);

        $builder->where('created_at', '>', $validDate);
    }
}
