<?php

return [
    'feeds' => [
        'news' => [
            /*
             * Here you can specify which class and method will return
             * the items that should appear in the feed. For example:
             * 'App\Model@getAllFeedItems'
             *
             * You can also pass an argument to that method:
             * ['App\Model@getAllFeedItems', 'argument']
             */
            'items' => 'App\Models\Article@getFeedItems',

            /*
             * The feed will be available on this url.
             */
            'url' => '/rss/news.xml',

            'title' => 'Centrum Gracza RSS | Artykuły',

            /*
             * The view that will render the feed.
             */
            'view' => 'vendor.feeds.news',
        ],
        'reviews' => [
            /*
             * Here you can specify which class and method will return
             * the items that should appear in the feed. For example:
             * 'App\Model@getAllFeedItems'
             *
             * You can also pass an argument to that method:
             * ['App\Model@getAllFeedItems', 'argument']
             */
            'items' => 'App\Models\Review@getFeedItems',

            /*
             * The feed will be available on this url.
             */
            'url' => '/rss/reviews.xml',

            'title' => 'Centrum Gracza RSS | Recenzje',

            /*
             * The view that will render the feed.
             */
            'view' => 'vendor.feeds.reviews',
        ],
    ],
];
