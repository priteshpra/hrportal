<!--START CONTENT -->
<section id="content complaint-page">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper" class="headcls">
        <!-- Search for small screen -->
        
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title"><a href="<?php echo $this->config->item('base_url'); ?>admin/rolemapping"> Role Mapping</a></h5>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->


    <!--start container-->
    <div class="container">
        <div class="section">
            <div class="listing-page">
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
                                <div class="col m6 s12 center m-t-20">
                                    <span><label>Data Display :</label></span> &nbsp;&nbsp;
                                    <input name="data_display" type="radio" id="All" value="All" onclick="return changeFilter(this.value);" checked="checked">
                                    <label for="All">All</label>
                                    <input name="data_display" type="radio" id="Filter" value="Filter" onclick="return changeFilter(this.value);">
                                    <label for="Filter">Filter</label>  &nbsp;&nbsp;

                                </div>  
                               <div class="col s12 m4 right-align list-page-right-top-icon">
                                    <a class="btn-floating waves-effect waves-light grey right">
                                        <i id="display_action" onClick="field_display();" class="mdi-hardware-keyboard-arrow-down"></i></a>
                                    <div class="right">
                                        <a href="<?php echo site_url("admin/rolemapping/export_to_excel"); ?>" class="export-excel btn-floating  right waves-effect waves-light btn white-text"><i class="mdi-file-cloud-download"></i></a>
                                        <a href="<?php echo $this->config->item('base_url'); ?>admin/rolemapping/add" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12">
                            <div class="search_action card-panel" style="display:none;">                                
                                <h4 class="header"><strong> Search</strong></h4>
                                <div class="row m-b-0">
                                    <div class="input-field col s6">
                                        <input type="text" name="Name" id="Name" value="" class="form-control">
                                        <label name="Name" class="">User Name</label>
                                    </div>                                     
                                    <div class="input-field col s6">
                                        <input type="text" name="RoleName" id="RoleName" value="" class="form-control">
                                        <label name="RoleName" class="">Role Name</label>
                                    </div>                                     
                                </div>

                                <button class="btn waves-effect waves-light right" type="button" id="button_role_submit" name="button_role_submit">Submit
                                </button>
                                &nbsp;&nbsp;&nbsp;

                                <a href="javascript:;" class="clear-all right" onclick="return clearAllFilter();">Clear                              
                                </a> 

                            </div>
                        </div>
                    </div>
                    <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Role Name</th>
                                <th class="actions center">Action</th>
                            </tr>
                        </thead>

                        <tbody id="role_table_body">

                        </tbody> 
                    </table>
                    <div id="table_paging_div"></div>

                </div>
            </div>
        </div>
    </div>
    <!--start container-->
    <!--end container-->
</section>
<!-- END CONTENT