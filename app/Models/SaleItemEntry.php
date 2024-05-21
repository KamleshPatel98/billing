<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItemEntry extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function saleEntry(){
        return $this->belongsTo(SaleEntry::class);
    }
}
