<?php

/*
 *
  Date: 16.09.2017
  All rights reserved.
  Cannot be redistributed  without
  a written permission.
 */

namespace mauztor\jinplace;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

class JinplaceDetailView extends DetailView
{

    public $url;

    protected function renderAttribute($attribute, $index)
    {
        if (is_string($this->template)) {
            $captionOptions = Html::renderTagAttributes(ArrayHelper::getValue($attribute, 'captionOptions', []));
            $contentOptions = Html::renderTagAttributes(ArrayHelper::getValue($attribute, 'contentOptions', []));
            if ($attribute['format'] == 'jinplace') {
                $options = ['input-class' => 'form-control', 'url' => $this->url];
                if (isset($attribute['jinplaceOptions'])) {
                    if (is_array($attribute['jinplaceOptions'])) {
                        foreach ($attribute['jinplaceOptions'] as $key => $value) {
                            $options[$key] = $value;
                        }
                    }
                }
                $value = $this->formatter->format(Jinplace::widget([
                            'model' => $this->model,
                            'attribute' => $attribute['attribute'],
                            'clientOptions' => $options
                        ]), 'raw');
            } else {
                $value = $this->formatter->format($attribute['value'], $attribute['format']);
            }
            return strtr($this->template, [
                '{label}' => $attribute['label'],
                '{value}' => $value,
                '{captionOptions}' => $captionOptions,
                '{contentOptions}' => $contentOptions,
            ]);
        } else {
            return call_user_func($this->template, $attribute, $index, $this);
        }
    }

}
