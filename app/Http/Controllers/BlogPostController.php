<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // Filter by search
        if ($request->has('search') && $request->search != '') {
            $posts = BlogPost::query()
                ->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('content', 'like', '%' . $request->search . '%')
                ->latest()
                ->paginate(9)->withQueryString();

            $otherPosts = $posts;
            $featuredPost = null;
        } else {
            // Ambil postingan terbaru sebagai postingan unggulan
            $featuredPost = BlogPost::latest()->with('author', 'comments')->first();
            // Ambil postingan lainnya dengan pagination, lewati postingan pertama
            $otherPosts = BlogPost::latest()->skip(1)->paginate(6);
        }

        // Ambil 4 postingan terbaru untuk sidebar
        $recentPosts = BlogPost::latest()->take(5)->get();

        return view('blog.index', [
            'featuredPost' => $featuredPost,
            'posts' => $otherPosts,
            'recentPosts' => $recentPosts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = new BlogPost([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::user()->id, //auth()->id(),
        ]);

        $post->save();

        return redirect()->route('blog.index')->with('success', 'Blog post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $post = BlogPost::where('slug', $slug)->firstOrFail();

        // Ambil 4 postingan terbaru untuk sidebar
        $recentPosts = BlogPost::latest()->take(4)->get();

        return view('blog.show', compact('post', 'recentPosts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $blogPost)
    {
        $this->authorize('update', $blogPost);
        return view('blog.edit', ['post' => $blogPost]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        $this->authorize('update', $blogPost);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $blogPost->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('blog.index')->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blogPost)
    {
        $this->authorize('delete', $blogPost);

        $blogPost->delete();

        return redirect()->route('blog.index')->with('success', 'Blog post deleted successfully.');
    }
}
