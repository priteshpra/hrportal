<section id="content complaint-page">
  <!--breadcrumbs start-->
  <div id="breadcrumbs-wrapper" class="headcls lighten-3">
    <div class="container">
      <div class="row">
        <div class="col s12 m12 l12">
          <h5 class="breadcrumbs-title text-uppercase"><a href="<?php echo site_url("admin/usersession/notification"); ?>"><?php echo label('msg_lbl_title_notificationmessages')?></a></h5>
        </div>
      </div>
    </div>
  </div>
  <div class="section">
  	<div class="container">
  	    <div class="card-panel card-panel-box">
  	        <div class="row">
                      <div class="col s12">
                          <div class="row m-b-0">
                            <div class="input-field col m2 s12">
                              <select id="select-dropdown" class="select-dropdown">
  	                              <option value="10" selected>10</option>
  	                              <option value="20">20</option>
  	                              <option value="50">50</option>
  	                              <option value="100">100</option>
                              </select>
                            </div>
                          </div>
                      </div>
                      <div class="col s12">
                        <div class="row m-b-0">
                            <div class="table-responsive">
                              <table id="data-table-row-grouping" class="display " cellspacing="0" width="100%">
                                <thead>
                                  <tr>
                                    	  
                                        <th><?php echo 'NotifiactionID' ?></th>
                                        <th><?php echo 'UserID'?></th>
                                        <th><?php echo label('msg_lbl_description')?></th>
                                        <th><?php echo 'TypeID'?></th>
                                        <th><?php echo 'CreatedBy'?></th>
                                        <th><?php echo 'CreatedDate'?></th>
                                        <th><?php echo label('msg_lbl_notificationaction')?></th>
                                    </tr>
                                  </thead>
                                  <tbody id="table_body">
                                  </tbody> 
                                </table>
                            </div>
                        </div>
                     </div>
                     <div id="table_paging_div" class="table_paging_div"></div>
              </div>
  	    </div>
  	</div>
  </div>
</section>