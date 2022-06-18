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

<h3>Liste des catégories</h3>

<table id="customers">
  <tr>
    <th>Désignation</th>
    <th>Description</th>
    <th>Date de création</th>
  </tr>
    <!--begin::Table body-->
    <tbody class="text-gray-600 fw-bold">
        <!--begin::Table row-->
        <?php foreach($list as $lst): ?>
            <!--begin::Table row-->
                <tr>
                    <td class="">
                    <?= $lst->product_categories_name?>
                    </td>
                    <td class="">
                    <?= $lst->product_categories_description?>
                    </td>
                   
                    <td><?= format_date($lst->product_categories_created_at, "d/m/Y à H:i:s") ?></td>                                       
                </tr>
                <!--end::Table row-->	
            <?php endforeach ?>							
    </tbody>
    <!--end::Table body-->
</table>

</body>
</html>


