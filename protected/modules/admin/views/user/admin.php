<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="content-module">

<div class="content-module-heading cf">
					
    <h3 class="fl">Manage Users</h3>
    <span class="fr expand-collapse-text">Click to collapse</span>
    <span class="fr expand-collapse-text initial-expand">Click to expand</span>

</div> <!-- end content-module-heading -->
<div class="content-module-main">
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
<?php echo CHtml::link('Add','create',array('class'=>'button round blue image-right ic-add text-upper','style'=>'float:right')); ?>
<br/>
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('ext.selgridview.SelGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'selectableRows' => 2,
	'filter'=>$model,
	'pager' => array('cssFile' => Yii::app()->themeManager->baseUrl . '/css/cgridview/cgridview.css'),
	'cssFile' => Yii::app()->themeManager->baseUrl . '/css/cgridview/cgridview.css',
	'columns'=>array(
		array(
          'class' => 'CCheckBoxColumn',
        ),
		'username',
		'email',
		'firstname',
		'lastname',
		'isactive',
		/*
		'createdon',
		'updatedon',
		*/
		array(
			'header'=>'Actions',
			'class'=>'CButtonColumn',
			'viewButtonImageUrl' => Yii::app()->themeManager->baseUrl . '/images/cgridview/' . 'view.png',
	        'updateButtonImageUrl' => Yii::app()->themeManager->baseUrl . '/images/cgridview/' . 'update.png',
	        'deleteButtonImageUrl' => Yii::app()->themeManager->baseUrl . '/images/cgridview/' . 'delete.png',
		),
	),
)); ?>

<div style="font-size:0.75em;" >									
<label for="table-select-actions">With selected:</label>

<select id="table-select-actions" class="round dropdowncss">
    <option value="Delete">Delete</option>
    <option value="Export">Export</option>
    <option value="Archive">Archive</option>
</select>

<a class="round button blue text-upper small-button" href="#">Apply to selected</a>	
</div>	
</div>
</div>