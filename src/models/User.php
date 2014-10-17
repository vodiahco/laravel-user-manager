<?php
namespace Ddata\UserManager\Models;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use App\Models\BaseModelAbstract;

class User extends BaseModelAbstract implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;
        
    public static $rules = array(
        'first_name'=>'sometimes|required|alpha|min:2',
            'last_name'=>'sometimes|required|alpha|min:2',
            'email'=>'sometimes|required|email|unique:user',
            'password'=>'sometimes|required|alpha_num|between:6,12|confirmed',
            'password_confirmation'=>'sometimes|required|alpha_num|between:6,12'
        );
    
    const EMAIL_RESET_HASH = "email";
    const ACTIVATION_HASH = "activation";

    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'user';

    protected $fillable = array(
        'first_name',
        'last_name',
        'middle_name',
        'email',
        'password',
    );

    /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
    
    protected $hidden = array('password', 'remember_token');
        
    public function setSignupDefaults()
    {
        $this->hashname = $this->generateHash(true);
        $this->identifier = $this->generateHash(true);
        $this->status = self::OFF;
        $this->is_active = self::OFF;
        $this->notify_newpost = self::ON;
        $this->notify_newuser = self::ON;
        $this->salt = rand(1, 100).time();
        $this->uid = self::OFF;
    }
    
    public function setActive()
    {
        $this->is_active = self::ON;
    }
    
    public function resetHashname()
    {
        $this->hashname = $this->generateHash(true);
    }
    
    public function resetIdentifier()
    {
        $this->generateHash(true);
    }
    
    public function generateHash($verify = false)
    {
        $time = time();
        $url = md5($this->email.rand(1, 100).$time);
        return ($verify) ? $url."_".$time : $url;
    }
    
    public function isvalidHash($type = self::ACTIVATION_HASH)
    {
        $paths = [];
        if ($type == self::EMAIL_RESET_HASH) {
            $paths = explode("_", $this->reset_token);
        } else {
            $paths = explode("_", $this->hashname);
        }
        
        if (count($paths) == 2) {
            $xtime = $paths[1];
            return ($xtime < (time() + (86400 * 3)));
        }
        return false;
    }
    

    
    public function findByEmail($email)
    {
        return $this->firstByAttributes(['email' => $email]);
    }
    

    public function isRegisteredUser($email)
    {
        return (null != $this->findByEmail($email));
    }
    
    public function isActive()
    {
        return self::OFF != $this->is_active;
    }
    
    public function getFullName()
    {
        return $this->first_name. " ". $this->last_name;
    }
    
}
