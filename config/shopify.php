<?php

return [

    'key' =>env('SHOPIFY_KEY'),

    'secret' => env('SHOPIFY_SECRET'),

    'redirectURL' => env('SHOPIFY_REDIRECT'),

    /*
     * scopes and endpoints from Shopify
     */
    'scopes' => [
            'read_content', 'write_content', 'read_themes', 'write_themes',
            'read_products', 'write_products', 'read_customers', 'write_customers',
            'read_orders', 'write_orders', 'read_draft_orders', 'write_draft_orders',
    ],



    /*
     * The following is an example of endpoints defined.
     * You can also add your own endpoints, following
     * the example
     *
     */
    'endpoints' => [
        'products' => ['images', 'variants', 'metafields'],

        'themes' => ['assets'],

        'smartCollections' => [],

        'customCollections' => [],

        'collects' => [],

        'collectionListings' => [],

        'scriptTags' => [],

        'pages' => ['metafields'],

        'orders' => [
            'transactions', 'fulfillments', 'risks', 'tier3' => ['fulfillments' => 'events']
        ],

        'blogs' => [ 'articles' ],

        'articles' => [],

        'metafields' => [],


    ],

    'tierTwoWithoutId' => [ 'themesAssets'],

];
