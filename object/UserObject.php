<?php


class UserObject
{
    const PERM_GROUP_VISITOR = 0, PERM_GROUP_USER = 1, PERM_GROUP_ADMIN = 9;

    const
        //Gerekeb min permi belirler
        PERM_IS = 0,
        //Ek olarak id verilir, user id farklısa false döner
        PERM_SELF = 1,
        //Şu veya daha üstü demektir
        PERM_UPPER = 2,
        //Kendisi veya daha yükseği demek
        PERM_SELF_OR_UPPER = 3;

    //todo
    public $id, $email, $fistName, $lastName, $isAdmin, $isAuthor, $permGroup;

    public function register(){
        //todo
    }

    public function login($userName, $password){
        global $database;

        $suffix = $database->first('SELECT suffix FROM users WHERE user_email = "'.$userName.'" AND is_deleted = 0');

        if($suffix->data == null){
            //todo user yok
        }

        $encryptedPassword = self::encryptPassword($password, $suffix->data);

        $user = $database->first('SELECT * FROM users WHERE user_email = "'.$userName.'" AND user_password = "'.$password.'" is_deleted = 0');

        if($user->data == null){
            //todo kullanıcı adı ve şifre
        }

        //todo session, token ?

        $user = $user->data;

        $this->id = $user['user_id'];
        $this->email = $user['user_email'];
        $this->fistName = $user['user_first_name'];
        $this->lastName = $user['user_last_name'];
        $this->isAdmin = $user['user_is_admin'];
        $this->isAuthor = $user['user_is_author'];
        $this->permGroup = ($this->isAdmin ? self::PERM_GROUP_ADMIN : self::PERM_GROUP_VISITOR);

        return new Output(true,'', $this);
    }

    public function perm($permType, $optionalFirst = 0, $optionalSecond = 0){
        switch ($permType){
            case self::PERM_IS:
                //First => İstenilen Perm
                if($this->permGroup != $optionalFirst){
                    return new Output(false);
                }
                break;
            case self::PERM_SELF:
                //First => İstenilen datadaki ID
                if($this->id != $optionalFirst){
                    return new Output(false);
                }
                break;
            case self::PERM_SELF_OR_UPPER:
                //First => İstenilen Kullanıcı ID
                //Seond => Min. Gereken Grup
                if($this->id != $optionalFirst && $optionalSecond > $this->permGroup){
                    return new Output(false);
                }
                break;
            case self::PERM_UPPER:
                //First => İstenilen Grup ID
                if($this->permGroup < $optionalFirst){
                    return new Output(false);
                }
                break;
        }

        return new Output(true);
    }
}