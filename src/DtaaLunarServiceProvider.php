<?php
namespace DtaaLunarExtended;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use DtaaLunarExtended\Http\Livewire\StoreFront;
use Lunar\Hub\Auth\DtaaManifest;
use Lunar\Hub\Facades\Menu;
use Livewire\Livewire;

class DtaaLunarServiceProvider extends ServiceProvider
{
    protected $configFiles = [

    ];

    protected $root = __DIR__.'/..';

    /**
     * Register any application services.
     */
    public function register(): void
    {

    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dtaa');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'dtaa');
        $this->registerPermissionManifest();
        $this->registerLivewireComponents();
        $this->registerStateListeners();
        // Menu Builder
        $this->registerMenuBuilder();
    }
    protected function registerMenuBuilder()
    {
        $slot = Menu::slot('sidebar');
        $slot->addItem(function ($item) {
            $item
                ->name(__('dtaa::storefront.sidebar'))
                ->handle('dtaa.storefront')
                ->route('dtaa.storefront.index')
                ->icon('ticket');
        });
    }
    /**
     * Register our permissions manifest.
     *
     * @return void
     */
    protected function registerPermissionManifest()
    {
        Gate::after(function ($user, $ability) {
            // Are we trying to authorize something within the extended?
            $permission = $this->app->get(DtaaManifest::class)->getPermissions()->first(fn ($permission) => $permission->handle === $ability);
            if ($permission) {
                return $user->admin || $user->hasPermissionTo($ability);
            }
        });
    }
    protected function registerAddonManifest()
    {

    }
    protected function registerStateListeners()
    {

    }
    /**
     * Register the observers used in Lunar.
     */
    protected function registerObservers(): void
    {

    }
    /**
     * Register the blueprint macros.
     */
    protected function registerBlueprintMacros(): void
    {

    }
    protected function registerLivewireComponents()
    {
        $this->registerGlobalComponents();
     }
    /**
     * Register global components.
     *
     * @return void
     */
    protected function registerGlobalComponents()
    {
        Livewire::component('dashboard', StoreFront::class);
        Livewire::component('hub.components.activity-log-feed', ActivityLogFeed::class);
    }
}
