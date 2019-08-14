<?php
include("DBConnect.php");
// Create connection
//TODO: add late of islate=0 else no thing to do 
// Check connection
$get1kw;
$total;
$dudate;
$vat;
$consm;
$islate;

$url = "";
if (isset($_POST['id'])) {

  $id = $_POST['id'];

  $querypay = "SELECT  `id`,`fk_client`,`consumption` ,`costof1`,`Total`,`payment_st`, `issued_date`, `payment_date` FROM `payment` WHERE   id=" . $id;

  $result = mysqli_query($connect, $querypay);

  $row = mysqli_fetch_assoc($result);
  $url = "pay.php?id=" . $row['id'];


  $dudate = date('Y-m-d', strtotime($row['issued_date'] . ' + 3 days'));
  //  if($dudate-date('Y-m-d')<0){

  //   $islate=1;
  //  } else{
  //   $islate=0;
  //TODO:calculate the late is true orfalse
  //  }                   
  //$data["consumption"] = $row["consumption"];
  /// $data["costof1"] = $row["costof1"];
  ///$data["Total"] = $row["Total"];
  /// $data["payment_st"] = $row["payment_st"];
  /// $data["issued_date"] = $row["issued_date"];
  $queryclient = "SELECT  `fname`, `lname`, `city`, `street`, `phone`, `email` FROM `person` INNER JOIN `client` on  client.PID = person.PID  WHERE id='" . $row['fk_client'] . "'";

  $profile = mysqli_query($connect, $queryclient);
  $clientrow = mysqli_fetch_assoc($profile);

  $costQ = "SELECT `cost_1kw` FROM `supplier`,`client` where client.fkSupplier = supplier.id and client.id ='" . $row['fk_client'] . "'";
  $costresult = mysqli_query($connect, $costQ);
  $cost = mysqli_fetch_object($costresult);
  $get1kw  = (int)$cost->cost_1kw;
  $consm = $get1kw * $row['consumption'];

  $total = $consm + ($consm * 11.0 / 100);
  $vat = $total - $consm;
  $querysupplier = "SELECT `fname`, `lname`, `city`, `street`, `phone`, `email` FROM `supplier`,`client`,`person` where client.fkSupplier = supplier.id and supplier.PID=person.PID and client.id ='" .  $row['fk_client'] . "'";

  $supplier = mysqli_query($connect, $querysupplier);
  $supplierrow = mysqli_fetch_assoc($supplier);
  if ($row["payment_st"] == "0") {

    $data["payment_date"] = "0";


    echo "<div class='modal fade' id='paymodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog  modal-lg' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h5 class='modal-title' id='exampleModalLabel'>Payment #" . $row['id'] . "</h5>
          <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>×</span>
          </button>
        </div>
        <div class='modal-body'>
          <div class='container'>
            <div class='card'>
              <div class='card-header'>
                Invoice
                <strong>" . $row["issued_date"] . "</strong>
                <span class='float-right'> <strong>Status:</strong style='color:red'><font color='red'>Unpaid</font></span>

              </div>
              <div class='card-body'>
                <div class='row mb-4'>
                  <div class='col-sm-6'>
                    <h6 class='mb-3'>From:</h6>
                    <div>
                      <strong>" . $supplierrow['fname'] . " " . $supplierrow['lname'] . "</strong>
                    </div>
                    <div> " . $supplierrow['street'] . "</div>
                    <div> " . $supplierrow['city'] . "</div>
                    <div>Email: " . $supplierrow['email'] . "</div>
                    <div>Phone: " . $supplierrow['phone'] . "</div>
                  </div>

                  <div class='col-sm-6'>
                    <h6 class='mb-3'>To:</h6>
                    <div>
                      <strong>" . $clientrow['fname'] . " " . $clientrow['lname'] . "</strong>
                    </div>
                    <div>" . $clientrow['street'] . "</div>
                    <div>" . $clientrow['city'] . "</div>
                    <div>Email: " . $clientrow['email'] . "</div>
                    <div>Phone: " . $clientrow['phone'] . "</div>
                  </div>



                </div>

                <div class='table-responsive-sm'>
                  <table class='table table-striped'>
                    <thead>
                      <tr>

                        <th>name</th>


                        <th class='right'>Unit Cost</th>
                        <th class='center'>kw.h</th>
                        <th class='right'>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>

                        <td class='left strong'>Consumption</td>


                        <td class='right'>" . $get1kw . "</td>
                        <td class='right'>" . $row['consumption'] . "</td>
                        <td class='right'>" . $consm . "</td>
                      </tr>

                    </tbody>
                  </table>
                </div>
                <div class='row'>
                  <div class='col-lg-4 col-sm-5'>

                  </div>

                  <div class='col-lg-4 col-sm-5 ml-auto'>
                    <table class='table table-clear'>
                      <tbody>
                        <tr>
                          <td class='left'>
                            <strong>Subtotal</strong>
                          </td>
                          <td class='right'>" . $consm . " lbp</td>
                        </tr>
                        <tr>
                          <td class='left'>
                            <strong>VAT (11%)</strong>
                          </td>
                          <td class='right'>" . $vat . "  lbp</td>
                        </tr>
                      
                        <tr>
                          <td class='left'>
                            <strong>Total</strong>
                          </td>
                          <td class='right'>
                            <strong>" . $total . " lbp</strong>
                          </td>
                        </tr>
                      </tbody>
                    </table>

                  </div>

                </div>

              </div>
            </div>
          </div>
        </div>
        <div class='modal-footer'>
        <button class='btn btn-primary hidden-print' onclick'print(paymodal)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>
          <button class='btn btn-secondary' type='button' data-dismiss='modal'>Cancel</button>
          <a class='btn btn-primary' href='" . $url . "'>Checkout</a>
        </div>
      </div>
    </div>
  </div>";
  } else {
    echo "<div class='modal fade' id='paymodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
          <div class='modal-dialog  modal-lg' role='document'>
            <div class='modal-content'>
              <div class='modal-header'>
              <h5 class='modal-title' id='exampleModalLabel'>Payment #" . $row['id'] . "</h5>
                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                  <span aria-hidden='true'>×</span>
                </button>
              </div>
              <div class='modal-body'>
                <div class='container'>
                  <div class='card'>
                    <div class='card-header'>
                      Invoice
                      <strong>" . $row["issued_date"] . "</strong>
                      <span class='float-right'> <strong>Status:</strong style='color:red'><font color='green'>Paid at  <strong>" . $row["payment_date"] . "</strong></font></span>
      
                    </div>
                    <div class='card-body'>
                      <div class='row mb-4'>
                        <div class='col-sm-6'>
                          <h6 class='mb-3'>From:</h6>
                          <div>
                            <strong>" . $supplierrow['fname'] . " " . $supplierrow['lname'] . "</strong>
                          </div>
                          <div>" . $supplierrow['street'] . "</div>
                          <div>" . $supplierrow['city'] . "</div>
                          <div>Email: " . $supplierrow['email'] . "</div>
                          <div>Phone: " . $supplierrow['phone'] . "</div>
                        </div>
      
                        <div class='col-sm-6'>
                          <h6 class='mb-3'>To:</h6>
                          <div>
                            <strong>" . $clientrow['fname'] . " " . $clientrow['lname'] . "</strong>
                          </div>
                          <div>" . $clientrow['street'] . "</div>
                          <div>" . $clientrow['city'] . "</div>
                          <div>Email: " . $clientrow['email'] . "</div>
                          <div>Phone: " . $clientrow['phone'] . "</div>
                        </div>
      
      
      
                      </div>
      
                      <div class='table-responsive-sm'>
                        <table class='table table-striped'>
                          <thead>
                            <tr>
      
                              <th>name</th>
      
      
                              <th class='right'>Unit Cost</th>
                              <th class='center'>kw.h</th>
                              <th class='right'>Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
      
                              <td class='left strong'>Consumption</td>
      
      
                              <td class='right'>" . $get1kw . "</td>
                              <td class='right'>" . $row['consumption'] . "</td>
                              <td class='right'>" . $consm . "</td>
                            </tr>
      
                          </tbody>
                        </table>
                      </div>
                      <div class='row'>
                        <div class='col-lg-4 col-sm-5'>
      
                        </div>
      
                        <div class='col-lg-4 col-sm-5 ml-auto'>
                          <table class='table table-clear'>
                            <tbody>
                              <tr>
                                <td class='left'>
                                  <strong>Subtotal</strong>
                                </td>
                                <td class='right'>" . $consm . " lbp</td>
                              </tr>
                              <tr>
                                <td class='left'>
                                  <strong>VAT (11%)</strong>
                                </td>
                                <td class='right'>" . $vat . "  lbp</td>
                              </tr>
                            
                              <tr>
                                <td class='left'>
                                  <strong>Total</strong>
                                </td>
                                <td class='right'>
                                  <strong>" . $total . " lbp</strong>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        
                        </div>
      
                      </div>
      
                    </div>
                  </div>
                </div>
            
                </div>
                <div class='modal-footer'>
                <button class='btn btn-primary hidden-print' onclick'print(paymodal)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>
                  <button class='btn btn-secondary' type='button' data-dismiss='modal'>Cancel</button>
                 
                </div>
                </div>


          </div>
        </div>";
  }
} else {




  echo "there is problem";
}







?>








