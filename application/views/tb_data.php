<table id="datatablesSimple" class="table table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>Ship To</th>
            <th></th>
            <th>PO</th>
            <th>Qty</th>
            <th>Style</th>
            <th>SKU</th>
            <th>Color</th>
            <th>Size</th>
            <th>Barcode</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $i = 1;
        foreach ($data as $dt) {
            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . $dt['ship_to'] . "</td>";
            echo "<td>" . $dt['ship2'] . "</td>";
            echo "<td>" . $dt['po'] . "</td>";
            echo "<td>" . $dt['qty'] . "</td>";
            echo "<td>" . $dt['style'] . "</td>";
            echo "<td>" . $dt['sku'] . "</td>";
            echo "<td>" . $dt['color'] . "</td>";
            echo "<td>" . $dt['size'] . "</td>";
            echo "<td>" . $dt['barcode'] . "</td>";
            echo "</tr>";
            $i++;
        }
        ?>
    </tbody>
</table>