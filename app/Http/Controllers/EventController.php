<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        $categories = Category::all();
        return view('admin.events', [
            'events' => $events,
            'categories' => $categories,
        ]);

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

        return redirect('/event');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return redirect('/event');
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'available_seats' => 'required|integer|min:0',
            'images' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $validatedData['images'] = $imageName;
        }

        $event->update($validatedData);

        return redirect('event')->with('success', 'Event updated successfully.');
    }



    public function destroy($id)
    {

        $event = Event::findOrFail($id);
        $event->delete();

        return redirect('event')->with('success', 'event updated successfully.');
    }
    public function filterByDate(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
        ]);

        $events = Event::whereDate('date', $validatedData['date'])->get();

        return redirect('event')->with('success', 'event updated successfully.');    }

    public function filterByLocation(Request $request)
    {
        $validatedData = $request->validate([
            'location' => 'required|string',
        ]);

        $events = Event::where('location', $validatedData['location'])->get();

        return redirect('event')->with('success', 'event updated successfully.');
    }
}
