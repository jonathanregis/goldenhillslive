<section class="home-banner-area">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                <div class="home-banner-wrap">
                    <h2><?php echo get_frontend_settings('banner_title'); ?></h2>
                    <p><?php echo html_entity_decode(get_frontend_settings('banner_sub_title')); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="home-fact-area">
    <div class="container-lg">
        <div class="row">
            <?php $courses = $this->crud_model->get_courses(); ?>
            <div class="col-md-4 d-flex">
                <div class="home-fact-box mr-md-auto ml-auto mr-auto">
                    <i class="fas fa-bullseye float-left"></i>
                    <div class="text-box">
                        <h4>For parents</h4>
                        <p><a href="/home/courses" style="color: #ccc">Register your children for online and academy fun</a></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-flex">
                <div class="home-fact-box mr-md-auto ml-auto mr-auto">
                    <i class="fa fa-check float-left"></i>
                    <div class="text-box">
                        <h4>For school admins</h4>
                        <p><a href="/home/partner" style="color: #ccc">Request more information for your school</a></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-flex">
                <div class="home-fact-box mr-md-auto ml-auto mr-auto">
                    <i class="fa fa-clock float-left"></i>
                    <div class="text-box">
                        <h4>Become an instructor</h4>
                        <p><a href="/user/become_an_instructor" style="color: #ccc">Sell your course on our platform</a></p>
                        <p> &nbsp;</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="course-carousel-area">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                <h2 class="course-carousel-title">Categories<?php //echo site_phrase('top_courses'); ?></h2>
                <div class="row">
                    <?php $categories = $this->crud_model->get_categories(); ?>
    <?php foreach ($categories->result_array() as $category):
        if($category['parent'] > 0)
         continue;
         $sub_categories = $this->crud_model->get_sub_categories($category['id']); ?>
         <div class="col-md-6 col-lg-6 col-xl-4 on-hover-action" id = "<?php echo $category['id']; ?>">
             <div class="card d-block">
                 <img class="card-img-top" src="<?php echo base_url('uploads/thumbnails/category_thumbnails/'.$category['thumbnail']); ?>" alt="Card image cap">
                 <div class="card-body">
                     <h4 class="card-title mb-0"><i class="<?php echo $category['font_awesome_class']; ?>"></i> <?php echo $category['name']; ?></h4>
                     <small style="font-style: italic;"><p class="card-text"><?php echo count($sub_categories).' '.get_phrase('sub_categories'); ?></p></small>
                 </div>
                 <div class="card-body">
                     <a href="/home/courses?category=<?php echo $category['slug'];?>">View courses</a>
                 </div> <!-- end card-body-->
             </div> <!-- end card-->
         </div>
    <?php endforeach; ?>
</div>
</div>
</div>
</div>
</section>

<section class="course-carousel-area">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                <h2 class="course-carousel-title"><?php echo site_phrase('latest_courses'); ?></h2>
                <div class="course-carousel">
                    <?php
                    $latest_courses = $this->crud_model->get_latest_10_course();
                    foreach ($latest_courses as $latest_course):?>
                    <div class="course-box-wrap">
                        <a href="<?php echo site_url('home/course/'.rawurlencode(slugify($latest_course['title'])).'/'.$latest_course['id']); ?>">
                            <div class="course-box">
                                <div class="course-image">
                                    <img src="<?php echo $this->crud_model->get_course_thumbnail_url($latest_course['id']); ?>" alt="" class="img-fluid">
                                </div>
                                <div class="course-details">
                                    <h5 class="title"><?php echo $latest_course['title']; ?></h5>
                                    <p class="instructors">
                                        <?php
                                        $instructor_details = $this->user_model->get_all_user($latest_course['user_id'])->row_array();
                                        echo $instructor_details['first_name'].' '.$instructor_details['last_name']; ?>
                                    </p>
                                    <div class="rating">
                                        <?php
                                        $total_rating =  $this->crud_model->get_ratings('course', $latest_course['id'], true)->row()->rating;
                                        $number_of_ratings = $this->crud_model->get_ratings('course', $latest_course['id'])->num_rows();
                                        if ($number_of_ratings > 0) {
                                            $average_ceil_rating = ceil($total_rating / $number_of_ratings);
                                        }else {
                                            $average_ceil_rating = 0;
                                        }

                                        for($i = 1; $i < 6; $i++):?>
                                        <?php if ($i <= $average_ceil_rating): ?>
                                            <i class="fas fa-star filled"></i>
                                        <?php else: ?>
                                            <i class="fas fa-star"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                    <span class="d-inline-block average-rating"><?php echo $average_ceil_rating; ?></span>
                                </div>
                                <?php if ($latest_course['is_free_course'] == 1): ?>
                                    <p class="price text-right"><?php echo site_phrase('free'); ?></p>
                                <?php else: ?>
                                    <?php if ($latest_course['discount_flag'] == 1): ?>
                                        <p class="price text-right"><small><?php echo currency($latest_course['price']); ?></small><?php echo currency($latest_course['discounted_price']); ?></p>
                                    <?php else: ?>
                                        <p class="price text-right"><?php echo currency($latest_course['price']); ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div>
</section>

<script type="text/javascript">
function handleWishList(elem) {

    $.ajax({
        url: '<?php echo site_url('home/handleWishList');?>',
        type : 'POST',
        data : {course_id : elem.id},
        success: function(response)
        {
            if (!response) {
                window.location.replace("<?php echo site_url('login'); ?>");
            }else {
                if ($(elem).hasClass('active')) {
                    $(elem).removeClass('active')
                }else {
                    $(elem).addClass('active')
                }
                $('#wishlist_items').html(response);
            }
        }
    });
}

function handleCartItems(elem) {
    url1 = '<?php echo site_url('home/handleCartItems');?>';
    url2 = '<?php echo site_url('home/refreshWishList');?>';
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
        }
    });
}

function handleEnrolledButton() {
    $.ajax({
        url: '<?php echo site_url('home/isLoggedIn');?>',
        success: function(response)
        {
            if (!response) {
                window.location.replace("<?php echo site_url('login'); ?>");
            }
        }
    });
}
</script>
