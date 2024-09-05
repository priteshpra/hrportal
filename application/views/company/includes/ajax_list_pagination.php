<input type="hidden" id="per_page_value" value="<?php echo $per_page_record; ?>" >

<div class="row">
    <div class="col l6 m6 s6">
        Showing <?php echo ($page_number - 1) * $per_page_record + 1; ?> to <?php
        $last = ($page_number - 1) * $per_page_record + $per_page_record;
		if ($last > $total_records)
            echo $total_records;
        else
            echo $last;
        ?> of <?php echo $total_records; ?> entries
    </div>
    <div class="col l6 m6 s6">
        <ul id="custom_pagination" class="pagination right nomargin">
            <li class="waves-effect"><a class="pagination_buttons <?php
                if ($page_number == 1) {
                    echo "hide";
                }
                ?>" data-page-number="<?php echo ($page_number - 1); ?>" data-dt-idx="2" aria-controls="data-table-simple" ><i class="mdi-navigation-chevron-left"></i></a></li>
            <li class=" <?php
            if ($page_number < 4) {
                echo "hide";
            }
            ?>">..</li>
                <?php 
                for ($i = ($page_number - 2); $i <= ($page_number + 2); $i++) {
                    
					if ($i > 0 && $i <= ceil($total_records / $per_page_record)) { 
                        ?>
                    <li class="<?php
                    if ($i == $page_number) {
                        echo "active";
                    }
                    ?>">
                        <a class="pagination_buttons" href="javascript:;" data-page-number="<?php echo $i; ?>"  data-dt-idx="2" aria-controls="data-table-simple"><?= $i ?></a>
                    </li>
                    <?php
                }
            }
            ?>
            <li class="<?php
            if ($page_number > floor($total_records / $per_page_record) - 3) {
                echo "hide";
            }
            ?>">..</li>
            <li class="waves-effect <?php 
            if ($page_number >= ceil($total_records / $per_page_record)) {
                echo $page_number;
				echo "hide";
            }
            ?>"  >
                <a data-page-number="<?php echo ($page_number + 1) ?>"  data-dt-idx="2" aria-controls="data-table-simple" class="pagination_buttons <?php 
            if ($page_number >= ceil($total_records / $per_page_record)) {
                echo "hide";
            }
            ?>"><i class="mdi-navigation-chevron-right"></i></a>
            </li>
        </ul>
    </div>        
</div>        