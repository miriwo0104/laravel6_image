<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// 下記を追記
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
	// 下記を追記
	use SoftDeletes;
}
