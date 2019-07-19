<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\Adminuser;

// 前台用户注册
class SignupForm extends Model
{
    public $username;
    public $nickname;
    public $email;
    public $password;
		public $password2; // 重复密码
		public $verifyCode; // 验证码
  
		public $profile;
		public $avatar;
		public $level;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // required 必填项， trim 去除空格
            [['username', 'email', 'nickname'], 'trim'],
            [['username', 'password', 'password2', 'email',], 'required'],

            // unique 唯一值, targetClass 对应的 数据库表
            ['username', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => '用户名已注册'],
            [['username'], 'string', 'min' => 6, 'max' => 120],
            // match 正则匹配
            ['username', 'match',
              'pattern'=>'/^[(\x{4E00}-\x{9FA5})a-zA-Z]+[(\x{4E00}-\x{9FA5})a-zA-Z_\d]*$/u',
              'message'=>'用户名由字母 汉字 数字 下划线组成，不能以数字和下划线开头。'
            ],

            ['email', 'email'],
            ['email', 'string', 'max' => 60],
            ['email', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => '邮箱已注册'],

            
            [['password', 'password2'], 'string', 'min' => 6],
            ['password2', 'compare',
              'compareAttribute' => 'password', 'message' => '两次密码输入不一致'],
            // ['verifyCode', 'captcha']
        ];
    }


    public function attributeLabels() {
      return [
        'username' => '用户名',
        'nickname' => '昵称',
				'email' => '邮箱',
				'password' => '密码',
				'password2' => '重复密码',
        'profile' => '自我介绍',
        'avatar' => '头像',
        'level' => '级别',
				'verifyCode' => '验证码'
      ];
    }


    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) return null;
        
        $user = new Adminuser();
        $user->username = $this->username;
        $user->nickname = $this->nickname;
        $user->email = $this->email;
        $user->profile = $this->profile;
        
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user-> password = '*';
        
        return $user->save() ? $user : null;
  
      // $user->generateEmailVerificationToken();
      // return $user->save() && $this->sendEmail($user);

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
