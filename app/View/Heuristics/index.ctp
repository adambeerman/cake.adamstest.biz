<!-- Cake PHP Template -->

HEURISTICS INDEX

<table>

    <tr>
        <th>Name</th>
        <th>Description</th>
    </tr>

    <?php foreach($heuristics as $heuristic): ?>

        <tr>
            <td>
               <?php echo $heuristic['Heuristic']['name'] ?>
            </td>
            <td>
                <?php echo $heuristic['Heuristic']['description'] ?>
            </td>

        </tr>


    <?php endforeach ?>


</table>