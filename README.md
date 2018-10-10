# jinplace Extension for Yii 2

This is the [The jinplace jQuery plugin](https://bitbucket.org/itinken/jinplace) Extension for Yii 2. 


Controller action example:

``` public function actionAjaxupdate($id)
    {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            if (isset($post['attribute'])) {
                $model = $this->findModel($id);
                $model->setAttribute($post['attribute'], $post['value']);
                if ($model->save()) {
                    return $post['value'];
                } else {
                    throw new ServerErrorHttpException;
                }
            }
            return $post['value'];
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    ```
