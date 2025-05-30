<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReportCitizens extends Mailable
{

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     **/
    public $reportData;

    public function __construct($reportData){
        $this->reportData = $reportData;
    }

    public function build() {
        return $this
            ->subject(__('Report'))
            ->markdown('emails.report')
            -> with([
                'reportData' => $this->reportData
            ]);
    }
}
