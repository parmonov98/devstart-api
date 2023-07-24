<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Collection;
use Illuminate\Notifications\Notifiable;
use App\Сonstants\User\UserTypeConstants;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @class User
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string $phone
 * @property string|null $email_verified_at
 * @property string|null $phone_verified_at
 * @property string $password
 * @property string $user_type
 * @property bool|null $is_admin
 * @property Collection|Skill[] $skills
 * @property SmsVerification $sms
 * @method static Builder developer()
 * @method static Builder ideaHolder()
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'phone', 'password', 'user_type', 'is_admin', 'active'];

    /**
     * @return HasOne
     */
    public function sms(): HasOne
    {
        return $this->hasOne(SmsVerification::class);
    }

    /**
     * @return BelongsToMany
     */
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'developer_skills_pivot');
    }

    /**
     * Scope a query to only include
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDeveloper($query): Builder
    {
        return $query->where('user_type', '=', UserTypeConstants::USER_TYPE_DEVELOPER);
    }

    /**
     * Scope a query to only include
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIdeaHolder($query): Builder
    {
        return $query->where('user_type', '=', UserTypeConstants::USER_TYPE_IDEA_HOLDER);
    }
}
