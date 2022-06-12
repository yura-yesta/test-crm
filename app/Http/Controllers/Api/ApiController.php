<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Company;
use App\Models\Relation;

class ApiController extends Controller
{
    public function companies()
    {

        return Company::all()->sortByDesc('id')->paginate(50)->toJson();
    }

    public function clients($id)
    {

        $ids = Relation::all_relations($id, 'id_company');
        return Client::all()->whereIn('id', $ids)->sortByDesc('id')->paginate(5)->toJson();
    }

    public function client_companies($id)
    {

        $ids = Relation::all_relations($id, 'id_client');
        return Company::all()->whereIn('id', $ids)->sortByDesc('id')->paginate(5)->toJson();
    }
}
