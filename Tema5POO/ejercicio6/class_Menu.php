<?php

class Menu
{

    private $url;
    private $nombre;

    public function __construct($nueva_url,$nuevo_nombre)
    {
        $this->url=$nueva_url;
        $this->nombre=$nuevo_nombre;
        
    }
    /**
     * Get the value of url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the value of url
     */
    public function setUrl($nueva_url)
    {
        $this->url = $nueva_url;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */
    public function setNombre($nuevo_nombre)
    {
        $this->nombre = $nuevo_nombre;

        return $this;
    }
}
