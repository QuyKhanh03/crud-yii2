<?php

namespace app\controllers;

use app\models\Category;

class CategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $data = Category::find()
            ->all();
        return $this->render('index',['data'=>$data]);
    }
    public function actionCreate()
    {
        try {
            $model = new Category();
            $request = \Yii::$app->request;

            if($model->load($request->post())){
                $model->image = \yii\web\UploadedFile::getInstance($model,'image');
                $uploadPath = \Yii::getAlias('@webroot').'/uploads/';
                if(!is_dir($uploadPath)){
                    mkdir($uploadPath);
                }
                $model->image->saveAs($uploadPath.$model->image->baseName.'.'.$model->image->extension);
                $model->image = $model->image->baseName.'.'.$model->image->extension;

                $model->save();
                return $this->redirect(['index']);
            }else{
                return $this->render('create',['model'=>$model]);
            }
        }catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function actionDelete()
    {
        try {
            $id = \Yii::$app->request->get('id');
            $model = Category::findOne($id);
            if($model->delete()){
                //delete image from folder
                $uploadPath = \Yii::getAlias('@webroot').'/uploads/';
                unlink($uploadPath.$model->image);

            }
            return $this->redirect(['index']);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function actionUpdate()
    {
        try {
            $id = \Yii::$app->request->get('id');
            $request = \Yii::$app->request;
            $model = Category::findOne($id);
            if ($model->load($request->post()) && $model->validate()) {
                $model->image = \yii\web\UploadedFile::getInstance($model, 'image');
                $uploadPath = \Yii::getAlias('@webroot') . '/uploads/';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath);
                }
                if ($model->image) {
                    $model->image->saveAs($uploadPath . $model->image->baseName . '.' . $model->image->extension);
                    $model->image = $model->image->baseName . '.' . $model->image->extension;
                    unlink($uploadPath . $model->oldAttributes['image']);
                } else {
                    $model->image = $model->oldAttributes['image'];
                }
                $model->save();
                return $this->redirect(['index']);
            }
            return $this->render('update', ['model' => $model]);
        }catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
