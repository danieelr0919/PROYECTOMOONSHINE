<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Bill;

use App\Models\Bill;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\MoonShine\Resources\Bill\Pages\BillIndexPage;
use App\MoonShine\Resources\Bill\Pages\BillFormPage;
use App\MoonShine\Resources\Bill\Pages\BillDetailPage;
use App\MoonShine\Resources\Order\OrderResource;
use App\MoonShine\Resources\Client\ClientResource;
use App\MoonShine\Resources\Product\ProductResource;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Text;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

/**
 * @extends ModelResource<Bill, BillIndexPage, BillFormPage, BillDetailPage>
 */
class BillResource extends ModelResource
{ 
    protected string $model = Bill::class;

    protected string $title = 'Facturas';

    /**
     * Carga automáticamente las relaciones necesarias para evitar consultas N+1
     * Esto optimiza el rendimiento al cargar order, order.product y client de una vez
     */
    protected array $with = ['order.product', 'order', 'client'];

    public function fields(): array
    {
        return [
            BelongsTo::make(
                'Pedido',
                'order',
                formatted: static fn (Order $model) => "Pedido #{$model->id}" . ($model->client ? " - {$model->client->name}" : ''),
                resource: OrderResource::class,
            )->required(),
            BelongsTo::make(
                'Cliente',
                'client',
                formatted: static fn (Client $model) => $model->name,
                resource: ClientResource::class,
            )->required(),
            // Muestra el producto a través de la relación order->product
            // Usa la ruta anidada para acceder al producto del pedido
            Text::make('Producto', 'order.product.name')
                ->hideOnForm() // No se muestra en el formulario (se obtiene del pedido)
                ->translatable(false),
            // Precio del producto
            Number::make('Precio', 'order.product.price')
                ->hideOnForm(), // No se muestra en el formulario (se obtiene del pedido) 
            // Cantidad de productos comprados (del pedido)
            Number::make('Cantidad', 'order.quantity')
                ->hideOnForm(), // No se muestra en el formulario (se obtiene del pedido)
            // Total de la factura
            Number::make('Total', 'amount')->required(),
            Date::make('Fecha de factura', 'bill_date')->required()->date(),
        ];
    }
    
    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            BillIndexPage::class,
            BillFormPage::class,
            BillDetailPage::class,
        ];
    }
}
