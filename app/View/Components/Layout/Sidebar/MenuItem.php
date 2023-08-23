<?php

namespace App\View\Components\Layout\Sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuItem extends Component
{
    /**
     * Create a new component instance.
     */
    public $url;
    public $icon;
    public $label;
    public $submenu;
    private $segment;
    public $isActive;
    public $isSubmenuActive;
    private $path;
    public function __construct($url = null, $icon = null, $label = null, $submenu = false)
    {
        $this->url = $submenu ? '#' : url($url);
        $this->icon = $icon;
        $this->label = $label;
        $this->submenu = $submenu;
        $this->submenu = $submenu;
        $this->segment = $this->getSegment($url);
        $this->path = $this->getPath($url);
        $this->isActive = $this->isMenuActive();
        $this->isSubmenuActive = $this->isSubmenuActive();
    }

    function getSegment($url)
    {
        $url_path = explode("/", $url);
        return count($url_path);
    }
    function getPath($url)
    {
        $url_path = explode("/", $url);
        return end($url_path);
    }
    function isMenuActive()
    {
        if (is_array($this->path)) if (in_array(request()->segment($this->segment), $this->path)) return "active";
        if (request()->segment($this->segment) == $this->path) return "active";
    }
    function isSubmenuActive()
    {
        if (is_array($this->path)) if (in_array(request()->segment($this->segment), $this->path)) return "active menu-open";
        if (request()->segment($this->segment) == $this->path) return "active menu-open";
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout.sidebar.menu-item');
    }
}
