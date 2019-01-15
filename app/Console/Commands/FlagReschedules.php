<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DateTime;
use App\Appointment;
use App\Flag;

class FlagReschedules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flag:reschedules';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks the reschedule count for all clients since a specified date. Flags all clients who reschedule a high number of appointments.';

    private $flagThreshold = 2;
    private $checkUntil = '-3 months';
    private $flagExpires = '+3 months';

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
        $checkDate = new DateTime();
        $checkDate->modify($this->checkUntil);

        $expDate = new DateTime();
        $expDate->modify($this->flagExpires);

        $results = Appointment::select('Client_ID', \DB::raw('count(Appointment_ID)'))
            ->where([
            ['Appointment_Date', '>=', $checkDate],
            ['Status_ID', Appointment::$RescheduledStatus]])
            ->groupBy('Client_ID')
            ->having(\DB::raw('count(Appointment_ID)'), '>=', $this->flagThreshold)
            ->get();

        foreach($results as $result) {
            $flag = Flag::firstOrNew(['Client_ID' => $result->Client_ID, 'Flag_DES' => Flag::$RescheduleDesc]);
            $flag->Flag_EXP = $expDate;
            $flag->save();
        }

        $this->info('Operation complete. '.$results->count().' clients flagged.');
    }
}
