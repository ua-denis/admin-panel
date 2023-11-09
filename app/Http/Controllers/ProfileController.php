<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilePhotoRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Repositories\Eloquent\UserRepository;
use App\Services\PhotoUploadService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function __construct(private UserRepository $userRepository, private PhotoUploadService $photoUploadService)
    {

    }

    public function show(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function edit(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = $request->user();
        $this->userRepository->update($user->id, $request->validated());
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }

    public function uploadPhoto(ProfilePhotoRequest $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->avatar) {
            $this->photoUploadService->deleteOldPhoto($user->avatar);
        }

        $path = $this->photoUploadService->upload($request->file('photo'));

        $this->userRepository->update($user->id, ['avatar' => $path]);

        return redirect()->route('profile.show')->with('success', 'Profile photo updated successfully.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::guard('web')->logout();

        $this->userRepository->delete($user->id);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
