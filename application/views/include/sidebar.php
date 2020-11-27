  <?php 
      $controller = (!empty($this->uri->segment(1))?$this->uri->segment(1):'');
      $method = (!empty($this->uri->segment(2))?$this->uri->segment(2):'');
      $session = $this->session->userdata('bakery_manage_session');
  ?>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('dashboard'); ?>" class="brand-link">
      <img src="<?php echo base_url(); ?>assets/dist/img/AdminLTELogo.png" data-src="<?php echo base_url(); ?>assets/dist/img/AdminLTELogo.png" data-srcset="<?php echo base_url(); ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 lazy"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview menu-open">
            <a href="<?php echo base_url('dashboard') ?>" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item <?php if(in_array($controller, array('users'))) { echo 'menu-open'; } ?>">
            <a href="<?php echo base_url('users'); ?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Users</p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if(in_array($controller, array('products'))) { echo 'menu-open'; } ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-boxes"></i>
              <p>Products<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview" <?php if(in_array($controller, array('products'))) { echo 'style="display:block"'; } ?>>
              <li class="nav-item">
                <a href="<?php echo base_url('products/master-category'); ?>" class="nav-link <?php if(in_array($method, array('master-category','add-master-category','edit-master-category'))) { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon text-green"></i><p>Master Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('products/sub-category'); ?>" class="nav-link <?php if(in_array($method, array('sub-category','add-sub-category','edit-sub-category'))) { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon text-danger"></i><p>Sub Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('products/brand'); ?>" class="nav-link <?php if(in_array($method, array('add-brand','edit-brand'))) { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon text-danger"></i><p>Brand</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('products/list'); ?>" class="nav-link <?php if(in_array($method, array('list'))) { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview <?php if(in_array($controller, array('sections'))) { echo 'menu-open'; } ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-puzzle-piece"></i>
              <p>Sections<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview" <?php if(in_array($controller, array('sections'))) { echo 'style="display:block"'; } ?>>
              <li class="nav-item">
                <a href="<?php echo base_url('sections/banner'); ?>" class="nav-link <?php if(in_array($method, array('master-category','add-master-category','edit-master-category'))) { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon text-green"></i><p>Banner</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?php echo base_url('vendor'); ?>" class="nav-link">
              <i class="nav-icon fas fa-people-carry"></i>
              <p>Vendor<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('vendor/add'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?php echo base_url('sales'); ?>" class="nav-link">
              <i class="nav-icon fab fa-bitcoin"></i>
              <p>Sales<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('sales/today'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Today Sale</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>