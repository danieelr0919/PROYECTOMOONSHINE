<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Order;

use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\MoonShine\Resources\Order\Pages\OrderIndexPage;
use App\MoonShine\Resources\Order\Pages\OrderFormPage;
use App\MoonShine\Resources\Order\Pages\OrderDetailPage;
use App\MoonShine\Resources\Client\ClientResource;
use App\MoonShine\Resources\Product\ProductResource;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Select;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

/**
 * @extends ModelResource<Order, OrderIndexPage, OrderFormPage, OrderDetailPage>
 */
class OrderResource extends ModelResource
{
    protected string $model = Order::class;

    protected string $title = 'Pedidos';

    public function fields(): array
    {
        return [
            BelongsTo::make(
                'Cliente',
                'client',
                formatted: static fn (Client $model) => $model->name,
                resource: ClientResource::class,
            )->required(),
            BelongsTo::make(
                'Producto',
                'product',
                formatted: static fn (Product $model) => $model->name,
                resource: ProductResource::class,
            )->required(),
            Number::make('Cantidad', 'quantity')->required(),
            Number::make('Total', 'total')->required(),
            Date::make('Fecha de pedido', 'order_date')->required()->format('d/m/Y'),
            Select::make('Estado', 'status')->required()->options([
                'pendiente' => 'Pendiente',
                'confirmado' => 'Confirmado',
                'enviado' => 'Enviado',
                'entregado' => 'Entregado',    
                'cancelado' => 'Cancelado',
            ]),
        ];
    }
    
    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            OrderIndexPage::class,
            OrderFormPage::class,
            OrderDetailPage::class,
        ];
    }
}
