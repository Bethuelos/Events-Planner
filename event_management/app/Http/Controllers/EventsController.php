<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class EventsController extends Controller
{
    //
    public function index()
    {
        $events = DB::table('events')->get();
        return Inertia::render('Events/Events', [
            'events' => $events,
        ]);
    }

    public function form()
    {
        return Inertia::render('Events/Form');
    }

    public function add_event(Request $request)
    {
        DB::table('events')->insert([
            "tittle" => $request->input('title'),
            "description" => $request->input('description'),
            "start_date" => $request->input('start_date'),
            "end_date" => $request->input('end_date'),
        ]);

        // return Redirect::route('events');
        redirect()->back();
        // return Redirect::route('events');
    }

    public function edit_event(Request $request, $id)
    {

        DB::table('events')
              ->where('id_events', $id)
              ->update([
                "tittle" => $request->input('title'),
                "description" => $request->input('description'),
                "start_date" => $request->input('start_date'),
                "end_date" => $request->input('end_date'),
              ]);

        // return Redirect::route('events');
        // return Redirect::back()->with('message','Operation Successful !');
        // return back();
        return redirect()->route('events');
    }

    public function delete_event($id)
    {
        DB::table('events')->where('id_events', $id)->delete();

        return Redirect::route('events');
    }

}
