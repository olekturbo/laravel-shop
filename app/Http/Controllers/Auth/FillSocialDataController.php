<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FillSocialDataController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function fillData() {
        return view('auth.fill-data');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeData(Request $request) {
        $authUser = Auth::user();
        $authUser->update([
            'phone' => $request->phone,
            'city' => $request->city,
            'post_code' => $request->post_code,
            'street' => $request->street
        ]);

        return redirect()->route('welcome');
    }
}
