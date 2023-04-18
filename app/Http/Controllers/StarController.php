<?php

namespace App\Http\Controllers;

use App\Models\Repositories\StarRepository;
use App\Models\Star;
use App\Models\Validators\StarValidator;
use Illuminate\Http\Request;

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
        // Validate the data
        StarValidator::store($request->all())->validate();

        // Rename the file and move it to the final path.
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/stars'), $imageName);

        // Store the Star.
        StarRepository::store($request->all(), $imageName);

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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified Star in storage.
     *
     * @param \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
            return redirect()
                ->route('dashboard')
                ->with('success', 'This Star has been deleted successfully !');
        }

        return redirect()
            ->route('dashboard')
            ->with('danger', 'An error occurred while deleting this Star !');
    }
}
