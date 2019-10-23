<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $routes = "";
    private $link = "";
    private $breadcrumb = ["Home" => "#"];
    private $title = "Title";
    private $subtitle = " ";
    private $tableStruct = [];

    public function setBreadcrumb($value=[])
    {
        $this->breadcrumb = $value;
    }

    public function pushBreadCrumb($value=[])
    {
        $this->breadcrumb = array_merge($this->breadcrumb, $value);
        // array_push($this->breadcrumb, $value);
    }

    public function getBreadcrumb()
    {
        return $this->breadcrumb;
    }

    public function setTableStruct($value=[])
    {
        $this->tableStruct = $value;
    }

    public function getTableStruct()
    {
        return $this->tableStruct;
    }

    public function setRoutes($value)
    {
        $this->routes = $value;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function setTitle($value="")
    {
        $this->title = $value;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setSubtitle($value="")
    {
        $this->subtitle = $value;
    }

    public function getSubtitle()
    {
        return $this->subtitle;
    }

    public function setLink($value="")
    {
        $this->link = $value;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function render($view, $additional=[])
    {
        $data = [
            'routes'     => $this->routes,
            'pageUrl'    => $this->link,
            'breadcrumb' => $this->breadcrumb,
            'title'      => $this->title,
            'subtitle'   => $this->subtitle,
            'tableStruct'=> $this->tableStruct,
        ];

        return view($view, array_merge($data, $additional));
    }

    public function makeButton($params = [])
    {
        $settings = [
            'id'    => '',
            'class'    => 'blue',
            'label'    => 'Button',
            'tooltip'  => '',
            'target'   => url('/'),
            'disabled' => '',
            'url' => '',
        ];

        $btn = '';
        $datas = '';
        $attrs = '';

        if (isset($params['datas'])) {
            foreach ($params['datas'] as $k => $v) {
                $datas .= " data-{$k}=\"{$v}\"";
            }
        }

        if (isset($params['attributes'])) {
            foreach ($params['attributes'] as $k => $v) {
                $attrs .= " {$k}=\"{$v}\"";
            }
        }

        switch ($params['type']) {
            case "delete":
                $settings['class']   = 'm-l delete button';
                $settings['label']   = '<i class="fa fa-trash text-light"></i>';
                $settings['tooltip'] = 'Delete';
                $settings['disabled'] = '';
                
                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";
                $btn = "<a href=\"#\" {$datas}{$attrs}{$extends} class='{$params['class']} ".($params['disabled'] ? 'disabled' : '')."' data-toggle=\"popover\" title=\"{$params['tooltip']}\">
                			{$params['label']}
                		</a>\n";
                break;
            case "edit":
                $settings['class']   = 'edit button';
                $settings['label']   = '<i class="fa fa-pencil text-light"></i>';
                $settings['tooltip'] = 'Edit';
                
                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";

                $btn = "<a href=\"#\" {$datas}{$attrs}{$extends} 
                           class='{$params['class']}' 
                           data-toggle=\"popover\" 
                           title=\"{$params['tooltip']}\"
                           {$params['disabled']} 
                        >
                			{$params['label']}
                		</a>\n";
                break;
            case "modal":
                $settings['onClick'] = '';
                $settings['class']   = 'blue icon edit';
                $settings['label']   = '<i class="edit icon"></i>';
                $settings['tooltip'] = 'Ubah Data';
                
                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";

                $btn = "<button type='button' {$datas}{$attrs}{$extends} 
                                class='{$params['class']} ".($params['disabled'] ? 'disabled' : '')."' 
                                onclick='{$params['onClick']}' 
                                data-toggle=\"popover\" 
                                title=\"{$params['tooltip']}\"
                                {$params['disabled']}
                        >
                            {$params['label']}
                        </button>\n";
                break;
            case "url":
            default:
                $settings['class']   = 'url button';
                $settings['label']   = '<i class="fa fa-pencil text-light"></i>';
                $settings['tooltip'] = 'Edit';
                
                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";

                $btn = "<a href=\"{$params['url']}\" {$datas}{$attrs}{$extends} 
                           class='{$params['class']}' 
                           data-toggle=\"popover\" 
                           title=\"{$params['tooltip']}\"
                           {$params['disabled']} 
                        >
                            {$params['label']}
                        </a>\n";
                break;
            case "approve":
                $settings['class']   = 'approve button';
                $settings['label']   = '<i class="fa fa-check-square text-light"></i>';
                $settings['tooltip'] = 'Approve';
                
                $params  = array_merge($settings, $params);
                $extends = " data-content='{$params['tooltip']}' data-id='{$params['id']}'";

                $btn = "<a href=\"#\" {$datas}{$attrs}{$extends} 
                           class='{$params['class']}' 
                           data-toggle=\"popover\" 
                           title=\"{$params['tooltip']}\"
                           {$params['disabled']} 
                        >
                            {$params['label']}
                        </a>\n";
                break;
        }

        return $btn;
    }
}
