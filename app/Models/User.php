<?php

namespace App\Models;

use DateTime;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int      $id
 * @property string   $name
 * @property string   $email
 * @property string   $password
 * @property string   $avatar
 * @property int      $uuid
 * @property string   $status
 * @property DateTime $created_at
 */
class User extends Authenticatable
{}
