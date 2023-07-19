<?php

namespace App\MoonShine\Resources;

use App\Models\User;
// use Faker\Core\Number;
use MoonShine\Fields\ID;

use MoonShine\Fields\Text;
use MoonShine\Fields\Number;
use MoonShine\Fields\Select;
use MoonShine\Fields\Checkbox;
use MoonShine\Resources\Resource;
use MoonShine\Fields\SwitchBoolean;
use MoonShine\Actions\FiltersAction;
use MoonShine\BulkActions\BulkAction;
use Illuminate\Database\Eloquent\Model;

class UserResource extends Resource
{
	public static string $model = User::class;

	public static string $title = 'Users';

    public static array $activeActions = ['show', 'edit'];

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Text::make('Name')->readOnly(),
            Text::make('Mail', 'email'),
            Text::make('Phone', 'phone')->mask('998999999999'),
            Select::make('User type', 'user_type')->options(['idea_holder' => "Idea holder", 'developer' => "Developer"]),
            SwitchBoolean::make('Admin', 'is_admin'),
            SwitchBoolean::make('Status', 'active'),
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

    public function bulkActions(): array
    {
        return [
            BulkAction::make('Заблокировать', function (Model $item) {
                $item->update(['active' => false]);
            }, 'Деактивировано')->showInLine()->withConfirm('Подтвердить действие', 'Пожалуйста, подтвердите свое действие, чтобы продолжить', 'Подтвердить'),

            BulkAction::make('Активировать', function (Model $item) {
                $item->update(['active' => true]);
            }, 'Aктивировано')->showInLine()->withConfirm('Подтвердить действие', 'Пожалуйста, подтвердите свое действие, чтобы продолжить', 'Подтвердить')
        ];
    }
}
