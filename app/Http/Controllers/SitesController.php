<?php

namespace App\Http\Controllers;

use App\Site;
use Illuminate\Http\Request;

class SitesController extends Controller
{
    public function show(Site $site)
    {
        return view('sites.show', compact('site'));
    }
}
