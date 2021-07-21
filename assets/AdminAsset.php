<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'vendors/bootstrap/dist/css/bootstrap.min.css',
	    // 'vendors/font-awesome/css/font-awesome.min.css',
	    // 'vendors/nprogress/nprogress.css',
	    // 'vendors/iCheck/skins/flat/green.css',
	    // 'vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css',
	    // 'vendors/jqvmap/dist/jqvmap.min.css',
	    // 'vendors/bootstrap-daterangepicker/daterangepicker.css',
	    'build/css/custom.min.css',
		'css/site.css',
    ];
    public $js = [
	    // 'vendors/jquery/dist/jquery.min.js',
	    // 'vendors/bootstrap/dist/js/bootstrap.bundle.min.js',
	    // 'vendors/fastclick/lib/fastclick.js',
	    // 'vendors/nprogress/nprogress.js',
	    // 'vendors/Chart.js/dist/Chart.min.js',
	    // 'vendors/gauge.js/dist/gauge.min.js',
	    // 'vendors/bootstrap-progressbar/bootstrap-progressbar.min.js',
	    // 'vendors/iCheck/icheck.min.js',
	    // 'vendors/skycons/skycons.js',
	    // 'vendors/Flot/jquery.flot.js',
	    // 'vendors/Flot/jquery.flot.pie.js',
	    // 'vendors/Flot/jquery.flot.time.js',
	    // 'vendors/Flot/jquery.flot.stack.js',
	    // 'vendors/Flot/jquery.flot.resize.js',
	    // 'vendors/flot.orderbars/js/jquery.flot.orderBars.js',
	    // 'vendors/flot-spline/js/jquery.flot.spline.min.js',
	    // 'vendors/flot.curvedlines/curvedLines.js',
	    // 'vendors/DateJS/build/date.js',
	    // 'vendors/jqvmap/dist/jquery.vmap.js',
	    // 'vendors/jqvmap/dist/maps/jquery.vmap.world.js',
	    // 'vendors/jqvmap/examples/js/jquery.vmap.sampledata.js',
	    // 'vendors/moment/min/moment.min.js',
	    // 'vendors/bootstrap-daterangepicker/daterangepicker.js',
	    // 'build/js/custom.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
