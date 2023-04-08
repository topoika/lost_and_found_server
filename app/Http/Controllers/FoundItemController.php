<?php

namespace App\Http\Controllers;

use App\Models\FoundItem;
use Illuminate\Http\Request;

class FoundItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $items = FoundItem::where('returned', 0)->get();
        foreach ($items as $item) {
            $item["found_by"] = $this->get_user($item["found_by"]);
            array_push($data, $item);
        }
        return response()->json(["success" => true, "data" => $data, "message" => "Found items retrieved successfully"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'note' => '',
            'description' => 'required|string',
            'phone_number' => 'required|string',
            'image' => 'required|image|max:2048',
            'date_found' => 'required|date',
            'location_found' => 'required|string',
            'current_location' => 'required|string',
            'found_by' => 'required|integer',
        ]);
        $image = $request->file('image');
        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/images', $imageName);
        $foundItem = new FoundItem();
        $foundItem->name = $validatedData['name'];
        $foundItem->note = $validatedData['note'];
        $foundItem->description = $validatedData['description'];
        $foundItem->phone_number = $validatedData['phone_number'];
        $foundItem->image = $imageName;
        $foundItem->date_found = $validatedData['date_found'];
        $foundItem->location_found = $validatedData['location_found'];
        $foundItem->current_location = $validatedData['current_location'];
        $foundItem->found_by = $validatedData['found_by'];
        $foundItem->save();
        $foundItem["found_by"] = $this->get_user($foundItem["found_by"]);
        return response()->json(["success" => true, "data" => $foundItem, "message" => "Found item created successfully"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FoundItem $foundItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoundItem $foundItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FoundItem $foundItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoundItem $foundItem)
    {
        //
    }
}