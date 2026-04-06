<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
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
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        /**
         * =========================
         * HAPUS FOTO (PRIORITAS)
         * =========================
         */
        if ($request->has('remove_photo')) {

            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
                $user->photo = null;
                $user->save();
            }

            return redirect()->back()->with('status', 'profile-updated');
        }

        /**
         * =========================
         * UPDATE DATA PROFILE
         * =========================
         */
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        /**
         * =========================
         * UPLOAD FOTO (CROPPER / BASE64)
         * =========================
         */
        if ($request->photo_base64) {

            // hapus foto lama
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            $image = $request->photo_base64;

            // hapus prefix base64
            $image = preg_replace('/^data:image\/\w+;base64,/', '', $image);

            $image = base64_decode($image);

            $fileName = 'profile/' . Str::random(20) . '.jpg';

            Storage::disk('public')->put($fileName, $image);

            $user->photo = $fileName;
        }

        /**
         * =========================
         * UPLOAD FOTO BIASA (fallback)
         * =========================
         */
        elseif ($request->hasFile('photo')) {

            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            $user->photo = $request->file('photo')
                ->store('profile', 'public');
        }

        $user->save();

        return redirect()->back()->with('status', 'profile-updated');
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

        // Logout user
        Auth::logout();

        // Hapus foto jika ada
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        // Hapus user
        $user->delete();

        // Reset session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}