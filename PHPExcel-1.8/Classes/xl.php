<?php
$connect = mysqli_connect("localhost", "root", "", "bakharabad");
$output = '';
if(isset($_POST["import"]))
{
 $extension = end(explode(".", $_FILES["excel"]["name"])); // For getting Extension of selected file
 $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
 if(in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
 {
  $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file
  include("PHPExcel/IOFactory.php"); // Add PHPExcel Library in this code
  $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file

  $output .= "<label class='text-success'>Data Inserted</label><br /><table class='table table-bordered'>";
  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
  {
   $highestRow = $worksheet->getHighestRow();
   for($row=2; $row<=$highestRow; $row++)
   {
    $output .= "<tr>";
    $bill_no = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
    $account_no = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
    $meter_no = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
    $meter_manufacturer_code = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
    $month = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
    $year=  mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
   
    $vat = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
    $total_amount = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
    $issue_date = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
     $new_issue_date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($issue_date));
    //echo $collection_date;die;
    // $newCollectionDate = date('Y-m-d',strtotime($collection_date));
     echo $new_issue_date ,"<br>";

    $tracking_number = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(9, $row)->getValue());
    $application_serial_no = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(10, $row)->getValue());
    
    $fees_type =  mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(11, $row)->getValue());
    
    $receipt_collected = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(12, $row)->getValue());
    $no_of_month = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(13, $row)->getValue());
    $m_factor = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(14, $row)->getValue());
    $unit = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(15, $row)->getValue());
    $total_unit = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(16, $row)->getValue());
    $hrs_per_hour = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(17, $row)->getValue());
    $load = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(18, $row)->getValue());
    $tariff = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(19, $row)->getValue());

    $revised_date = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(20, $row)->getValue());
    $new_revised_date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($revised_date));
    //echo $collection_date;die;
    // $newCollectionDate = date('Y-m-d',strtotime($collection_date));
     echo $new_revised_date ,"<br>";

    $prepared_by = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(21, $row)->getValue());
    $billed_unit = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(22, $row)->getValue());
    $adjustment_tk = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(23, $row)->getValue());
    $comments = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(24, $row)->getValue());
    $installment = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(25, $row)->getValue());
    $paid_code = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(26, $row)->getValue());
    $paid_calc = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(27, $row)->getValue());
    $service_no_code = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(28, $row)->getValue());
    $old_account_no = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(29, $row)->getValue());
    $due_date = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(30, $row)->getValue());
     $new_due_date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($due_date));
    //echo $collection_date;die;
    // $newCollectionDate = date('Y-m-d',strtotime($collection_date));
     echo $new_due_date ,"<br>";
     
    $remote_posted = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(31, $row)->getValue());
    $dept_id  = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(32, $row)->getValue());
    $lpc = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(33, $row)->getValue());
    $batch_cityb  = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(34, $row)->getValue());
    

    

    $query = "INSERT INTO desco_fees_calculation (`bill_no`, `account_no`, `meter_no`, `meter_manufacturer_code`,`month`,`year`,`vat`,
    `total_amount`,`issue_date`,`tracking_number`, `application_serial_no`, `fees_type`,`receipt_collected`,`no_of_month`,`m_factor`,`unit`,
    `total_unit`,`hrs_per_hour`,`load`,`tariff`,`revised_date`,`prepared_by`,`billed_unit`,`adjustment_tk`,`comments`,`installment`,`paid_code`,`paid_calc`,
    `service_no_code`,`old_account_no`,`due_date`,`remote_posted`,`dept_id`,`lpc`,`batch_cityb`) VALUES ('".$bill_no."', '".$account_no."' , '".$meter_no."' , '".$meter_manufacturer_code."', '".$month."', '".$year."', '".$vat."', '".$total_amount."', '".$new_issue_date."', '".$tracking_number."', '".$application_serial_no."', '".$fees_type."', '".$receipt_collected."', '".$no_of_month."', '".$m_factor."',
     '".$unit."', '".$total_unit."', '".$hrs_per_hour."', '".$load."', '".$tariff."', '".$new_revised_date."', '".$prepared_by."'
     ,'".$billed_unit."' ,'".$adjustment_tk."' ,'".$comments."' ,'".$installment."' ,'".$paid_code."' ,'".$paid_calc."',
     '".$service_no_code."','".$old_account_no."','".$new_due_date."','".$remote_posted."','".$dept_id."','".$lpc."','".$batch_cityb."')";
    $q=mysqli_query($connect, $query);
    print $query;

/*
    $output .= '<td>'.$bill_no.'</td>';
    $output .= '<td>'.$bundle_no.'</td>';
    $output .= '<td>'.$bank_code.'</td>';
    $output .= '<td>'.$scroll_no.'</td>';
    $output .= '<td>'.$collection_date.'</td>';
    $output .= '<td>'.$total_payable_amount.'</td>';
    $output .= '<td>'.$total_paid_amount.'</td>';
    $output .= '<td>'.$lpc.'</td>';
     $output .= '<td>'.$paid.'</td>';
    $output .= '<td>'.$due_date.'</td>';
    $output .= '<td>'.$old_bill_no.'</td>';
    $output .= '<td>'.$entry_date.'</td>';
    $output .= '<td>'.$op_id.'</td>';
    $output .= '<td>'.$collection_status.'</td>';
    $output .= '<td>'.$collected_vat.'</td>';
    $output .= '<td>'.$confirm.'</td>';

   $output .= '<td>'.$c_tariff.'</td>';
    $output .= '<td>'.$short_access.'</td>';
    $output .= '<td>'.$remote_posted.'</td>';
    $output .= '<td>'.$department_id.'</td>';
    $output .= '<td>'.$batch_gp.'</td>';
    $output .= '<td>'.$batch_for_gp.'</td>';
    $output .= '<td>'.$old_account_no.'</td>';
*/
     
    $output .= '</tr>';
   }
  } 
  $output .= '</table>';

 }
 else
 {
  $output = '<label class="text-danger">Invalid File</label>'; //if non excel file then
 }
}



$sql="SELECT * FROM desco_fees_calculation";
$row=mysqli_query($connect,$sql);
echo "Total rows are : ",mysqli_num_rows($row),"<br>";
?>

<html>
 <head>
  <title>Import Excel to Mysql using PHPExcel in PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  <style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
  .box
  {
   width:700px;
   border:1px solid #ccc;
   background-color:#fff;
   border-radius:5px;
   margin-top:100px;
  }
  
  </style>
 </head>
 <body>
  <div class="container box">
   <h3 align="center">Import Excel to Mysql using PHPExcel in PHP</h3><br />
   <form method="post" enctype="multipart/form-data">
    <label>Select Excel File</label>
    <input type="file" name="excel" />
    <br />
    <input type="submit" name="import" class="btn btn-info" value="Import" />
   </form>
   <br />
   <br />
   <?php
   echo $output;
   ?>
  </div>
 </body>
</html>