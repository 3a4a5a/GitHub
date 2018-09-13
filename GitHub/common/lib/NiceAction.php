<?php
namespace common\lib;

/* @var $user \common\modules\user\models\User */
/* @var $editProfileInfoForm \common\modules\user\models\forms\EditProfileInfoForm */

use common\modules\user\models\forms\settings\PersonalForm;
use common\modules\user\models\forms\settings\PasswordForm;
use Yii;
use yii\base\Action;
use common\modules\user\models\User;
use yii\widgets\ActiveForm;
use yii\web\Response;
use ReflectionClass;

class NiceAction extends Action
{
    public $dataProviders = [];
    public $models = [];
    public $forms = [];
    public $data = [];
    
    public $urlData = [];
    public $receivedUrlParams = [];
    
    public $form;
    
    public $POST;
    public $GET;
    public $requestIsAjax = false;
    
    public function run()
    {
        if (Yii::$app->request->post()) {
            $this->POST = Yii::$app->request->post();
            
            if (Yii::$app->request->isAjax) {
                $this->requestIsAjax = true;
            }
        }
        
        if (Yii::$app->request->get()) {
            $this->GET = Yii::$app->request->get();
        }
    }
    
    public function saveForm()
    {
        if ($this->form->load(Yii::$app->request->post()) && $this->form->validate()) {
            if ($this->form->saveForm()) {
                return true;
            }
        }
        
        return false;
    }
    
    public function initForm()
    {
        if (Yii::$app->request->post()) {
            foreach ($this->forms as $form) {
                $reflect = new ReflectionClass($form);
                $formName = $reflect->getShortName();
                
                if (Yii::$app->request->post($formName)) {
                    $this->form = $form;
                    break;
                }
            }
        } else {
            return null;
        }
    }
    
    public function fillForm($fillArray)
    {
        foreach ($fillArray as $formName => $modelName) {
            $formToFill = $this->forms[$formName];
            $modelToFillWith = $this->models[$modelName];
            
            $formToFill->setAttributes($modelToFillWith->getAttributes());
            $this->form = $formToFill;
        }
    }
    
    public function ajaxValidation($form)
    {
        // Form
        $form->load(Yii::$app->request->post());
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ActiveForm::validate($form);
    }
    
    /**
     * 
     * @return User
     */
    public function getUser()
    {
        return User::findOne(Yii::$app->user->id);
    }
    
    public function render($viewName)
    {
        return $this->controller->render($viewName, [
            'dataProviders' => $this->dataProviders,
            'models' => $this->models,
            'forms' => $this->forms,
            'data' => $this->data,
        ]);
    }
    
    public function redirect($url)
    {  
        return $this->controller->redirect([$url]);
    }
    
    public function setFlash($key, $message)
    {
        Yii::$app->session->setFlash($key, $message);
    }
}