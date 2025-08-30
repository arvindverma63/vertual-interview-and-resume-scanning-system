<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\InterviewInvitation;
use Illuminate\Support\Facades\Mail;

class InterviewController extends Controller
{
    /**
     * Send interview invitation email.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendInvitation(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'candidate_name' => 'required|string',
            'job_title' => 'required|string',
            'interview_date' => 'required|date',
            'interview_time' => 'required|string',
            'interview_location' => 'required|string',
            'candidate_email' => 'required|email',
        ]);

        // Send the interview invitation email
        Mail::to($request->candidate_email)->send(new InterviewInvitation(
            $request->candidate_name,
            $request->job_title,
            $request->interview_date,
            $request->interview_time,
            $request->interview_location
        ));

        return response()->json([
            'message' => 'Interview invitation sent successfully to ' . $request->candidate_email
        ]);
    }
}
