<!-- <?php
				$user = $this->session->userdata('user');
				extract($user);
			?> -->
<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="<?php echo base_url('assets/img/brand/blue.png" class="navbar-brand-img" alt="..." ')?>">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="<?=site_url().'/home/'?>">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=site_url().'/models/'?>">
                <i class="ni ni-planet text-orange"></i>
                <span class="nav-link-text">Models</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=site_url().'/molddetails/'?>">
                <i class="ni ni-planet text-orange"></i>
                <span class="nav-link-text">Mold Details</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=site_url().'/debplans/'?>">
                <i class="ni ni-planet text-orange"></i>
                <span class="nav-link-text">Deburring Plan</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=site_url().'/areas/'?>">
                <i class="ni ni-planet text-orange"></i>
                <span class="nav-link-text">Areas</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?=site_url().'/lines/'?>">
                <i class="ni ni-planet text-orange"></i>
                <span class="nav-link-text">Lines</span>
              </a>
            </li>
           
           
          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Documentation</span>
          </h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
           
            <li class="nav-item ">
              <a style="background-color: #C5FFF8;" class="nav-link active active-pro" href="<?php echo base_url(); ?>index.php/user/logout">
              <!-- <a style="background-color: #C5FFF8;" class="nav-link active active-pro" href="<?=site_url().'/Auth/logout'?>"> -->
                <i style="font-size: 25px" class="ni ni-atom text-dark"></i>
                <span class="nav-link-text"><b>Logout</b></span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          <!-- <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
            <div class="form-group mb-0">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" placeholder="Search" type="text">
              </div>
            </div>
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </form> -->
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
           
              
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="<?php echo base_url('assets/img/theme/team-1.jpg')?>">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <!-- <span class="mb-0 text-sm  font-weight-bold"><?php echo $fullname; ?></span> -->
                    <span class="mb-0 text-sm  font-weight-bold"><?php echo $fullname; ?></span>
                  </div>
                </div>
              </a>
              
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <!-- Header -->

    

        <!-- Logout Modal-->
        <!-- <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Are you sure do you want to logout?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="#">Logout</a>
        </div>
      </div>
    </div>
  </div> -->
  