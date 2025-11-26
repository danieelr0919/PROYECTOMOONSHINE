<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Bill\Pages;

use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\MoonShine\Resources\Bill\BillResource;
use App\MoonShine\Resources\Order\OrderResource;
use App\MoonShine\Resources\Client\ClientResource;
use App\Models\Order;
use App\Models\Client;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Date;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\UI\Components\Layout\Box;
use Throwable;


/**
 * @extends FormPage<BillResource>
 */
class BillFormPage extends FormPage
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
                    'Pedido',
                    'order',
                    formatted: static fn (Order $model) => "Pedido #{$model->id}" . ($model->client ? " - {$model->client->name}" : ''),
                    resource: OrderResource::class,
                )
                    ->required()
                    ->valuesQuery(static fn (Builder $q) => $q->with('client')->select(['id', 'client_id'])),
                BelongsTo::make(
                    'Cliente',
                    'client',
                    formatted: static fn (Client $model) => $model->name,
                    resource: ClientResource::class,
                )
                    ->required()
                    ->creatable()
                    ->valuesQuery(static fn (Builder $q) => $q->select(['id', 'name'])),
                // Total de la factura (monto total a pagar)
                Number::make('Total', 'amount')->required()->placeholder('Ingrese el total de la factura'),
                Date::make('Fecha de factura', 'bill_date')->required()->placeholder('Ingrese la fecha de la factura'),
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
