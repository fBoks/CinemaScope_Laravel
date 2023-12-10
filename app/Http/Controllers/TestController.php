<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __invoke(Request $request) {
        // return response('test');
        // return response('test', 200, [ 'foo' => 'bar', ]);
        return response()->json(['foo' => 'bar',]);

    }
}
