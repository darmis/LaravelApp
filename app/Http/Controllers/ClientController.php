<?php

namespace Ciklas\Http\Controllers;

use Ciklas\Client;
use Illuminate\Http\Request;
use Ciklas\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = auth()->user()->role;
        $clients = Client::paginate(10);

        
        return view('clients.all')
            ->with('clients', $clients)
            ->with('role', $role)
            ->with('name','Visi klientai');
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
            'name' => 'required'
        ]);

        //create repair
        Client::create($request->all());
        return redirect()->back()->with('success', 'Klientas įvestas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Ciklas\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $role = auth()->user()->role;

        
        return view('clients.show')
            ->with('client', $client)
            ->with('role', $role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Ciklas\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $role = auth()->user()->role;

        return view('clients.edit')
            ->with('client', $client)
            ->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Ciklas\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        //edit repair
        $update = request()->all();
        $client->update($update);

        return redirect()->back()->with('success', 'Pakeitimai išsaugoti');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Ciklas\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect('/clients')->with('success', 'Įrašas ištrintas');
    }
}
