<?php

namespace DtaaLunarExtended\Auth;

use Illuminate\Support\Collection;
use Lunar\Hub\Auth\Manifest;

class DtaaManifest extends Manifest
{
    /**
     * A collection of permissions loaded into the manifest.
     */
    protected Collection $permissions;

    /**
     * Initialise the manifest class.
     */
    public function __construct()
    {
        $this->permissions = collect($this->getBasePermissions());
    }
    /**
     * Returns the base permissions which are required by Lunar.
     */
    protected function getBasePermissions(): array
    {
        return [
            new Permission(
                __('dtaa::storefront.manage-storefront'),
                'dtaa:manage-storefront',
                __('dtaa::storefront.manage-storefront')
            ),
        ];
    }
}
