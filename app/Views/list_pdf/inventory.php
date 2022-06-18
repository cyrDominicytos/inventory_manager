<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>

<h1 style="text-align: center;">Inventaire du stock du <?php echo date('d/m/Y') ?> à <?php echo date('H:i:s') ?></h1>

<table id="customers">
  <tr>
    <th>Produits</th>
    <th>Options de vente</th>
    <th>Quantités Approvisionnées</th>
    <th>Quantités Vendues</th>
    <th>Quantités Restantes</th>
  </tr>
    <!--begin::Table body-->
    <tbody class="text-gray-600 fw-bold">
        <!--begin::Table row-->
        <?php foreach($list as $lst): ?>
            <!--begin::Table row-->
                <tr>
                    <td class="">
                    <?= $lst->products_name?>
                    </td>
                    <td class="">
                    <?= $lst->sales_options_name?>
                    </td>
                    <td class="">
                    <?= $lst->supply_quantity_total?>
                    </td>
                    <td class="">
                    <?= $lst->sell_quantity_total?>
                    </td>
                    <td class="">
                    <?= $lst->quantity_inventory?>
                    </td>
                   
                </tr>
                <!--end::Table row-->	
            <?php endforeach ?>							
    </tbody>
    <!--end::Table body-->
</table>

</body>
</html>


