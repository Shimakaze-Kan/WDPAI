<?php

require_once "Repository.php";
require_once __DIR__."/../models/User.php";

class UserRepository extends Repository
{
    public function getUserByEmail(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :email
        ');

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        if($user == false)
        {
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['id'],
            $user['role'],
            $user['active'],
            $user['ban']
        );
    }

    public function getUserById(int $id): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE id = :id
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        if($user == false)
        {
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['id'],
            $user['role'],
            $user['active'],
            $user['ban']
        );
    }

    public function getUsersDetails(int $id)
    {
        $stmt = $this->database->connect()->prepare('
            select about, avatar_url from users_details
            where id=(select id_user_details from users where id=:id)
        ');

        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
        $details = $stmt->fetch(PDO::FETCH_ASSOC);
        return $details;
    }

    public function updateUsersDetails(int $id, string $avatar_url, string $about)
    {
        $stmt = $this->database->connect()->prepare('
            update public.users_details 
            set avatar_url = :avatar_url, about = :about
            where id=(select id_user_details from users where id=:id)
        ');

        $stmt->bindParam(':avatar_url', $avatar_url, PDO::PARAM_STR);
        $stmt->bindParam(':about', $about, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function addUser(User $user)
    {
        $date = new DateTime();

        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.users_details (about, avatar_url)
            VALUES (:about, :avatar)
            RETURNING id;
        ');

        $about = "";
        $avatar = "";
        $stmt->bindParam(':about', $about, PDO::PARAM_STR);
        $stmt->bindParam(':avatar', $avatar, PDO::PARAM_STR);
        $result = $stmt->execute();
        $user_details = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_details_id = $user_details['id'];

        if($result==false)
        {
            return "błąd przy user details".var_dump($result);
        }

        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.users (email,password,id_user_details,created_at)
            VALUES (?,?,?,?)
        ');

        $result = $stmt->execute([
          $user->getEmail(),
          password_hash($user->getPassword(),PASSWORD_BCRYPT),
            $user_details_id,
            $date->format("Y-m-d H:i:s")]
        );

        return "błąd przy dodaniu usera".var_dump($result);

    }

    public function changeUserActiveStatus(string $email,bool $state)
    {
        $stmt = $this->database->connect()->prepare('
            UPDATE public.users SET active=:state WHERE email=:email
        ');

        $stmt->bindParam(':state', $state, PDO::PARAM_BOOL);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        $result = $stmt->execute();

        return $result;
    }

    public function changeUserActiveStatusUsingId(int $id,bool $state)
    {
        $stmt = $this->database->connect()->prepare('
            UPDATE public.users SET active=:state WHERE id=:id
        ');

        $stmt->bindParam(':state', $state, PDO::PARAM_BOOL);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);

        $result = $stmt->execute();

        return $result;
    }

    public function getUserBanDate($id)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT ban from public.users where id=:id
        ');

        $stmt->bindParam(':id', $id,PDO::PARAM_INT);
        $stmt->execute();
        $date = $stmt->fetch(PDO::FETCH_ASSOC);

        return $date['ban'];
    }

    public function setUserBanDate($id, $newDate)
    {
        $stmt = $this->database->connect()->prepare('
            UPDATE public.users SET ban=:newDate WHERE id=:id
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':newDate', $newDate, PDO::PARAM_STR);
        $stmt->execute();

    }

    public function updateLastActivity($id)
    {
        $stmt = $this->database->connect()->prepare('
            select update_last_active(:id)
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getUserActiveStatus($id)
    {
        $stmt = $this->database->connect()->prepare('
            select active from public.users where id = :id
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['active'];
    }

}