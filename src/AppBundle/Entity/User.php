<?php
/**
 * Created by PhpStorm.
 * User: Sylwa
 * Date: 11.08.2016
 * Time: 11:40
 */

namespace AppBundle\Entity;


use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    private $username;

    public function getRoles()
    {
        return ['ROLE USER'];
    }

    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function setUsername($username){
        $this->username = $username;
    }

}