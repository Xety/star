<?php

namespace App\Http\Controllers;

use App\Models\Repositories\StarRepository;
use App\Models\Star;
use App\Models\Validators\StarValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class StarController extends Controller
{
/**
     * Show the form for creating a new Star.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('star.create');
    }

    /**
     * Store a newly created Star in database.
     *
     * @param  \Illuminate\Http\Request $request The actual request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // Validate the data
        StarValidator::store($data)->validate();

        // Store the image.
        $path = $request->file('image')->store('images/stars');
        $data['image_path'] = $path;

        // Store the Star.
        StarRepository::store($data);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Your Star has been created successfully !');
    }

    /**
     * Display the specified Star.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $star = Star::findOrFail($id);

        return view('star.show', ['star' => $star]);
    }

    /**
     * Show the form for editing the specified Star.
     *
     * @param int $id The id of the Star to edit.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $star = Star::findOrFail($id);

        return view('star.edit', ['star' => $star]);
    }

    /**
     * Update the specified Star in database.
     *
     * @param \Illuminate\Http\Request $request The actual request.
     * @param int $id The id of the Star.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $star = Star::findOrFail($id);
        $data = $request->all();

        // Validate the data
        StarValidator::update($data)->validate();

        // Check if the image is present. If not that mean the user don't want to update it.
        if (!is_null($request->file('image'))) {
            // Remove the old file.
            $oldPath = storage_path('app/public/' . $star->image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            // Store the new file.
            $path = $request->file('image')->store('images/stars');
            $data['image_path'] = $path;
        }

        // Update the Star.
        StarRepository::update($data, $star);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Your Star has been updated successfully !');
    }

    /**
     * Remove the specified Star from database.
     *
     * @param int $id The id of the Star to delete.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $star = Star::findOrFail($id);

        if ($star->delete()) {
            // Remove the old file.
            $oldPath = public_path('images/stars/' . $star->image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            return redirect()
                ->route('dashboard')
                ->with('success', 'This Star has been deleted successfully !');
        }

        return redirect()
            ->route('dashboard')
            ->with('danger', 'An error occurred while deleting this Star !');
    }
}
