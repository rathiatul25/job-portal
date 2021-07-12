<?php

namespace App\Http\Controllers;

use App\Job;
use App\JobContact;
use App\JobMessage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $columns = [
                'name',
                'title',
                'user_id',
                'jobs.id as job_id'
            ];
            $data['jobs'] = User::join('jobs', 'jobs.user_id', '=', 'users.id')
                                ->orderBy('jobs.created_at', 'desc')
                                ->get($columns);
            return view('job.index', $data);
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('job.add');
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $job = new Job();
            $job->user_id = Auth::user()->id;
            $job->title = $request->title;
            $job->description = $request->description;
            if($job->save()) {
                Session::flash('message', 'Job added successfully');
                return redirect()->to('job');
            }
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Show the job contact form
     * @param $jobId
     * @param $userId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function jobContactMessage($jobId, $userId)
    {
        try {
            $jobId = base64_decode($jobId);
            $userId = base64_decode($userId);

            $data['job'] = Job::where('id', $jobId)->first(['id', 'title']);
            $data['user_id'] = $userId;
            $fromUserId = Auth::user()->id;
            $data['messages'] = DB::select(DB::raw("SELECT name,message,job_messages.created_at as msg_time from job_messages JOIN users ON users.id = job_messages.from_user WHERE job_id = $jobId AND (from_user = $fromUserId AND to_user = $userId OR from_user = $userId AND to_user = $fromUserId) ORDER BY job_messages.id"));

            return view('job.job-contact', $data);
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Save the user messages
     * @param Request $request
     * @param $jobId
     * @param $toUserId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveJobContactMessage(Request $request, $jobId, $toUserId)
    {
        try {
            $fromUserId = Auth::user()->id;
            $title = $request->message;
            $jobCount = JobContact::where('user_id', $fromUserId)
                                    ->where('job_id', $jobId)
                                    ->count();
            if($jobCount == 0) {
                $jobContact = new JobContact();
                $jobContact->user_id = $fromUserId;
                $jobContact->job_id = $jobId;
                $jobContact->save();
            }
            $jobMessage = new JobMessage();
            $jobMessage->from_user = $fromUserId;
            $jobMessage->to_user = $toUserId;
            $jobMessage->job_id = $jobId;
            $jobMessage->message = $title;

            if($jobMessage->save()) {
                return redirect()->to("job-contact/".base64_encode($jobId)."/".base64_encode($toUserId))->with('success', 'Message sent');
            }


        } catch (Exception $exception) {
            echo $exception->getMessage();
        }

    }

    /**
     * Get all users who contact for the job
     * @param $jobId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userJobList($jobId)
    {
        try {
            $jobId = base64_decode($jobId);
            $columns = ['users.id as user_id', 'name', 'job_id'];
            $data['job'] = Job::where('id', $jobId)
                                ->where(['user_id' => Auth::user()->id])
                                ->first(['title']);
            if($data['job']) {
                $data['jobs'] = JobContact::join('users', 'users.id', '=', 'job_contacts.user_id')
                                            ->where('job_id', $jobId)
                                            ->where('users.id', '!=', Auth::user()->id)
                                            ->get($columns);
                return view('job.user-inbox', $data);
            }

        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
}
