<?php

/*
 * _ _   _
  (_) |_| | _____  _ __ ___
  | | __| |/ / _ \| '_ ` _ \
  | | |_|   < (_) | | | | | |
  |_|\__|_|\_\___/|_| |_| |_|
 * 
 * 
 * 
 * <?=
  \frontend\widgets\jinplace\Jinplace::widget([
  'model' => $model,
  'attribute' => 'region',
  'clientOptions' => [
  'input-class' => 'form-control',
  'url' => '/ttttt'
  ]
  ]
  );
  ?>
 *
 */

namespace frontend\widgets\jinplace;

use yii\helpers\Html;
use yii\widgets\InputWidget;

class Jinplace extends InputWidget
{

    /**
     * @var array the JQuery plugin options for the jinplace plugin.
     * @see https://bitbucket.org/itinken/jinplace/wiki/Attributes
     */
    public $clientOptions = [];

    public function init()
    {
        parent::init();
        if (!empty($this->clientOptions)) {
            foreach ($this->clientOptions as $key => $value) {
                if ($key == 'data') {
                    $value = $this->getDataData($value);
                }
                $this->options['data-' . $key] = $value;
            }
        }
        $this->options['class'] = 'editable jinplace-editable';
    }

    public function run()
    {
        parent::run();
        $view = $this->getView();
        JinplaceAsset::register($view);
        $view->registerJs('jQuery(".editable").jinplace().on("jinplace:fail", function(ev, jqxhr, textStatus, errorThrown){
                jQuery(ev.currentTarget).addClass("jinplace-haserror"); 
                }).on("jinplace:done", function(ev, data) {
                jQuery(ev.currentTarget).removeClass("jinplace-haserror")
                });');
        if ($this->hasModel()) {
            $this->options['data-attribute'] = $this->attribute;
            $this->value = Html::getAttributeValue($this->model, $this->attribute);
            if (isset($this->options['data-type'])) {
                if ($this->options['data-type'] == 'select') {
                    if (isset($this->options['data-value'])) {
                        $this->value = $this->options['data-value'];
                    }
                }
            }
        }
        echo Html::tag('div', $this->value, $this->options);
    }

    public function getDataData($array)
    {
        $result = [];
        foreach ($array as $key => $value) {
            array_push($result, [$key, $value]);
        }
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

}
