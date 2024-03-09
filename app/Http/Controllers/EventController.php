<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{
    //
    protected $event;
    protected $category;
    public function __construct(){
        $this->event = new Event();
        $this->category = new Category();
    }

    public function eventpage(){
        $events = DB::table('events')
                ->join('categories', 'events.category_id', '=', 'categories.id')
                ->select('events.*', 'categories.id as category_idd' , 'categories.name as category_name')
                ->orderBy('events.updated_at', 'desc')
                ->paginate(10);

        $categories = $this->category->all();
        $count = $this->event->count();
        return view('dashboard.layouts.eventadmin' , compact('count', 'events' , 'categories'));
    }

    public function eventpageorg(){
        $events = DB::table('events')
                    ->join('categories', 'events.category_id', '=', 'categories.id')
                    ->select('events.*', 'categories.id as category_idd', 'categories.name as category_name')
                    ->where('events.user_id', '=', Session::get('user_id'))
                    ->orderBy('events.updated_at', 'desc')
                    ->paginate(10);

        $categories = $this->category->all();
        $count = $this->event->count();
        return view('dashboard.layouts.event' , compact('count', 'events' , 'categories'));
    }


    public function addevent(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'time' =>'required|date_format:H:i', 
            'location' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'price' => 'required',
            'total_places' => 'required',
            'duration' => 'required',
        ]); 
        
    
        if ($request->hasFile('image')) {
            $imageName = uniqid().'.'.$request->image->extension();
            $request->image->move(public_path('assets/images'), $imageName); 
        } else {
            return redirect()->back()->with('delmsg', 'Image upload failed.');
        }
    
        $event = $this->event; 
        $event->image = $imageName; 
        $event->title = $request->title;
        $event->description = $request->description;
        $event->location = $request->location;
        $event->date = $request->date;
        $event->time = $request->time;
        $event->duration = $request->duration;
        $event->price = $request->price;
        $event->acceptation = $request->acceptation;
        $event->total_places = $request->total_places;
        $event->user_id = Session::get('user_id');
        $event->category_id = $request->category;
        $event->save();
    
        return redirect('/eventpage')->with('msg', 'Event added successfully.');
    }


    public function EditEvent(Request $request)
    {
        $this->validate($request, [
            'id' => 'required', 
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'location' => 'required',
            'price' => 'required',
            'total_places' => 'required',
            'duration' => 'required',
        ]);     
    
        $event = $this->event->find($request->id);
        if (!empty($event)) {        
    
            if ($request->hasFile('image')) {
                $imageName = uniqid().'.'.$request->image->extension();
                $request->image->move(public_path('assets/images'), $imageName); 
                $event->image = $imageName; 
            } elseif (!empty($event->image)) {
               
                $imageName = $event->image;
            }
    
            $event->title = $request->title;
            $event->description = $request->description;
            $event->location = $request->location;
            $event->date = $request->date;
            $event->time = $request->time;
            $event->duration = $request->duration;
            $event->price = $request->price;
            $event->total_places = $request->total_places;
            $event->category_id = $request->category;
            $event->acceptation = $request->acceptation;
            $event->save();
    
            return redirect('/eventpage')->with('msg', 'Event updated successfully.');
        } else {

            return redirect()->back()->with('delmsg', 'Event not found.');
        }
    }
    
    
    public function ArchivEvent($id){
        $event = $this->event->find($id);
        $event->status = 4;
        $event->update();
        return redirect('/eventpage')->with('delmsg', 'Event Archived with successfully.');
    }
    public function ArchivEventOrg($id){
        $event = $this->event->find($id);
        $event->status = 1;
        $event->update();
        return redirect('/eventpageorg')->with('delmsg', 'Event Archived with successfully.');
    }
    public function unarchiveorg($id){
        $event = $this->event->find($id);
        $event->status = 0;
        $event->update();
        return redirect('/eventpageorg')->with('delmsg', 'Event Archived with successfully.');
    }



    public function AcceptEvent($id){
        $event = $this->event->find($id);
        $event->status = 2;
        $event->update();
        return redirect('/eventpage')->with('msg', 'Event Accepted with successfully.');
    }
    
    public function RejectEvent($id){
        $event = $this->event->find($id);
        $event->status = 3;
        $event->update();
        return redirect('/eventpage')->with('delmsg', 'Event Rejected with successfully.');
    }



}   
