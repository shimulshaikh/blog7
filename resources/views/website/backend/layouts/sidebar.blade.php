<!-- START LEFT ASIDE SECTION -->
            <aside class="main-sidebar">
                <!-- START SIDEBAR SECTION -->
                <section class="sidebar">
                    <!-- START SIDEBAR USER PANEL PART -->
                    <div class="user-panel">
                        <div style="font-weight: bold;"><img class="img-responsive searchIcon" src="{{asset('backend/dist/img/searchIcon.png')}}"><span>Menu</span></div>
                    </div><!-- SIDEBAR USER PANEL PART END -->


                    <!-- START SEARCH FORM PART -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Menu Search">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form><!-- SEARCH FORM PART END -->


                    <!-- START SIDEBAR MENU PART -->
                    <ul class="sidebar-menu">
                        <li class="treeview">
                            <a href="#">
                                <img class="img-responsive searchIcon" src="{{asset('backend/dist/img/searchIcon.png')}}"><span class="aside-main-menu">Tags</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-caret-down pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('tag.index')}}"><img class="img-responsive bulletIcon" src="{{asset('backend/dist/img/bulletIcon.png')}}">Tag</a></li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <img class="img-responsive searchIcon" src="{{asset('backend/dist/img/searchIcon.png')}}"><span class="aside-main-menu">Category</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-caret-down pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('category.index')}}"><img class="img-responsive bulletIcon" src="{{asset('backend/dist/img/bulletIcon.png')}}">category</a></li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <img class="img-responsive searchIcon" src="{{asset('backend/dist/img/searchIcon.png')}}"><span class="aside-main-menu">Posts</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-caret-down pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('post.index')}}"><img class="img-responsive bulletIcon" src="{{asset('backend/dist/img/bulletIcon.png')}}">Post</a></li>
                            </ul>
                            <ul class="treeview-menu">
                                <li><a href="{{route('post.pending')}}"><img class="img-responsive bulletIcon" src="{{asset('backend/dist/img/bulletIcon.png')}}">Pending</a></li>
                            </ul>
                        </li>
                        
                    </ul><!-- SIDEBAR MENU PART END -->
                </section><!-- START SIDEBAR SECTION -->
            </aside><!-- LEFT ASIDE SECTION END -->