<?php

namespace App\Http\Controllers;

use App\Models\Repositories\StarRepository;
use App\Models\Star;
use App\Models\Validators\StarValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

        // Rename the file and move it to the final path.
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/stars'), $imageName);

        $data['image_name'] = $imageName;

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
        //
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
            $oldPath = public_path('images/stars/' . $star->image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            // Rename the file and move it to the final path.
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/stars'), $imageName);

            $data['image_name'] = $imageName;
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
