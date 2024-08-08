<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', 2)->orderBy('id', 'desc')->get();

        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Manage Users', 'url' => ''],
        ];

        return view('admin.user.index', compact('users', 'breadcrumbs'));
    }
    public function enable(Request $request, $id)
    {
        try {
            $user = User::where('id', $id)->first();

            if (!empty($user)) {

                User::where('id', $user->id)->update([
                    'status' => true
                ]);

                return redirect()->back()->with('success', 'User enabled successful');

            } else {
                return redirect()->back()->with('error', 'User not found!');

            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Update data is failed!');
        }
    }

    public function disable($id)
    {
        try {
            $user = User::where('id', $id)->first();

            if (!empty($user)) {

                User::where('id', $user->id)->update([
                    'status' => false
                ]);

                return redirect()->back()->with('success', 'User disabled successful');

            } else {
                return redirect()->back()->with('error', 'User not found!');

            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Update data is failed!');
        }
    }
}