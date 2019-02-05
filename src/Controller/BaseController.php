<?php
/**
 * Created by PhpStorm.
 * User: Wilson-PC
 * Date: 1/30/2019
 * Time: 8:06 PM
 */

namespace App\Controller;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


abstract class BaseController extends AbstractController
{
    /**
     * @method User|null getUser()
     */
    protected function getUser(): User
    {
        return parent::getUser();
    }

}