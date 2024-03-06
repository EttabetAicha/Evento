<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return response()->json($events);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'available_seats' => 'required|integer|min:0',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('images');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);

        $validatedData['images'] = $imageName;

        $event = Event::create($validatedData);

        return response()->json($event, 201);
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return response()->json($event);
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'string',
            'description' => 'string',
            'date' => 'date',
            'location' => 'string',
            'category_id' => 'exists:categories,id',
            'available_seats' => 'integer|min:0',
            'images' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Allow only one image
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;
        }

        $event->update($validatedData);

        return response()->json($event, 200);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json(['message' => 'Event deleted successfully']);
    }
    public function filterByDate(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
        ]);

        $events = Event::whereDate('date', $validatedData['date'])->get();

        return response()->json($events);
    }

    public function filterByLocation(Request $request)
    {
        $validatedData = $request->validate([
            'location' => 'required|string',
        ]);

        $events = Event::where('location', $validatedData['location'])->get();

        return response()->json($events);
    }
}
