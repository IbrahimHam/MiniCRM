<?php

namespace App\Helpers;

use App\Models\Company;

class checker
{
    public static function check($request, $route)
    {
        $checker = Company::where('email', '=', $request->get('email'))->first();

        if($checker !== null)
        {
            return redirect()
                ->route('companies.index')
                ->with('status', 'A company is already created with this email!.');
        }

    }
}
