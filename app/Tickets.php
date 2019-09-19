<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
	public const STATUS_TODO = 1;
	public const STATUS_COMPLETE = 2;

}
