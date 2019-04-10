<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DateTime;
use App\Appointment;

class MarkMissedAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mark:missed-appointments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically marks expired, pending appointments as missed.';

    private $checkUntil = '-2 weeks';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $today = new DateTime();

        $checkDate = new DateTime();
        $checkDate->modify($this->checkUntil);

        $missedAppointments = Appointment::where([
            ['Appointment_Date', '<=', $today],
            ['Appointment_Date', '>=', $checkDate],
            ['Status_ID', Appointment::$PendingStatus]
        ])->get();

        foreach($missedAppointments as $appt) {
            $appt->Status_ID = Appointment::$MissedStatus;
            $appt->save();
        }

        $this->info('Opperation complete. '.$missedAppointments->count().' appointments missed.');
    }
}
