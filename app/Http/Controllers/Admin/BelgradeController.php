<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BelgradeInfoRequest;
use App\Http\Requests\EditBelgradeInfoRequest;
use App\Models\Belgrade;
use App\Services\BelgradeService;

class BelgradeController extends Controller
{
    public function getBelgradeInfo()
    {
        $belgrade = Belgrade::first();
        
        return view('auth.belgrade.info', compact('belgrade'));
    }

    public function addBelgradeInfo(BelgradeInfoRequest $request)
    {
        $data = [
            'meta_keywords'    => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'belgrade_image'   => BelgradeService::getBelgradeImage(
                $request->belgradeimage
            ),
            'description'      => clean($request->description)
        ];

        Belgrade::create($data);

        return back()->with(
            'status', 'You have added Belgrade info successfully'
        );
    }

    public function editBelgradeInfo(EditBelgradeInfoRequest $request, Belgrade $belgrade)
    {
        $data = [
            'meta_keywords'    => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'belgrade_image'   => BelgradeService::getUpdatedBelgradeImage(
                $request->belgradeimage,
                $belgrade->belgrade_image
            ),
            'description'      => clean($request->description)
        ];

        $belgrade->update($data);

        return back()->with(
            'status', 'You have updated Belgrade info successfully'
        );
    }
}
