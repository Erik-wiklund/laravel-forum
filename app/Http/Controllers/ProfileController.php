<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{

    public function index(string $userId)
    {
        $user = User::find($userId);
        return view('profile.index', compact('user'));
    }

    public function show(User $user)
    {
        return view('profile.show_modal', compact('user'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, string $userId)
    {
        $image = '';
        $imageFileName = '';
        $newImageFileName = '';

        if ($request->image) {
            $image = $request->image;
            $imageFileName = $image->getClientOriginalName();
            $newImageFileName = time() . $imageFileName;

            // Move the uploaded image to the public/images folder with the new filename
            $imagePath = public_path('images/' . $newImageFileName);
            $request->image->move(public_path('images'), $newImageFileName);

            // Open the uploaded image using Intervention Image and resize it to fit within a 300x300 pixel box
            Image::make($imagePath)->fit(300, 300)->save($imagePath);
        }

        $user = User::find($userId);

        if ($request->filled('email')) {
            $user->email = $request->email;
        }

        if ($request->image) {
            $user->image = $newImageFileName;
        }

        $user->save();

        Session::flash('message', 'User updated successfully');
        Session::flash('alert-class', 'alert-success');

        return back();
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
