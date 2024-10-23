<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required'
        ]);

        if ($request->file('photo')) {
            $manager = new ImageManager(new Driver());
            $image = $request->file('photo');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $img = $manager->read($image);
            $img = $img->resize(300, 200);

            $img->toJpeg(80)->save(public_path('uploads/' . $imageName));
            $imagePath = 'uploads/' . $imageName;

            Company::create([
                'name' => $request->name,
                'logo_path' => $imagePath,
                'status' => $request->status 
            ]);
        }

        return redirect()->route('companies.index')->with('success', 'Company successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::find($id);

        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required'
        ]);

        if ($request->file('photo')) {
            $manager = new ImageManager(new Driver());
            $image = $request->file('photo');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $img = $manager->read($image);
            $img = $img->resize(300, 200);

            $img->toJpeg(80)->save(public_path('uploads/' . $imageName));
            $imagePath = 'uploads/' . $imageName;

            $company = Company::find($id);
            $company->name = $request->name;
            $company->logo_path = $imagePath;
            $company->status = $request->status;
            $company->save();
        } else {
            $company = Company::find($id);
            $company->name = $request->name;
            $company->status = $request->status;
            $company->save();
        }

        return redirect()->route('companies.index')->with('success', 'Company successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
