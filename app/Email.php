<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
	protected $fillable = [
        'email','uuid', 'status',
    ];


	public function job_posts()
	{
	    return $this->hasMany('App\Job_post');
	}
}
