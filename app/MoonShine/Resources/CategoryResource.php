<?php

namespace App\MoonShine\Resources;

use App\Models\Category;
use MoonShine\Fields\ID;

use MoonShine\Fields\Text;
use MoonShine\Fields\Select;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;

class CategoryResource extends Resource
{
    public static string $model = Category::class;

    public static string $title = 'Categories';

    public function fields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('Title'),
            Textarea::make('Description')->nullable()->hideOnIndex(),
            Select::make('Parent', 'parent_id')->nullable()->options(Category::GetOptions())->searchable()
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }

    public function search(): array
    {
        return ['id'];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
