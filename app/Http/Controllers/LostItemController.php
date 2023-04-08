<?php

namespace App\Http\Controllers;

use App\Models\LostItem;
use Illuminate\Http\Request;

class LostItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
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
        $lostItem = LostItem::create([
            'name' => $validatedData['name'],
            'note' => $validatedData['note'],
            'description' => $validatedData['description'],
            'phone_number' => $validatedData['phone_number'],
            'date_time' => $validatedData['date_time'],
            'returned' => $validatedData['returned'],
            'lost_by' => $validatedData['lost_by'],
        ]);
        $lostItem["lost_by"] = $this->get_user($lostItem["lost_by"]);
        return response()->json(["success" => true, "data" => $lostItem, "message" => "Lost item created successfully"]);
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
    public function show(LostItem $lostItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LostItem $lostItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LostItem $lostItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LostItem $lostItem)
    {
        //
    }
}