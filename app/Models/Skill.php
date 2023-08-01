<?php

namespace App\Models;

use App\Traits\HasHierarchyTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skill extends Model
{
    use HasFactory, HasHierarchyTrait;

    protected static function GetParentColumn()
    {
        return 'parent_skill';
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_skill');
    }
}
