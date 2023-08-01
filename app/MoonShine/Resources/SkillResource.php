<?php

namespace App\MoonShine\Resources;

use App\Models\Skill;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Select;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;

class SkillResource extends Resource
{
    public static string $model = Skill::class;

    public static string $title = 'Skills';

    public function fields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('Name'),
            Text::make('Icon'),
            Select::make('Parent skill')->nullable()->options(Skill::GetOptions())->searchable()
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
