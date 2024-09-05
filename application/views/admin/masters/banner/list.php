<!--START CONTENT -->
<section id="content complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title"><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/banner"><?php echo label('msg_lbl_title_banner');?></a></h5>
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
					 <span><label><?php echo label('msg_lbl_data_display');?> :</label></span> &nbsp;&nbsp;
					<input name="data_display" type="radio" id="All" value="All" onclick="return changeFilter(this.value);" checked="checked">
					<label for="All"><?php echo label('msg_lbl_all');?></label>
					<input name="data_display" type="radio" id="Filter" value="Filter" onclick="return changeFilter(this.value);">
					<label for="Filter"><?php echo label('msg_lbl_filter');?></label>  &nbsp;&nbsp;
                </div>  
                 <div class="col s12 m4 right-align list-page-right-top-icon">
					  <a class="btn-floating waves-effect waves-light grey right">
					  <i id="display_action" onClick="field_display();" class="mdi-hardware-keyboard-arrow-down tooltipped" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
					  <?php if(@$this->cur_module->is_export == 1){?>
					  <a href="<?php echo site_url("admin/masters/banner/export_to_excel");?>" class="export-excel btn-floating  right waves-effect waves-light btn white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a>
					  <?php }if(@$this->cur_module->is_insert == 1){?>
					  <a href="<?php echo site_url("admin/masters/banner/add");?>" class="btn-floating right waves-effect waves-light green accent-6"><i class="mdi-content-add tooltipped" data-position="top" data-delay="50" data-tooltip="Add"></i></a>
					  <?php } ?>
				</div>
              </div>
            </div>
            <div class="col s12">
              <div class="search_action card-panel" style="display:none;">                                
                <h4 class="header m-b-0"><strong> <?php echo label('msg_lbl_search_value');?></strong></h4>
                <div class="row m-b-0">
					<div class="input-field col m6 s12">
						<input type="text" name="BannerTitle" id="BannerTitle" maxlength="50" class="form-control LetterOnly">
						<label><?php echo label('msg_lbl_bannertitle')?> </label>
					</div> 
					<div class="input-field col m6 s12">
						<input type="text" name="SubTitle" id="SubTitle"  maxlength="100" class="form-control LetterOnly">
						<label><?php echo label('msg_lbl_subtitle')?></label>
					</div>
                </div>
        <div class="row m-b-0">
					<div class="input-field col s12 m6">
      
          <div name="type1" class="form-control search_div m-t-10 left"><?php echo label('msg_lbl_type');?></div>
            <input name="Type" type="radio" id="All_Status_search1" value="-1" checked="checked">
              <label for="All_Status_search1"><?php echo label('msg_lbl_all');?></label>
						<input name="Type" type="radio" id="Job" value="Job">
						<label for="Job"><?php echo label('msg_lbl_job');?></label>
						<input name="Type" type="radio" id="Company" value="Company">
						<label for="Company"><?php echo label('msg_lbl_company');?></label>  &nbsp;&nbsp;
							
					</div>
					<div class="search_label_radio input-field col m6 s12">
						<div name="status" class="form-control search_div m-t-10 left"><?php echo label('msg_lbl_status');?></div>
							<input name="Status_search" type="radio" id="All_Status_search" value="-1" checked="checked">
							<label for="All_Status_search"><?php echo label('msg_lbl_all');?></label>
							<input name="Status_search" type="radio" id="Active" value="1">
							<label for="Active"><?php echo label('msg_lbl_active');?></label> 
							<input name="Status_search" type="radio" id="InActive" value="0">
							<label for="InActive"><?php echo label('msg_lbl_inactive');?></label>
						</div>
					</div>
					<button class="btn waves-effect waves-light right" type="button" id="button_submit" name="button_submit"><?php echo label('msg_lbl_submit');?>
					</button>
					&nbsp;&nbsp;&nbsp;
					<a href="javascript:;" class="clear-all right" onclick="return clearAllFilter();"><?php echo label('msg_lbl_clear_all');?>
					</a>
                </div>
                
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
              <thead>
                <tr>
				    <th><?php echo label('msg_lbl_image')?></th>
					<th><?php echo label('msg_lbl_bannertitle')?></th>
					<th><?php echo label('msg_lbl_subtitle')?></th>
          			<th><?php echo label('msg_lbl_type')?></th>
					<th class="actions center"><?php echo label('msg_lbl_status');?></th>
					<th class="actions center"><?php echo label('msg_lbl_action');?></th>
                </tr>
              </thead>
                <tbody id="banner_table_body">
                </tbody> 
              </table>
            </div>
            <div id="table_paging_div"></div>
			</div>
            <?php echo $view_modal_popup; ?>
        
      </div>
    </div>
  </div>
  <!--start container-->
  <!--end container-->
</section>
<!-- END CONTENT