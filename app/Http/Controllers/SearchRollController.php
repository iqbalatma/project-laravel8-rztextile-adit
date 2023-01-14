<?php

namespace App\Http\Controllers;

use App\Services\SearchRollService;
use Illuminate\Http\Response;

class SearchRollController extends Controller
{

    /**
     * Description : use to show search form
     * 
     * @param SearchRollService $service dependency injection
     * @return Response
     */
    public function index(SearchRollService $service):Response
    {
        return response()->view("search-roll.index", $service->getAllData());
    }
}
