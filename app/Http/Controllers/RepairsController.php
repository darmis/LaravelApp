<?php

namespace Ciklas\Http\Controllers;

use Illuminate\Http\Request;
use Ciklas\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Ciklas\Repair;
use Ciklas\User;

class RepairsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $role = auth()->user()->role;

        $repairs = Repair::paginate(10);

        $users = User::all();

        $userOptions = array('0' => 'Nepaskirtas')
            +DB::table('users')->select(DB::raw('concat (name," ",lastname) as fullname, id'))
            ->pluck('fullname', 'id')->toArray();

        
        return view('repairs.all')
            ->with('repairs', $repairs)
            ->with('users', $users)
            ->with('userOptions', $userOptions)
            ->with('role', $role)
            ->with('name','Visi gedimai');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'klientas' => 'required',
            'spec_komp' => 'required',
            'gedimai' => 'required'
        ]);

        //create repair
        Repair::create($request->all());

        //finds last insterted 
        $inserted = Repair::orderby('created_at', 'desc')->first();

        $user_id = auth()->user()->id;
        $inserted->registrator_id = $user_id;
        $inserted->save();

        return redirect()->back()->with('success', 'Įrašas išsaugotas');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $user_id = auth()->user()->id;
        $role = auth()->user()->role;

        $repair = Repair::find($id);

        $users = User::all();

        $userOptions = array('0' => 'Nepaskirtas')
            +DB::table('users')->select(DB::raw('concat (name," ",lastname) as fullname, id'))
            ->pluck('fullname', 'id')->toArray();

        
        return view('repairs.show')
            ->with('repair', $repair)
            ->with('users', $users)
            ->with('userOptions', $userOptions)
            ->with('role', $role);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = auth()->user()->role;

        $repair = Repair::find($id);

        $users = User::all();

        $userOptions = array('0' => 'Nepaskirtas')
            +DB::table('users')->select(DB::raw('concat (name," ",lastname) as fullname, id'))
            ->pluck('fullname', 'id')->toArray();

        
        return view('repairs.edit')
            ->with('repair', $repair)
            ->with('users', $users)
            ->with('userOptions', $userOptions)
            ->with('role', $role);
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
        $this->validate($request, [
            'klientas' => 'required',
            'spec_komp' => 'required',
            'gedimai' => 'required'
        ]);

        //edit repair
        $repair = Repair::find($id);
        $update = request()->all();
        $repair->update($update);

        return redirect()->back()->with('success', 'Pakeitimai išsaugoti');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $repair = Repair::find($id);
        $repair->delete();

        return redirect('/repairs')->with('success', 'Gedimas ištrintas');
    }

    public function thisMonthRepairs()
    {
        $role = auth()->user()->role;
        $user_id = auth()->user()->id;
        $users = User::all();

        $userOptions = array('0' => 'Nepaskirtas')
            +DB::table('users')->select(DB::raw('concat (name," ",lastname) as fullname, id'))
            ->pluck('fullname', 'id')->toArray();

        $thisMonthRepairs = Repair::where([
            ['created_at', '>=', Carbon::now()->startOfMonth()],
            ['meistro_id', '=', $user_id]
        ])->paginate(10);

        return view('repairs.thisMonth')
        ->with('thisMonthRepairs', $thisMonthRepairs)
        ->with('users', $users)
        ->with('userOptions', $userOptions)
        ->with('role', $role)
        ->with('name','Šio mėnesio gedimai');
    }

    public function newRepairs()
    {
        $role = auth()->user()->role;
        $user_id = auth()->user()->id;
        $users = User::all();

        $userOptions = array('0' => 'Nepaskirtas')
            +DB::table('users')->select(DB::raw('concat (name," ",lastname) as fullname, id'))
            ->pluck('fullname', 'id')->toArray();

        $newRepairs = Repair::where('busena', 'uzregistruotas')->paginate(10);

        return view('repairs.newRepairs')
        ->with('newRepairs', $newRepairs)
        ->with('users', $users)
        ->with('userOptions', $userOptions)
        ->with('role', $role)
        ->with('name','Nauji gedimai');
    }

    public function notFinishedRepairs()
    {
        $role = auth()->user()->role;
        $user_id = auth()->user()->id;
        $users = User::all();

        $userOptions = array('0' => 'Nepaskirtas')
            +DB::table('users')->select(DB::raw('concat (name," ",lastname) as fullname, id'))
            ->pluck('fullname', 'id')->toArray();

        $notFinishedRepairs = Repair::where('busena', 'vykdomas')->paginate(10);

        return view('repairs.notFinished')
        ->with('notFinishedRepairs', $notFinishedRepairs)
        ->with('users', $users)
        ->with('userOptions', $userOptions)
        ->with('role', $role)
        ->with('name','Vykdomi gedimai');
    }

    public function isShowing(Request $request)
    {
        $id = $request->id;
        $arRodo = $request->arRodo;
        $repair = Repair::find($id);
        $repair->arRodo = $arRodo;
        $repair->save();
        
        return;
    }

    public function printPDF($id)
    {
        $repair = Repair::find($id);

        $userOptions = array('0' => 'Nepaskirtas')
            +DB::table('users')->select(DB::raw('concat (name," ",lastname) as fullname, id'))
            ->pluck('fullname', 'id')->toArray();

        $now = Carbon::now()->format('Y-m-d H:i:s');

        $pdf = app('dompdf.wrapper')->loadView('repairs.repairPDF', ['repair' => $repair, 'userOptions' => $userOptions, 'now' => $now]);
        
        
        return $pdf->stream('repair.pdf');
    }

    public function search(Request $request)
    {
        $conditions = request()->all();

        $result = Repair::orderBy('created_at','desc');

        if(!empty($conditions['id'])){
            $result->where('id', '=', $conditions['id']);
        }

        if(!empty($conditions['barkodas'])){
            $result->where('barkodas', 'like', '%'.$conditions['id'].'%');
        }

        if(!empty($conditions['nuo'])){
            $result->where('created_at', '>=', $conditions['nuo']);
        }

        if(!empty($conditions['iki'])){
            $result->where('created_at', '<=', $conditions['iki']);
        }

        if(!empty($conditions['klientas'])){
            $result->where('klientas', 'like', '%'.$conditions['klientas'].'%');
        }

        if(!empty($conditions['spec_komp'])){
            $result->where('spec_komp', 'like', '%'.$conditions['spec_komp'].'%');
        }

        if(!empty($conditions['meistro_id'])){
            $result->where('meistro_id', '=', $conditions['meistro_id']);
        }

        $repairs = $result->paginate(10);

        $role = auth()->user()->role;
        
        $users = User::all();

        $userOptions = array('0' => 'Nepaskirtas')
            +DB::table('users')->select(DB::raw('concat (name," ",lastname) as fullname, id'))
            ->pluck('fullname', 'id')->toArray();

        
        return view('repairs.search')
            ->with('repairs', $repairs)
            ->with('users', $users)
            ->with('userOptions', $userOptions)
            ->with('role', $role)
            ->with('name','Paieškos rezultatai');
        
    }

    public function public()
    {
        return view('repairs.public');
    }

    public function publicSearch(Request $request)
    {
        $repair = Repair::where('id', '=', $request->input('nr'))->get();
        if (isset($repair[0]->busena)) {
            $busena = $repair[0]->busena;
        } else {
            $busena = 'Nerastas';
        }
        
        return view('repairs.public')->with('busena', $busena);
    }
}
