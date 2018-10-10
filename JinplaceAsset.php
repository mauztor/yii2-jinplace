<?php


namespace mauztor\jinplace;

use yii\web\AssetBundle;

/**
 * Class JinplaceAsset
 * @author Poletaev Aleksey <mauztor@mail.ru>
 */
class JinplaceAsset extends AssetBundle
{

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        'js/jinplace.js',
    ];

    /**
     * @inheritdoc
     */
    public $css = [
        'css/jinplace.css',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = __DIR__ . "/assets";
        parent::init();
    }

}
