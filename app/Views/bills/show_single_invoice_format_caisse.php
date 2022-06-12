<?php 
    $itterator = 0;
?>
<!doctype html>
<html dir="ltr" lang="en" class="no-js">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width" />

	<title><?php echo $this->data['page_title']; ?></title>
    <!--favicon-->
	<link rel="icon" href="<?php echo img_assets_url(); ?>favicon-32x32.png" type="image/png" />

    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            background: #ffffff;
        }

        div,
        p,
        a,
        li,
        td {
            -webkit-text-size-adjust: none;
        }

        body {
            width: 88mm;
            height: 100%;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;

        }

        p {
            padding: 0 !important;
            margin-top: 0 !important;
            margin-right: 0 !important;
            margin-bottom: 0 !important;
            margin- left: 0 !important;
        }

        .visibleMobile {
            display: none;
        }

        .hiddenMobile {
            display: block;
        }
    </style>
	
</head>

<body>

    <div style="position:absolute;right:50px !important;top:50px!important;">
            <!-- Float Print button here -->
            <a href="#" onclick="printDiv('ticketCaisseDiv')" >
                <i class="fa fa-plus my-float"><img src="<?php echo invoice_assets_url(); ?>img/print.png" width="60"/></i>
            </a>
    </div>

    <div id="ticketCaisseDiv">
        <!-- Header -->
        <table width="100%" border="0" cellpadding='2' cellspacing="2" align="center" bgcolor="#ffffff" style="padding-top:4px;">
            <tbody>
                <tr>
                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; line-height: 

            18px; vertical-align: bottom; text-align: center;">
                    <strong style="font-size:16px;">MYAH IT COMPANY</strong>
                    <br>Tél: +229 XX XX XX XX
                    <br>IFU: 34231123123123
                    <br> Adresse, adresse, adresse, adresse
                </td>
                </tr>
                <tr>
                    <td height="2" colspan="0" style="border-bottom:1px solid #e4e4e4 "></td>
                </tr>
            </tbody>
        </table>

        <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
            <tbody>
                <tr>
                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; line-height: 

            18px; vertical-align: bottom; text-align: left;">
                    <b>CLIENT</b> 
                    <br/>
                    <?php echo $this->data['single_invoice'][0]['first_name'].' '.$this->data['single_invoice'][0]['last_name'] ?>
                    <br> 
                    <?php echo $this->data['single_invoice'][0]['phone_number'] ?>
                    <br/>
                    <?php echo $this->data['single_invoice'][0]['email'] ?>
                    <br/>
                    <?php echo $this->data['single_invoice'][0]['ifu'] ?>

                </td>
                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; line-height:18px; vertical-align: top; text-align: right;">
                
                    <b>TICKET</b> 
                    <br/>
                    #<?php echo $this->data['single_invoice'][0]['invoice_code'] ?>
                    <br> 
                    <b>Vendeur :</b>
                    <br/>
                    <?php echo $this->session->userdata('logged_in_user_details')->first_name.' '.$this->session->userdata('logged_in_user_details')->last_name; ?>
                </td>
                </tr>
            </tbody>
        </table>

        <!-- /Header -->
        <!-- Order Details -->
        <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
            <tbody>
                <tr>
                    <td>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
                            <tbody>
                                <tr>
                                    <td height="20"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width=" 100% " border="0 " cellpadding="0 " cellspacing="0 " align="center " class="fullPadding ">
                                            <tbody>
                                                <tr>
                                                    <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 10px 7px 0; " width="10% " align="left ">
                                                        N°.
                                                    </th>
                                                    <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 10px 7px 0; " width="40% " align="left ">
                                                        Articles
                                                    </th>
                                                    <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 0 7px; " align="left ">
                                                        Qte
                                                    </th>
                                                    <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 0 7px; " align="center ">
                                                        Prix
                                                    </th>
                                                    <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 0 7px; " align="right ">
                                                        Montants
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td height="1 " style="background: #bebebe;" colspan="5 "></td>
                                                </tr>
                                                <tr>
                                                    <td height="2" colspan="4 "></td>
                                                </tr>
                                                

                                                <?php foreach($this->data['items_on_single_invoice'] as $item){
                                                    $itterator++;
                                                    if($item['item_tax'] > 0){
                                                ?>
                                                        <tr>
                                                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 18px; vertical-align: top; padding:0px 0; text-align:left;">#<?php echo $itterator; ?></td>
                                                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 18px; vertical-align: top; padding:0px 0; text-align:left;"><?php echo $item['item_name'].' - '.$item['taxable_group_code'].'<br/>T.S = '.$item['item_quantity'].' x '.(round($item['item_tax']/$item['item_quantity'])).' x '.$item['item_taxable_group_value']; ?></td>
                                                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 18px; vertical-align: top; padding:0px 0; text-align:right;"><?php echo $item['item_quantity'].'<br/>-'; ?></td>
                                                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 18px; vertical-align: top; padding:0px 0; text-align:right;"><?php echo $item['item_price'].'<br/>-'; ?></td>
                                                        <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 18px; vertical-align: top; padding:0px 0; text-align:right;"><?php echo $item['item_total'].'<br/>'.round($item['item_quantity'] * (round($item['item_tax']/$item['item_quantity'])) * $item['item_taxable_group_value']); ?></td>
                                                        </tr>
                                                <?php
                                                    }
                                                    else{
                                                ?>
                                                        <tr>
                                                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 18px; vertical-align: top; padding:0px 0; text-align:left;">#<?php echo $itterator; ?></td>
                                                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 18px; vertical-align: top; padding:0px 0;text-align:left; "> <?php  echo $item['item_name'].' - '.$item['taxable_group_code']; ?></td>
                                                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 18px; vertical-align: top; padding:0px 0;text-align:right;"><?php echo $item['item_quantity'] ?></td>
                                                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 18px; vertical-align: top; padding:0px 0;text-align:right;"><?php echo $item['item_price'] ?></td>
                                                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 18px; vertical-align: top; padding:0px 0;text-align:right;"><?php echo $item['item_total'] ?></td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                                
                                                
                                                
                                                
                                                <!--<tr>
                                                    <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 18px; vertical-align: top; padding:0px 0; ">
                                                        1
                                                    </td>
                                                    <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 18px; vertical-align: top; padding:0px 0; " class="article ">
                                                        Inconnu
                                                    </td>
                                                    <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 18px; vertical-align: top; padding:0px 0; ">2</td>
                                                    <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 18px; vertical-align: top; padding:0px 0; " align="center ">50</td>
                                                    <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #1e2b33; line-height: 18px; vertical-align: top; padding:0px 0; " align="right ">100</td>
                                                </tr>-->
                                            

                                                
                                                <tr>
                                                    <td height="2" colspan="5" style="border-bottom:1px solid #e4e4e4 "></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="10"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- /Order Details -->
        <!-- Table Total -->
        <table width="90% " border="0 " cellpadding="0 " cellspacing="0 " align="center " class="fullPadding " style="padding-bottom: 20px !important ">
            <tbody>
                <!--<tr>
                    <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                        Total
                    </td>
                    <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; white-space:nowrap; " width="80 ">
                        150
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                        Réduction
                    </td>
                    <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                    (-) 100
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                        <strong>Total</strong>
                    </td>
                    <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                        <strong>100 Fcfa</strong>
                    </td>
                </tr>-->

                <tr>
                    <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                        <strong>TOTAL</strong>
                    </td>
                    <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                        <strong><?php echo '*'.$this->data['single_invoice'][0]['total'] ?></strong>
                    </td>
                </tr>

                <?php 
                    // TOTAL HT AND TVA FOR TAXABLE GROUP B
                    if($this->data['single_invoice'][0]['hab'] > 0){
                ?>
                        <tr>
                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                                <strong>T. H.T. [B] 18%</strong>
                            </td>
                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                                <strong><?php echo '*'.($this->data['single_invoice'][0]['hab'] - $this->data['single_invoice'][0]['ts']); ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                            <strong>T. TVA [B] 18%</strong>
                            </td>
                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                                <strong><?php echo '*'.($this->data['single_invoice'][0]['tab'] - $this->data['single_invoice'][0]['hab']) ;?></strong>
                            </td>
                        </tr>
                        
                <?php 
                    }
                ?>

                <?php 
                    // TOTAL HT AND TVA FOR TAXABLE GROUP C
                    if($this->data['single_invoice'][0]['tac'] > 0){
                ?>
                        <tr>
                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                            <strong>T. H.T. [C] 0%</strong>
                            </td>
                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                                <strong><?php echo '*'.$this->data['single_invoice'][0]['tac'] ; ?></strong>
                            </td>
                        </tr>

                        <tr>
                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                            <strong>T. TVA [C] 0%</strong>
                            </td>
                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                                <strong><?php echo '*'.($this->data['single_invoice'][0]['tac'] - $this->data['single_invoice'][0]['tac']) ;?></strong>
                            </td>
                        </tr>
                <?php 
                    }
                ?>

                <?php 
                    // TOTAL HT AND TVA FOR TAXABLE GROUP D
                    if($this->data['single_invoice'][0]['had'] > 0){
                ?>
                        <tr>
                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                            <strong>T. H.T. [D] 18%</strong>
                            </td>
                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                                <strong><?php echo '*'.$this->data['single_invoice'][0]['had'] ; ?></strong>
                            </td>
                        </tr>

                        <tr>
                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                            <strong>T. TVA [D] 18%</strong>
                            </td>
                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                                <strong><?php echo '*'.$this->data['single_invoice'][0]['vad'] ;?></strong>
                            </td>
                        </tr>
                <?php 
                    }
                ?>

                <?php 
                    // AIB SPECIFICATION
                    if($this->data['single_invoice'][0]['aib'] > 0){
                ?>
                        <tr>
                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                            <strong>AIB - <?php echo $this->data['single_invoice'][0]['aib_percentage'].'%'; ?></strong>
                            </td>
                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                                <strong><?php echo '*'.$this->data['single_invoice'][0]['aib'] ; ?></strong>
                            </td>
                        </tr>
                <?php 
                    }
                ?>

                <?php 
                    // TS SPECIFICATION
                    if($this->data['single_invoice'][0]['ts'] > 0){
                ?>
                        <tr>
                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                            <strong>TOTAL TS</strong>
                            </td>
                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                                <strong><?php echo '*'.$this->data['single_invoice'][0]['ts'] ; ?></strong>
                            </td>
                        </tr>
                <?php 
                    }
                ?>

                <?php 
                    // TOTAL HT AND TVA FOR TAXABLE GROUP A
                    if($this->data['single_invoice'][0]['taa'] > 0){
                ?>
                        <tr>
                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                            <strong>EXONÉRÉS</strong>
                            </td>
                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                                <strong><?php echo '*'.$this->data['single_invoice'][0]['taa'] ; ?></strong>
                            </td>
                        </tr>
                <?php 
                    }
                ?>
                
                <tr>
                    <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                    <strong>TOTAL (Fcfa)</strong>
                    </td>
                    <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                        <strong><?php echo $this->data['single_invoice'][0]['total'] ?></strong>
                    </td>
                </tr>

                
            </tbody>
        </table>
        <!-- /Table Total -->

        <div style="margin-left:10px!important;">
            <p>
                <b>Mode de paiement : </b> <?php echo $this->data['single_invoice'][0]['payment_method'] ?>
            </p>
        </div>

        <!-- /Table Mecef details -->
        <?php if(isset($this->data['single_invoice'][0]['qrCode'])){
        ?>
            <hr>
            <table border="0" cellpadding="0" cellspacing="0" style="margin-left:10px!important;">
                <tbody>
                    <tr>
                        <td style="font-size: 13px; font-family: 'Open Sans', sans-serif; line-height: 18px;">
                            <b>Code MECef : </b> <?php echo $this->data['single_invoice'][0]['codeMECeFDGI'] ?>
                            <br> 
                            <b>NIM : </b> <?php echo $this->data['single_invoice'][0]['nim'] ?>
                            <br> 
                            <b>Compteurs : </b> <?php echo $this->data['single_invoice'][0]['counters'] ?>
                            <br> 
                            <b>Date & Heure : </b> <?php echo $this->data['single_invoice'][0]['date'].' '.$this->data['single_invoice'][0]['hour'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; line-height:18px; text-align:center!important;">
                            <img src="<?php echo img_assets_url().'qrcodes/'.$this->data['single_invoice'][0]['codeMECeFDGI'].'.png'; ?>" />
                        </td>
                    </tr>

                </tbody>
            </table>
        <?php
            }
        ?>
        <!-- /Table Mecef details -->
    </div>


<script>
     //FUNCTION TO PRINT
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