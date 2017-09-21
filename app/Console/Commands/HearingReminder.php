<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Http\Controllers\HearingsController;
use App\Mail\Reminder;
use Mail;
use Log;

class HearingReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Reminder for the next day\'s hearing';

    protected $hearing;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(HearingsController $hearing)
    {
        parent::__construct();
        $this->hearing = $hearing;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /*
        $hearing = new HearingsController();
        $data = $hearing->getTomorrowsHearingsList();
        $user = \App\Models\User::find(1);
        Log::info('This is some useful information.'.$user->email);
        Mail::to(\App\Models\User::find(1))->send(new Reminder());
        Log::info('This is some useful information.1111');
        */
        //Mail::to('ramvinoth37@gmail.com')->send(new Reminder);
        $this->hearing->sendmail();
        $this->hearing->send('ramvinoth37@gmail.com');
    }
}
