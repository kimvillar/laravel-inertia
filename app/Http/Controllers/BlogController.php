<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blogs\BlogsRequest;
use Inertia\Inertia;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Blog::class);
        $blogs = Blog::where('user_id', Auth::id())->get();

        return Inertia::render('Blogs/Index', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Blog::class);
        return Inertia::render('Blogs/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogsRequest $request)
    {
        $this->authorize('create', Blog::class);

        $request->validated();

        $image_path = '';
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('image', 'public');
        }

        $blog = New Blog();
        $blog->user_id = Auth::id();
        $blog->title = $request->title;
        $blog->slug = \Str::slug($request->slug);
        $blog->content = $request->content;
        $blog->image = $image_path ?? null;
        $blog->save();
        sleep(1);

        return redirect()->route('blogs.index')->with('message', 'Blog Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $this->authorize('create', Blog::class);
        return Inertia::render('Blogs/Edit', ['blog' => $blog]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(BlogsRequest $request, Blog $blog)
    {
        $this->authorize('create', Blog::class);
        $request->validated();
        $image_path = '';
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('image', 'public');
            $blog->image = $image_path;
        }

        $blog->user_id = Auth::id();
        $blog->title = $request->title;
        $blog->slug = \Str::slug($request->slug);
        $blog->content = $request->content;
        $blog->save();
        sleep(1);

        return redirect()->route('blogs.index')->with('message', 'Blog Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $this->authorize('create', Blog::class);
        $blog->delete();
        sleep(1);

        return redirect()->route('blogs.index')->with('message', 'Blog Delete Successfully');
    }
}
