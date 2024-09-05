<?php //pr($roles_data);exit;?>
<!--START CONTENT -->
<section id="content complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title text-uppercase"><a id="<?php echo @$role_data->RoleID?>" class="txt-underline" href="<?php echo site_url('admin/rolemapping/index/'.@$role_data->RoleID);?>"> <?= (@$role_data->RoleName)?$role_data->RoleName:"Role Mapping";?></a></h5>
        </div>
      </div>
    </div>
  </div>
  <!--breadcrumbs end-->
<!--start container-->
  <div class="container">
    <div class="section">
      <div class="list-page-right">
        <div class="card-panel">
          <div class="row">
            <div class="col s12">
              <div class="row m-b-0">
                <div class="input-field col m2 s12">
                  <select id="select-dropdown">
                    <option value="10"  selected>10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                  </select>
                </div>
                <div class="col m6 s12 center m-t-20"></div>
                <div class="col s12 m4 right-align list-page-right-top-icon">
                  <div class="right">
                      <a href="<?php echo $this->config->item('base_url'); ?>admin/rolemapping/add" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add"></i></a>
                  </div>
              </div>
              </div>
            </div>
           
          </div>
          <div class="table-responsive">
            <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Role Name</th>
                  <th class="title-box-th">User Type</th>
                  <th class="title-box-th">Name</th>
                  <th class="title-box-th">Description</th>    
                  
                </tr>
              </thead>
                <tbody id="rolemap_table_body">
                </tbody> 
              </table>
            </div>
            <div id="table_paging_div"></div>
            <?php echo $view_modal_popup; ?>
        </div>
      </div>
    </div>
  </div>
  <!--start container-->
  <!--end container-->
</section>
<!-- END CONTENT