<?php namespace App\Http\Controllers\v2;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        //
    }


    public function test(Request $request)
    {
        return array_merge(getTimestampedDemoData(), ['version' => "v2"]);
    }


}
