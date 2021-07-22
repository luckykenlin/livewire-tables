<?php

namespace Luckykenlin\LivewireTables\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DummyModel extends Model
{
    use hasFactory;
    protected $guarded = ['id'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function dummy_has_one()
    {
        return $this->hasOne(DummyHasOneModel::class);
    }

    public function dummy_has_many()
    {
        return $this->hasMany(DummyHasManyModel::class);
    }

    public function dummy_belongs_to_many()
    {
        return $this->belongsToMany(DummyBelongsToManyModel::class);
    }
}
