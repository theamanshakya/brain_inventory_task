<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $table = "trip";

    protected $fillable = [
        "id", 
        "trip_name", 
        "trip_type", 
        "status", 
        "trip_status", 
        "booking_cost", 
        "commission_cost", 
        "trip_date", 
        "booking_date", 
        "created_at", 
        "updated_at"
    ];
}
