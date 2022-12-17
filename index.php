<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\modules\yiiform\models\Country;
use app\modules\yiiform\models\Yiiform;
use app\modules\yiiform\models\State;
use yii\bootstrap5dropdown\ButtonDropdown;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\yiiform\models\YiiformSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Yiiforms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yiiform-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?= Html::a('Create Yiiform', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
			'mobile_number',
            'email:email',
            'gender',
			//'resume',
			[
			'attribute' => 'resume',
			 'value'=>function($model)
			  {
				  
				  return $model->image?'<embed src="http://10.10.10.100/prasanth/yii2/6-12-2022/basic/uploads/resume/'.$model->resume.'" type="application/pdf" />':'';
			  },
			  'format'=>'raw'
		   ],
			//'hobby',
			[
			'attribute' => 'hobby',
			 'value'=>function($model)
			  {
				 $get_val = [];
				 $hob = explode(',',$model->hobby);
				 $org =  ['0' => 'gardening','1' => 'egames', '2' => 'cycling'];
				 foreach($org as $org=>$k)
				 {
					 if (in_array($org,$hob))
					 {
						 $get_val[]= $k;
				     }
					
				   
				 }
				// print_r($get_val);exit;
				 return implode('<br>', $get_val);
				 
			  },
			  
			  'format'=>'raw'
			],
			
            'employee_number',
			'textarea',
			'website',
			//'movies',
			//'country',
			['attribute' => 'country',
			'value' => function($model) 
				{$countryarr = Country::find()->where(['country_id' => $model->country])->one();
				return $countryarr->country_name;},
			],
			['attribute' => 'state',
			'value' => function($model) 
				{$statearr = State::find()->where(['state_id' => $model->state])->one();
				return $statearr->state_name;},
			],
			
			[
			'attribute' => 'movies',
			 'value'=>function($model)
			  {
				 $get_val = [];
				 $web = explode(',',$model->movies);
				 $org =  ['1' => 'BB','2' => 'RRR', '3' => '007'];
				 foreach($org as $org=>$k)
				 {
					 if (in_array($org,$web))
					 {
						 $get_val[]= $k;
				     }
					
				   
				 }
				// print_r($get_val);exit;
				 return implode('<br>', $get_val);
				 
			  },
			  
			  'format'=>'raw'
			],
			
			
			'DOB',
			//'image',
			[
			'attribute' => 'image',
			 'value'=>function($model)
			  {
				  return $model->image?'<a href="index.php?r=form%2Fyiiform%2Fupload&id='.$model->id.'"><img src="../uploads/'.$model->image.'" width="50px" height="50px"></a>':'';
			  },
			  'format'=>'raw'
		   ],
		
		 
			/**
			['label' => 'ShowImage',

			'format' => ['image',['width'=>'50']], 

			<?php echo '<img src="<?= Yii::$app->request->baseUrl '.' "/uploads/" '. $model->image ?>"' ;?>,

							

			],
			**/
			['attribute' => 'name',
			'value' => function($model) 
				{
				return $model->name?'<input value="'.$model->name.'"'.'id="id-'.$model->id.'"'.'onchange="changename('.$model->id.')"'.'></input>':'';
				},
				'format'=>'raw'
			],
			
			
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
			
			
			
			
        ],
    ]); ?>


</div>

<script>
  
function changename(a){
	
		
	var user = $("#id-"+a).val();
	//console.log(user);
	//console.log(a);
	 $.ajax({  
		url: 'index.php?r=form%2Fyiiform%2Fedit',  
		type: 'POST',  
		data : {id:a,name:user,_csrf : '<?=Yii::$app->request->getCsrfToken()?>'},
		success: function(data) 
		{  
			if(data==1)
			{
			 location.reload();  
			}
		}  
	});  
    
};  
</script>

