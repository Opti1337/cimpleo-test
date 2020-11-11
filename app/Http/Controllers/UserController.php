<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function updateParameters(Request $request, User $user)
    {
        if (!auth()->user()->isAdmin() && auth()->user()->id != $user->id) {
            return back()->with('status', __('Access denied!'));
        }

        $rules = [];
        foreach (array_keys($user->parameters) as $parameter) {
            $rules[$parameter] = ['required', 'boolean'];
        }

        $data = $request->validate($rules);

        $user->user_type()->update($data);

        if ($request->wantsJson()) {
            return;
        }

        return back()->with('status', __('Parameters updated!'));
    }
}
