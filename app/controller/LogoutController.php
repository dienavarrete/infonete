<?php


class LogoutController
{
    public function getIndex()
    {
        session_unset();
        session_destroy();
        header("Location: /");
        exit();
    }
}