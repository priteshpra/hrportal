<!--START CONTENT -->
<section id="content complaint-page">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper" class="headcls">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title"><a href="<?php echo base_url('admin/masters/motivationalquotes'); ?>"><?php echo label('msg_lbl_motivationalquote');?></a></h5>
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
                                        <option value="10" selected>10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="col s12 m10 right-align list-page-right-top-icon">
                                <?php if(@$this->cur_module->is_insert == 1){?>
                                    <a href="<?php echo base_url("admin/masters/motivationalquotes/add");?>" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a>
                                <?Php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo label('msg_lbl_motivationalquote');?></th>
    								<th class="actions center"><?php echo label('msg_lbl_action');?></th>
                                </tr>
                            </thead>
                            <tbody id="table_body">

                            </tbody> 
                        </table>
                    </div>
                    <div id="table_paging_div"></div>
                </div>
                <?php echo @$view_modal_popup; ?>
            </div>
        </div>
    </div>
    <!--start container-->
    <!--end container-->
</section>
<!-- END CONTENT-->