<?php
/**
 * File : HomeController.php
 * Author : D. Ramos
 * Created : 2020-10-06
 * Modified last :
 **/

class HomeController
{
    /**
     * This method displays the home page with its three buttons
     */
    public function index()
    {
        require_once "../ressources/views/home.php";
    }
}