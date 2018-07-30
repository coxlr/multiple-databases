<?php

namespace App;

use App\Traits\MySQL2ConnectionTrait;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
	use MySQL2ConnectionTrait;
}
