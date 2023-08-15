<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int           $id
 * @property int           $user_id
 * @property DateTime      $start
 * @property DateTime|null $end
 * @property string        $ip_address
 */
class UserOnlineLog extends Model
{}
