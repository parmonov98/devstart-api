<?php

namespace App\Providers;

use App\Models\User;
use App\MoonShine\Resources\CategoryResource;
use App\MoonShine\Resources\SkillResource;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuItem;
use MoonShine\Menu\MenuGroup;
use Illuminate\Support\ServiceProvider;
use App\MoonShine\Resources\UserResource;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(MoonShine::class)->menu([
            MenuGroup::make('moonshine::ui.resource.system', [
                MenuItem::make('moonshine::ui.resource.admins_title', new MoonShineUserResource())
                    ->translatable()
                    ->icon('users'),
                MenuItem::make('moonshine::ui.resource.role_title', new MoonShineUserRoleResource())
                    ->translatable()
                    ->icon('bookmark'),
            ])->translatable(),

            MenuGroup::make("Users", [
                MenuItem::make('List', new UserResource())
            ])->icon('heroicons.user-group'),

            MenuGroup::make("Skills", [
                MenuItem::make('List', new SkillResource())
            ])->icon('heroicons.code-bracket'),
          
            MenuGroup::make("Categories", [
                MenuItem::make('List', new CategoryResource())
            ])->icon('heroicons.cube'),
        ]);
    }
}
