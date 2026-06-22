<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kafaa extends User
{
    use HasFactory;

    protected $table = 'users';

    protected static function booted(): void
    {
        static::addGlobalScope('kafaa', function ($query) {
            $query->where(function ($scope) {
                $scope->whereIn('account_type', ['kafaa', 'employee'])
                    ->orWhereIn('role', ['kafaa', 'employee']);
            });
        });
    }
}
