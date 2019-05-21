<?php

namespace Ciklas\Http\Controllers;

use Ciklas\Service;
use Illuminate\Http\Request;
use Ciklas\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Ciklas\User;

class ServiceController extends Controller
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

        $services = Service::paginate(10);

        $users = User::all();

        $userOptions = array('0' => 'Nepaskirtas')
            +DB::table('users')->select(DB::raw('concat (name," ",lastname) as fullname, id'))
            ->pluck('fullname', 'id')->toArray();

        
        return view('services.all')
            ->with('services', $services)
            ->with('users', $users)
            ->with('userOptions', $userOptions)
            ->with('role', $role)
            ->with('name','Visi iškvietimai');
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
            'tel' => 'required',
            'adresas' => 'required',
            'uzduotis' => 'required'
        ]);

        //create service
        Service::create($request->all());

        //finds last insterted 
        $inserted = Service::orderby('created_at', 'desc')->first();

        $user_id = auth()->user()->id;
        $inserted->registrator_id = $user_id;
        $inserted->save();

        return redirect()->back()->with('success', 'Įrašas išsaugotas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Ciklas\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $role = auth()->user()->role;

        $users = User::all();

        $userOptions = array('0' => 'Nepaskirtas')
            +DB::table('users')->select(DB::raw('concat (name," ",lastname) as fullname, id'))
            ->pluck('fullname', 'id')->toArray();

        
        return view('services.show')
            ->with('service', $service)
            ->with('users', $users)
            ->with('userOptions', $userOptions)
            ->with('role', $role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Ciklas\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $role = auth()->user()->role;

        $users = User::all();

        $userOptions = array('0' => 'Nepaskirtas')
            +DB::table('users')->select(DB::raw('concat (name," ",lastname) as fullname, id'))
            ->pluck('fullname', 'id')->toArray();

        
        return view('services.edit')
            ->with('service', $service)
            ->with('users', $users)
            ->with('userOptions', $userOptions)
            ->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Ciklas\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $this->validate($request, [
            'klientas' => 'required',
            'tel' => 'required',
            'adresas' => 'required',
            'uzduotis' => 'required'
        ]);

        //edit service
        $update = request()->all();
        $service->update($update);

        

        return redirect()->back()->with('success', 'Pakeitimai išsaugoti');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Ciklas\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect('/services')->with('success', 'Iškvietimas ištrintas');
    }

    public function thisMonthServices()
    {
        $role = auth()->user()->role;
        $user_id = auth()->user()->id;
        $users = User::all();

        $userOptions = array('0' => 'Nepaskirtas')
            +DB::table('users')->select(DB::raw('concat (name," ",lastname) as fullname, id'))
            ->pluck('fullname', 'id')->toArray();

        $thisMonthServices = Service::where([
            ['created_at', '>=', Carbon::now()->startOfMonth()],
            ['meistro_id', '=', $user_id]
        ])->paginate(10);

        return view('services.thisMonth')
        ->with('thisMonthServices', $thisMonthServices)
        ->with('users', $users)
        ->with('userOptions', $userOptions)
        ->with('role', $role)
        ->with('name','Šio mėnesio iškvietimai');
    }

    public function newServices()
    {
        $role = auth()->user()->role;
        $user_id = auth()->user()->id;
        $users = User::all();

        $userOptions = array('0' => 'Nepaskirtas')
            +DB::table('users')->select(DB::raw('concat (name," ",lastname) as fullname, id'))
            ->pluck('fullname', 'id')->toArray();

        $newServices = Service::where('busena', 'uzregistruotas')->paginate(10);

        return view('services.newServices')
        ->with('newServices', $newServices)
        ->with('users', $users)
        ->with('userOptions', $userOptions)
        ->with('role', $role)
        ->with('name','Nauji iškvietimai');
    }

    public function notFinishedServices()
    {
        $role = auth()->user()->role;
        $user_id = auth()->user()->id;
        $users = User::all();

        $userOptions = array('0' => 'Nepaskirtas')
            +DB::table('users')->select(DB::raw('concat (name," ",lastname) as fullname, id'))
            ->pluck('fullname', 'id')->toArray();

        $notFinishedServices = Service::where('busena', 'vykdomas')->paginate(10);

        return view('services.notFinished')
        ->with('notFinishedServices', $notFinishedServices)
        ->with('users', $users)
        ->with('userOptions', $userOptions)
        ->with('role', $role)
        ->with('name','Vykdomi iškvietimai');
    }

    public function isShowing(Request $request)
    {
        $id = $request->id;
        $arRodo = $request->arRodo;
        $service = Service::find($id);
        $service->arRodo = $arRodo;
        $service->save();
        
        return;
    }

    public function printPDF($id)
    {
        $service = Service::find($id);

        $userOptions = array('0' => 'Nepaskirtas')
            +DB::table('users')->select(DB::raw('concat (name," ",lastname) as fullname, id'))
            ->pluck('fullname', 'id')->toArray();

        $now = Carbon::now()->format('Y-m-d H:i:s');

        $pdf = app('dompdf.wrapper')->loadView('services.servicePDF', ['service' => $service, 'userOptions' => $userOptions, 'now' => $now]);
        
        
        return $pdf->stream('service.pdf');
    }

    public function search(Request $request)
    {
        $conditions = request()->all();

        $result = Service::orderBy('created_at','desc');

        if(!empty($conditions['id'])){
            $result->where('id', '=', $conditions['id']);
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

        if(!empty($conditions['busena'])){
            $result->where('busena', 'like', '%'.$conditions['busena'].'%');
        }

        if(!empty($conditions['meistro_id'])){
            $result->where('meistro_id', '=', $conditions['meistro_id']);
        }

        $services = $result->paginate(10);

        $role = auth()->user()->role;
        
        $users = User::all();

        $userOptions = array('0' => 'Nepaskirtas')
            +DB::table('users')->select(DB::raw('concat (name," ",lastname) as fullname, id'))
            ->pluck('fullname', 'id')->toArray();

        
        return view('services.search')
            ->with('services', $services)
            ->with('users', $users)
            ->with('userOptions', $userOptions)
            ->with('role', $role)
            ->with('name','Paieškos rezultatai');
    }
}
