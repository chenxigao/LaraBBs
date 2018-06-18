<?php

return array(

    /*
     * Package URI
     *
     * @type string
     */
    //后台的uri入口
    'uri' => 'admin',

    /*
     *  Domain for routing.
     *
     *  @type string
     */
    //后台专属域名，没有的话可以留空

    'domain' => '',

    /*
     * Page title
     *
     * @type string
     */
    //应用名称，在页面标题和左上角站点名称出显示
    'title' => env('APP_NAME','Laravel'),

    /*
     * The path to your model config directory
     *
     * @type string
     */
    //模型配置信息文件存放目录
    'model_config_path' => config_path('administrator'),

    /*
     * The path to your settings config directory
     *
     * @type string
     */
    //配置信息文件存放目录
    'settings_config_path' => config_path('administrator/settings'),

    /*
     * 后台菜单数组，多维数组渲染结果为多级嵌套菜单。
     *
     * 数组里的值有三种类型：
     * 1. 字符串 —— 子菜单的入口，不可访问；
     * 2. 模型配置文件 —— 访问 `model_config_path` 目录下的模型文件，如 `users` 访问的是 `users.php` 模型配置文件；
     * 3. 配置信息 —— 必须使用前缀 `settings.`，对应 `settings_config_path` 目录下的文件，如：默认设置下，
     *              `settings.site` 访问的是 `administrator/settings/site.php` 文件
     * 4. 页面文件 —— 必须使用前缀 `page.`，如：`page.pages.analytics` 对应 `administrator/pages/analytics.php`
     *               或者是 `administrator/pages/analytics.blade.php` ，两种后缀名皆可
     *
     * 示例：
     *  [
     *      'users',
     *      'E-Commerce' => ['collections', 'products', 'product_images', 'orders'],
     *      'Settings'  => ['settings.site', 'settings.ecommerce', 'settings.social'],
     *      'Analytics' => ['E-Commerce' => 'page.pages.analytics'],
     *  ]
     */
    'menu' => [
        '用户与权限'=>[
            'users',
        ],
    ],

    /*
     * 权限控制的回调函数。
     *
     * 此回调函数需要返回 true 或 false ，用来检测当前用户是否有权限访问后台。
     * `true` 为通过，`false` 会将页面重定向到 `login_path` 选项定义的 URL 中。
     */
    'permission' => function () {
        //只要是能管理内容的用户，就允许他访问后台
        return Auth::check() && Auth::user()->can('manage_contents');
    },

    /*
     * 使用布尔值来设定是否使用后台主页，
     * 如值为true，则使用‘dashboard——view’定义的视图文件渲染页面；
     * 如值为false，将使用‘home——page’定义的菜单条目来作为后台主页
     */
    'use_dashboard' => false,

    /*
     * 设置后台主页视图文件，由'use_dashboard'选项决定
     */
    'dashboard_view' => '',

    /*
     * 用来作为后台主页的菜单条目，由'use_dashboard'选项决定，菜单指的是‘menu'选项
     */
    'home_page' => 'users',

    /*
     * 右上角返回主站按钮连接
     */
    'back_to_site_path' => '/',

    /*
     * 当选项‘permission’权限检测不通过时，将重定向用户到此处设置路径
     */
    'login_path' => 'login',

    /*
     *
     */
    'logout_path' => false,

    /*
     * 允许用户登录成功后使用Session::get('redirect')将用户重定向到原本要访问的后台页面
     */
    'login_redirect_key' => 'redirect',

    /*
     * 控制模型数据页面默认的显示条目
     */
    'global_rows_per_page' => 20,

    /*
     * 可选择的语言，如果不为空，将会在页面顶部显示选择语言按钮
     *
     * @type array
     */
    'locales' => [],

    'custom_routes_file' => app_path('Http/routes/administrator.php'),
);
