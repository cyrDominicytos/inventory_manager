<!doctype html>
<html dir="ltr" lang="en" class="no-js">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width" />

	<title><?php echo "Facture de vente"; ?></title>
    <!--favicon-->
	<link rel="icon" href="<?php echo base_url(); ?>/public/assets/bill/favicon-32x32.png" type="image/png" />

	<link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/bill/reset.css" media="all" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/bill/style.css" media="all" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/bill/print.css" media="print" />

	<!-- give life to HTML5 objects in IE -->
	<!--[if lte IE 8]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

	<!-- js HTML class -->
	<script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
</head>
<body>

    <?php 
        // IF THE INVOICE IS VENTE INVOICE THEN
        if($invoice_type == 'FV'){
    ?>
                    
            <div>
                <!-- Float Print button here -->
                <a href="#" class="float" onclick="printDiv('invoice')" title="Imprimer la facture">
                    <i class="fa fa-plus my-float"><img src="<?php echo base_url(); ?>/public/assets/bill/img/print.png" width="60"/></i>
                </a>
                </div>


            <!-- begin markup -->



            <div id="invoice" class="new"><!-- INVOICE -->

                <header id="header"><!-- HEADER -->
                    <div class="invoice-logo" style="background-image : url(<?php echo base_url()."/writable/".$configList[11]->config_value;?>)"></div><!-- LOGO -->
                
                    <div class="invoice-from"><!-- HEADER FROM -->
                        <div class="org"><b>IFU :<?=$configList[2]->config_value." - ".$configList[10]->config_value." -  Siège : ".$configList[5]->config_value ?></b></div>
                        <div class="org">Téléphone: <b><?= $configList[4]->config_value ?></b> </div>
                            <a class="email" href="mailto:"<?= $configList[3]->config_value ?>>E-mail: <b><?= $configList[3]->config_value ?></b></a>
                    </div><!-- HEADER FROM -->

                </header><!-- HEADER -->
                <!-- e: invoice header -->
            
                <div class="this-is-line">
                    <div class="this-is" style="font-size:25px!important;">FACTURE</div><!-- DOC TITLE -->
                </div>

                <section id="info-to"><!-- TO SECTION -->

                    <div class="invoice-to-title">Info Client</div><!-- INVOICE TO -->

                    <div class="invoice-to">
                        <div class="to-org"><?php echo $sellDetails[0]->clients_company ?></div>
                        <div class="to-phone"><?php echo $sellDetails[0]->clients_phone_number ?></div>
                        <a class="to-email" href="mailto:<?php echo $sellDetails[0]->clients_email ?>">
                        <?php echo $sellDetails[0]->clients_email ?></a>
                    </div> <!-- INVOICE TO -->

                    <div class="invoice-meta">
                        <div class="meta-uno invoice-number">ID Facture:</div>
                        <div class="meta-duo"><?php echo "FV_2015" ?></div>
                        <div class="meta-uno invoice-date">Date:</div>
                        <div class="meta-duo"><?php echo  $bill->bill_mecef_date_time ?></div>
                        <!--<div class="meta-uno invoice-due">Total:</div>
                        <div class="meta-duo"><?php echo $sellDetails[0]->sales_amount ?> FCFA</div>-->
                        <div class="meta-uno invoice-due">Vendeur:</div>
                        <div class="meta-duo"><strong><?php echo "ABOU KARIOU" ?></strong></div>
                    </div>

                </section><!-- TO SECTION -->

                <section class="invoice-financials" style="margin-top:-60px !important;"><!-- FINANCIALS SECTION -->

                    <div class="invoice-items" ><!-- INVOICE ITEMS -->
                        <table>
                            <thead>
                                <tr>
                                    <th class="col-1">Désignations</th>
                                    <th class="col-2">Quantités</th>
                                    <th class="col-3">Prix unitaire(TTC)</th>
                                    <th class="col-4">Montants</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($sellDetails as $item){
                                        if(in_array($item->exonerations_name, ['B'])){
                                ?>
                                            <tr>
                                                <th>
                                                    <h1>
                                                        <?php 
                                                                echo $item->products_name.' - '.$item->exonerations_slug.'<br/>T.S = '.$item->sell_details_quantity.' x '.(round($item->exonerations_rate/$item->sell_details_quantity)).' x '.$item->exonerations_rate;
                                                        ?>
                                                    </h1>
                                                </th>
                                                <td style="text-align:right;padding-right:10px !important;"><?php echo $item->sell_details_quantity.'<br/>-'; ?></td>
                                                <td style="text-align:right;padding-right:10px !important;"><?php echo $item->sell_details_selling_price.'<br/>-'; ?></td>
                                                <?php 
                                                            //if($item['item_taxable_group_id'] == 'D' or $item['item_taxable_group_id'] == 'A'){
                                                ?>
                                                        <td style="text-align:right;padding-right:10px !important;"><?php echo $item->sell_details_selling_price.'<br/>'.round($item->sell_details_quantity) * (round($item->exonerations_rate/$item->sell_details_quantity)) * $item->exonerations_rate; ?></td>
                                                <?php
                                                            //}
                                                            //else{
                                                ?>
                                                        <!--<td style="text-align:right;padding-right:10px !important;"><?php echo $item->sell_details_amount.'<br/>'.round($item->sell_details_quantity) * (round($item->exonerations_rate/$item->sell_details_quantity)) * $item->exonerations_rate; ?></td>-->
                                                <?php
                                                            //}
                                                ?>
                                            </tr>
                                <?php
                                        }
                                        else{
                                ?>
                                            <tr>
                                                <th> <h1> <?php  echo $item->products_name.' - '.$item->exonerations_name; ?></h1></th>
                                                <td style="text-align:right;padding-right:10px !important;"><?php echo $item->sell_details_quantity ?></td>
                                                <td style="text-align:right;padding-right:10px !important;"><?php echo $item->sell_details_selling_price ?></td>
                                                <td style="text-align:right;padding-right:10px !important;"><?php echo $item->sell_details_amount ?></td>
                                            </tr>
                                <?php
                                        }
                                }
                                ?>
                                
                            </tbody>
                            
                        </table>
                    </div><!-- INVOICE ITEMS -->
                    
                    <div class="lower-block"><!-- TERMS&PAYMENT INFO -->

                        <div class="invoice-totals"><!-- TOTALS -->
                            <table>
                                <tbody>
                                    <tr>
                                        <th>TOTAL</th>						
                                        <td style="text-align:right;padding-right:10px !important;"><?php echo '*'.$sale->sales_amount ?></td>
                                    </tr>

                                    <?php 
                                        // TOTAL HT AND TVA FOR TAXABLE GROUP B
                                        if($bill->bill_hab > 0){
                                    ?>
                                            <tr>
                                                <th style="width:50%;">T. H.T. [B] 18%</th>						
                                                <td style="text-align:right;padding-right:10px !important;"><?php echo '*'.($bill->bill_hab); ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width:50%;">TVA [B] 18%</th>						
                                                <td style="text-align:right;padding-right:10px !important;"><?php echo '*'.($bill->bill_vab);?></td>
                                            </tr>
                                    <?php 
                                        }
                                    ?>

                                    <?php 
                                        // TOTAL HT AND TVA FOR TAXABLE GROUP C
                                        if($bill->bill_tac > 0){
                                    ?>
                                            <tr>
                                                <th style="width:50%;">T. H.T. [C] 0%</th>						
                                                <td style="text-align:right;padding-right:10px !important;"><?php echo '*'.($bill->bill_tac) ; ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width:50%;">T. TVA [C] 0%</th>						
                                                <td style="text-align:right;padding-right:10px !important;"><?php echo '*0';?></td>
                                            </tr>
                                    <?php 
                                        }
                                    ?>

                                    <?php 
                                        // TOTAL HT AND TVA FOR TAXABLE GROUP D
                                        if($bill->bill_had > 0){
                                    ?>
                                            <tr>
                                                <th style="width:50%;">T. H.T. [D] 18%</th>						
                                                <td style="text-align:right;padding-right:10px !important;"><?php echo '*'.$bill->bill_had ; ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width:50%;">T. TVA [D] 18%</th>						
                                                <td style="text-align:right;padding-right:10px !important;"><?php echo '*'.$bill->bill_vad ;?></td>
                                            </tr>
                                    <?php 
                                        }
                                    ?>
                                    <?php 
                                        // TOTAL HT AND TVA FOR TAXABLE GROUP E
                                        if($bill->bill_tae > 0){
                                    ?>
                                            <tr>
                                                <th style="width:50%;">REGIME TPS [E]</th>						
                                                <td style="text-align:right;padding-right:10px !important;"><?php echo '*'.($bill->bill_tae) ; ?></td>
                                            </tr>
                                    <?php 
                                        }
                                    ?>

                                    <?php 
                                        // TOTAL HT AND TVA FOR TAXABLE GROUP F
                                        if($bill->bill_taf > 0){
                                    ?>
                                            <tr>
                                                <th style="width:50%;">RESERVES [F]</th>						
                                                <td style="text-align:right;padding-right:10px !important;"><?php echo '*'.($bill->bill_taf) ; ?></td>
                                            </tr>
                                    <?php 
                                        }
                                    ?>
                                     <?php 
                                        // TOTAL HT AND TVA FOR TAXABLE GROUP A
                                        if($bill->bill_taa > 0){
                                    ?>
                                            <tr>
                                                <th>EXONÉRÉS</th>						
                                                <td style="text-align:right;padding-right:10px !important;"><?php echo '*'.$bill->bill_taa ; ?></td>
                                            </tr>
                                    <?php 
                                        }
                                    ?>

                                    <?php 
                                        // AIB SPECIFICATION
                                        if($bill->bill_aib > 0){
                                    ?>
                                            <tr>
                                                <th style="width:50%;">AIB - <?php echo ($sale->sales_aib == "A") ? (1) : (5).'%'; ?></th>						
                                                <td style="text-align:right;padding-right:10px !important;"><?php echo '*'.$bill->bill_aib; ?></td>
                                            </tr>
                                    <?php 
                                        }
                                    ?>

                                    <?php 
                                        // TS SPECIFICATION
                                        if($bill->bill_ts > 0){
                                    ?>
                                            <tr>
                                                <th style="width:50%;">TOTAL TS</th>						
                                                <td style="text-align:right;padding-right:10px !important;"><?php echo '*'.$bill->bill_ts ; ?></td>
                                            </tr>
                                    <?php 
                                        }
                                    ?>
                                    
                                    <tr>
                                        <th class="col-1" style="font-size:14px;">TOTAL (Fcfa)</th>						
                                        <td style="font-size:20px;text-align:right;padding-right:10px !important;" class="col-2"><?php echo $sale->sales_amount ?></td>
                                    </tr>
                                </tbody>
                            </table>
                
                            <!--<div class="invoice-pay">
                                <h5>Pay with...</h5>
                                <ul>
                                    <li>
                                        <a href="#" class="gcheckout">Checkout with Google</a>
                                    </li>
                                    <li>
                                        <a href="#" class="acheckout">Checkout with Amazon</a>
                                    </li>
                                </ul>
                            </div>-->
                        </div><!-- TOTALS -->

                        <div class="info">
                            <div class="info-time"><strong>Mode de paiement:</strong> <?php echo 'ESPECE' ?> </div>
                            
                            <?php if($bill->bill_mecef_qr_code != null){
                            ?>
                                <div class="info-payment"><strong>MECef/DGI</strong><br>
                                    <strong>Code MECef : </strong> <?php echo $bill->bill_mecef_code_dgi ?> <br/>
                                    <strong>NIM : </strong> <?php echo $bill->bill_mecef_nim ?> <br/>
                                    <strong>Compteurs : </strong> <?php echo $bill->bill_mecef_counters ?> <br/>
                                    <strong>Date & Heure : </strong> <?php echo "le ".format_date($bill->bill_mecef_date_time, "d/m/Y à H:i:s")   ?> <br/><br/>
                                    <p>
                                        <img src="<?php echo base_url().'/writable/uploads/qrcode/'.$bill->bill_code.'.png';?>"alt="codeqr introuvable" />
                                    </p>
                                </div>
                            <?php
                            }
                            ?>
                            
                        
                            <div class="info-terms">
                            <!--<strong>Terms & Conditions</strong><br>
                Sime omnimag natibus es nis eum re prepuditest, tem que numqui doluptas sinvel mod eos rem fuga. Ribus es ailiqui il maiori sit unti sit et lam quam volum-->
                            </div>
                        </div>

                        
                        <!--<div class="invoice-signature">  <br>
                            <strong><?php "USER NAME"; ?></strong> 
                        </div>-->
                        <!--<div class="invoice-paynow"><a href="#">Pay Now</a></div>-->

                    </div><!-- TERMS&PAYMENT INFO -->
                    
                </section><!-- FINANCIALS SECTION -->

                <footer id="footer">  
                    <p style="color:white;padding-top:5px;">
                        <b><?= $configList[1]->config_value." | ".$configList[9]->config_value ?></b>
                    </p>
                </footer> 

            </div><!-- INVOICE -->
    <?php
        }
        // ELSE IF THE INVOICE IS AVOIR INVOICE THEN
        elseif($invoice_type == 'FA'){
            $this->load->view('invoice/show_single_avoir_invoice.php');
        }
    ?>

<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>

</body>
</html>