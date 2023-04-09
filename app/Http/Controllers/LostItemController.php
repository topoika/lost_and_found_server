<?php

namespace App\Http\Controllers;

use App\Models\LostItem;
use Illuminate\Http\Request;

class lost_itemController extends Controller
{
    public function index()
    {
        $data = [];
        $items = LostItem::where('returned', 0)->get();
        foreach ($items as $item) {
            $item["lost_by"] = $this->get_user($item["lost_by"]);
            array_push($data, $item);
        }
        return response()->json(["success" => true, "data" => $data, "message" => "Lost items retrieved successfully"]);
    }
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'note' => 'required|string',
            'description' => 'required|string',
            'phone_number' => 'required|string',
            'date_time' => 'required|date',
            'returned' => '',
            'lost_by' => 'required|integer',
        ]);
        $lost_item = LostItem::create([
            'name' => $validatedData['name'],
            'note' => $validatedData['note'],
            'description' => $validatedData['description'],
            'phone_number' => $validatedData['phone_number'],
            'date_time' => $validatedData['date_time'],
            'returned' => $validatedData['returned'],
            'lost_by' => $validatedData['lost_by'],
        ]);
        $lost_item["lost_by"] = $this->get_user($lost_item["lost_by"]);
        return response()->json(["success" => true, "data" => $lost_item, "message" => "Lost item created successfully"]);
    }
    public function edit($id)
    {
        $lost_item = LostItem::findOrFail($id);
        $lost_item->returned = true;
        $lost_item->save();
        $lost_item["lost_by"] = $this->get_user($lost_item["lost_by"]);
        return response()->json(["success" => true, "data" => $lost_item, "message" => "Item updated successfully"]);
    }
    public function destroy($id)
    {
        $lost_item = LostItem::findOrFail($id);
        $lost_item->delete();
        return response()->json(["message" => "Item deleted successfully"]);
    }
}