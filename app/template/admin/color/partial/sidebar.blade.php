<?php
function activeModule($names)
{
    if(!is_array($names)){
        $names = array($names);
    }
    $module = Session::get('current_module');
    echo in_array($module, $names)?'active':'';
}

function activeItem($names)
{
    if(!is_array($names)){
        $names = array($names);
    }
    $controller = strtolower(Session::get('current_controller'));
    echo in_array($controller, $names)?'active':'';
}

?>
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;"><div data-scrollbar="true" data-height="100%" style="overflow: hidden; width: auto; height: 100%;">
            <!-- begin sidebar user -->
            <ul class="nav">
                <li class="nav-profile">
                    <div class="info">
                        <small>Logged in as</small> Admin
                    </div>
                </li>
            </ul>
            <!-- end sidebar user -->
            <!-- begin sidebar nav -->
            <ul class="nav">
                <li class="nav-header">Navigation</li>
                <li class="{{activeModule('application')}}">
                    <a href="{{url('admin/dashboard')}}"><i class="fa fa-laptop"></i> <span>Dashboard</span></a>
                </li>
                <li class="has-sub {{activeModule('catalog')}}">
                    <a href="javascript:;">
                        <i class="fa fa-suitcase"></i>
                        <b class="caret pull-right"></b>
                        <span>@lang('Catalog')</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="{{activeItem('product')}}"><a href="{{url('admin/catalog/product')}}">{{trans('Products')}}</a></li>
                        <li class="{{activeItem('category')}}"><a href="{{url('admin/catalog/category')}}">{{trans('Categories')}}</a></li>
                        <li class="has-sub {{activeItem( array('attribute','attributeset') )}}">
                            <a href="javascript:;">
                                <b class="caret pull-right"></b>
                                {{trans('Attributes')}}
                            </a>
                            <ul class="sub-menu">
                                <li class="{{activeItem('attribute')}}"><a href="{{url('admin/catalog/attribute')}}">{{trans('Attributes')}}</a></li>
                                <li class="{{activeItem('attributeset')}}"><a href="{{url('admin/catalog/attribute-set')}}">{{trans('Attribute Sets')}}</a></li>
                            </ul>
                        </li>
                        <li class="divider"></li>
                        <li class="{{activeItem('review')}}"><a href="{{url('admin/catalog/review')}}">{{trans('Reviews')}}</a></li>
                        <li class="{{activeItem('vendor')}}"><a href="{{url('admin/catalog/vendor')}}">{{trans('Vendors')}}</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <i class="fa fa-file-o"></i>
                        <b class="caret pull-right"></b>
                        <span>Form Stuff</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="form_elements.html">Form Elements</a></li>
                        <li><a href="form_plugins.html">Form Plugins</a></li>
                        <li><a href="form_validation.html">Form Validation</a></li>
                        <li><a href="form_wizards.html">Wizards</a></li>
                        <li><a href="form_wysiwyg.html">WYSIWYG</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret pull-right"></b>
                        <i class="fa fa-th"></i>
                        <span>Tables</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="table_basic.html">Basic Tables</a></li>
                        <li><a href="table_manage.html">Managed Tables</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <i class="fa fa-envelope"></i>
                        <b class="caret pull-right"></b>
					        <span>
					            Email Template 
					            <span class="label label-success m-l-5">NEW</span>
					        </span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="email_system.html">System Template <i class="fa fa-paper-plane text-success m-l-5"></i></a></li>
                        <li><a href="email_newsletter.html">Newsletter Template <i class="fa fa-paper-plane text-success m-l-5"></i></a></li>
                    </ul>
                </li>
                <li><a href="charts.html"><i class="fa fa-signal"></i> <span>Charts</span></a></li>
                <li><a href="calendar.html"><i class="fa fa-calendar"></i> <span>Calendar</span></a></li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <i class="fa fa-map-marker"></i>
                        <b class="caret pull-right"></b>
                        <span>Map</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="map_vector.html">Vector Map</a></li>
                        <li><a href="map_google.html">Google Map</a></li>
                    </ul>
                </li>
                <li><a href="gallery.html"><i class="fa fa-camera"></i> <span>Gallery</span></a></li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <i class="fa fa-cogs"></i>
                        <b class="caret pull-right"></b>
                        <span>Page Options</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="page_blank.html">Blank Page</a></li>
                        <li><a href="page_with_footer.html">Page with Footer</a></li>
                        <li><a href="page_without_sidebar.html">Page without Sidebar</a></li>
                        <li><a href="page_with_right_sidebar.html">Page with Right Sidebar</a></li>
                        <li><a href="page_with_minified_sidebar.html">Page with Minified Sidebar</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <i class="fa fa-gift"></i>
                        <b class="caret pull-right"></b>
						    <span>
						        Extra
						        <span class="label label-success m-l-5">NEW</span>
						    </span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="extra_timeline.html">Timeline <i class="fa fa-paper-plane text-success m-l-5"></i></a></li>
                        <li><a href="extra_coming_soon.html">Coming Soon Page <i class="fa fa-paper-plane text-success m-l-5"></i></a></li>
                        <li><a href="extra_search_results.html">Search Results</a></li>
                        <li><a href="extra_invoice.html">Invoice</a></li>
                        <li><a href="extra_404_error.html">404 Error Page</a></li>
                        <li><a href="extra_login.html">Login</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <i class="fa fa-align-left"></i>
                        <b class="caret pull-right"></b>
                        <span>Menu Level</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="has-sub">
                            <a href="javascript:;">
                                <b class="caret pull-right"></b>
                                Menu 1.1
                            </a>
                            <ul class="sub-menu">
                                <li class="has-sub">
                                    <a href="javascript:;">
                                        <b class="caret pull-right"></b>
                                        Menu 2.1
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a href="javascript:;">Menu 3.1</a></li>
                                        <li><a href="javascript:;">Menu 3.2</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:;">Menu 2.2</a></li>
                                <li><a href="javascript:;">Menu 2.3</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:;">Menu 1.2</a></li>
                        <li><a href="javascript:;">Menu 1.3</a></li>
                    </ul>
                </li>
                <!-- begin sidebar minify button -->
                <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
                <!-- end sidebar minify button -->
            </ul>
            <!-- end sidebar nav -->
        </div><div class="slimScrollBar ui-draggable" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 1px; height: 98.11616954474098px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
    <!-- end sidebar scrollbar -->
</div>