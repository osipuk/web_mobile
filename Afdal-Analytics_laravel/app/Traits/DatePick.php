<?php

namespace App\Traits;

use Carbon\Carbon;

trait DatePick
{
    public $date_from;
    public $date_to;

    public function PickDate($date1 = null, $date2 = null,$sub_days=null){
        

        if($date1 && $date2){
            $this->date_from = $date1;
            $this->date_to = $date2;
            return;
        }
        if($sub_days){
            $this->date_to = Carbon::now()->format('Y/m/d');
            $this->date_from = Carbon::now()->subDays($sub_days)->format('Y/m/d'); 
            return;
        } 
        $this->date_to = Carbon::now()->format('Y/m/d');
        $this->date_from = Carbon::now()->subDays(90)->format('Y/m/d');
    }
}
