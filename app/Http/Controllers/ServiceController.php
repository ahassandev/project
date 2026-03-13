<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Service;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('services/Index', [
            'services' => Service::query()
                ->with(['images', 'parent'])
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('title', 'like', "%{$search}%");
                })
                ->get(),
            'filters' => $request->only(['search']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('services/Create', [
            'parentServices' => Service::all(['id', 'title'])
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return Inertia::render('services/Show', [
            'service' => $service->load(['images', 'parent', 'children'])
        ]);
    }

    /**
     * Display the specified resource for the public view via slug.
     */
    public function publicShow(string $slug)
    {
        $service = Service::where('slug', $slug)->with(['images', 'children.children'])->firstOrFail();

        return Inertia::render('services/PublicShow', [
            'service' => $service,
            // also load all top-level services that are marked as is_top for the header menu to work on this page too
            'services' => \App\Models\Service::whereNull('parent_id')->where('is_top', true)->with('children.children')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'parent_id' => 'nullable|exists:services,id',
            'images' => 'nullable|array',
            'images.*' => 'image|max:10240',
            'is_top' => 'boolean',
        ]);

        $isTop = $request->boolean('is_top');

        if ($isTop) {
            if (!empty($validated['parent_id'])) {
                return back()->withErrors(['is_top' => 'Only top-level services can be marked as top menu items.'])->withInput();
            }

            if (Service::where('is_top', true)->count() >= 2) {
                return back()->withErrors(['is_top' => 'Only 2 services can be set as top services.'])->withInput();
            }
        }

        $service = Service::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'parent_id' => $validated['parent_id'] ?? null,
            'is_top' => $isTop,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('services', 'public');
                $service->images()->create(['image_path' => $path]);

                // Set the first image as the main image_path for backward compatibility/thumbnail
                if (!$service->image_path) {
                    $service->update(['image_path' => $path]);
                }
            }
        } elseif ($request->has('images') && !empty($request->images)) {
            // Checking for potential file upload error (size limit etc)
            if (count($request->allFiles()) === 0 && count($request->images) > 0) {
                return back()->withErrors(['images' => 'The image upload failed. Please try smaller files.']);
            }
        }

        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return Inertia::render('services/Edit', [
            'service' => $service->load('images'),
            'parentServices' => Service::where('id', '!=', $service->id)->get(['id', 'title'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'parent_id' => 'nullable|exists:services,id',
            'images' => 'nullable|array',
            'images.*' => 'image|max:10240',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'integer',
            'is_top' => 'boolean',
        ]);

        $isTop = $request->boolean('is_top');

        if ($isTop) {
            if (!empty($validated['parent_id'])) {
                return back()->withErrors(['is_top' => 'Only top-level services can be marked as top menu items.'])->withInput();
            }

            if (Service::where('is_top', true)->where('id', '!=', $service->id)->count() >= 2) {
                return back()->withErrors(['is_top' => 'Only 2 services can be set as top services.'])->withInput();
            }
        }

        $service->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'parent_id' => $validated['parent_id'] ?? null,
            'is_top' => $isTop,
        ]);

        // Delete requested images
        if ($request->has('delete_images')) {
            foreach ($validated['delete_images'] as $imageId) {
                $image = $service->images()->find($imageId);
                if ($image) {
                    Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }
        }

        // Upload new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('services', 'public');
                $service->images()->create(['image_path' => $path]);
            }
        }

        // Update main image_path if it was deleted or is null
        if (!$service->image_path || !Storage::disk('public')->exists($service->image_path)) {
            $firstImage = $service->images()->first();
            $service->update(['image_path' => $firstImage ? $firstImage->image_path : null]);
        }

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        foreach ($service->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }

    /**
     * Get top services for the public menu.
     */
    public function topMenu()
    {
        return response()->json(
            Service::where('is_top', true)
                ->whereNull('parent_id')
                ->with('children.children')
                ->get()
        );
    }
}
