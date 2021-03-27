<?php

namespace App\Http\Controllers;

use App\Category;
use App\Posts;
use App\Tags;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // create alamat peternakan 
    public function formcreate()
    {
        return view('user.location.create');
    }

    public function indexfarm()
    {
        $farm = Location::where('author', Auth::user()->name)->get();
        return view('user.location.index', compact('farm'));
    }

    public function indexadmin()
    {
        $farm = Location::paginate(10);
        return view('admin.peternakan.index', compact('farm'));
    }

    public function createfarm(Request $request)
    {
        Location::create([
            'provinsi'=>$request->prov,
            'nama_peternakan' => $request->name,
            'author'=>$request->author,
            'jenis_peternakan' => $request->jenis,
            'alamat' => $request->alamat,
            'lat' => $request->lat,
            'lng' => $request->lng
        ]);

        return redirect('/farmindex');
    }

    public function delete($id)
    {
        Location::destroy($id);
        return redirect('/farmindex');
    }

    public function deleteadmin($id)
    {
        Location::destroy($id);
        return redirect('/farmadmin');
    }

    public function editpostform($id){
        $post = Posts::find($id);
        $category = Category::all();
        $tags = Tags::all();
        return view('user.postternak.edit', compact('post','category','tags'));
    }

    public function editpost(Request $request, $id)
    {
        $this->validate($request, [
            'judul' => 'required',
            'category_id' => 'required',
            'content' => 'required',
        ]);

        $post = Posts::findorfail($id);

        if ($request->has('img')) {
            $img = $request->img;
            $new_img = time() . $img->getClientOriginalName();
            $img->move('uploads/posts/', $new_img);

            $post_data = [
                'judul' => $request->judul,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'img' => 'uploads/posts/' . $new_img,
                'slug' => Str::slug($request->judul)
            ];
        } else {
            $post_data = [
                'judul' => $request->judul,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'slug' => Str::slug($request->judul)
            ];
        }

        $post->tags()->sync($request->tags);
        $post->update($post_data);

        return redirect()->route('post.index')->with('success', 'Post Updated Successfully');
    }

    // post
    public function postcreate(){
        $tags = Tags::all();
        $category = Category::all();
        return view('user.postternak.create',compact('tags','category'));
    }

    public function createternaku(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'img' => 'required'
        ]);

        $img = $request->img;
        $new_img = time() . $img->getClientOriginalName();

        $post = Posts::create([
            'judul' => $request->judul,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'author'=>$request->author,
            'img' => 'uploads/posts/' . $new_img,
            'slug' => Str::slug($request->judul),
            'users_id' => Auth::id()
        ]);
        // $aut = $request->author;
        // echo $aut;
        $post->tags()->attach($request->tags);
        $img->move('uploads/posts/', $new_img);

        return redirect()->back()->with('success', 'Post Saved Successfully');
    }

    public function postdestroy($id)
    {
        Posts::destroy($id);
        return redirect('/postuser');
    }

    public function index()
    {
        $post = Posts::paginate(10);
        return view('admin.post.index', compact('post'));
    }

    public function indexuser()
    {
        // echo "hai";
        $post = Posts::where('author', Auth::user()->name)->get();
        return view('admin.post.indexuser', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tags::all();
        $category = Category::all();
        return view('admin.post.create', compact('category', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'img' => 'required'
        ]);

        $img = $request->img;
        $new_img = time() . $img->getClientOriginalName();

        $post = Posts::create([
            'judul' => $request->judul,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'img' => 'uploads/posts/' . $new_img,
            'slug' => Str::slug($request->judul),
            'users_id' => Auth::id()
        ]);

        $post->tags()->attach($request->tags);
        $img->move('uploads/posts/', $new_img);

        return redirect()->back()->with('success', 'Post Saved Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::all();
        $tags = Tags::all();
        $post = Posts::findorfail($id);
        return view('admin.post.edit', compact('post', 'tags', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul' => 'required',
            'category_id' => 'required',
            'content' => 'required',
        ]);

        $post = Posts::findorfail($id);

        if ($request->has('img')) {
            $img = $request->img;
            $new_img = time() . $img->getClientOriginalName();
            $img->move('uploads/posts/', $new_img);

            $post_data = [
                'judul' => $request->judul,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'img' => 'uploads/posts/' . $new_img,
                'slug' => Str::slug($request->judul)
            ];
        } else {
            $post_data = [
                'judul' => $request->judul,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'slug' => Str::slug($request->judul)
            ];
        }

        $post->tags()->sync($request->tags);
        $post->update($post_data);

        return redirect('/postuser');
        // return redirect()->route('post.index')->with('success', 'Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Posts::findorfail($id);
        $post->delete();

        return redirect()->back()->with('success', 'Post Deleted Successfully, Please Check the Trash');
    }

    public function show_delete(){
        $post = Posts::onlyTrashed()->paginate();
        return view('admin.post.delete', compact('post'));
    }

    public function restore($id){
        $post = Posts::withTrashed()->where('id', $id)->first();
        $post->restore();

        return redirect()->back()->with('success', 'Post Restored Successfully, Please Check List Post');
    }

    public function deleted($id){
        $post = Posts::withTrashed()->where('id', $id)->first();
        $post->forceDelete();

        return redirect()->back()->with('success', 'Post has been Successfully Deleted');
    }
}
