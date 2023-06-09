<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostItem extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "note",
        "description",
        "phone_number",
        "date_time",
        "returned",
        "lost_by",
    ];
}