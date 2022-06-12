<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Company;
use Carbon\Carbon;

class HomeController extends Controller
{
    public static function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $companies_count = Company::all()->count();
        $clients_count = Client::all()->count();
        $newCompanies_count = Company::whereDate('created_at', Carbon::today())->get()->count();
        $newClients_count = Client::whereDate('created_at', Carbon::today())->get()->count();
        $posts = Company::all()->sortByDesc('id')->paginate(50);
        $posts->entries = Company::paginateEntries($posts);

        return view('admin.index', compact('companies_count', 'clients_count', 'posts', 'newCompanies_count', 'newClients_count'));
    }
}
