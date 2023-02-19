<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListController extends Controller
{
    public function index()
    {
        return view('listings.index', [
            'listings' => Listing::latest('updated_at')
            ->filter(request(['tag', 'search']))
            ->paginate(4)
        ]);
    }

    public function show(Listing $listing)
    {
        return view('listings.show', [
            'list' => $listing
        ]);
    }

    public function create()
    {
        return view('listings.create');
    }

    public function store(Request $request){
        $formFields = $request->validate([
            "company" => ["required", Rule::unique('listings', 'company')],
            "title" => "required",
            "location" => "required",
            "email" => ["required", "email"],
            "website" => "required",
            "tags" => "required",
            "description" => 'required',
        ]);
        
        
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();
        
        Listing::create($formFields);

        return redirect('/')->with('success', 'Listing created successfully!');
    }

    public function edit(Listing $listing)
    {
        if($listing->user_id != auth()->id()){
            abort(403, "You don't have authorization for this action!");
        }

        return view('listings.edit', [
            'listing' => $listing
        ]);
    }

    public function update(Request $request, Listing $listing){
        if($listing->user_id != auth()->id()){
            abort(403, "You don't have authorization for this action!");
        }

        $formFields = $request->validate([
            "company" => ["required", Rule::unique('listings', 'company')],
            "title" => "required",
            "location" => "required",
            "email" => ["required", "email"],
            "website" => "required",
            "tags" => "required",
            "description" => 'required',
        ]);
        
        
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        
        $listing->update($formFields);

        return redirect("/")->with('success', 'Listing updated successfully!');
    }

    public function destroy(Listing $listing){
        if($listing->user_id != auth()->id()){
            abort(403, "You don't have authorization for this action!");
        }

        $listing->delete();
        return redirect('/listings/manage')->with('success', 'Listing deleted successfully!');
    }

    public function manage(){
        return view('listings.manage', [
            "listings" => auth()->user()
            ->listings()->get()
        ]);
    }
}
