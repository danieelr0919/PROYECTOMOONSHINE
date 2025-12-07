<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    //
    protected $fillable = ['name', 'email', 'phone', 'address'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getProductsAttribute()
    {
        return $this->orders->FlatMap(function ($order) {
            return $order->product;
        });
    }

    public function getTotalAttribute()
    {
        return $this->orders->sum('total');
    }

    public function getTotalBillsAttribute()
    {
        return $this->bills->sum('amount');
    }

    protected function validationRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ];
    }

    protected function validationMessages(): array
    {
        return [
            'name.required' => 'El campo nombre es requerido',
            'email.required' => 'El campo email es requerido',
            'email.email' => 'El campo email debe ser una dirección de email válida',
            'email.unique' => 'El email ya está en uso',
        ];
    }
}
