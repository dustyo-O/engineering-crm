<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\base\InvalidParamException;
use common\models\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $password_repeat;

    /**
     * @var \common\models\User
     */
    private $_user;


    /**
     * Creates a form model on current user.
     *
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($config = [])
    {
        $this->_user = Yii::$app->user->identity;
        if (!$this->_user) {
            throw new InvalidParamException('No user');
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password', 'password_repeat'], 'required'],
            ['password', 'string', 'min' => 6],
            ['password', 'compare', 'compareAttribute' => 'password_repeat']
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        if ($this->password === $this->password_repeat) 
        {
            $user = $this->_user;
            $user->setPassword($this->password);

            return $user->save(false);
        }

        return false;
    }
}
