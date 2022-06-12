<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use App\Models\Relation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        $posts = Client::all()->sortByDesc('id')->paginate(50);
        $posts->entries = Company::paginateEntries($posts);

        return view('client.list', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request): Redirector|Application|RedirectResponse
    {
        $request->validate(Client::validation_rules());
        $new_client = Client::create($request->all());
        if (!empty($request->id_company)) {
            Relation::add_relation($request->id_company, $new_client->id);
            return redirect(route('company-show', $request->id_company))->with('status',
                "Client $new_client->id created successfully...");
        }

        return redirect()->back()->with('status', 'Client created successfully...');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id): Application|Factory|View
    {
        return view('client.edit', ['client' => Client::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate(Client::validation_rules($id));
        $client = Client::find($id);
        $client->update($request->all());

        return redirect()->back()->with('status', "Client $id updated successfully...");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        Client::destroy($id);

        return redirect()->back()->with('status', "Client - $id deleted successfully...");
    }
}
