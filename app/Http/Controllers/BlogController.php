<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('id', 'desc')->get();
        return view('backend.pages.blog.index', compact('blogs'));
    }

    public function create(Request $request)
    {
        if ($request->id) {
            $blog = Blog::find($request->id);
            $id = $request->id;
            return view('backend.pages.blog.create', compact('blog', 'id'));
        } else {
            $id = $request->id;
            return view('backend.pages.blog.create', compact('id'));
        }
    }

    public function store(Request $request)
    {
        if ($request->blog_id) {
            $fileValidation = '';
        } else {
            $fileValidation = 'required|file|mimes:jpeg,png,jpg,gif|max:2048';
        }

        $validator = FacadesValidator::make($request->all(), [
            'title' => 'required||min:3',
            'status' => 'required',
            'description' => 'required||min:5',
            'file' => $fileValidation
        ]);

        if ($validator->passes()) {

            $blog = $request->blog_id ? Blog::find($request->blog_id) : new Blog();

            if (($request->hasFile('file') && $request->blog_id) || ($request->hasFile('file') && $request->blog_id == '0')) {
                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
            } else {
                $fileName = $blog->image;
            }

            $blog->title = $request->title;
            $blog->status = $request->status;
            $blog->description = $request->description;
            $blog->image = $fileName;
            $blog->save();

            if (($request->hasFile('file') && $request->blog_id) || ($request->hasFile('file') && $request->blog_id == '0')) {
                $request->file('file')->storeAs('uploads', $fileName, 'public');
            }

            $message = $request->blog_id ? "Blog updated successfully" : "Blog added successfully";

            session()->flash('success', $message);

            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function delete(Request $request)
    {
        $blog = Blog::find($request->id);
        $blog->delete();

        if ($blog) {
            session()->flash('success', "Blog deleted successfully");
            return response()->json([
                'status' => true,
            ]);
        } else {
            session()->flash('success', "Blog delete failed");
            return response()->json([
                'status' => false
            ]);
        }
    }
}
