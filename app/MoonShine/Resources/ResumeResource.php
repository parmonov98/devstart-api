<?php

namespace App\MoonShine\Resources;

use App\Builders\Hierarchy\HierarchyBuilder;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resume;

use MoonShine\Fields\File;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Fields\Url;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class ResumeResource extends Resource
{
    public static string $model = Resume::class;

    public static string $title = 'Resumes';

    public function fields(): array
    {
        $options = User::query()->pluck('name', 'id')->toArray();

        return [
            ID::make()->sortable(),
            Text::make('Title'),
            File::make('file')->nullable(),
            Url::make('link')->nullable(),
            Select::make('User', 'user_id')->nullable()->options($options)->searchable(),
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'title'   => 'required|string|min:5',
            'file'    => 'required_without:link|nullable',
            'link'    => 'required_without:file|nullable',
            'user_id' => 'required|integer',
        ];
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
