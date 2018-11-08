<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job_post extends Model
{
     protected $fillable = [
        'title', 'description', 'email_id'
        ];


    public function email()
	{
	    return $this->belongsTo('App\Email');
	}
}
