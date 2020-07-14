<?php



use Dompdf\Autoloader;
use Dompdf\Dompdf;

require_once "./model/Usuario.php";


class Renderer
{

    private $mustache;
    private $dompdf;



    public function __construct($partialsPathLoader)
    {

        Autoloader::register();
        $this->dompdf = new Dompdf();
        Mustache_Autoloader::register();
        $this->mustache = new Mustache_Engine(array(
            'partials_loader' => new Mustache_Loader_FilesystemLoader($partialsPathLoader)
        ));
    }

    public function render($contentFile, $data = array())
    {
        $contentAsString = file_get_contents($contentFile);
        $view = $this->mustache->render($contentAsString, array_merge($this->getArrayData(), $data));


        return $this->mustache->render("{{> doc }}", $this->getArrayDataWithView($view, $data));
    }

    public function renderPdf($contentFile, $data = array())
    {
        $contentAsString = file_get_contents($contentFile);
        $view = $this->mustache->render($contentAsString, array_merge($this->getArrayData(), $data));


        $this->dompdf->loadHtml($this->mustache->render("{{> doc }}", $this->getArrayDataWithView($view, $data)));
        $this->dompdf->render();
        $this->dompdf->stream();
    }

    private function getArrayData()
    {
        return array(
            "session" => $_SESSION,
            "cookie" => $_COOKIE,
            "request" => $_REQUEST,
        );
    }

    private function getArrayDataWithView($view, $data = array())
    {
        return
            array_merge(
                $this->getArrayData(),
                array(
                    "title" => "Infonete",
                    "content" => $view,
                ),
                $data
            );
    }
}