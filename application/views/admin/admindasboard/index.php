<div id="card-stats">
                        <div class="row">
                            <div class="col s12 m6 l3">
                                <div class="card">
                                    <div class="card-content  green white-text">
                                        <p class="card-stats-title"><i class="mdi-social-group-add"></i> Total Companies</p>
                                        <h4 class="card-stats-number"><?php echo ($dashboard['AllCompany']) ? $dashboard['AllCompany'] : 0;?></h4>
                                        <!-- <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-up"></i> 15% <span class="green-text text-lighten-5">from yesterday</span>
                                        </p> -->
                                    </div>
                                    <div class="card-action  green darken-2">
                                        <div id="clients-bar"><canvas style="display: inline-block; width: 290px; height: 25px; vertical-align: top;" width="290" height="25"></canvas></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l3">
                                <div class="card">
                                    <div class="card-content purple white-text">
                                        <p class="card-stats-title"><i class="mdi-social-group-add"></i>Total Candidates</p>
                                        <h4 class="card-stats-number"><?php echo ($dashboard['AllCandidates']) ? $dashboard['AllCandidates'] : 0;?></h4>
                                        <!-- <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-up"></i> 70% <span class="purple-text text-lighten-5">last month</span>
                                        </p> -->
                                    </div>
                                    <div class="card-action purple darken-2">
                                        <div id="sales-compositebar"><canvas style="display: inline-block; width: 286px; height: 25px; vertical-align: top;" width="286" height="25"></canvas></div>

                                    </div>
                                </div>
                            </div>                            
                            <div class="col s12 m6 l3">
                                <div class="card">
                                    <div class="card-content blue-grey white-text">
                                        <p class="card-stats-title"><i class="mdi-action-trending-up"></i> Today Jobs</p>
                                        <h4 class="card-stats-number"><?php echo ($dashboard['AllJob']) ? $dashboard['AllJob'] : 0;?></h4>
                                        <!-- <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-up"></i> 80% <span class="blue-grey-text text-lighten-5">from yesterday</span> -->
                                        </p>
                                    </div>
                                    <div class="card-action blue-grey darken-2">
                                        <div id="profit-tristate"><canvas style="display: inline-block; width: 290px; height: 25px; vertical-align: top;" width="290" height="25"></canvas></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l3">
                                <div class="card">
                                    <div class="card-content pink lighten-2 white-text">
                                        <p class="card-stats-title"><i class="mdi-editor-attach-money"></i> Total Collection</p><!-- class="mdi-editor-insert-drive-file"-->
                                        <h4 class="card-stats-number"><?php echo ($config[0]->CurrencyCode) ? $config[0]->CurrencyCode: 'GBP';?> <?php echo ($dashboard['TotalCollection']) ? $dashboard['TotalCollection'] : 0;?></h4>
                                        <!-- <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-down"></i> 3% <span class="deep-purple-text text-lighten-5">from last month</span> -->
                                        </p>
                                    </div>
                                    <div class="card-action  pink darken-2">
                                        <div id="invoice-line"><canvas style="display: inline-block; width: 435px; height: 25px; vertical-align: top;" width="435" height="25"></canvas></div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>