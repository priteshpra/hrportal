<!--START CONTENT -->
<section id="content complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls">
    <!-- Search for small screen -->
    <div class="header-search-wrapper grey hide-on-large-only">
      <i class="mdi-action-search active"></i>
      <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
    </div>
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title"><a href="<?php echo $this->config->item('base_url'); ?>admin/masters/message"> Message</a></h5>
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
                  <i id="display_action" onClick="field_display();" class="mdi-hardware-keyboard-arrow-down tooltipped" data-position="top" data-delay="50" data-tooltip="Search Filter"></i></a>
                  <div class="right">
                    <a href="<?php echo site_url("admin/masters/message/export_to_excel");?>" class="export-excel btn-floating  right waves-effect waves-light btn white-text"><i class="mdi-file-cloud-download tooltipped" data-position="top" data-delay="50" data-tooltip="Export Excel"></i></a>
                  
                  </div>
                </div>
              </div>
            </div>
            <div class="col s12">
              <div class="search_action card-panel" style="display:none;">                                
                <h4 class="header"><strong> <?php echo label('msg_lbl_search_value');?> </strong></h4>
                <div class="row m-b-0">
                  <div class="input-field col s6">                     
                    <input id="MessageKey" name="MessageKey" value="" type="text"  maxlength="250" class="form-control onlyletter"   />
                    <label for="MessageKey"><?php echo label('msg_lbl_messagekey')?></label>
                  </div>
                  <div class="input-field col s6">
                   <?=$language;?>    
                  </div>
                </div>
                
                <button class="btn waves-effect waves-light right" type="button" id="button_message_submit" name="button_message_submit"><?php echo label('msg_lbl_submit');?>
                </button>
                &nbsp;&nbsp;&nbsp;

                <a href="javascript:;" class="clear-all right" onclick="return clearAllFilter();"><?php echo label('msg_lbl_clear_all');?>
                </a> 

              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th class="width_300"><?php echo label('msg_lbl_messagekey');?></th>
                          <th class="width_300"><?php echo label('msg_lbl_message');?></th>
                          <th class="actions center"><?php echo label('msg_lbl_notificationaction');?></th>
                      </tr>
                  </thead>

                  <tbody id="message_table_body">
                                             
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