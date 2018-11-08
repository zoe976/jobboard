<?php

namespace App\Http\Controllers;

use App\Email;
use App\Job_post;
use Mail;

use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\URL;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;

use Validator;

class AddJobsController extends Controller
{
    public function index()
    {
    	return(view('addjob'));
    }

    public function addJob(Request $request)
    {
    	Log::info($request);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'description' => 'required|string',
        ]);
		
		$cleaned_name = strip_tags($request->input('name'));
        
        if ($validator->fails())
        {
            $status = 'Job post is not valid';
        }else
        {

	    	$email = Email::where('email', $request->email)->first();

	    	Log::info($email);

	    	if(empty($email))
	    	{
	    		$email = Email::create([
	                'email' => $request->email,
	                'uuid' => Uuid::generate()->string,
	                'status' => 'W',
	            ]);

	            $job = Job_post::create([
	                'title' => $request->title,
	                'description' => $request->description,
	                'email_id' => $email->id,
	            ]);
	  			$data = array( 'email' => $email->email, 'title' => $job->title, 'content' => 'Submission is in moderation. Waiting for approval.');
	  			$data_moderator = array( 'email' => 'moderator@gmail.com', 'title' => $job->title, 'content' => $job->description, 'approve_text'=>'Approve', 'spam_text'=>'Mark as spam', 'approve_link'=>URL::to('/').'/moderator?status=OK&uuid='.$email->uuid, 'spam_link'=>URL::to('/').'/moderator?status=Spam&uuid='.$email->uuid);

	  			Mail::send('moderator_mail', $data_moderator, function($message) use ($data_moderator) {
			        $message->to($data_moderator['email'])->subject('Job post' );
			        $message->from('noreplay@jobboard.com','jobboard');
			    });

			    Mail::send('mail', $data, function($message) use ($data) {
			        $message->to($data['email'])->subject('Job post' );
			        $message->from('noreplay@jobboard.com','jobboard');
			    });
			    $status = 'You have successfully submitted an job! After approval, the job will be published.';

			    
		  	}else if ( $email->status == "A")
		  	{

		  		$job = Job_post::create([
	                'title' => $request->title,
	                'description' => $request->description,
	                'email_id' => $email->id,
	            ]);

		  		$status = 'You successfully added a job!';
		  		
		  	}else if ($email->status == "W") {
		  		$status = 'To post a new job, you have to wait for the approval of the email!';
		  	}else
		  	{
		  		$status = 'This email is marked as spam!';
		  	}
	  }

    	return redirect('/')->with('status', $status);;
    }

    public function moderateJob(Request $request)
    {
    	if(isset($request->uuid) && isset($request->status))
    	{
    		$email = Email::where('uuid', $request->uuid)->first();
  
			if($request->status == 'OK')
			{
				$email->status = 'A';

			}else
			{
				$email->status = 'S';
			}
			$email->save();
    	}
    	return redirect('/jobs');
    }
}
