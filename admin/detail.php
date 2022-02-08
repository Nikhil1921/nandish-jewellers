<?php
    include('layout/connect.php');
    $oid = (isset($_GET['je_id'])) ? $_GET['je_id'] : 0;
    $sql = "SELECT * FROM orders o JOIN user u ON o.o_u_id = u.u_id where o_id = '$oid'";
    $run = mysqli_query($connect,$sql);
    $data = mysqli_fetch_assoc($run);
    if (!$data)
    echo "<script>alert('Invalid order.');window.open('complete_order_list.php','_self');</script>";
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
    <link rel="stylesheet" href="assets/css/billlayout.css">
<body>
    <div class="content bg-gray-lighter">
        <center>
            <button type="button" onclick="printDiv('prnt')"><i class="si si-printer"></i> Print</button>
        </center>
        <br>
        <div id="prnt" style="overflow:auto" >
                <page class="org" size="A4" layout="portrait">
                    <table class="tblsize" border="0" cellpadding="0" cellspacing="0">
                        <tr style="height:258px">
                            <td>
                                <table align="right" style="margin-right: 60px;margin-top: 80px;" border="0" cellpadding="3">
                                    <tr align="right">
                                        <td><span style="font-weight:bold;font-size: 20px ">Transaction:<b style="margin-left: 10px;font-family: Arial">Online</b></span></td>
                                    </tr>
                                    <tr  align="right">
                                       <td><span style="font-weight:bold;font-size: 20px "> Bill No.:<b style="margin-left: 10px;font-family: Arial">20/21-2</b></span></td>
                                    </tr>
                                    <tr  align="right">
                                        <td><span style="font-weight:bold;font-size: 20px "> Pan No.: <b style="font-family: Arial;text-transform: uppercase;">GJAT897415</b></span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td>
                                <table border="0" width="1010px" align="center" style="margin-top: 3px">
                                    <tbody>
                                    <tr>
                                        <td width="35px" height="18px">&nbsp;</td>
                                        <td width="240px" colspan="5"><b style="margin-left: 45px;font-size: 20px"><?= $data['u_f_name'].' '.$data['u_m_name'].' '.$data['u_l_name'] ?></b></td>
                                        <td ><b style="font-size: medium"><?= $data['o_date']; ?></b></td>
                                        <td colspan="2"><b style="margin-left: 85px;font-size: large !important;"><?= $data['o_city'] ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width="35px" height="34px">&nbsp;</td>
                                        <td width="240px">&nbsp;</td>
                                        <td width="75px">&nbsp;</td>
                                        <td width="98px">&nbsp;</td>
                                        <td width="98px">&nbsp;</td>
                                        <td width="98px">&nbsp;</td>
                                        <td width="97px"> &nbsp;</td>
                                        <td width="98px">&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr height="185px" valign="top">
                                        <td colspan="9">
                                            <table border="0"  width="100%" align="center" cellspacing="0" cellpadding="1">
                                                <?php
                                                    $pro = json_decode($data['o_details']);
                                                    $price['gold'] = $making['gold'] = $shipping['gold'] = $other['gold'] = $total['gold'] = 0;
                                                    $price['silver'] = $making['silver'] = $shipping['silver'] = $other['silver'] = $total['silver'] = 0;
                                                    foreach ($pro as $k => $v): 
                                                        $sql_pr = "SELECT * FROM product p INNER JOIN category c ON p.p_cat = c.c_id WHERE p_id = '$v->prod_id'";
                                                        $result_pr = $connect->query($sql_pr);
                                                        $data_pr = $result_pr->fetch_assoc();
                                                        
                                                        if ($data_pr['c_name'] == 'Silver') {
                                                            $shipping['silver'] += $v->shipping;
                                                            $price['silver'] += $v->price;
                                                            $making['silver'] += $v->making;
                                                            $other['silver'] += $v->other;
                                                            $total['silver'] += $v->total;
                                                        }else if ($data_pr['c_name'] == 'Gold') {
                                                            $shipping['gold'] += $v->shipping;
                                                            $price['gold'] += $v->price;
                                                            $making['gold'] += $v->making;
                                                            $other['gold'] += $v->other;
                                                            $total['gold'] += $v->total;
                                                        }
                                                        // $img = explode(',', $data_pr['p_image']);
                                                ?>
                                                <tr>
                                                    <td width="10px" style="padding-left: 5px" align="center"><b style="font-size: medium"><?= $k+1 ?></b></td>
                                                    <td width="290px" align="left" style="padding-left: 10px"><b style="font-size: medium"><?= $data_pr['p_name']; ?><?= ($v->price) ? '' : ' (Pre order)' ?> X <?= $v->qty; ?><br><?= $data_pr['p_code'] ?></b></td>
                                                    <td width="80px" align="center" style="padding-right: 5px"><b style="font-size: medium"><?= $data_pr['p_g_wei'] ?></b></td>
                                                    <td width="90px" align="center" style="padding-right: 5px"><b style="font-size: medium"><?= $data_pr['p_l_wei'] ?></b></td>
                                                    <td width="90px" align="center" style="padding-right: 5px"><b style="font-size: medium"><?= $data_pr['p_gram'] ?></b></td>
                                                    <td width="80px" align="center" style="padding-right: 5px"><b style="font-size: medium"><?= $v->price; ?></b></td>
                                                    <td width="90px" align="center" style="padding-right: 5px"><b style="font-size: medium"><?= $v->making; ?></b></td>
                                                    <td width="90px" align="center" style="padding-right: 5px"><b style="font-size: medium"><?= $v->other; ?></b></td>
                                                    <td width="130px" align="center" style="padding-right: 10px"><b style="font-size: medium"><?= $v->total; ?></b></td>
                                                </tr>
                                                <?php endforeach ?>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr style="height: 200px;">
                                        <td colspan="9" valign="bottom">
                                            <b style="margin-left: 50px;top: 170px;position: relative">Discount on order : ₹ <?= $total['gold'] + $total['silver'] + $shipping['gold'] + $shipping['silver'] - $data['o_total'] ?> </b>
                                            <table align="right" style="margin-right: 4px;" border="0" width="450px" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td width="90px"></td>
                                                    <td width="90px" align="right">
                                                        <b> <?= $price['silver'] ?> </b>
                                                    </td>
                                                    <td width="90px"></td>
                                                    <td width="90px" align="right">
                                                        <b> <?= $price['gold'] ?> </b>
                                                    </td>
                                                </tr>
                                                <tr height="27px">
                                                    <td width="90px"></td>
                                                    <td width="90px" align="right">
                                                        <b> <?= $making['silver'] ?> </b>
                                                    </td>
                                                    <td width="90px"></td>
                                                    <td width="90px" align="right">
                                                        <b> <?= $making['gold'] ?> </b>
                                                    </td>
                                                </tr>
                                                <tr height="25px">
                                                    <td width="90px"></td>
                                                    <td width="90px" align="right">
                                                        <b><?=  $other['silver'] ?></b>
                                                    </td>
                                                    <td width="90px"></td>
                                                    <td width="90px" align="right">
                                                        <b> <?= $other['gold'] ?> </b>
                                                    </td>
                                                </tr>
                                                <tr height="20px">
                                                    <td width="90px"></td>
                                                    <td width="90px" align="right">
                                                        <b><?=  $shipping['silver'] ?></b>                                                           
                                                    </td>
                                                    <td width="90px"></td>
                                                    <td width="90px" align="right">
                                                        <b> <?= $shipping['gold']; ?></b>
                                                    </td>
                                                </tr>

                                                 
                                                <tr height="28px">
                                                    <td width="90px"></td>
                                                    <td width="90px" align="right">
                                                        
                                                        <b> ------- </b>
                                                    </td>
                                                    <td width="90px"></td>
                                                    <td width="90px" align="right">
                                                        
                                                        <b> ------- </b>
                                                    </td>
                                                </tr>
                                                <tr height="25px">
                                                    <td width="90px"></td>
                                                    <td width="90px" align="right">
                                                        <b> ------- </b>
                                                    </td>
                                                    <td width="90px"></td>
                                                    <td width="90px" align="right">
                                                        <b> ------- </b>
                                                    </td>
                                                </tr>
                                                <tr height="25px">
                                                    <td width="90px"></td>
                                                    <td width="90px" align="right">
                                                        <b> ------- </b>
                                                    </td>
                                                    <td width="90px"></td>
                                                    <td width="90px" align="right">
                                                        <b> ------- </b>
                                                    </td>
                                                </tr>
                                                <tr height="26px">
                                                    <td width="90px"></td>
                                                    <td width="90px" align="right">
                                                        <b> ₹ <?= $total['silver'] ?> </b>
                                                    </td>
                                                    <td width="90px"></td>
                                                    <td width="90px" align="right">
                                                        <b> ₹ <?= $total['gold'] ?> </b>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td colspan="3" align="center" style="padding-top: 0px">
                                                        <b style="font-size: 20px">₹&nbsp;<?= $data['o_total'] ?></b>
                                                    </td>
                                                </tr>

                                            </table>

                                        </td>

                                    </tr>

                                    <tr>
                                        <td height="1px"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                            
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </page>
        </div>
    </div>
</body>