<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Reservation extends Model
{
    protected $data;

    public function __construct()
    {
        $this->data = json_decode(
            Storage::disk('local')->get('reservation.json'),
            true,
            512,
            JSON_OBJECT_AS_ARRAY
        ) ?? [];
    }

    public function getData()
    {
        return $this->data;
    }

    public function saveData(array $reservations)
    {
        Storage::disk('local')->put('reservation.json', json_encode($reservations));
    }
}
