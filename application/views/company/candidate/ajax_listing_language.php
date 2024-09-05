<?php 
    foreach ($language as $language) {  ?>

        <tr id="row_<?php echo $language->UserLanguageID; ?>">
               
            <td align="center"><?=$language->Language; ?></td>
            <td align="center"><?=$language->Proficiency; ?></td>
        </tr>
    <?php }
    ?>