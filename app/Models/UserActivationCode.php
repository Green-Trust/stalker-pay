<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $user_id
 * @property string   $code
 * @property DateTime $created_at
 */
class UserActivationCode extends Model
{}
