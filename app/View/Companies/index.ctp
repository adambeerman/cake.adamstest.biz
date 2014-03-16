<!-- Cake PHP Template -->


<table>
    <tr>
        <th>Company</th>
        <th>Logo</th>
    </tr>


    <?php foreach ($companies as $company): ?>


    <tr>
        <td><?php echo $company['Company']['name']; ?></td>
        <td>
            <img class = 'company_logo' src = '<?php echo $company['Company']['logo'] ?>'>

        </td>

        <?php endforeach ?>
</table>