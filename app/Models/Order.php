<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = ['client_id', 'product_id', 'quantity', 'total', 'order_date', 'status'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    protected function validationRules(): array
    {
        return [
            'client_id' => 'required|exists:clients,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ];
    }

    protected function validationMessages(): array
    {
        return [
            'client_id.required' => 'El campo cliente es requerido',
            'client_id.exists' => 'El cliente no existe',
            'product_id.required' => 'El campo producto es requerido',
            'product_id.exists' => 'El producto no existe',
        ];
    }
}
