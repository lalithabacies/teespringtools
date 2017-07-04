<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
                'css/site.css',
		"css/teespring-theme/bootstrap.css?1422792965",
		"css/teespring-theme/materialadmin.css?1425466319",
		"css/teespring-theme/font-awesome.min.css?1422529194",
		"css/teespring-theme/material-design-iconic-font.min.css?1421434286",
		"css/teespring-theme/libs/rickshaw/rickshaw.css?1422792967",
		"css/teespring-theme/libs/morris/morris.core.css?1420463396",
    ];
    public $js = [
		"js/libs/jquery/jquery-migrate-1.2.1.min.js",
		"js/libs/bootstrap/bootstrap.min.js",
		"js/libs/d3/d3.min.js",
		"js/libs/d3/d3.v3.js",
		"js/libs/rickshaw/rickshaw.min.js",
		"js/core/source/App.js",
		"js/core/source/AppNavigation.js",
		"js/core/source/AppOffcanvas.js",
		"js/core/source/AppCard.js",
		"js/core/source/AppForm.js",
		"js/core/source/AppNavSearch.js",
		"js/core/source/AppVendor.js",
		'js/app.js',
        'js/common.js',
    ];

   // public $jsOptions = [
    //'position' => \yii\web\view::POS_HEAD,
   // ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
