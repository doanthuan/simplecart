<?php

namespace Goxob\Locale\Block\Admin\Grid\Renderer;


class CurrencyDefault implements \Goxob\Core\Block\Grid\RendererInterface{
    public function render($row)
    {
        return $row->default == 1 ? trans('True') : trans('False');
    }
}