<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function index() {

        $cache = app('cache');

        $cache->forever('key', 'value');


        return view('homepage');
    }
}
