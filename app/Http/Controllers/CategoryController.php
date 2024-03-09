<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    protected $category;
    public function __construct(){

        $this->category = new  Category ();

    }
    public function categorypage(){
        $categories = $this->category->paginate(10);
        $count = count($categories);
        return view('dashboard.layouts.category' , compact('categories' , 'count') ) ;
    }

    public function addcategory(Request $request)
    {
        $this->validate($request, [
            'name' =>'required|unique:categories,name'
        ]);

        $this->category->name = $request->name;
        $this->category->save();
        return redirect()->back()->with('msg', 'Category Added with Successfully');
    }

    public function categorydelete($id)
    {
        $this->category->find($id)->delete();
        return redirect()->back()->with('delmsg', 'Category Deleted Successfully');
    }


    public function categoryedit(Request $request)
    {
        try{
            $this->validate($request, [
                'name' => 'required|unique:categories,name,' . $request->id,
            ]);
            
            $category = $this->category->find($request->id);
            
            $category->name = $request->name;
            $category->save();

            return redirect()->back()->with('msg', 'Category Updated Successfully');
            }
        
        catch (\Exception $e){
            return redirect()->back()->with('delmsg', 'Something went wrong');
        }
    }



   

    public function EventsByCategory($categoryId, $textsearch)
    {   
        $events = Event::query();

        if ($categoryId != 0) {
            $events->where('category_id', $categoryId);
        }

        if ($textsearch != 0) {
            $events->where('title', 'like', '%' . $textsearch . '%')
            ->orWhere('description', 'like', '%'. $textsearch. '%');;
        }
        $events = $events->latest()->get();

        
        return view('user.search.bycategory', compact('events'));
    }  



}