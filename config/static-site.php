<?php

 return [

    /**
     * Directory name within storage Directory
     *
     * @var string
     */
    "storageDirectoryName" => "static-site",

    /**
     * Chmod permissions for created Directory
     *
     * @var int
     */
    "createdDirectoryPermission" => 0755,

    /**
     * Chmod permissions for created file
     *
     * @var int
     */
    "createdFilePermission" => 0644,

    /**
     * Urls to be converted into static files
     *
     * @var string[]
     */
    "urlList" => [
		'/dealercars',
		'/about',
		'/tradein',
		'/index-dealer',
		'/configurator-dealer',
		'/service-request/dealer',
		'/test-drive/dealer',
		'/ContactUs-dealer',
    ],

    /**
     * Urls to be skipped on auto generation
     *
     * @var array
     */
    "skipUrlList" => [
		
    ],

    /**
     * Automatically discover routes
     *
     * @var bool
     */
    "auto" => TRUE,

    /**
     * Only routes with specified method will be automatically converted to static files
     *
     * @var bool
     */
    "autoRequestMethodList" => [
        "GET"
    ],

    /**
     * Parametrized routes will not be automatically converted to static files (not much sense to cache this routes)
     * You may pass urlList with specified parameters or overwrite getUrlList method for complex logic
     *
     *
     * @var bool
     */
    "autoSkipParametrized" => TRUE,

    /**
     * Pages with csrf forms will be skipped on auto generation
     *
     * @var bool
     */
    "autoSkipCSRFInput" => TRUE,

    /**
     * Pages with csrf meta tag will be skipped on auto generation
     *
     * @var bool
     */
    "autoSkipCSRFMeta" => TRUE,

    /**
     * Http status codes to be converted to static files
     *
     * @var array
     */
    "httpStatusCodeList" => [
        200
    ],

    /**
     * File name for root url like '/'
     *
     * @var string
     */
    "rootUrlFileName" => "_",

    /**
     * Add .gitignore file static files directory
     *
     * @var bool
     */
    "addGitignoreToStaticDirectory" => TRUE,

    /**
     * Extension will be added to static file name
     *
     * Set false
     *
     * @var string|boolean|null
     */
    "staticFileExtension" => "html",

    /**
     * "Echo" output will be prepended to route content
     *
     * @var bool
     */
    "prependEchoContent" => TRUE,

    /**
     * Get content method
     * 'app' - through app()->handle method
     * 'curl' - through curl request
     *
     * @var 'app'|'curl'
     */
    "defaultGetContentMethod" => "app",

];
