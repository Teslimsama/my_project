<?php

function component($productname, $productlink, $productimg, $productid)
{
  $element = "
    
    <div class='pic card bg-gradient-light mt-3'>
          <img class='' src='$productimg' height='' alt='book_pics' style='width: 100%;'>
          <div class='over'>
            <a id='download' class='alert ' href='$productlink'><i class='fa-solid fa-download'></i></a>
          </div>
          <input type='hidden' name= '$productid'>
          <a href='description_page?id=$productid'>
            <div class='container name '>
              <h6>$productname</h6>
          </a>
        </div>
      </div>
    ";
  echo $element;
}

function procomponent($productname,$productimg, $productid)
{
  $element = "
    
    <div class='pic card bg-gradient-light mt-3'>
          <img class='' src='$productimg' height='' alt='book_pics' style='width: 100%;'>
          <div class='over'>
            <a id='download' class='alert ' href='#'><i class='fa-solid fa-download'></i></a>
          </div>
          <input type='hidden' name= '$productid'>
          <a href='description_page?id=$productid'>
            <div class='container name '>
              <h6>$productname</h6>
          </a>
        </div>
      </div>
    ";
  echo $element;
}

// function cartElement($productimg, $productname, $productlink, $productid){
//     $element = '
    
//     <form action=\'cart.php?action=remove&id=$productid\' method=\'post\' class=\'cart-items\'>
//                     <div class=\'border rounded\'>
//                         <div class=\'row bg-white\'>
//                             <div class=\'col-md-3 pl-0\'>
//                                 <img src=$productimg alt=\'Image1\' class=\'img-fluid\'>
//                             </div>
//                             <div class=\'col-md-6\'>
//                                 <h5 class=\'pt-2\'>$productname</h5>
//                                 <small class=\'text-secondary\'>Seller: dailytuition</small>
//                                 <h5 class=\'pt-2\'>$$productlink</h5>
//                                 <button type=\'submit\' class=\'btn btn-warning\'>Save for Later</button>
//                                 <button type=\'submit\' class=\'btn btn-danger mx-2\' name=\'remove\'>Remove</button>
//                             </div>
//                             <div class=\'col-md-3 py-5\'>
//                                 <div>
//                                     <button type=\'button\' class=\'btn bg-light border rounded-circle\'><i class=\'fas fa-minus\'></i></button>
//                                     <input type=\'text\' value=\'1\' class=\'form-control w-25 d-inline\'>
//                                     <button type=\'button\' class=\'btn bg-light border rounded-circle\'><i class=\'fas fa-plus\'></i></button>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                 </form>
    
//     ';
//     echo  $element;
// }
