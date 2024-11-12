<?php

return [
    [
        'name' => 'Tenants',
        'flag' => 'tenant.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'tenant.destroy',
        'parent_flag' => 'tenant.index',
    ],
    [
        'name' => 'Tenants',
        'flag' => 'tenant.settings',
        'parent_flag' => 'settings.others',
    ],
];
