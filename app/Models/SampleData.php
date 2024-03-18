<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SampleData extends Model
{
    protected $data;

    public function __construct()
    {
        $this->data = json_decode(
            Storage::disk('local')->get('sampleData.json'),
            true,
            512,
            JSON_OBJECT_AS_ARRAY
        ) ?? [];
    }

    public function getData()
    {
        return collect($this->data);
    }
}
