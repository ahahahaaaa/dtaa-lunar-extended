<?php
namespace DtaaLunarExtended;

use DtaaLunarExtended\Auth\DtaaManifest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use DtaaLunarExtended\Http\Livewire\StoreFront;
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
        $this->app->singleton(DtaaManifest::class, function () {
            return new DtaaManifest();
        });
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
        $storefront = $slot
            ->section('dtaa::storefront.section')
            ->name(__('dtaa::storefront.section'))
            ->route('dtaa.storefront.index')
            ->icon(<<<HTML
<svg
   version="1.1"
   id="svg2"
   width="666.66669"
   height="666.66669"
   viewBox="0 0 666.66669 666.66669"
   sodipodi:docname="453356-PF8VKA-799.ai"
   xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
   xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
   xmlns="http://www.w3.org/2000/svg"
   xmlns:svg="http://www.w3.org/2000/svg">
  <defs
     id="defs6">
    <clipPath
       clipPathUnits="userSpaceOnUse"
       id="clipPath16">
      <path
         d="M 0,500 H 500 V 0 H 0 Z"
         id="path14" />
    </clipPath>
    <clipPath
       clipPathUnits="userSpaceOnUse"
       id="clipPath36">
      <path
         d="M 0,500 H 500 V 0 H 0 Z"
         id="path34" />
    </clipPath>
    <clipPath
       clipPathUnits="userSpaceOnUse"
       id="clipPath52">
      <path
         d="M 0,500 H 500 V 0 H 0 Z"
         id="path50" />
    </clipPath>
  </defs>
  <sodipodi:namedview
     id="namedview4"
     pagecolor="#ffffff"
     bordercolor="#000000"
     borderopacity="0.25"
     inkscape:showpageshadow="2"
     inkscape:pageopacity="0.0"
     inkscape:pagecheckerboard="0"
     inkscape:deskcolor="#d1d1d1" />
  <g
     id="g8"
     inkscape:groupmode="layer"
     inkscape:label="453356-PF8VKA-799"
     transform="matrix(1.3333333,0,0,-1.3333333,0,666.66667)">
    <g
       id="g10">
      <g
         id="g12"
         clip-path="url(#clipPath16)">
        <g
           id="g18"
           transform="translate(125.9844,260.6157)">
          <path
             d="m 0,0 h 45.115 c 0.46,-14.937 2.203,-29.34 5.115,-42.583 C 41.185,-47.012 32.681,-52.618 24.914,-59.325 10.854,-43.175 1.75,-22.603 0,0 M 24.914,75.325 C 32.681,68.618 41.185,63.012 50.23,58.583 47.318,45.34 45.575,30.937 45.115,16 H 0 C 1.75,38.603 10.854,59.175 24.914,75.325 M 159.579,16 c -0.461,14.936 -2.202,29.337 -5.115,42.579 9.047,4.429 17.553,10.031 25.319,16.742 14.059,-16.15 23.16,-36.72 24.911,-59.321 z m -5.115,-58.579 c 2.913,13.242 4.654,27.644 5.115,42.579 h 45.115 c -1.751,-22.6 -10.852,-43.171 -24.91,-59.32 -7.767,6.709 -16.273,12.312 -25.32,16.741 m -9.902,-30.926 c 2.108,4.723 3.998,9.791 5.687,15.116 6.393,-3.381 12.447,-7.46 18.071,-12.194 -9.448,-7.946 -20.341,-14.22 -32.226,-18.369 3.048,4.499 5.885,9.656 8.468,15.447 M 143.586,0 c -0.427,-13.227 -1.903,-25.47 -4.154,-36.462 -11.813,3.871 -24.294,5.883 -37.085,5.883 -12.785,0 -25.268,-2.011 -37.084,-5.885 C 63.012,-25.471 61.535,-13.227 61.107,0 Z m -41.239,46.579 c 12.791,0 25.272,2.012 37.085,5.883 C 141.683,41.47 143.159,29.227 143.586,16 H 61.107 c 0.428,13.227 1.905,25.471 4.156,36.464 11.816,-3.873 24.299,-5.885 37.084,-5.885 m 42.215,42.927 c -2.583,5.791 -5.42,10.947 -8.468,15.446 11.885,-4.149 22.778,-10.424 32.226,-18.369 -5.624,-4.733 -11.678,-8.812 -18.071,-12.194 -1.689,5.325 -3.579,10.393 -5.687,15.117 m -42.215,21.151 c 12.083,0 25.017,-16.083 33.145,-42.629 -10.533,-3.581 -21.695,-5.449 -33.145,-5.449 -11.445,0 -22.608,1.87 -33.144,5.453 8.128,26.544 21.061,42.625 33.144,42.625 M 54.445,74.39 c -6.393,3.381 -12.447,7.462 -18.071,12.193 9.448,7.945 20.341,14.22 32.226,18.369 C 65.552,100.453 62.715,95.297 60.131,89.506 58.024,84.783 56.134,79.715 54.445,74.39 M 69.203,-52.033 c 10.536,3.583 21.699,5.454 33.144,5.454 11.45,0 22.612,-1.869 33.145,-5.449 -8.128,-26.546 -21.061,-42.629 -33.145,-42.629 -12.083,0 -25.016,16.081 -33.144,42.624 m -9.072,-21.472 c 2.584,-5.791 5.422,-10.948 8.47,-15.447 -11.885,4.149 -22.779,10.423 -32.227,18.369 5.624,4.732 11.678,8.812 18.071,12.193 1.689,-5.324 3.579,-10.393 5.686,-15.115 m 42.216,200.162 C 36.919,126.657 -16.31,73.428 -16.31,8 c 0,-65.427 53.229,-118.657 118.657,-118.657 65.427,0 118.657,53.23 118.657,118.657 0,65.428 -53.23,118.657 -118.657,118.657"
             style="fill:#000000;fill-opacity:1;fill-rule:nonzero;stroke:none"
             id="path20" />
        </g>
        <g
           id="g22"
           transform="translate(296.0283,240.2822)">
          <path
             d="m 0,0 h -135.394 c -6.6,0 -12,5.4 -12,12 v 32.667 c 0,6.6 5.4,12 12,12 H 0 c 6.6,0 12,-5.4 12,-12 V 12 C 12,5.4 6.6,0 0,0"
             style="fill:#000000;fill-opacity:1;fill-rule:nonzero;stroke:none"
             id="path24" />
        </g>
      </g>
    </g>
    <text
       xml:space="preserve"
       transform="matrix(1,0,0,-1,164.7778,253.2314)"
       style="font-variant:normal;font-weight:bold;font-stretch:normal;font-size:58.1254px;font-family:Comfortaa;-inkscape-font-specification:Comfortaa-Bold;writing-mode:lr-tb;fill:#ffffff;fill-opacity:1;fill-rule:nonzero;stroke:none"
       id="text28"><tspan
         x="0 45.047184 90.094368"
         y="0"
         sodipodi:role="line"
         id="tspan26">www</tspan></text>
    <g
       id="g30">
      <g
         id="g32"
         clip-path="url(#clipPath36)">
        <g
           id="g38"
           transform="translate(379.6182,152.0244)">
          <path
             d="M 0,0 C -2.138,0 -4.146,0.832 -5.657,2.344 L -26.259,22.945 -34.572,7.509 c -1.398,-2.596 -4.092,-4.208 -7.032,-4.208 -3.456,0 -6.51,2.198 -7.601,5.47 l -24.316,72.951 c -0.824,2.469 -0.426,5.092 1.089,7.195 1.508,2.092 3.931,3.341 6.48,3.341 0.861,0 1.719,-0.141 2.55,-0.417 L 9.547,67.524 c 3.078,-1.025 5.163,-3.67 5.441,-6.902 0.279,-3.232 -1.322,-6.194 -4.178,-7.731 L -4.626,44.579 15.976,23.976 c 1.51,-1.51 2.343,-3.519 2.343,-5.657 0,-2.137 -0.833,-4.146 -2.344,-5.657 L 5.656,2.343 C 4.146,0.832 2.137,0 0,0"
             style="fill:#000000;fill-opacity:1;fill-rule:nonzero;stroke:none"
             id="path40" />
        </g>
        <g
           id="g42"
           transform="translate(313.666,248.2822)">
          <path
             d="m 0,0 c -3.832,0 -7.468,-1.87 -9.725,-5.002 -2.276,-3.158 -2.874,-7.095 -1.639,-10.8 l 24.316,-72.949 c 1.637,-4.908 6.216,-8.206 11.396,-8.206 4.414,0 8.459,2.419 10.554,6.311 l 5.764,10.704 16.801,-16.801 c 2.266,-2.267 5.28,-3.515 8.485,-3.515 3.205,0 6.219,1.248 8.486,3.515 l 5.159,5.16 5.16,5.159 c 4.679,4.679 4.679,12.292 0,16.971 l -16.801,16.801 10.703,5.763 c 4.219,2.272 6.679,6.824 6.267,11.597 -0.412,4.774 -3.615,8.838 -8.161,10.353 L 3.814,-0.622 C 2.575,-0.209 1.292,0 0,0 m 0,-8 c 0.418,0 0.851,-0.067 1.285,-0.212 l 72.949,-24.316 c 3.327,-1.109 3.719,-5.656 0.632,-7.318 L 59.43,-48.157 c -2.36,-1.271 -2.827,-4.456 -0.933,-6.351 L 79.1,-75.11 c 1.562,-1.562 1.562,-4.095 0,-5.657 l -5.16,-5.16 -5.16,-5.159 c -0.781,-0.781 -1.804,-1.172 -2.828,-1.172 -1.024,0 -2.048,0.391 -2.829,1.172 l -20.602,20.602 c -0.792,0.793 -1.812,1.172 -2.822,1.172 -1.403,0 -2.79,-0.732 -3.528,-2.104 l -8.313,-15.437 c -0.764,-1.42 -2.14,-2.104 -3.51,-2.104 -1.608,0 -3.207,0.94 -3.806,2.735 L -3.774,-13.271 C -4.672,-10.579 -2.592,-8 0,-8"
             style="fill:#ffffff;fill-opacity:1;fill-rule:nonzero;stroke:none"
             id="path44" />
        </g>
      </g>
    </g>
  </g>
</svg>
HTML);
        $slot->addItem(function ($item) {
            $item
                ->name(__('dtaa::storefront.homeblock'))
                ->handle('dtaa.storefront.homeblock')
                ->route('dtaa.homeblock.index')
                ->icon('table');
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
