<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Order\Pages;

use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\Contracts\UI\FieldContract;
use App\Models\Client;
use App\Models\Product;
use App\MoonShine\Resources\Order\OrderResource;
use App\MoonShine\Resources\Client\ClientResource;
use App\MoonShine\Resources\Product\ProductResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Select;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use Throwable;


/**
 * @extends DetailPage<OrderResource>
 */
class OrderDetailPage extends DetailPage
{
    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make(),
            BelongsTo::make(
                'Cliente',
                'client',
                formatted: static fn (Client $model) => $model->name,
                resource: ClientResource::class,
            ),
            BelongsTo::make(
                'Producto',
                'product',
                formatted: static fn (Product $model) => $model->name,
                resource: ProductResource::class,
            ),
            Number::make('Cantidad', 'quantity'),
            Number::make('Total', 'total'),
            Date::make('Fecha de pedido', 'order_date')->format('d/m/Y'),
            Select::make('Estado', 'status')->options([
                'pendiente' => 'Pendiente',
                'confirmado' => 'Confirmado',
                'enviado' => 'Enviado',
                'entregado' => 'Entregado',
                'cancelado' => 'Cancelado',
            ]),
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
