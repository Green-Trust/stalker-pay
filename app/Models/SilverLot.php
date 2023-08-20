<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int         $id
 * @property int         $amount
 * @property int         $minimum
 * @property string|null $description
 * @property string      $type
 * @property int         $creator_id
 * @property int         $location_id
 * @property int         $server_id
 * @property string      $status
 */
class SilverLot extends Model
{}
