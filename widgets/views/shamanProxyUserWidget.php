<?php

/** @var $user \app\models\ShamanProxyUser */

?>

<div class="well">
    <div class="wrap">
        <table class="table">
            <thead>
            <tr>
                <th>Параметр</th>
                <th>Значение</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($user->getAttributes() as $key => $value) {
                if ($value === null)
                    continue;
                ?>
                <tr>
                    <th>
                        <?= $user->getAttributeLabel($key); ?>
                    </th>
                    <td><?= $value ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
