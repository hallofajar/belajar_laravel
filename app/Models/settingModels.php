<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class settingModels extends Model
{
	use HasFactory;

	protected $table = 'page_setting';
	protected $primaryKey = 'idpage_setting';

	public $incrementing = true;
	public $timestamps = false;

	protected $fillable = [
		'keterangan',
		'dusunNama',
		'idpage_setting',
	];

	
}
