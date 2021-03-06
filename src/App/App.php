<?php

namespace Oenstrom\App;

/**
 * An App class to wrap the resources of the framework.
 */
class App
{
    /**
     * Redirects the user to the route specified in the path.
     *
     * @param string $path The location to redirect to.
     *
     * @SuppressWarnings(PHPMD.ExitExpression)
     */
    public function redirect($path)
    {
        if ($path === "404") {
            $this->router->handleInternal("404");
        } else {
            $this->response->redirect($this->url->create($path));
        }
        exit;
    }


    /**
     * Wrapper for TextFilter->format()
     *
     * @param string $text The text to escape.
     */
    public function esc($text)
    {
        return $this->textFilter->format($text, "esc");
    }


    /**
     * Add block content to region.
     *
     * @param string $slug      Slug to fetch data with from database.
     * @param string $region    which region to attach the view.
     * @param int $order        which order to display the views.
     */
    public function addBlock($slug, $region, $order)
    {
        $contentDao = new \Oenstrom\Content\ContentDao($this->db);
        $data = $contentDao->getContent("block", $slug);
        $this->view->add("view/block", ["region" => $region, "data" => $data], $region, $order);
    }


    /**
     * Wrapper for rendering page with default regions.
     *
     * @param string $page Path for the content.
     * @param array $data Data to make available to the view.
     * @param string $layout The layout file to use.
     */
    public function renderPage($page, $data, $layout = "default")
    {
        $this->view->add("layouts/$layout", $data, "layout");

        $this->view->add("view/flash", ["region" => "flash"], "flash", 0);
        $this->view->add($page, array_merge(["region" => "main"], $data), "main", 0);
        $this->view->add("view/footer", ["region" => "footer"], "footer", 0);

        $body = $this->view->renderBuffered("layout");
        $this->response->setBody($body)->send();
    }
}
