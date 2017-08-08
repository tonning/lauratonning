<?php

namespace App\Http\Controllers;

use App\Transformers\SiteTransformer;
use Spatie\Fractalistic\ArraySerializer;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $sites = fractal()
            ->collection(\App\Site::all())
            ->transformWith(new SiteTransformer())
            ->serializeWith(new ArraySerializer())->toJson();

        return view('welcome', compact('sites'));
    }
}
