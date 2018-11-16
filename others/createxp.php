<?php $b = 0; ?>
<table>
<?php for($xp = 1; $xp <= 50; $xp++){ ?>
<tr>
    <td><?= $xp; ?></td>
    <td><?= $b += (($xp/2 * 1.8)*1000)  ?></td>
</tr>
<?php }?>
</table>