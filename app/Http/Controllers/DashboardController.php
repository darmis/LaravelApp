<?php

namespace Ciklas\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Ciklas\Note;
use Ciklas\Repair;
use Ciklas\Service;
use Ciklas\Task;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $role = auth()->user()->role;
        $note = Note::where('user_id','=', $user_id)->first();

        $thisMonthRepairs = Repair::where([
            ['created_at', '>=', Carbon::now()->startOfMonth()],
            ['meistro_id', '=', $user_id]
        ])->get();
        $countThisMonthRepairs = count($thisMonthRepairs);

        $thisMonthServices = Service::where([
            ['created_at', '>=', Carbon::now()->startOfMonth()],
            ['meistro_id', '=', $user_id]
        ])->get();
        $countThisMonthServices = count($thisMonthServices);

        $countRepairs = count(Repair::where('busena', '=', 'uzregistruotas')->get());
        $countServices = count(Service::where('busena', '=', 'uzregistruotas')->get());
        $countNotFinishedRepairs = count(Repair::where([
            ['busena', '=', 'vykdomas'],
            ['meistro_id', '=', $user_id]
            ])->get());
        $countNotFinishedServices = count(Service::where([
            ['busena', '=', 'vykdomas'],
            ['meistro_id', '=', $user_id]
            ])->get());

        $tasks = Task::all();


        return view('dashboard')
        ->with('role', $role)
        ->with('note', $note->note)
        ->with('countThisMonthRepairs', $countThisMonthRepairs)
        ->with('countThisMonthServices', $countThisMonthServices)
        ->with('countRepairs', $countRepairs)
        ->with('countServices', $countServices)
        ->with('countNotFinishedRepairs', $countNotFinishedRepairs)
        ->with('countNotFinishedServices', $countNotFinishedServices)
        ->with('tasks', $tasks);
    }
}
