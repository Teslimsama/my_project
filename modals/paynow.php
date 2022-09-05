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
      <div class="card-body">
             <h6>your donation will realy go long way in helping me pursue my carrer ,please any amount is a life changer</h6>
             <form id="paymentForm">
                <div class="form-group form-control">
                    <label for="email">Email Address</label>
                    <input type="email" id="email-address" required />
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="tel" id="amount" required />
                </div>
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" />
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" />
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

      <script>
        const paymentForm = document.getElementById('paymentForm');
    paymentForm.addEventListener("submit", payWithPaystack, false);
    function payWithPaystack(e) {
    e.preventDefault();

    let handler = PaystackPop.setup({
        key: 'pk_test_3d44964799de7e2a5abdbf2eef2fbe6852e60833', // Replace with your public key
        email: document.getElementById("email-address").value,
        amount: document.getElementById("amount").value * 100,
        ref: 'unibook'+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
        // label: "Optional string that replaces customer email"
        onClose: function(){
          // window.location
        alert('Window closed.');
        },
        callback: function(response){
        let message = 'Payment complete! Reference: ' + response.reference;
        alert(message);
        
        window.location = "http://localhost/my_project/pages/transact_verify?reference=" + response.reference;

        }
    });

    handler.openIframe();
    }
    </script>
            </div>
          </div>
        </div>
      </div>
     

   
        
       
      
    </div>
  </div>
</div>