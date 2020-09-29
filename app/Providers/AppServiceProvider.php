<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        Schema::defaultStringLength(191);

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $menus = Menu::with(['permissions', 'submenus'])
            ->where('status', true)
            ->orderBy('order')
            ->get();

            foreach ($menus as $menu) {
                $data = [
                    'text' => $menu->text,
                    'url' => $menu->url,
                    'icon' => $menu->icon,
                    'target' => $menu->target
                ];

                if ($menu->submenus->isNotEmpty()) {
                    $submenu = $menu->submenus->filter(fn ($item) => $item->status === 1)
                    ->sortBy('order')
                    ->map(function ($item, $key) {
                        return [
                            'text' => $item->text,
                            'url' => $item->url,
                            'icon' => $item->icon,
                            'target' => $item->target
                        ];
                    });
                    $data['submenu'] = $submenu->toArray();
                }

                if ($menu->permissions->isNotEmpty()) {
                    $data['can'] = $menu->permissions->map(fn ($item) => $item->name)->toArray();
                }

                $event->menu->add($data);
            }

        });
    }
}
