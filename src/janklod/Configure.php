<?php 

return [
     'providers' => [
        JK\Http\Facades\RequestProvider::class,
        JK\Http\Facades\ResponseProvider::class,
        JK\Routing\Facades\RouterProvider::class, 
        JK\Loader\Facades\LoaderProvider::class,
        JK\Database\Facades\DatabaseProvider::class,
        /*
        \JK\Template\Facades\ViewProvider::class,
        \JK\Validation\Facades\ValidationProvider::class,
       */
    ],
    'alias' => [
         'Route'    => 'JK\\Routing\\Route',
         'Asset'    => 'JK\\Template\\Asset',
         'HTML'     => 'JK\\Template\\HTML', 
         'Config'   => 'JK\\Config\\Config',
         'Url'      => 'JK\\Helper\\Url',
    ],
];
			
}