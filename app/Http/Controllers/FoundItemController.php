<?php

namespace App\Http\Controllers;

use App\Models\FoundItem;
use Illuminate\Http\Request;

class FoundItemController extends Controller
{
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
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
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
        $found_item = new FoundItem();
        $found_item->name = $validatedData['name'];
        $found_item->description = $validatedData['description'];
        $found_item->phone_number = $validatedData['phone_number'];
        $found_item->image = $imageName;
        $found_item->date_found = $validatedData['date_found'];
        $found_item->location_found = $validatedData['location_found'];
        $found_item->current_location = $validatedData['current_location'];
        $found_item->found_by = $validatedData['found_by'];
        $found_item->save();
        $found_item["found_by"] = $this->get_user($found_item["found_by"]);
        return response()->json(["success" => true, "data" => $found_item, "message" => "Found item created successfully"]);
    }
    public function edit($id)
    {
        $found_item = FoundItem::findOrFail($id);
        $found_item->returned = true;
        $found_item->save();
        $found_item["found_by"] = $this->get_user($found_item["found_by"]);
        return response()->json(["success" => true, "data" => $found_item, "message" => "Item updted successfully"]);
    }
    public function destroy($id)
    {
        try {
            $found_item = FoundItem::findOrFail($id);
            $found_item->delete();
            return response()->json(["message" => "Item deleted successfully"]);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Item has already been deleted"]);
        }

    }
}