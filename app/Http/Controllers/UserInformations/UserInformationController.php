<?php

namespace App\Http\Controllers\UserInformations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserInformation;
use Illuminate\Support\Facades\Auth;

class UserInformationController extends Controller
{
    public function index()
    {
        $userInformations = UserInformation::all();
        return view('userinformations.index', compact('userInformations'));
    }

    public function create()
    {
        return view('userinformations.create');
    }

    public function edit($id)
    {
        // Retrieve the authenticated user's information
        $userInformation = UserInformation::where('user_id', Auth::id())->findOrFail($id);
        
        return view('userinformations.edit', compact('userInformation'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Max size 10MB
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Max size 10MB
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:user_informations,email',
            'country' => 'required|string',
            'street_address' => 'required|string',
            'city' => 'required|string',
            'region' => 'required|string',
            'postal_code' => 'required|string',
        ]);

        // Handle file uploads
        $photoPath = null;
        $documentPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos');
        }

        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents');
        }

        // Create a new UserInformation instance and save it to the database
        $userId = Auth::id();

        // Create a new UserInformation instance and associate it with the authenticated user
        $userInformation = new UserInformation($validatedData);
        $userInformation->user_id = $userId;
        $userInformation->photo = $photoPath;
        $userInformation->document = $documentPath;
        $userInformation->save();

        return redirect()->route('userinformations.index')->with('success', 'User information saved successfully!');
    }

    public function update(Request $request, $id)
    {

        $userInformation = UserInformation::findOrFail($id);


        $validatedData = $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', 
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:user_informations,email,'.$userInformation->id,
            'country' => 'required|string',
            'street_address' => 'required|string',
            'city' => 'required|string',
            'region' => 'required|string',
            'postal_code' => 'required|string',
        ]);

        $photoPath = $userInformation->photo;
        $documentPath = $userInformation->document;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos');
        }

        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents');
        }

      
        $userInformation->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'country' => $validatedData['country'],
            'street_address' => $validatedData['street_address'],
            'city' => $validatedData['city'],
            'region' => $validatedData['region'],
            'postal_code' => $validatedData['postal_code'],
            'photo' => $photoPath,
            'document' => $documentPath,
        ]);

    
        return redirect()->route('userinformations.index')->with('success', 'User information updated successfully!');
    }
}
