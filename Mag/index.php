<?php
require_once 'authenticate.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <form action="saveVictimForm.php" method="POST">
           <div class="tableContainer">
              <table class="table table-hover" width="70%">
                  <tr>
                      <td>Agency</td>
                      <td><input type="text" name="agency"></td>
                  </tr>
                  <tr>
                      <td>Address</td>
                      <td><input type="text" name="address"></td>
                  </tr>
                  <tr>
                      <td>City</td>
                      <td><input type="text" name="city"></td>
                  </tr>
                  <tr>
                      <td>Zip</td>
                      <td><input type="text" name="zip"></td>
                  </tr>
                  <tr>
                      <td>Phone</td>
                      <td><input type="text" name="phone"></td>
                  </tr>
                  <tr>
                      <td>Web</td>
                      <td><input type="text" name="web"></td>
                  </tr><tr>
                      <td>Email</td>
                      <td><input type="text" name="email"></td>
                  </tr>
                  <tr>
                      <td>Hours</td>
                      <td><input type="text" name="hours"></td>
                  </tr>
                  <tr>
                      <td><label class="checkbox">
                         <input type="checkbox" name="crisisResponse"> Crisis Response
                     </label></td>
                  </tr>
                  <tr>
                      <td><label class="checkbox">
                         <input type="checkbox" name="legal"> Legal
                     </label></td>
                  </tr>
               <tr>
                      <td><label class="checkbox">
                         <input type="checkbox" name="crisisResponse"> Civil Legal Advocacy
                     </label></td>
                  </tr>
                  <tr>
                      <td><label class="checkbox">
                         <input type="checkbox" name="crisisResponse"> Safety Planning
                     </label></td>
                  </tr>
                  <tr>
                      <td><label class="checkbox">
                         <input type="checkbox" name="crisisResponse"> Social Services Referral
                     </label></td>
                  </tr>
                  <tr>
                      <td><label class="checkbox">
                         <input type="checkbox" name="crisisResponse"> Medical Referral
                     </label></td>
                  </tr>
                  <tr>
                      <td><label class="checkbox">
                         <input type="checkbox" name="crisisResponse"> Shelter Referral
                     </label></td>
                  </tr>
                  <tr>
                      <td><label class="checkbox">
                         <input type="checkbox" name="crisisResponse"> Protection Orders
                     </label></td>
                  </tr>
                  <tr>
                      <td><label class="checkbox">
                         <input type="checkbox" name="crisisResponse"> Referrals for Counciling
                     </label></td>
                  </tr>
                   <tr>
                      <td><label class="checkbox">
                         <input type="checkbox" name="crisisResponse">On Location Financial Assistance
                     </label></td>
                  </tr>
                   <tr>
                      <td><label class="checkbox">
                         <input type="checkbox" name="crisisResponse">Referrals for Financial Assistance
                     </label></td>
                  </tr>   
              </table>
           </div>
           <input type="submit" name="submit">
       </form>
    </body>
       <script src="includes/js/jquery.js"></script>
    <script src="includes/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="includes/css/bootstrap.min.css">
    <script src="includes/js/bootstrap.file-input.js"></script>
</html>
