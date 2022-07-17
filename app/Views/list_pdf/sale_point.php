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

/* #customers tr:nth-child(even){background-color: #f2f2f2;} */

/* #customers tr:hover {background-color: #ddd;} */

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  /* background-color: #04AA6D; */
  /* color: white; */
}

.head, .line{
  background-color: #d5d5d5;
 /* background-image: linear-gradient(to bottom right,#5d6d7e, #FFF, #CCC, #5d6d7e); */
}
 .line2{
  background-color: #ccc;
 /* background-image: linear-gradient(to bottom right,#5d6d7e, #FFF, #CCC, #5d6d7e); */
}
</style>
</head>
<body>

<h2 style="text-align: center;">Point des ventes du <?= $old_begin ?> au <?= $old_end ?></h2>

<table id="customers">
  <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0 head"  >
        <th class="min-w-125px">Dates</th>
        <th class="min-w-125px">Désignations</th>
        <th class="min-w-125px">Quantités</th>
        <th class="min-w-125px">Prix/Vente</th>
        <th class="min-w-125px">Réductions</th>
        <th class="min-w-125px">Montant</th>
        <th class="min-w-125px">Livraison</th>
    </tr>
     <!--begin::Table body-->
     <tbody class="text-gray-600 fw-bold" >
                            <!--begin::Table row-->
          <?php 
          $total =0;
          foreach ($sales as $temp) :   
              foreach ($temp as $order) :   ?>
                  <tr>
                      <td class="">
                          <?= format_date($order->sales_created_at, "d/m/Y à H:i:s") ?>
                      </td>
                      <td class="">
                          <?= $order->products_name ?>
                      </td>
                      
                      <td class="">
                          <?= $order->sell_details_quantity.' ' .$order->sales_options_name ?>
                      </td>
                      <td class="">
                          <?= $order->sell_details_selling_price?>
                      </td>
                      <td class="">
                          <?= $order->sell_details_reduction?>
                      </td>
                      <td class="">
                          <?= $order->sell_details_amount?>
                      </td>
                      <td class="">
                          <?= livraison($order->sales_deliver_man)  ?>
                      </td>                                   
                    
                  </tr>                                                       
              <?php  endforeach ?>
              <tr class="line">
                  <td colspan="2" style="text-align:left">
                    <strong style="font-weight: bold; "> Client :</strong> <span >  <?= $order->clients_company ?></span>
                  </td>
                  
                  
                  <td colspan="2">
                  <strong style="font-weight: bold; "> Vendeur :</strong> <span ><?= $order->last_name.' '.$order->first_name.' '.$order->first_name?></span>
                  </td>
                  
                  <td colspan="3">
                  <strong style="font-weight: bold; "> Net Payé :</strong> <span ><?= $order->sales_amount?></span>
                  </td>   
              </tr>
              <br><br>
          <?php  $total+= $order->sales_amount; endforeach ?>
          <tr class="line2">
                  <td colspan="4" style="text-align:left">
                    <strong style="font-weight: bold; "> Total Recette :</strong> <span >  <?= $total ?></span>
                  </td>
                  <td colspan="3" style="text-align:left">
                    <strong style="font-weight: bold; ">Point Généré par :</strong> <span >  <?=  session()->has('identity') ? ($auth->user()->row()->first_name.' '.$auth->user()->row()->last_name) : ("")?></span>
                  </td>
                  
                  
                   
              </tr>
      </tbody>
      <!--end::Table body-->
</table>
<p style="text-align: right; margin-top:50px"><em style="text-align: right;">Point Généré le <?php echo date('d/m/Y') ?> à <?php echo date('H:i:s') ?></em></p>

</body>
</html>


