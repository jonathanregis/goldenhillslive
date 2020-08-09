<style>
    @import url("https://fonts.googleapis.com/css?family=Playfair+Display&display=swap");
.typo, .list a {
  font-weight: 700;
  font-family: 'Playfair Display', serif;
  color: #585858;
  text-decoration: none;
}
.typo option, .list a option {
  font-size: 30px;
}

.transition {
  -webkit-transition: all .4s ease-in-out;
  transition: all .4s ease-in-out;
}

.wrapper {
  padding-top: 150px;
  height: 100vh;
  font-size: 60px;
}

.list {
  display: inline-block;
  position: relative;
  margin-left: 6px;
}
.list ul {
  text-align: left;
  position: absolute;
  padding: 0;
  top: 0;
  left: 0;
  display: none;
}
.list ul .active {
  display: block;
}
.list li {
  list-style: none;
}
.list li:first-child a {
  color: #7d40bf;
}
.list a {
  -webkit-transition: all .4s;
  transition: all .4s;
  color: #7b00ff;
  position: relative;
}
.list a:after {
  position: absolute;
  content: '';
  height: 5px;
  width: 0;
  left: 0;
  background: #b066ff;
  bottom: 0;
  -webkit-transition: all .4s ease-out;
  transition: all .4s ease-out;
}
.list a:hover {
  cursor: pointer;
  color: #b066ff;
}
.list a:hover:after {
  width: 100%;
}

select {
  display: inline;
  border: 0;
  width: auto;
  margin-left: 10px;
  outline: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  border-bottom: 2px solid #555;
  color: #7b00ff;
  -webkit-transition: all .4s ease-in-out;
  transition: all .4s ease-in-out;
}
select:hover {
  cursor: pointer;
}
select option {
  border: 0;
  border-bottom: 1px solid #555;
  padding: 10px;
  -webkit-appearance: none;
  -moz-appearance: none;
}

.placeholder {
  border-bottom: 4px solid;
  cursor: pointer;
}
.placeholder:hover {
  color: #888888;
}
</style>
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
                                <a href="<?php echo site_url('home/course/'.slugify($course_details['title']).'/'.$course_details['id']); ?>">
                                    <img src="<?php echo $this->crud_model->get_course_thumbnail_url($cart_item);?>" alt="" class="img-fluid">
                                </a>
                            </div>
                            <div class="details">
                                <a href="<?php echo site_url('home/course/'.slugify($course_details['title']).'/'.$course_details['id']); ?>">
                                    <div class="name"><?php echo $course_details['title']; ?></div>
                                </a>
                                <a href="<?php echo site_url('home/instructor_page/'.$instructor_details['id']); ?>">
                                    <div class="instructor">
                                        <?php echo site_phrase('by'); ?>
                                        <span class="instructor-name"><?php echo $instructor_details['first_name'].' '.$instructor_details['last_name']; ?></span>,
                                    </div>
                                </a>
                                <!-- package selection -->
                                
                                
                                <div class="wrapper typo">I'm buying
                                  <div class="list"><span class="placeholder">select package &#xfe40;</span>
                                    <ul class="list__ul">
                                      <li><a href="">One lesson only</a></li>
                                      <li><a href="">12 weeks of full access</a></li>
                                    </ul>
                                  </div>
                                  <!--
                                  .select
                                    select.typo
                                      - each item in ['lorem', 'ipsum', 'dolor', 'sit', 'amet']
                                        option.typo 
                                  -->
                                </div>
                                
                                <!-- / package selection -->
                            </div>
                            <div class="move-remove">
                                <div id = "<?php echo $course_details['id']; ?>" onclick="removeFromCartList(this)"><?php echo site_phrase('remove'); ?></div>
                                <!-- <div>Move to Wishlist</div> -->
                            </div>
                            <div class="price">
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
        <span id = "total_price_of_checking_out" hidden><?php echo $total_price; $this->session->set_userdata('total_price_of_checking_out', $total_price);?></span>
        <div class="total-price"><?php echo currency($total_price); ?></div>
        <div class="total-original-price">
            <span class="original-price">
                <?php if ($course_details['discount_flag'] == 1): ?>
                    <span class="original-price"><?php echo currency($actual_price); ?></span>
                <?php endif; ?>
            </span>
            <!-- <span class="discount-rate">95% off</span> -->
        </div>
        <button type="button" class="btn btn-primary btn-block checkout-btn" onclick="handleCheckOut()"><?php echo site_phrase('checkout'); ?></button>
    </div>
</div>
<script type="text/javascript">
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
                window.location.replace("<?php echo site_url('home/payment/'); ?>");
            }else{
                toastr.error('<?php echo site_phrase('there_are_no_courses_on_your_cart');?>');
            }
        }
    });
}
</script>
