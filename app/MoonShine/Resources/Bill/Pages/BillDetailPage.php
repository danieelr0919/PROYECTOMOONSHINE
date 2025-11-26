<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Bill\Pages;

use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\Contracts\UI\FieldContract;
use App\Models\Order;
use App\Models\Client;
use App\MoonShine\Resources\Bill\BillResource;
use App\MoonShine\Resources\Order\OrderResource;
use App\MoonShine\Resources\Client\ClientResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Text;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use Throwable;


/**
 * @extends DetailPage<BillResource>
 */
class BillDetailPage extends DetailPage
{
    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make(),
            BelongsTo::make(
                'Pedido',
                'order',
                formatted: static fn (Order $model) => "Pedido #{$model->id}" . ($model->client ? " - {$model->client->name}" : ''),
                resource: OrderResource::class,
            ),
            BelongsTo::make(
                'Cliente',
                'client',
                formatted: static fn (Client $model) => $model->name,
                resource: ClientResource::class,
            ),
            // Muestra el producto a través de la relación order->product
            // Usa Text para mostrar el nombre del producto desde la relación anidada
            Text::make('Producto', 'order.product.name'),
            // Precio del producto
            Number::make('Precio', 'order.product.price'), 
            // Cantidad de productos comprados (del pedido)
            Number::make('Cantidad', 'order.quantity'),
            // Total de la factura
            Number::make('Total', 'amount'), 
            Date::make('Fecha de factura', 'bill_date'),
        ];
    }

    protected function buttons(): ListOf
    {
        return parent::buttons();
    }

    /**
     * @param  TableBuilder  $component
     *
     * @return TableBuilder
     */
    protected function modifyDetailComponent(ComponentContract $component): ComponentContract
    {
        return $component;
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer()
        ];
    }
}
