<?php

namespace Oenstrom\User;

class User
{
    private $id;
    private $authority;
    private $username;
    private $password;
    private $firstname;
    private $lastname;
    private $email;
    private $birthday;
    private $bio;


    /**
     * Get the specified object property.
     *
     * @param string $var The name of the property.
     *
     * @return property The value of the property.
     */
    public function get($var)
    {
        return $this->{$var};
    }


    /**
     * Edit an user.
     *
     * @param array $fields POST array.
     */
    public function edit($fields)
    {
        $this->id        = isset($fields["id"]) ? $fields["id"] : $this->id;
        $this->authority = isset($fields["authority"]) ? $fields["authority"] : $this->authority;
        $this->username  = isset($fields["username"]) ? $fields["username"] : $this->username;
        $this->password  = !empty($fields["new_password"]) ? password_hash($fields["new_password"], PASSWORD_DEFAULT) : $this->password;
        $this->firstname = $fields["firstname"];
        $this->lastname  = $fields["lastname"];
        $this->email     = $fields["email"];
        $this->birthday  = $fields["birthday"];
        $this->bio       = $fields["bio"];
    }


    /**
     * Get object vars.
     *
     * @return array The properties of the object.
     */
    public function getInfo()
    {
        return get_object_vars($this);
    }


    /**
     * Get a Gravatar URL for the user email address.
     *
     * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     *
     * @return String containing either just a URL or a complete image tag
     * @source https://gravatar.com/site/implement/images/php/
     */
    public function getGravatar($size = 80, $default = 'mm', $rating = 'g')
    {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($this->email)));
        $url .= "?s=$size&d=$default&r=$rating";
        return $url;
    }
}
