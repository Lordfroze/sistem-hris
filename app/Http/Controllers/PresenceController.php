<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence;

class PresenceController extends Controller
{
    //index
    public function index()
    {
        $presences = Presence::all();
        return view('presences.index', compact('presences'));
    }
}
