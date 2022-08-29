<?php 
//  $download = $_POST['title'];
 $student_id = $_SESSION['id'];
 ?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4>click the button down below </h4>
        <form id="paymentForm">
                <div class="form-group form-control">
                    <label for="email">Email Address</label>
                    <input value="<?php echo $rows['email'] ;?>" type="email" id="email-address"  required /> 
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input value="<?php echo $download;?>" type="tel" id="amount" required />
                </div>
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    <input value="<?php echo $rows['firstname'] ;?>" type="text" id="first-name" />
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input value="<?php echo $rows['lastname'] ;?>" type="text" id="last-name" />
                </div>
                <div class="form-submit">
                    <button type="submit" onclick="payWithPaystack()"> Pay </button>
                </div>
            </form>

            <script src="https://js.paystack.co/v1/inline.js"></script> 
            </div>
            </div>
          </div>
        </div>
      </div>
     

   
        
       
      
    </div>
  </div>
</div>