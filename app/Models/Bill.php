<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    //
    protected $fillable = ['order_id', 'client_id', 'amount', 'bill_date'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function getProductAttribute()
    {
        return $this->order->product;
    }

    protected function validationRules(): array
    {
        return [
            'order_id' => 'required|exists:orders,id',
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric|min:0',
            'bill_date' => 'required|date',
        ];
    }

    protected function validationMessages(): array
    {
        return [
            'order_id.required' => 'El campo orden es requerido',
            'order_id.exists' => 'La orden no existe',
            'client_id.required' => 'El campo cliente es requerido',
            'client_id.exists' => 'El cliente no existe',
        ];
    }
}