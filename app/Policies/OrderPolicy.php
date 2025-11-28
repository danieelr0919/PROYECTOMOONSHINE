<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role == 'admin' || $user->role == 'empleado';
    }

    public function view(User $user, Order $order): bool
    {
        // Cliente solo ve SUS pedidos, admin/empleados ven todos
        return $user->role == 'admin' || 
                $user->role == 'empleado' || 
                ($user->role == 'cliente' && $order->client_id == $user->id);
    }

    public function create(User $user): bool
    {
        // ✅ Clientes también pueden crear pedidos
        return $user->role == 'admin' || 
                $user->role == 'empleado' || 
                $user->role == 'cliente';
    }

    public function update(User $user, Order $order): bool
    {
        // Solo admin/empleados editan pedidos
        return $user->role == 'admin' || $user->role == 'empleado';
    }

    public function delete(User $user, Order $order): bool
    {
        return $user->role == 'admin'; // Solo admin borra pedidos
    }
}