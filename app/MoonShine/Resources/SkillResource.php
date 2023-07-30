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
            Select::make('Parent skill')->nullable()->options($this->GetSkillOptions())->searchable()
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

    private static function MakeHierarchicalOptions(&$skills = [], $parent_id = null, $level = 0)
    {
        $skill_items = Skill::query();

        if(is_null($parent_id)) {
            $skill_items->whereNull('parent_skill');
        } else {
            $skill_items->where('parent_skill', '=', $parent_id);
        }

        $skill_items = $skill_items->pluck('name', 'id')->toArray();

        foreach ($skill_items as $id => $name) {
            $skills[$id] = " " . str_repeat("-", $level) . " " . $name;
            self::MakeHierarchicalOptions($skills, $id, $level+1);
        }
    }

    public function GetSkillOptions()
    {
        $skills = [];
        self::MakeHierarchicalOptions($skills);
        return $skills;
    }
}
