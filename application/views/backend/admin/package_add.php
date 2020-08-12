<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i>Add package</h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
              <div class="col-lg-12">
                <h4 class="mb-3 header-title">Add package form</h4>

                <form class="required-form" action="<?php echo site_url('admin/packages/add'); ?>" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="name">Package name<span class="required">*</span></label>
                        <input type="text" class="form-control" id="name" name = "name" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Package price<span class="required">*</span></label>
                        <input type="number" min="0" class="form-control" id="price" name = "price" required>
                    </div>
                    <div class="form-group half">
                        <label for="duration">Package duration<span class="required">*</span></label>
                        <input type="number" min="1" class="form-control" id="duration" required name="duration">
                    </div><!--
                    --><div class="form-group half">
                        <label for="duration_unit">Unit</label>
                        <select id="duration_unit" class="form-control" name="duration_unit">
                            <option value="minutes">Minute(s)</option>
                            <option value="hours" selected>Hour(s)</option>
                            <option value="months">Month(s)</option>
                            <option value="years">Year(s)</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-primary" onclick="checkRequiredFields()"><?php echo get_phrase("submit"); ?></button>
                </form>
              </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
