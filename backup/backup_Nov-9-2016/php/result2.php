<?php
session_start();
include '../db/connect.php';
error_reporting(0);
$id = $_SESSION['id'];
$sql = "select * from score_students where stud_id = '$id'";
$result = mysql_query($sql) or die(mysql_error());
$count = mysql_num_rows($result);
$row = mysql_fetch_object($result);
$sid = $row->stud_id;
$tid = $row->test_id;
//$attemptquestion = mysql_num_rows($row,$con);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" /-->
 <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script-->
 <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->
 <style>
.height {
    min-height: 200px;
}

.icon {
    font-size: 47px;
    color: #5CB85C;
}

.iconbig {
    font-size: 77px;
    color: #5CB85C;
}

.table > tbody > tr > .emptyrow {
    border-top: none;
}

.table > thead > tr > .emptyrow {
    border-bottom: none;
}

.table > tbody > tr > .highrow {
    border-top: 3px solid;
}

</style>
<script>
$(document).ready(function(){
$('.closediv').click(function(){
		// To close the div and empty it
		$("#response_here").empty();
	});
$('.btnReview').click(function(){
	$('#response_here').load('../php/review_test.php?id=' + <?php echo $sid; ?>);
});	
});
</script>
</head>
<body>
<!--div class="affix-btn">
                    <button name="submit" type="submit" value="Save" class="btn pull-right closediv" data-offset-top="0">Close</button>
                </div-->
<?php
/*foreach ($ids as $value) {
    //echo "Key: $key; Value: $value\n";
	//echo $value;
	$tmp[]=$value;

}
//print_r($tmp);
$tmpjoin = implode(",",$tmp);*/

//$sql = "SELECT customerorders.orderids, customer_cart_items.customer_cart, FROM   customerorders , customer_cart_items WHERE  id = $id && cust_id=cust_id";
$sql = "select * from result_students where student_id = '$id'";

$result = mysql_query($sql) or die(mysql_error());

$row = mysql_fetch_object($result);
$sid = $row->student_id;
$tid = $row->test_id;
$tm = $row->total_marks;
$at = $row->attempt;
$duration = $row->duration;
?>
<div class="panel-body">
                
			
<!-- Simple Invoice - START -->

   
    <div class="row">
        <div class="col-md-12">
		<?php
						$sql2 = "select * from students where id = '$sid'";
						$result2 = mysql_query($sql2) or die(mysql_error());
						$value = mysql_fetch_object($result2);
						$fullname = $value->fullname;
						$name = $value->username;
						$email = $value->email;
						$category = $value->studentcategory;

				?>
                    <div class="panel panel-default height">
                        <div class="panel-heading">Student Details</div>
                        <div class="panel-body">
						ID: <strong><?php echo $sid; ?></strong><br>
						Name: <?php echo $fullname; //$name ?><br>
						Category: <?php echo $category; ?><br>
						Email: <?php echo $email; //$name ?><br>
                        </div>
                    </div>
                
            <div class="panel panel-default">
                        <div class="panel-heading panel-heading-custom">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Result
                        </div>
                        <div class="panel-body">
                            <div class="col-md-7">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Descriptions</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Attempted Question</td>
                                            <td><?php echo $count; ?></td>
                                        </tr>
                                        <!--tr>
                                            <td>Un-Attempted Question</td>
                                            <td><?php //echo $unatmpt = $count - $tm; ?></td>
                                        </tr-->
                                        <tr>
                                            <td>Total Correct Answer</td>
                                            <td><?php echo $tm; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total Wrong Answer</td>
                                            <td><?php echo $wrong = $count - $tm; ?></td>
                                        </tr>
										 <tr>
                                            <td>Total Spend time</td>
                                            <td><?php echo number_format($duration,2); ?> Min.</td>
                                        </tr>
                                        <tr>
                                            <td>Result</td>
                                            <td><?php if($tm == '') { return; }  if($tm >= 20) {?> <span class="label label-success">Pass</span> <?php } else { ?> <span class="label label-danger">Fail</span> <?php } ?></td>
                                        </tr>
                                        <tr>
                                            <td>Performance</td>
                                            <td>
											<?php if($tm <=10 ) {echo 'Bad';} 
													else if($tm <=15) {echo 'Improve';}
													else if($tm <=20) {echo 'Good';}
													else if($tm <=25) {echo 'Better';}
													else if($tm <=28) {echo 'Best';}
																						
											
											?>
											
											
											
											</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-5">
                                <div id="chart" class="c3" style="max-height: 320px; position: relative;"><table class="c3-tooltip"><tbody><!--tr class="c3-tooltip-name-Wrong"><td class="name"><span style="background-color:#0064C9"></span>Wrong</td><td class="value">100.0%</td></tr--></tbody></table></div></div>
                            </div>
                            
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                             
                                <button class="btn btn-primary" onclick="javascript:window.print();" style="margin-left:10px;"><i class="fa fa-print"></i>Print</button>
								<button class="btn btn-primary btnReview"><i class="fa fa-print"></i>Review</button>
								<button name="submit" type="submit" value="Save" class="btn pull-center closediv" data-offset-top="0">Close</button>
								<!--a href="#" class="btn btn-info" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print</a-->
                            </div>
                            <!--div>
<div class="col-md-12" style="padding:15px;">
    
</div></div-->
                        </div>
                    </div>
        <!--/div>
    </div-->




<!-- Simple Invoice - END -->
</div>
</body>
</html>