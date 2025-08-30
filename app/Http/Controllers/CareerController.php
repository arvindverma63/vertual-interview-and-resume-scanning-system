<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CareerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'company'      => 'nullable|string|max:255',
            'current_ctc'  => 'nullable|numeric',
            'expected_ctc' => 'nullable|numeric',
            'image'        => 'required',
            'resume'       => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $careerData = $request->only([
            'name',
            'email',
            'company',
            'current_ctc',
            'expected_ctc',
        ]);

        // Handle image (base64)
        if ($request->image) {
            $imageData = $request->image;
            $imageName = 'career_' . time() . '.png';
            $imagePath = 'uploads/careers/' . $imageName;
            // remove base64 header
            $imageData = preg_replace('/^data:image\/\w+;base64,/', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            Storage::disk('public')->put($imagePath, base64_decode($imageData));
            $careerData['image'] = $imagePath;
        }

        // Handle resume
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('uploads/resumes', 'public');
            $careerData['resume'] = $resumePath;
        }

        Career::create($careerData);

        return back()->with('success', 'Career application submitted successfully!');
    }
}
