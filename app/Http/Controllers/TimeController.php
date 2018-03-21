<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timelog;
use Carbon\Carbon; 
use DB;

class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timelogs = Timelog::all();
        return view( 'timelogs.index', compact('timelogs') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('timelogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $timelog = new Timelog;
        $timelog->description = $request->input('description');
        $timelog->day = $request->input('day');
        $timelog->hours = $request->input('hours');
        $timelog->user = $request->user()->id;
        $timelog->save();


       return redirect()->route('timelogs.index')->with('Tid sparad!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $timelog = Timelog::find($id);
        return view('timelogs.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $timelog = Timelog::find($id);
        return view('timelogs.edit', compact($timelog));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $timelog = Timelog::find($id);
        $timelog->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $timelog = Timelog::find($id);
        $timelog->delete();
    }

    public function reports()
    {
        $totalHours = Timelog::all()->sum('hours');

        $hoursPerYear = DB::table('timelogs')
        ->select(DB::raw('YEAR(day) as year'), DB::raw('sum(hours) as total'))
        ->groupBy(DB::raw('YEAR(day)') )
        ->orderBy('year', 'desc')
        ->get();

        //$hoursPerYear= $hoursPerYear->year->format('d-m-Y');


        $hoursPerMonth = DB::table('timelogs')
        ->select(DB::raw("DATE_FORMAT(day, '%M %Y') as month"), DB::raw('sum(hours) as total'))
        ->groupBy(DB::raw( "DATE_FORMAT(day, '%M %Y')" ))
        ->orderBy('month', 'desc')
        ->get();

        $hoursPerDay = DB::table('timelogs')
        ->select(DB::raw("DATE_FORMAT(day, '%M %Y %D') as day"), DB::raw('sum(hours) as total'))
        ->groupBy(DB::raw( "DATE_FORMAT(day, '%M %Y %D')" ))
        ->orderBy('day', 'desc')
        ->get();

        return view('timelogs.reports', compact('totalHours', 'hoursPerDay', 'hoursPerMonth', 'hoursPerYear'));
    }
}
