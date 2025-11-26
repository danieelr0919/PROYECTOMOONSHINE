<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Order\Pages;

use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\MoonShine\Resources\Order\OrderResource;
use App\MoonShine\Resources\Client\ClientResource;
use App\MoonShine\Resources\Product\ProductResource;
use App\Models\Client;
use App\Models\Product;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Select;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\UI\Components\Layout\Box;
use Throwable;


/**
 * @extends FormPage<OrderResource>
 */
class OrderFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                BelongsTo::make(
                    'Cliente',
                    'client',
                    formatted: static fn (Client $model) => $model->name,
                    resource: ClientResource::class,
                )
                    ->required()
                    ->creatable()
                    ->valuesQuery(static fn (Builder $q) => $q->select(['id', 'name'])),
                BelongsTo::make(
                    'Producto',
                    'product',
                    formatted: static fn (Product $model) => $model->name,
                    resource: ProductResource::class,
                )
                    ->required()
                    ->creatable()
                    ->valuesQuery(static fn (Builder $q) => $q->select(['id', 'name'])),
                Number::make('Cantidad', 'quantity')->required()->placeholder('Ingrese la cantidad del pedido'),
                Number::make('Total', 'total')->required()->placeholder('Ingrese el total del pedido'),
                Date::make('Fecha de pedido', 'order_date')->required()->placeholder('Ingrese la fecha de pedido'),
                Select::make('Estado', 'status')->required()->placeholder('Seleccione el estado del pedido')->options([
                    'pendiente' => 'Pendiente',
                    'confirmado' => 'Confirmado',
                    'enviado' => 'Enviado',
                    'entregado' => 'Entregado',
                    'cancelado' => 'Cancelado',
                ]),
            ]),
        ];
    }

    protected function buttons(): ListOf
    {
        return parent::buttons();
    }

    protected function formButtons(): ListOf
    {
        return parent::formButtons();
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [];
    }

    /**
     * @param  FormBuilder  $component
     *
     * @return FormBuilder
     */
    protected function modifyFormComponent(FormBuilderContract $component): FormBuilderContract
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
