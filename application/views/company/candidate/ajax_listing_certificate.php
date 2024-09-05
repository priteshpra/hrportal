<?php 
    foreach ($certificate as $certificate) {  ?>

        <tr id="row_<?php echo $certificate->UserCertificateID; ?>">
               
            <td align="center"><?=$certificate->Description; ?></td>
            <td align="center"><?=$certificate->CertificateYear; ?></td>
        </tr>
    <?php }
    ?>