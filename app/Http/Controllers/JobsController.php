<?php

namespace App\Http\Controllers;
use App\Email;
use App\Job_post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function index()
    {
    	$jobs = DB::table('job_posts')
            ->join('emails', 'emails.id', '=', 'job_posts.email_id')
            ->where('emails.status', 'A')
            ->orderBy('job_posts.id', 'desc')
            ->get();
    	Log::info($jobs);
    	return(view('jobs',['jobs'=>$jobs]));
    }
}
