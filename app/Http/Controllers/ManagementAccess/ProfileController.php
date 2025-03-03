<?php

namespace App\Http\Controllers\ManagementAccess;

use App\Models\User;
use Illuminate\Support\Str;

// use library here
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// use model here
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('name', Auth::user()->name)->first();

        return view('pages.management-access.profile.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required|string',
            'password' => 'required|string',
            'password_confirmation' => 'required|string',
        ]);

        $auth = Auth::user();

        // The passwords matches
        if (! Hash::check($request->get('current_password'), $auth->password)) {
            alert()->warning('Gagal', 'Password lama tidak diketahui');
            return back();
        }

        // Current password and new password same
        if (strcmp($request->get('current_password'), $request->password) == 0) {
            alert()->warning('Gagal', 'Password baru tidak boleh sama dengan password lama');
            return back();
        }

        //New password and confirm password are not same
        if (! (strcmp($request->get('password'), $request->get('password_confirmation'))) == 0) {
            alert()->warning('Gagal', 'Password baru harus sama dengan password anda yang dikonfirmasi');
            return back();
        }

        // updatean user
        $user = User::find($auth->id);
        $user->password = Hash::make($request->password_confirmation);
        $user->save();
        alert()->success('Sukses', 'Profile berhasil diupdate');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($id);
        $user = User::findOrFail($id);
        $this->validate($request, [
            'icon' => 'nullable|file|max:51200', // 50MB
        ]);
        // cari old photo
        $path_file = $user['icon'];

        // Upload process here
        if ($request->hasFile('icon')) {
            $files = $request->file('icon');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME).' - '.Str::random(3);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename.'.'.$extension;

            // Store new file
            $icon = $request->file('icon')->storeAs('assets/user-icon', $fullname);

            // Delete old file if it exists
            if (! empty($path_file) && Storage::exists($path_file)) {
                Storage::delete($path_file);
            }
        } else {
            $request['icon'] = $path_file;
        }

        $user->update([
            'icon' => $icon,
        ]);

        alert()->success('success', 'User has been updated successfully!');
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort(404);
    }
}
