<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

                <li class="menu-title"> 
                    <span>Main</span>
                </li>

                <li class=""> 
                    <a href=""><i class="fe fe-home"></i> <span>Dashboard</span></a>
                </li>
                @if (in_array('Slider', json_decode(Auth::guard('admin')->user()->role->permission)))
                <li class=""> 
                    <a href="{{route('slider.index')}}"><i class="fe fe-home"></i> <span>Slider</span></a>
                </li>
                @endif
                
                @if (in_array('Testimonial', json_decode(Auth::guard('admin')->user()->role->permission)))
                <li class=""> 
                    <a href="{{route('testimonial.index')}}"><i class="fe fe-home"></i> <span>Testimonial</span></a>
                </li>
                @endif
                @if (in_array('Our Clints', json_decode(Auth::guard('admin')->user()->role->permission)))
                <li class=""> 
                    <a href="{{route('client.index')}}"><i class="fe fe-home"></i> <span>Our Clints</span></a>
                </li>
                @endif
                @if (in_array('Our Team', json_decode(Auth::guard('admin')->user()->role->permission)))
                <li class=""> 
                    <a href=""><i class="fe fe-home"></i> <span>Our Team</span></a>
                </li>
                @endif
                @if (in_array('Expertise', json_decode(Auth::guard('admin')->user()->role->permission)))
                <li class=""> 
                    <a href="{{route('expertise.index')}}"><i class="fe fe-home"></i> <span>Expertise</span></a>
                </li>
                @endif
                @if (in_array('The Vision', json_decode(Auth::guard('admin')->user()->role->permission)))
                <li class=""> 
                    <a href="{{route('vision.index')}}"><i class="fe fe-home"></i> <span>The Vision</span></a>
                </li>
                @endif
                @if (in_array('Counter', json_decode(Auth::guard('admin')->user()->role->permission)))
                <li class=""> 
                    <a href="{{route('counter.index')}}"><i class="fe fe-home"></i> <span>Counter</span></a>
                </li>
                @endif
                @if (in_array('Post', json_decode(Auth::guard('admin')->user()->role->permission)))
                <li class="submenu">
                    <a href="#"><i class="fe fe-document"></i> <span> Post</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="invoice-report.html">All Post</a></li>
                        <li><a href="invoice-report.html">Category</a></li>
                        <li><a href="invoice-report.html">Tag</a></li>
                    </ul>
                </li>
                @endif

                @if (in_array('Portfolio', json_decode(Auth::guard('admin')->user()->role->permission)))
                <li class="submenu">
                    <a href="#"><i class="fe fe-document"></i> <span> Portfolio</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="invoice-report.html">Portfolio</a></li>
                        <li><a href="{{route('category.index')}}">Category</a></li>
                        <li><a href="invoice-report.html">Tag</a></li>
                    </ul>
                </li>
                @endif      
           

                <li class="menu-title"> 
                    <span>admin panel</span>
                </li>
 
                
                @if (in_array('Admin User', json_decode(Auth::guard('admin')->user()->role->permission)))
                <li class="submenu">
                    <a href="#"><i class="fe fe-document"></i> <span> Admin User</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{route('admin-user.index')}}">All Users</a></li>
                        <li><a href="{{route('role.index')}}">Role</a></li>
                        <li><a href="{{route('permission.index')}}">Permission</a></li>
                    </ul>
                </li>
                @endif

                @if (in_array('Theme Option', json_decode(Auth::guard('admin')->user()->role->permission)))
                <li> 
                    <a href="settings.html"><i class="fe fe-vector"></i> <span>Theme Option</span></a>
                </li>
                @endif

                @if (in_array('Settings', json_decode(Auth::guard('admin')->user()->role->permission)))
                <li> 
                    <a href="settings.html"><i class="fe fe-vector"></i> <span>Settings</span></a>
                </li>
                @endif

            </ul>

           
            


        </div>
    </div>
</div>