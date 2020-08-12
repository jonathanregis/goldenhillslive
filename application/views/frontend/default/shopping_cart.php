
<section class="page-header-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('home'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#"><?php echo site_phrase('shopping_cart'); ?></a></li>
                    </ol>
                </nav>
                <h1 class="page-title"><?php echo site_phrase('shopping_cart'); ?></h1>
            </div>
        </div>
    </div>
</section>

<section class="cart-list-area">
    <div class="container">
        <div class="row" id = "cart_items_details">
            <div class="col-lg-9">

                <div class="in-cart-box">
                    <div class="title"><?php echo sizeof($this->session->userdata('cart_items')).' '.site_phrase('courses_in_cart'); ?></div>
                    <div class="">
                        <ul class="cart-course-list">
                            <?php
                            $actual_price = 0;
                            $total_price  = 0;
                            foreach ($this->session->userdata('cart_items') as $cart_item):
                                $course_details = $this->crud_model->get_course_by_id($cart_item)->row_array();
                                $instructor_details = $this->user_model->get_all_user($course_details['user_id'])->row_array();
                                ?>
                                <li>
                                    <div class="cart-course-wrapper">
                                        <div class="image">
                                            <a href="<?php echo site_url('home/course/'.rawurlencode(slugify($course_details['title'])).'/'.$course_details['id']); ?>">
                                                <img src="<?php echo $this->crud_model->get_course_thumbnail_url($cart_item);?>" alt="" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="details">
                                            <a href="<?php echo site_url('home/course/'.rawurlencode(slugify($course_details['title'])).'/'.$course_details['id']); ?>">
                                                <div class="name"><?php echo $course_details['title']; ?></div>
                                            </a>
                                            <a href="<?php echo site_url('home/instructor_page/'.$instructor_details['id']); ?>">
                                                <div class="instructor">
                                                    <?php echo site_phrase('by'); ?>
                                                    <span class="instructor-name"><?php echo $instructor_details['first_name'].' '.$instructor_details['last_name']; ?></span>,
                                                </div>
                                            </a>
                                            <!-- package selection -->
                                            
                                            <form action="">
                                             I'm buying
                                              <div class="select-box">
                                                <select id="select-box<?php echo $course_details['id']; ?>" data-courseid="<?php echo $course_details['id']; ?>" class="select">
                                                    <?php $packages = $this->crud_model->get_packages(); ?>
                                                    <?php foreach($packages as $package) { ?>
                                                  <option value="<?php echo $package['id'];?>" <?php if($package['id'] == 1) echo "selected";?>><?php echo $package['name'] . " (".$package['duration'] ." ".$package['duration_unit'] . ")";?></option>
                                              <?php } ?>
                                                </select>
                                                <p><small>Time will only start when you access the course.</small></p>
                                                
                                              </div>
                                               
                                            </form>
                                            
                                            <!-- / package selection -->
                                        </div>
                                        <div class="move-remove">
                                            <div id = "<?php echo $course_details['id']; ?>" onclick="removeFromCartList(this)"><?php echo site_phrase('remove'); ?></div>
                                            <!-- <div>Move to Wishlist</div> -->
                                        </div>
                                        <div class="price" id="price-<?php echo $course_details['id']; ?>">
                                            <a href="">
                                                <?php if ($course_details['discount_flag'] == 1): ?>
                                                    <div class="current-price">
                                                        <?php
                                                        $total_price += $course_details['discounted_price'];
                                                        echo currency($course_details['discounted_price']);
                                                        ?>
                                                    </div>
                                                    <div class="original-price">
                                                        <?php
                                                        $actual_price += $course_details['price'];
                                                        echo currency($course_details['price']);
                                                        ?>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="current-price">
                                                        <?php
                                                        $actual_price += $course_details['price'];
                                                        $total_price  += $course_details['price'];
                                                        echo currency($course_details['price']);
                                                        ?>
                                                    </div>
                                                <?php endif; ?>
                                                <span class="coupon-tag">
                                                    <i class="fas fa-tag"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-lg-3">
                <div class="cart-sidebar">
                    <div class="total"><?php echo site_phrase('total'); ?>:</div>
                    <span id = "total_price_of_checking_out" hidden><?php echo $total_price; $this->session->set_userdata('total_price_of_checking_out', $total_price);
                    $meta = array();
                    foreach($this->session->userdata("cart_items") as $course){
                        $meta[$course] = "1";
                    }
                    $this->session->set_userdata('cart_meta', $meta);
                    ?>
                    </span>
                    <div class="total-price"><?php echo currency($total_price); ?></div>
                    <div class="total-original-price">
                        <?php if ($course_details['discount_flag'] == 1): ?>
                            <span class="original-price"><?php echo currency($actual_price); ?></span>
                        <?php endif; ?>
                        <!-- <span class="discount-rate">95% off</span> -->
                    </div>
                    <button type="button" class="btn btn-primary btn-block checkout-btn" onclick="handleCheckOut()"><?php echo site_phrase('checkout'); ?></button>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://www.paypalobjects.com/js/external/dg.js"></script>
<script>
    var dgFlow = new PAYPAL.apps.DGFlow({ trigger: 'submitBtn' });
    dgFlow = top.dgFlow || top.opener.top.dgFlow;
    dgFlow.closeFlow();
    // top.close();
</script>

<script type="text/javascript">
function removeFromCartList(elem) {
    url1 = '<?php echo site_url('home/handleCartItems');?>';
    url2 = '<?php echo site_url('home/refreshWishList');?>';
    url3 = '<?php echo site_url('home/refreshShoppingCart');?>';
    $.ajax({
        url: url1,
        type : 'POST',
        data : {course_id : elem.id},
        success: function(response)
        {

            $('#cart_items').html(response);
            if ($(elem).hasClass('addedToCart')) {
                $('.big-cart-button-'+elem.id).removeClass('addedToCart')
                $('.big-cart-button-'+elem.id).text("<?php echo site_phrase('add_to_cart'); ?>");
            }else {
                $('.big-cart-button-'+elem.id).addClass('addedToCart')
                $('.big-cart-button-'+elem.id).text("<?php echo site_phrase('added_to_cart'); ?>");
            }

            $.ajax({
                url: url2,
                type : 'POST',
                success: function(response)
                {
                    $('#wishlist_items').html(response);
                }
            });

            $.ajax({
                url: url3,
                type : 'POST',
                success: function(response)
                {
                    $('#cart_items_details').html(response);
                }
            });
        }
    });
}

function handleCheckOut() {
    $.ajax({
        url: '<?php echo site_url('home/isLoggedIn');?>',
        success: function(response)
        {
            if (!response) {
                window.location.replace("<?php echo site_url('login'); ?>");
            }else if("<?php echo $total_price; ?>" > 0){
                // $('#paymentModal').modal('show');
                //$('.total_price_of_checking_out').val($('#total_price_of_checking_out').text());
                window.location.replace("<?php echo site_url('home/payment'); ?>");
            }else{
                toastr.error('<?php echo site_phrase('there_are_no_courses_on_your_cart');?>');
            }
        }
    });
}

function handleCartItems(elem) {
    url1 = '<?php echo site_url('home/handleCartItems');?>';
    url2 = '<?php echo site_url('home/refreshWishList');?>';
    url3 = '<?php echo site_url('home/refreshShoppingCart');?>';
    $.ajax({
        url: url1,
        type : 'POST',
        data : {course_id : elem.id},
        success: function(response)
        {
            $('#cart_items').html(response);
            if ($(elem).hasClass('addedToCart')) {
                $('.big-cart-button-'+elem.id).removeClass('addedToCart')
                $('.big-cart-button-'+elem.id).text("<?php echo site_phrase('add_to_cart'); ?>");
            }else {
                $('.big-cart-button-'+elem.id).addClass('addedToCart')
                $('.big-cart-button-'+elem.id).text("<?php echo site_phrase('added_to_cart'); ?>");
            }
            $.ajax({
                url: url2,
                type : 'POST',
                success: function(response)
                {
                    $('#wishlist_items').html(response);
                }
            });

            $.ajax({
                url: url3,
                type : 'POST',
                success: function(response)
                {
                    $('#cart_items_details').html(response);
                }
            });
        }
    });
}
</script>

<script>


$("select").on("change" , function() {
  
  var value = $(this).val();
      courseid = $(this).data("courseid");
  fetch("<?php echo site_url('home/access_type_ajax'); ?>"+"/"+courseid+"/"+value)
  .then(res => res.json())
  .then(response => {
    console.log(response);
    $("#price-"+courseid+" .current-price").text(response.price);
    $(".total-price").text(response.total);
    });
    
});


</script>
