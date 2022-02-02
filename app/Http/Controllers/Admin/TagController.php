<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddTagRequest;
use App\Http\Requests\EditTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function searchTag(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            
            $data = Tag::select('id', 'name')
                ->where('name', 'LIKE', "%{$search}%")
                ->get();
        }
        
        return response()->json($data);
    }
    
    public function getAllTags()
    {
        $tags = Tag::sortable()->paginate(10);
        
        return view('auth.tags.tags', compact('tags'));
    }
    
    public function newTagForm()
    {
        return view('auth.tags.add-new-tag');
    }

    public function addNewTag(AddTagRequest $request)
    {
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ];

        Tag::create($data);

        return back()->with('status', 'You have added tag successfully');
    }

    public function editTagForm(Tag $tag)
    {
        return view('auth.tags.edit-tag', compact('tag'));
    }

    public function editTag(EditTagRequest $request, Tag $tag)
    {
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ];

        $tag->update($data);

        return back()->with('status', 'You have updated tag successfully');
    }
}
