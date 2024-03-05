<?php
/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\grid\GridView;
$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
echo Html::a(Yii::t('app', 'Create Category'), ['create'], ['class' => 'btn btn-primary']);
?>
<div class="categories-index table-responsive mt-3">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $category) : ?>
                <tr>
                    <td><?= $category->id ?></td>
                    <td><?= $category->name ?></td>
                    <td><?= $category->description ?></td>
                    <td><img src="<?= Yii::getAlias('@web').'/uploads/'.$category->image ?>" width="100"></td>
                    <td>
                        <?= Html::a('Update', ['update', 'id' => $category->id],['class'=>'btn btn-success']) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $category->id], ['data-method' => 'post','class'=>'btn btn-danger']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
