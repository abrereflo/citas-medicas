<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkDay;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    private $days = [
        'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'
    ];
    public function index()
    {


    }
    public function edit()
    {
        $wordDays = WorkDay::where('user_id', auth()->id())->get();
        if(count($wordDays) > 0)
        {
            $wordDays->map(function($wordDay){
                $wordDay->morning_start = (new Carbon($wordDay->morning_start))->format('g:i A');
                $wordDay->morning_end = (new Carbon($wordDay->morning_end))->format('g:i A');
                $wordDay->afternoon_start = (new Carbon($wordDay->afternoon_start))->format('g:i A');
                $wordDay->afternoon_end = (new Carbon($wordDay->afternoon_end))->format('g:i A');
                return $wordDay;
            });
        }

        else
        {
            $wordDays=collect();
            for($i=0; $i<7; ++$i)
            $wordDays->push(new WorkDay());
        }
        $days = $this->days;
        return view('calendario', compact('wordDays','days'));
    }
    public function store(Request $request)
    {

        $active = $request->input('active' ?: []);
        $morning_start = $request->input('morning_start');
        $morning_end = $request->input('morning_end');
        $afternoon_start = $request->input('afternoon_start');
        $afternoon_end = $request->input('afternoon_end');

        $errors =[];

        for($i=0; $i<7; ++$i)
        {
            if($morning_start[$i] > $morning_end[$i])
            {
                $errors [] ='Las horas del turno mañana son inconsitentes para el diá ' .$this->days[$i]. '.';
            }
            if ($afternoon_start[$i] > $afternoon_end[$i])
            {
                $errors [] ='Las horas del turno tarde son inconsitentes para el diá ' . $this->days[$i] . '.';
            }

            WorkDay::updateOrCreate(
                [
                    'day' => $i,
                    'user_id' => auth()->id()
                ],
                [
                    'active' => in_array($i, $active),
                    'morning_start' => $morning_start[$i],
                    'morning_end' => $morning_end[$i],
                    'afternoon_start' => $afternoon_start[$i],
                    'afternoon_end'=> $afternoon_end[$i]
                ]
            );
        }
        if(count($errors) > 0)
        {
            return back()->with(compact('errors'));
        }

        $notification = 'Los cambios se han guardado correctamente.';
        return back()->with(compact('notification'));
    }
}
