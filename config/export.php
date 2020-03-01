<?php
return [
    /*
     * If set, the site will be exported to this disk. Disks can be configured
     * in `config/filesystems.php`.
     *
     * If empty, your site will be exported to a `dist` folder.
     */
    'disk' => null,
    /*
     * The entry points of your app. The export crawler will start to build
     * pages from these URL's.
     */
    // 'entries' => [
    //     '/dealercars',
    //     '/about',
    //     '/tradein',
    //     '/index-dealer',
    //     '/configurator-dealer',
    //     '/service-request/dealer',
    //     '/test-drive/dealer',
    //     '/ContactUs-dealer',
	// ],
	// 'exclude' => [
	// 	'/\.php$/',
	// 	'www.allaboutcookies.org',
	// 	'/news'
	// ],
	'include' => [
        ['source' => 'public', 'target' => '../resources/views/frontend/motorstudio'],
    ],
];