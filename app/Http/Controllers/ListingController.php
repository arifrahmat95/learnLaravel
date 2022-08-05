<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //All listing
    public function index()
    {
        //dd(request()->tag); sama je dngn yg bawah
        // dd(request('tag'));
        return view('listings.index', [
            // paginate tu boleh tukar ke simplePaginate untuk tunjuk arrow depan blakang
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(4)
        ]);
    }

    //Single listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    //create form
    public function create(Listing $listing)
    {
        return view('listings.create');
    }

    //store listing data 
    public function store(Request $request)
    {
        // dd($request->all());
        //kne masukkan fillable dalam model. (pegi listing model)
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'], //email depan tu untuk email pnya format
            'tags' => 'required',
            'description' => 'required',

        ]);

        //upload file
        if ($request->hasFile('logo')) {
            //logos tu nama folder
            //public tu nak jadikan image tu public. kne set kat config/filesystems
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        //add ownership to the listing
        $formFields['user_id'] = auth()->id();

        //save to database
        Listing::create($formFields);

        //message tu boleh ganti dngn success/error 
        //kne buat page kat components
        return redirect('/')->with('message', 'Listing created succesfully!');
    }

    //show edit form
    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    //update listing data 
    public function update(Request $request, Listing $listing)
    {

        //Make sure logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'], //email depan tu untuk email pnya format
            'tags' => 'required',
            'description' => 'required',

        ]);

        //upload file
        if ($request->hasFile('logo')) {
            //logos tu nama folder
            //public tu nak jadikan image tu public. kne set kat config/filesystems
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        //update to database
        $listing->update($formFields);

        //message tu boleh ganti dngn success/error 
        //kne buat page kat components
        return back()->with('message', 'Listing updated succesfully!');
    }

    //delete listing
    public function destroy(Listing $listing)
    {

        //Make sure logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted succesfully');
    }

    //manage listing
    public function manage()
    {
        // dd(auth()->user()->listings()->get());
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
// common resource routes:
// index - show all listing
// show - show single listing
// create - show form to create new Listing
// store - store new Listing
// edit - show form to edit listing
// update - update listing
// destroy - delete listing