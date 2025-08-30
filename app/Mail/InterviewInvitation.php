<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InterviewInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $candidateName;
    public $jobTitle;
    public $interviewDate;
    public $interviewTime;
    public $interviewLocation;

    /**
     * Create a new message instance.
     *
     * @param string $candidateName
     * @param string $jobTitle
     * @param string $interviewDate
     * @param string $interviewTime
     * @param string $interviewLocation
     */
    public function __construct($candidateName, $jobTitle, $interviewDate, $interviewTime, $interviewLocation)
    {
        $this->candidateName = $candidateName;
        $this->jobTitle = $jobTitle;
        $this->interviewDate = $interviewDate;
        $this->interviewTime = $interviewTime;
        $this->interviewLocation = $interviewLocation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Interview Invitation for $this->jobTitle")
                    ->view('emails.interview_invitation');
    }
}
