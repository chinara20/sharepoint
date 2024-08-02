<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['id', 'name', 'src', 'type'];

    
    public function getTypeAttribute($value)
    {
        switch ($value) {
            case 0:
                return 'Digər';
                break;
            case 1:
                return 'PDF';
                break;
            case 2:
                return 'DOCX';
                break;
            case 3:
                return 'XLSX';
                break;
        }
    }
}
