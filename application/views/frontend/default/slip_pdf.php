<?php
$user_id = $this->session->userdata('user_id');

$user = $this->user_model->get_all_user($user_id)->result_array();
//print_array($pdf_data);


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body style="padding: 0px 00px;overflow-x: hidden;">

<!--    <div style="border: 1px solid black;-->
<!--width: 111px;-->
<!--position: absolute;-->
<!--top: 149px;-->
<!--left: 800px;-->

<!--transform: rotate(90deg);">-->
<!--        -->
</div>

<img src="<?php echo base_url('assets/frontend/default/assets/unilogo.png') ?>"
     style="width:100px;text-align: center; scroll-margin-top: 20px;position: relative;top: 25px"/>


<h3 style="text-align: center;margin: 0px;font-family: Arial, Helvetica, sans-serif;
font-size: 20px;"> Invoice Receipt</h3>
<br>

<table style="border-collapse: collapse; width: 100%;border: 2px solid black; ">
    <tbody>
    <tr>
        <td style="width: 100%;">
        </td>
    </tr>
    <tr>
        <td style="width: 100%;padding: 20px 8px;border-top: 2px solid;font-family: Arial, Helvetica, sans-serif;font-size: 14px; ;border-top: 0px">
            <!--            TO <br>-->
            <b>Name :- <?php echo $user[0]['first_name'] . " " . $user[0]['last_name'] ?></b>
            <!--            <br>Second floor, 7/312, IUDS PuRI, DEL111.110091-->
            </li>
            <div class="list" style="position: relative;left: 360px;list-style: none;margin-top: -45px;">
                <br>
                <li style="text-align: right;list-style: none;position: relative;left: 470px;margin: 0px 0px;top: -13px;width: 300px;">
                <li>
                    <b>Bill No- </b> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                    <?php echo "PH-" . rand(0000000, 9999999) ?>
                </li>
                <li>
                    <b>Purchase Date- </b>&nbsp;&nbsp;
                    <?php echo date('M d Y', $pdf_data[0]['date_added']) ?>
                </li>
                <!--                <li>-->
                <!--                    <b>On Account- </b> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;Credit-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <b>Delivery Date- </b> &nbsp;&nbsp;&nbsp; --><?php //echo date(strtotime($pdf_data[0]['date_added']))?>
                <!--                </li>-->
                </li>
            </div>
        </td>

    </tr>

    <!--    <tr>-->
    <!--        <td style="width: 100%;padding: 20px 8px;border-top: 2px solid ;font-family: Arial, Helvetica, sans-serif;font-size: 14px;">-->
    <!--            TO <br>-->
    <!--            <b>--><?php //echo $comission_data['commission_type'] ?>
    <!--            </b>-->
    <!--            <br>Second floor, 7/312, IUDS PuRI, DEL111.110091-->
    <!--            </li>-->
    <!--        </td>-->
    <!--    </tr>-->
    </tbody>
</table>
<p style="border-left: 2px solid black;padding: 7px;margin: 0px;border-right: 2px solid black;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </p>
<table style="border-collapse: collapse; width: 100%; height: 36px; border: 2px solid black; ">
    <tbody>
    <tr style="height: 30px;border-bottom: 2px solid;">
        <th style="width: auto; height: 18px;border-right: 2px solid black;text-align: center">S.No</th>
        <th style="width: auto; height: 18px;border-right: 2px solid black;padding-left:5px ;text-align: center">
            Courses Name
        </th>
        <th style="width: auto; height: 18px;border-right: 2px solid black;padding-left:5px ;text-align: center">
            Transaction NO
        </th>
        <th style="width: auto; height: 18px;border-right: 2px solid black;padding-left:5px ;text-align: center">
            Price
        </th>
        <th style="width: auto; height: 18px;border-right: 2px solid black;padding-left:5px ;text-align: center">
            Gst / 18%
        </th>
        <th style="width: auto; height: 18px;border-right: 2px solid black;text-align: center">Amount</th>

        <!--        <th style="width: auto; height: 18px;border-right: 2px solid black;">Start Date</th>-->
        <!--        <th style="width: auto; height: 18px;border-right: 2px solid black;">End Date</th>-->

    </tr>
    <?php
    $total_amount = 0;
    foreach ($pdf_data as $key => $history_data) {

        $course = $this->crud_model->get_course_by_id($history_data['course_id'])->result_array();
        $total_amount = $course[0]['price'] + $total_amount;
//            print_array($course);
        ?>
        <tr style="height: 18px;">
            <td style="width: auto; height: 18px;border-right: 2px solid black;text-align: center">
                <?php echo $key + 1 ?>
            </td>
            <td style="width: auto; height: 18px;border-right: 2px solid black;text-align: center">
                <?php echo $course[0]['title'] ?>
            </td>
            <td style="width: auto; height: 18px;border-right: 2px solid black;text-align: center">
                <?php echo $history_data['tr_num'] ?>
            </td>
            <td style="width: auto; height: 18px;text-align: center;padding: 10px;border-right: 2px solid black;">
                <?php echo $course[0]['price'] - $course[0]['price'] / 100 * 18 ?></td>
            <td style="width: auto; height: 18px;text-align: center;padding: 10px;border-right: 2px solid black;">
                <?php echo $course[0]['price'] / 100 * 18 ?>
            </td>
            <td style="width: auto; height: 18px;text-align: center;padding: 10px;border-right: 2px solid black;">
                <?php echo $course[0]['price'] ?>
            </td>
        </tr>
        <!--           $pdf_data[0]['total_amount']." | ".$pdf_data[0]['status']." | "-->
        <?php
    }
    ?>
    </tbody>
</table>
<table style="border-collapse: collapse; width: 100%; height: 36px; border: 2px solid black;;border-top: 0px">
    <tbody>
    <tr style="height: 30px;border-bottom: 2px solid;">
        <!--        <th style="width: auto; height: 18px;text-align: center"></th>-->


        <th style="width: auto;height: 18px;text-align: right;padding: 10px;">Total Amount
            :- <?php echo $total_amount ?></th>


    </tr>


    <th style="width: 100%;height: 18px;text-align: left;padding: 10px 14px;"></th>

    <!--    <th style="border-right:2px solid #000"> </th>-->

    </tbody>
</table>

<table style="border-collapse: collapse; width: 100%; height: 36px; border-right: 2px solid black; border-bottom: 2px solid black; border-left: 2px solid black">
    <tbody>
    <th style="width: auto;height: 18px;text-align: left;padding: 10px 14px;">
        Amount in world:- <?php num_to_word($total_amount); ?>
    </th>
    </tbody>
</table>

<!--<table style="border-collapse: collapse; width: 100%; height: 36px; border: 2px solid black; border-top: 0px">-->
<!--    <tbody>-->
<!--    <tr style="height: 30px;border-bottom: 2px solid;">-->
<!---->
<!--        <th style="width: 100%;height: 18px;text-align: left;margin-left:200px;padding: 10px 14px;"></th>-->
<!---->
<!--        <th style="height: 18px;text-align: right;padding: 10px;text-align: left">tax Summary<br> tttttyy:fefjefhew<br>-->
<!--            fgdshfgds:gfdugfsudf<br></th>-->
<!--    </tr>-->
<!--    </tbody>-->
<!--</table>-->


<!--<table style="width:100%;border-right: 2px solid black;border-left: 2px solid black;border-bottom: 2px solid black;">-->
<!--    <tr>-->
<!--        <th style="text-align: left;">-->
<!--            <b>Term And Condition </b>-->
<!--        </th>-->
<!--        <th></th>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>1.Delivert Terms: Payment:-Within15 day</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>2.Despatch Instructions:-At PANDAV Nagar Office</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>3.Company Dicision With Regards Of the Material Will be Final Add Binding On the Supplier</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>5.Reject Consignments Are to be taken by you immidaitly at your cost6.</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>6.Gaurntee Warranty 100% Food Grade MATERIL</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>7.Penalty:-</td>-->
<!--        <td style="text-align: left;width:300px">-->
<!--            <b>MULTIPLEX CINEVISION P. LIMITED </b>-->
<!--        </td>-->
<!--        <td></td>-->
<!--    </tr>-->
<!--    <tr></tr>-->
<!--    <tr>-->
<!--        <td>8.Please return duplicate Copy of This Order After Acknowledgments</td>-->
<!--        <td></td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>9. All Disputes Subject to Delhi Jurisdition</td>-->
<!--    </tr>-->
<!--</table>-->
<!-- <div class="container"><div class="row"><div class="col-md-6" style="display: inline-block;
        width: 50%;font-size: 14px;
            font-weight: 600;
            font-family: Arial, Helvetica, sans-serif;"><tr style="height: 18px;"><td style="width: auto; height: 18px; font-family: Arial, Helvetica, sans-serif;
              font-size: 13px;
              font-weight: 600;width: 50%;
              float: right;"><b>Term And Condition </b><br>1.Delivert Terms: <br> Payment:-Within15 day <br>2.Despatch Instructions:-At PANDAV Nagar Office <br>3,.Company Dicision With Regards Of the Material Will be Final Add Binding On the Supplier <br> 5.Reject Consignments Are to be taken by you immidaitly at your cost6. <br> 6.Gaurntee Warranty 100% Food Grade MATERIL <br>7.Penalty:-  8. Please return duplicate Copy of This Order After Acknowledgments <br> 9. All Disputes Subject to Delhi Jurisdition
        </td><td style="width: auto; height: 18px;text-align:"></td></tr></div><div class="col-md-6" style="display: inline-block;width: 50%;
            float: right;top: 141px;"><p style="float: right;position: relative;
            top: 119px;font-family: Arial, Helvetica, sans-serif;"><b>Multiplex Cinevision P.LIMITED </b></p></div></div></div><div class="container" style="margin-top: 40px;"><div class="row"><div class="col-md-6" style="display: inline-block;
            width: 50%;"><p style="text-align:left;text;list-style: none;  position: relative;width: 113px;left: 262px;font-family: Arial, Helvetica, sans-serif;font-size: 14px;font-size: 14px;
          font-weight: 600;"> Purchase Order</p></div><div class="col-md-6" style="display: inline-block;width: 50%;float: right;top: 141px;"><ul style="list-style: none;
            position: relative;

            margin: 0px 0px;
            top: -13px;
            width: 300px;font-family: Arial, Helvetica, sans-serif;font-size: 14px;"><li><b>Po No- </b> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; PO00091
        </li><li><b>Date- </b> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 09/2/2022
        </li><li><b>On Account- </b> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; Credit
        </li><li><b>Delivery Date- </b> &nbsp;&nbsp;&nbsp; 29/2/2022
        </li></ul></div></div></div> -->

<!--<table style="border-collapse: collapse; width: 100%; height: 36px;margin-top:20px;">-->
<!--    <tbody>-->
<!--    <tr style="height: 18px;">-->
<!--        <th style="width: auto; height: 18px;font-weight: 600;-->
<!--          font-size: 15px;font-family: Arial, Helvetica, sans-serif;">Ph no 7846573587657-->
<!--        </th>-->
<!---->
<!---->
<!--    </tr>-->
<!--    </tbody>-->
<!--</table>-->

<!--<p style="text-align:center;margin: 0px;"> fdhewfewhfejelkl</p>-->

<table >
    <tbody>
    <tr>
        <td style="width: auto;height: 18px;text-align: left;padding:5px ;">
            <b>Term's & Condition :- </b><br>DataTable custom filter dropdown - Stack Overflow
            7 Feb 2020
            Datatables add custom select on heading filter - Stack Overflow
            6 Jun 2016
            How to search/filter a specific DataTables column from a select
            2 Sept 2021
            Dropdown filtering in jQuery Datatables - Stack Overflow
            11 Mar 2020
            More results from stackoverflow.com
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>