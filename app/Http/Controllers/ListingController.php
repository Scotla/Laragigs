<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // dd(Listing::latest()->filter(request(['taggy','search']))->paginate(6));
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['taggy', 'search']))->simplePaginate(10) //can also use paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('listings.create');;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        //
        // dd($request->company);
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        } else {
            $formFields['logo'] = "";
        }
        $formFields['user_id'] = auth()->id();
        Listing::create($formFields);

        return redirect('/listings')->with('message', 'Details entered successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        //
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        //
        return view('listings.edit', [
            'listing' => $listing
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized action');
        }
        //
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        } else {
            $formFields['logo'] = "";
        }
        $listing->update($formFields);

        // return redirect('/listings')->with('message', 'Details updated successfully');
        return back()->with('message', 'Details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        //
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized action');
        }
        $listing->delete();

        return redirect('/listings')->with('message', 'Record has been successfully removed');
    }
    public function manage()
    {
        return view('listings.manage', [
            'listings' => auth()->user()->listings()->get()
        ]);
    }
}
