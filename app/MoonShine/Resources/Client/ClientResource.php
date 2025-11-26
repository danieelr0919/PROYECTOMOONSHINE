<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Client;

use App\Models\Client;
use App\MoonShine\Resources\Client\Pages\ClientIndexPage;
use App\MoonShine\Resources\Client\Pages\ClientFormPage;
use App\MoonShine\Resources\Client\Pages\ClientDetailPage;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends ModelResource<Client, ClientIndexPage, ClientFormPage, ClientDetailPage>
 */
class ClientResource extends ModelResource
{
    protected string $model = Client::class;

    protected string $title = 'Clientes';

    public function fields(): array
    {
        return [
            Text::make('Nombre', 'name')->required()->unique(),
            Email::make('Email', 'email')->required()->unique(),
            Phone::make('Teléfono', 'phone')->required()->unique(),
            Textarea::make('Dirección', 'address')->required(),
        ];
    }
    
    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            ClientIndexPage::class,
            ClientFormPage::class,
            ClientDetailPage::class,
        ];
    }
}
