<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['member_id', 'date_start', 'date_end', 'status'];

    use HasFactory;

    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'member_id');
    }

    public function transactionDetail()
    {
        return $this->hasOne('App\Models\TransactionDetail', 'id');
    }
}
