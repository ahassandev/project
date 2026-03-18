<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\About;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        return Inertia::render('About', [
            'about' => $about
        ]);
    }

    public function edit()
    {
        $about = About::first();
        return Inertia::render('about/Edit', [
            'about' => $about
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'mission_title' => 'required|string|max:255',
            'mission_content' => 'required|string',
            'vision_title' => 'required|string|max:255',
            'vision_content' => 'required|string',
            'team_content' => 'required|string',
            'standards_content' => 'required|string',
            'excellence_content' => 'required|string',
            'professional_statement' => 'required|string',
            'hero_image' => 'nullable|file|image|max:5120',
            'expertise_label' => 'required|string|max:255',
            'expertise_title' => 'required|string|max:255',
            'expertise_subtitle' => 'nullable|string',
            'expertise_description' => 'nullable|string',
            'expertise_image' => 'nullable|file|image|max:5120',
            'expertise_experience_years' => 'required|string|max:255',
            'expertise_services' => 'required|array',
            'expertise_services.*' => 'required|string|max:255',
        ]);

        $about = About::first();
        
        $data = $validated;
        
        if ($request->hasFile('hero_image')) {
            if ($about->hero_image) {
                Storage::disk('public')->delete($about->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')->store('about', 'public');
        } else {
            unset($data['hero_image']);
        }

        if ($request->hasFile('expertise_image')) {
            if ($about->expertise_image) {
                Storage::disk('public')->delete($about->expertise_image);
            }
            $data['expertise_image'] = $request->file('expertise_image')->store('about', 'public');
        } else {
            unset($data['expertise_image']);
        }

        $about->update($data);

        return redirect()->back()->with('success', 'About page updated successfully.');
    }
}
