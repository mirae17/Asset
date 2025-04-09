<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Asset;
use App\Notifications\AssetNotification;
use Illuminate\Support\Facades\Notification;

class UserAssetController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $assets = $user->assets; // Fetch only the assets of the logged-in user
        return view('userAsset.index', compact('assets'));
    }

    public function create()
    {
        return view('userAsset.create');
    }

    public function store(Request $request)
    {
        // Define common validation rules
        $commonRules = [
            'type' => 'required|string|max:255',
            'date' => 'required|date',
            'value' => 'required|numeric', // Ensure value is validated
            'longitude' => 'nullable|numeric',
            'latitude' => 'nullable|numeric',
        ];

        // Conditional rules
        if ($request->input('type') === 'land') {
            $commonRules['address'] = 'nullable|string|max:255';
            if (!$request->has('longitude') || !$request->has('latitude')) {
                $commonRules['address'] = 'required|string|max:255';
            }
        } else {
            $commonRules['address'] = 'required|string|max:255';
        }

        // Validate the request
        $request->validate($commonRules);

        // Create a new asset
        $asset = new Asset();
        $asset->type = $request->type;
        $asset->address = $request->address;
        $asset->date = $request->date;
        $asset->value = $request->value;
        $asset->longitude = $request->longitude;
        $asset->latitude = $request->latitude;
        $asset->user_id = Auth::id(); // Set the user_id based on the authenticated user
        $asset->save();

        // Notify users and family members about the created asset
        $this->sendAssetNotification($asset, 'created');

        return redirect()->route('userAsset.index')->with('success', 'Asset created successfully.');
    }

    public function show(Asset $asset)
    {
        // Ensure the asset belongs to the authenticated user
        if ($asset->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('userAsset.show', compact('asset'));
    }

    public function edit(Asset $asset)
    {
        // Ensure the asset belongs to the authenticated user
        if ($asset->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('userAsset.edit', compact('asset'));
    }

    public function update(Request $request, Asset $asset)
    {
        // Ensure the asset belongs to the authenticated user
        if ($asset->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Define common validation rules
        $commonRules = [
            'type' => 'required|string|max:255',
            'date' => 'required|date',
            'value' => 'required|numeric', // Ensure value is validated
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ];

        // Conditional rules
        if ($request->input('type') === 'land') {
            $commonRules['address'] = 'nullable|string|max:255';
            if (!$request->has('longitude') || !$request->has('latitude')) {
                $commonRules['address'] = 'required|string|max:255';
            }
        } else {
            $commonRules['address'] = 'required|string|max:255';
        }

        // Validate the request
        $request->validate($commonRules);

        // Update asset fields
        $asset->type = $request->type;
        $asset->address = $request->address;
        $asset->date = $request->date;
        $asset->value = $request->value;
        $asset->longitude = $request->longitude;
        $asset->latitude = $request->latitude;
        $asset->save();

        // Notify users and family members about the updated asset
        $this->sendAssetNotification($asset, 'updated');

        return redirect()->route('userAsset.index')->with('success', 'Asset updated successfully.');
    }

    public function destroy(Asset $asset)
    {
        // Ensure the asset belongs to the authenticated user
        if ($asset->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $asset->delete();

        // Notify users and family members about the deleted asset
        $this->sendAssetNotification($asset, 'deleted');

        return redirect()->route('userAsset.index')->with('success', 'Asset deleted successfully.');
    }

    protected function sendAssetNotification($asset, $action)
    {
        // Get the authenticated user
        $currentUser = Auth::user();

        // Retrieve assigned family members
        $users = $currentUser->assignedFamilyMembers()->get();

        // Add the current user to recipients
        $recipients = $users->push($currentUser);

        // Send notification
        Notification::send($recipients, new AssetNotification($asset, $action));
    }
}
