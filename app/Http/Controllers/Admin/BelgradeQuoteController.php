<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BelgradeInfoRequest;
use App\Models\BelgradeQuote;

class BelgradeQuoteController extends Controller
{
    public function getBelgradeInfo()
    {
        $belgrade = BelgradeQuote::first();
        
        return view('auth.belgrade.info', compact('belgrade'));
    }

    public function addBelgradeInfo(BelgradeInfoRequest $request)
    {
        $data = [
            'meta_keywords'    => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'description'      => clean($request->description)
        ];

        BelgradeQuote::create($data);

        return back()->with(
            'status', 'You have added Belgrade info successfully'
        );
    }

    public function editBelgradeInfo(BelgradeInfoRequest $request, BelgradeQuote $belgrade)
    {
        $data = [
            'meta_keywords'    => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'description'      => clean($request->description)
        ];

        $belgrade->update($data);

        return back()->with(
            'status', 'You have updated Belgrade info successfully'
        );
    }
}
