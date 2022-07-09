<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\ScheduleServiceInterface;
use App\Models\WorkDay;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function hours(Request $request, ScheduleServiceInterface $scheduleService)
    {
        /* dd($request); */
        $rule = [
            'date' => 'required|date_format:"Y-m-d"',
            'doctor_id' => 'required|exists:users,id'
        ];

        $this->validate($request, $rule);

        $date = $request->input('date');
        $doctorId = $request->input('doctor_id');

        return $scheduleService->getAvailableIntervals($date,$doctorId);


    }

    public function getIntervals($start, $end)
    {

        $start= new Carbon($start);
        $end = new Carbon($end);

        $intervals = [];
        while($start < $end)
        {
            $interval = [];
            $interval['start'] = $start->format('g:i A');
            $start->addMinutes(30);
            $interval['end'] = $start->format('g:i A');
            $intervals[] = $interval;
        }
        return $intervals;
    }
}
