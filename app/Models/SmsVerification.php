<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @class SmsVerification
 * @property int $user_id
 * @property int $code
 * @property string $expired_at
 */
class SmsVerification extends Model {
    use HasFactory;
}
