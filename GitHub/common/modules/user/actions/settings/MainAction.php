<?php
namespace common\modules\user\actions\settings;

/* @var $user \common\modules\user\models\User */
/* @var $editProfileInfoForm \common\modules\user\models\forms\EditProfileInfoForm */

use common\modules\user\models\forms\settings\PersonalForm;
use common\modules\user\models\forms\settings\PasswordForm;
use common\lib\NiceAction;

class MainAction extends NiceAction
{
    public function run()
    {
        parent::run();
        
        $this->forms['personalForm'] = new PersonalForm();
        $this->forms['passwordForm'] = new PasswordForm();
        $this->models['user'] = $this->getUser();
        
        $this->initForm();
        
        if ($this->requestIsAjax == true) {
            return $this->ajaxValidation($this->form);
        }
        
        if ($this->POST) {
            $this->saveForm();
            $this->redirect('/user/settings');
        }
        
        
        $this->fillForm(['personalForm' => 'user']);
        return $this->render('main');
    }
}