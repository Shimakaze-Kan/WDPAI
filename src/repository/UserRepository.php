<?php

require_once "Repository.php";
require_once __DIR__."/../models/User.php";

class UserRepository extends Repository
{
    public function getUser(string $email): ?User
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
            $user['id']
        );
    }

    public function getUsersDetails(int $id)
    {
        $stmt = $this->database->connect()->prepare('
            select country, about, avatar_url from users_details
            where id=(select id_user_details from users where id=:id)
        ');

        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
        $details = $stmt->fetch(PDO::FETCH_ASSOC);
        return $details;
    }

    public function addUser(User $user)
    {
        $date = new DateTime();

        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.users_details (country)
            VALUES (:country)
            RETURNING id;
        ');

        $country = "Finland";
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
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

}