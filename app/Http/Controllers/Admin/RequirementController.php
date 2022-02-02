<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddRequirementRequest;
use App\Http\Requests\EditRequirementRequest;
use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RequirementController extends Controller
{
    public function searchRequirement(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            
            $data = Requirement::select('id', 'name')
                ->where('name', 'LIKE', "%{$search}%")
                ->get();
        }
        
        return response()->json($data);
    }
    
    public function getAllRequirements()
    {
        $requirements = Requirement::sortable()->paginate(10);
        
        return view('auth.requirements.requirements', compact('requirements'));
    }
    
    public function newRequirementForm()
    {
        return view('auth.requirements.add-new-requirement');
    }

    public function addNewRequirement(AddRequirementRequest $request)
    {
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ];

        Requirement::create($data);

        return back()->with('status', 'You have added requirement successfully');
    }

    public function editRequirementForm(Requirement $requirement)
    {
        return view('auth.requirements.edit-requirement', compact('requirement'));
    }

    public function editRequirement(EditRequirementRequest $request, Requirement $requirement)
    {
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ];

        $requirement->update($data);

        return back()->with('status', 'You have updated requirement successfully');
    }
}
