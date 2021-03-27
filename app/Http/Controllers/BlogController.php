<?php

namespace App\Http\Controllers;

use App\Category;
use App\Posts;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index(Posts $posts){
        $category_widget = Category::all();
        
        $data = $posts->latest()->take(4)->get();
        $locations = DB::table('location')->get();
        // return view('blog.gmaps', compact('locations'));
        // return view('homeblog.gmaps', compact('locations'));
        return view('blog', compact('data','category_widget','locations'));

    }

    public function content_blog($slug){
        $category_widget = Category::all();

        $locations = DB::table('location')->get();
        $data = Posts::where('slug', $slug)->get();
        return view('blog.content_blog', compact('data','category_widget','locations'));
    }

    public function list(){

        $category_widget = Category::all();

        $locations = DB::table('location')->get();
        $data = Posts::latest()->paginate(3);
        return view('blog.list', compact('data','category_widget','locations'));
    }

    public function list_category(category $category){
        $category_widget = Category::all();

        $locations = DB::table('location')->get();
        $data = $category->posts()->paginate(3);
        return view('blog.list', compact('data','category_widget','locations'));
    }

    public function search(request $request){
        $category_widget = Category::all();

        $locations = DB::table('location')->get();
        $data = Posts::where('judul', $request->search)->orWhere('judul','like','%'.$request->search.'%')->paginate(6);
        return view('blog.list', compact('data','category_widget','locations'));
    }

    public function about(){
        $category_widget = Category::all();

        $locations = DB::table('location')->get();
        $data = Posts::latest();
        return view('blog.about', compact('data','category_widget','locations'));
    }

    public function contact(){
        $category_widget = Category::all();

        $locations = DB::table('location')->get();
        $data = Posts::latest();
        return view('blog.contact', compact('data','category_widget','locations'));
    }
}
