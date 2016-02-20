<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use common\models\LoginForm;
use common\models\User;
use frontend\models\UserInfo;
use frontend\models\Relation;
use frontend\models\Happiness;
use frontend\models\StageOne;
use frontend\models\StageTwo;
use backend\models\CurrentStage;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use frontend\models\Character;
use backend\models\RegisterNewUserForm;
/**
 * Site controller
 */
class SiteController extends Controller
{
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'about'],
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                   
                   
                ],

            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        if(key(\Yii::$app->authManager->getRolesByUser(\Yii::$app->user->getId())) == 'admin'){


            //Give all current stages
            $all_stages = CurrentStage::find()->all();
            $all_stages = ArrayHelper::map($all_stages, 'stage', 'description');

            //Get current stage
            $current_stage = CurrentStage::getCurrentStage();

            $register_form = new RegisterNewUserForm();

            if(isset($_POST['current_stage'])){
                $current_stage = $_POST['current_stage'];
                if(!CurrentStage::updateStage($current_stage)){
                    return $this->redirect('error');
                }
            }
            return $this->render('index', ['all_stages' => $all_stages, 'current_stage' => $current_stage,
                                        'register_form' => $register_form]);
        }
        else{
            return $this->render('prohibited');
        }
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }


        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRegisterNewUser(){
        $register_form = new RegisterNewUserForm();


        if($register_form->load(Yii::$app->request->post()) && $register_form->validate()){
            if($register_form->signup()){
                $register_form = new RegisterNewUserForm();
                return $this->renderAjax('_index_register_user', ['register_form' => $register_form]);
            }
        }
        else{
            $this->renderAjax('_index_register_user', ['register_form' => $register_form]);
        }
    }
    public function actionStudentInfo(){
    // build an ActiveDataProvider with an empty query and a pagination with 35 items for page
        $provider = new ActiveDataProvider([
            'query' => UserInfo::find(),
            'pagination' => [
                'pageSize' => 35,
            ],
        ]);

        return $this->render('student-info', ['provider' => $provider]);
    }

    public function actionStudentRelation(){
         $provider = new SqlDataProvider([
            'sql' => Relation::retrieveAllBySql(),  
            'totalCount' => Relation::countRetrieveAll(),
          
            'pagination' => [
                'pageSize' =>5,
            ],
        ]);

        return $this->render('student-relation', ['provider' => $provider]);
    }

    public function actionStudentCharacter(){
         $provider = new SqlDataProvider([
            'sql' => Character::retrieveAllBySql(),  
            'totalCount' => Character::countRetrieveAll(),
          
            'pagination' => [
                'pageSize' =>5,
            ],
        ]);

        return $this->render('student-character', ['provider' => $provider]);
    }

     public function actionStudentHappiness(){
         $provider = new SqlDataProvider([
            'sql' => Happiness::retrieveAllBySql(),  
            'totalCount' => Happiness::countRetrieveAll(),
          
            'pagination' => [
                'pageSize' =>5,
            ],
        ]);

        return $this->render('student-happiness', ['provider' => $provider]);
    }

     public function actionStageone(){
         $provider = new SqlDataProvider([
            'sql' => StageOne::retrieveAllBySql(),  
            'totalCount' => StageOne::countRetrieveAll(),
          
            'pagination' => [
                'pageSize' =>15,
            ],
        ]);

        return $this->render('stageone', ['provider' => $provider]);
    }

    /**
     * render stage 2 page
     * @return string
     */
    public function actionStagetwo(){
         $provider = new SqlDataProvider([
            'sql' => StageTwo::retrieveAllBySql(),  
            'totalCount' => StageTwo::countRetrieveAll(),
          
            'pagination' => [
                'pageSize' =>5,
            ],
        ]);

        return $this->render('stagetwo', ['provider' => $provider]);
    }

    public function actionEmail(){
        return $this->render('email');
    }

    public function actionSendone(){
        return $this->render('email');
    }

    public function actionSendall(){

        $messages = [];
    
        $users = User::retrieveAll();

        foreach ($users as $user) {

            $password = User::decryptIt($user['password_hash']);
            $email = $user['email'];
            $messages[] = Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom('RLIMANTO001@e.ntu.edu.sg')
                ->setSubject('Paid Economy Survey')
                ->setTextBody('Your Username is: ' . $user['username']. ', Your password is: '. $password);
        }
        Yii::$app->mailer->sendMultiple($messages);

        return $this->render('email');
    }

    public function actionStudentRelationMatrix(){
        $matrix = Relation::generate2DMatrix();
        $ids = Relation::getAllParticipants();
        $ids = $this->getIdValues($ids);

        return $this->render('student-relation-matrix', ['matrix' => $matrix, 'ids' => $ids]);
    }

    public function actionStageoneMatrix(){
        $matrix = StageOne::generate2DMatrix();
        $ids = StageOne::getAllParticipants();
        $ids = $this->getIdValues($ids);

        return $this->render('stageone-matrix', ['matrix' => $matrix, 'ids' => $ids]);
    }

    public function actionInfoExcel(){
        $query  =UserInfo::find()->all();

        $objPHPExcel  = new \PHPExcel();

        //Set title
        $objPHPExcel->getActiveSheet()->setCellValue('B'. 1, 'name');
        $objPHPExcel->getActiveSheet()->setCellValue('C'. 1, 'gender');
        $objPHPExcel->getActiveSheet()->setCellValue('D'. 1, 'course');
        $objPHPExcel->getActiveSheet()->setCellValue('E'. 1, 'year_of_birth');
        $objPHPExcel->getActiveSheet()->setCellValue('F'. 1, 'year_of_study');
        $objPHPExcel->getActiveSheet()->setCellValue('G'. 1, 'user_prior_school');
        $objPHPExcel->getActiveSheet()->setCellValue('H'. 1, 'user_height');
        $objPHPExcel->getActiveSheet()->setCellValue('I'. 1, 'user_weight');
        $objPHPExcel->getActiveSheet()->setCellValue('J'. 1, 'num_of_sibling');
        $objPHPExcel->getActiveSheet()->setCellValue('K'. 1, 'your_cgpa');
        $objPHPExcel->getActiveSheet()->setCellValue('L'. 1, 'user_money_received');
        $objPHPExcel->getActiveSheet()->setCellValue('M'. 1, 'work_part_time');
        $objPHPExcel->getActiveSheet()->setCellValue('N'. 1, 'hour_week');
        $objPHPExcel->getActiveSheet()->setCellValue('O'. 1, 'part_time_rate');
        $objPHPExcel->getActiveSheet()->setCellValue('P'. 1, 'volunteer_activity');
        $objPHPExcel->getActiveSheet()->setCellValue('Q'. 1, 'hobbies');
        $objPHPExcel->getActiveSheet()->setCellValue('R'. 1, 'other_hobbies');
        $objPHPExcel->getActiveSheet()->setCellValue('S'. 1, 'user_cca');
        $objPHPExcel->getActiveSheet()->setCellValue('T'. 1, 'user_first_language');
        $objPHPExcel->getActiveSheet()->setCellValue('U'. 1, 'user_hall');
        $objPHPExcel->getActiveSheet()->setCellValue('V'. 1, 'hall_number');
        $objPHPExcel->getActiveSheet()->setCellValue('A'. 1, 'id');




        // Fill worksheet from values in array
        for($i = 0; $i < count($query); $i++){
            $item = $query[$i];
           // Yii::$app->end(print_r($item));

            $j = $i + 2;
            $objPHPExcel->getActiveSheet()->setCellValue('A'. $j, $item->id);
            $objPHPExcel->getActiveSheet()->setCellValue('B'. $j, $item->name);
            $objPHPExcel->getActiveSheet()->setCellValue('C'. $j, $item->gender);
            $objPHPExcel->getActiveSheet()->setCellValue('D'. $j, $item->course);
            $objPHPExcel->getActiveSheet()->setCellValue('E'. $j, $item->year_of_birth);
            $objPHPExcel->getActiveSheet()->setCellValue('F'. $j, $item->year_of_study);
            $objPHPExcel->getActiveSheet()->setCellValue('G'. $j, $item->user_prior_school);
            $objPHPExcel->getActiveSheet()->setCellValue('H'. $j, $item->user_height);
            $objPHPExcel->getActiveSheet()->setCellValue('I'. $j, $item->user_weight);
            $objPHPExcel->getActiveSheet()->setCellValue('J'. $j, $item->num_of_sibling);
            $objPHPExcel->getActiveSheet()->setCellValue('K'. $j, $item->your_cgpa);
            $objPHPExcel->getActiveSheet()->setCellValue('L'. $j, $item->user_money_received);
            $objPHPExcel->getActiveSheet()->setCellValue('M'. $j, $item->work_part_time);
            $objPHPExcel->getActiveSheet()->setCellValue('N'. $j, $item->hour_week);
            $objPHPExcel->getActiveSheet()->setCellValue('O'. $j, $item->part_time_rate);
            $objPHPExcel->getActiveSheet()->setCellValue('P'. $j, $item->volunteer_activity);
            $objPHPExcel->getActiveSheet()->setCellValue('Q'. $j, $item->hobbies);
            $objPHPExcel->getActiveSheet()->setCellValue('R'. $j, $item->other_hobbies);
            $objPHPExcel->getActiveSheet()->setCellValue('S'. $j, $item->user_cca);
            $objPHPExcel->getActiveSheet()->setCellValue('T'. $j, $item->user_first_language);
            $objPHPExcel->getActiveSheet()->setCellValue('U'. $j, $item->user_hall);
            $objPHPExcel->getActiveSheet()->setCellValue('V'. $j, $item->hall_number);

        }

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Student');

        // Set AutoSize for name and email fields
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);

        // Save Excel 2007 file
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachement; filename="student-info.xlsx"');
        $objWriter->save('php://output');

        return $this->redirect('index.php?r=site/student-info');

    }

    public function actionCharacterExcel(){
        $query  =Character::find()->all();

        $objPHPExcel  = new \PHPExcel();

        //Set title
        $objPHPExcel->getActiveSheet()->setCellValue('B'. 1, 'optimistic');
        $objPHPExcel->getActiveSheet()->setCellValue('C'. 1, 'extroverted');
        $objPHPExcel->getActiveSheet()->setCellValue('D'. 1, 'confident');
        $objPHPExcel->getActiveSheet()->setCellValue('E'. 1, 'outgoing');
        $objPHPExcel->getActiveSheet()->setCellValue('A'. 1, 'user_name');




        // Fill worksheet from values in array
        for($i = 0; $i < count($query); $i++){
            $item = $query[$i];
            // Yii::$app->end(print_r($item));

            $j = $i + 2;
            $objPHPExcel->getActiveSheet()->setCellValue('A'. $j, $item->id);
            $objPHPExcel->getActiveSheet()->setCellValue('B'. $j, $item->optimistic);
            $objPHPExcel->getActiveSheet()->setCellValue('C'. $j, $item->extroverted);
            $objPHPExcel->getActiveSheet()->setCellValue('D'. $j, $item->confident);
            $objPHPExcel->getActiveSheet()->setCellValue('E'. $j, $item->outgoing);
        }

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Character');

        // Set AutoSize for name and email fields
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

        // Save Excel 2007 file
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachement; filename="student-character.xlsx"');
        $objWriter->save('php://output');

        return $this->redirect('index.php?r=site/student-character');

    }

    public function actionHappinessExcel(){
        $query  =Happiness::find()->all();

        $objPHPExcel  = new \PHPExcel();

        //Set title
        $objPHPExcel->getActiveSheet()->setCellValue('B'. 1, 'happiness');
        $objPHPExcel->getActiveSheet()->setCellValue('C'. 1, 'comhappiness');
        $objPHPExcel->getActiveSheet()->setCellValue('D'. 1, 'careless');
        $objPHPExcel->getActiveSheet()->setCellValue('E'. 1, 'secretive');
        $objPHPExcel->getActiveSheet()->setCellValue('A'. 1, 'user id');




        // Fill worksheet from values in array
        for($i = 0; $i < count($query); $i++){
            $item = $query[$i];
            // Yii::$app->end(print_r($item));

            $j = $i + 2;
            $objPHPExcel->getActiveSheet()->setCellValue('A'. $j, $item->id);
            $objPHPExcel->getActiveSheet()->setCellValue('B'. $j, $item->happiness);
            $objPHPExcel->getActiveSheet()->setCellValue('C'. $j, $item->comhappiness);
            $objPHPExcel->getActiveSheet()->setCellValue('D'. $j, $item->careless);
            $objPHPExcel->getActiveSheet()->setCellValue('E'. $j, $item->secretive);
        }

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Character');

        // Set AutoSize for name and email fields
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

        // Save Excel 2007 file
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachement; filename="student-happiness.xlsx"');
        $objWriter->save('php://output');


        return $this->redirect('index.php?r=site/student-happiness');

    }

    public function actionRelationExcel(){
        $matrix = Relation::generate2DMatrix();
        $ids = Relation::getAllParticipants();
        $ids = $this->getIdValues($ids);

        $objPHPExcel  = new \PHPExcel();
        // Fill worksheet from values in array
        for($i = 0; $i < count($ids); $i++){
            $id = $ids[$i];
            $j = $i + 2;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('A', $j,
                $id );
        }

        $objPHPExcel->getActiveSheet()->fromArray($ids, null, 'B1');
        $objPHPExcel->getActiveSheet()->fromArray($matrix, null, 'B2');

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Relations');

        // Set AutoSize for name and email fields
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);

        // Save Excel 2007 file
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachement; filename="relation.xlsx"');
        $objWriter->save('php://output');

        return $this->render('student-relation-matrix', ['matrix' => $matrix, 'ids' => $ids]);

    }

    public function actionStageoneExcel(){
        $matrix = StageOne::generate2DMatrix();
        $ids = StageOne::getAllParticipants();
        $ids = $this->getIdValues($ids);

        $objPHPExcel  = new \PHPExcel();
        // Fill worksheet from values in array
        for($i = 0; $i < count($ids); $i++){
            $id = $ids[$i];
            $j = $i + 2;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('A', $j,
                $id );
        }

        $objPHPExcel->getActiveSheet()->fromArray($ids, null, 'B1');
        $objPHPExcel->getActiveSheet()->fromArray($matrix, null, 'B2');

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('StageOne');

        // Set AutoSize for name and email fields
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);


        // Save Excel 2007 file
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachement; filename="stageone.xlsx"');
        $objWriter->save('php://output');

        //$objWriter->save(str_replace(__FILE__,'../runtime/stageone.xlsx',__FILE__));

        return $this->render('stageone-matrix', ['matrix' => $matrix, 'ids' => $ids]);

    }

    

    private function getIdValues($ids){
        $idonly  = array();
        foreach($ids as $id){
            $value = $id['id'];
            $idonly[] = $value;
        }

        return $idonly;
    }
}
    