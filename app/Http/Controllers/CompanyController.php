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

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $posts = Company::all()->sortByDesc('id')->paginate(100);
        $posts->entries = Company::paginateEntries($posts);

        return view('company.list', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Factory|View|Application
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request): Redirector|Application|RedirectResponse
    {
        $request->validate(Company::validation_rules());
        $company = Company::create($request->all());

        return redirect(route('company'))->with('status', "Company $company->id created successfully...");
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id): Factory|View|Application
    {
        $ids = Relation::all_relations($id, 'id_company');
        $posts = Client::all()->whereIn('id', $ids)->sortByDesc('id')->paginate(5);
        $posts->entries = Company::paginateEntries($posts);

        return view('company.clients', compact('posts', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id): Factory|View|Application
    {
        return view('company.edit', ['company' => Company::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, $id): Redirector|Application|RedirectResponse
    {
        $request->validate(Company::validation_rules($id));
        $company = Company::find($id);
        $company->update($request->all());

        return redirect()->back()->with('status', "Company $id updated successfully...");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($id): Redirector|Application|RedirectResponse
    {
        Company::destroy($id);

        return redirect()->back()->with('status', "Company - $id deleted successfully...");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id_company
     * @return Application|RedirectResponse|Redirector
     */
    public function createClient($id_company): Factory|View|Application
    {
        return view('client.create', compact('id_company'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @param $id_company
     * @return Application|RedirectResponse|Redirector
     */
    public function destroyClient($id, $id_company): Redirector|Application|RedirectResponse
    {
        Relation::where('id_client', $id)->where('id_company', $id_company)->delete();

        return redirect()->back()->with('status', "Company - $id deleted successfully...");
    }
}
