<?php


class DashboardController
{
    private $renderer;

    /**
     * DashboardController constructor.
     * @param Renderer $renderer
     */
    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function getIndex()
    {
        echo $this->renderer->render("view/dashboard.mustache",
            array("title" => "Dashboard"));
    }
}