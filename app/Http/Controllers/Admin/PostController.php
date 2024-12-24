<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::orderBy('id', 'DESC');

        return view('admin.posts.index', [
            'posts' => $posts->paginate(8)
        ]);
    }

    public function store(StorePostRequest $request)
    {
        $request->validated();

        $imageName = '';
        if ($image = $request->file('image')) {
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move('images/blog/orginal', $imageName);

            $originalPath = 'images/blog/orginal/' . $imageName;
            $resizedPath = 'images/blog/thumbnail/' . $imageName;

            $this->resizedImage($originalPath, $resizedPath);
        }

        Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'category' => $request->category,
            'image' => $imageName,
        ]);

        return redirect()->back()->with('success', 'post created successfully');
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.post-create', [
            'categories' => $categories
        ]);
    }

    public function edit(Post $post)
    {
        $categories = Category::all();

        return view('admin.posts.post-edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $validated = $request->validated();

        $post->update($validated);

        return redirect()->route('admin.posts.edit', $post->slug)->with('success', "post updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        if (File::exists(public_path('images/blog/thumbnail/' . $post->image)))
            File::delete(public_path('images/blog/thumbnail/' . $post->image));

        if (File::exists(public_path('images/blog/orginal/' . $post->image)))
            File::delete(public_path('images/blog/orginal/' . $post->image));

        return redirect()->back()->with('success', 'post deleted successfully');
    }

    private function resizedImage($originalPath, $resizedPath)
    {
        list($width, $height) = getimagesize($originalPath);
        $newWidth = 416;
        $newHeight = 234;
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
        $sourceImage = imagecreatefromjpeg($originalPath);
        imagecopyresampled($resizedImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagejpeg($resizedImage, $resizedPath);
        imagedestroy($sourceImage);
        imagedestroy($resizedImage);
    }
}
