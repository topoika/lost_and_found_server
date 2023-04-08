<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoundItem extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "note",
        "description",
        "phone_number",
        "image",
        "date_found",
        "location_found",
        "current_location",
        "found_by",
    ];
}