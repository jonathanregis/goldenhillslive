<?php
$package_details = $this->crud_model->get_packages($package_id);
?>

<!-- start page title -->
<div class="row">
  <div class="col-12">
    <div class="page-title-box ">
      <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> Update package</h4>
    </div>
  </div>
</div>

<div class="row justify-content-md-center">
  <div class="col-xl-6">
    <div class="card">
      <div class="card-body">
        <div class="col-lg-12">
          <h4 class="mb-3 header-title">Update package form</h4>

          <form class="required-form" action="<?php echo site_url('admin/packages/edit/'.$package_id); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
              <label for="name">Package name<span class="required">*</span></label>
              <input type="text" class="form-control" id="name" name = "name" value="<?php echo $package_details['name']; ?>" required>
            </div>
            <div class="form-group">
              <label for="price">Package price<span class="required">*</span></label>
              <input type="number" class="form-control" id="price" name = "price" value="<?php echo $package_details['price']; ?>" required>
            </div>
            <div class="form-group half">
              <label for="duration">Package duration<span class="required">*</span></label>
              <input type="number" class="form-control" id="duration" name = "duration" value="<?php echo $package_details['duration']; ?>" required>
            </div><!--
            --><div class="form-group half">
                <label for="duration_unit">Unit</label>
                <select id="duration_unit" class="form-control" name="duration_unit">
                    <option value="minutes" <?php echo $package_details['duration_unit'] == 'minutes' ? 'selected' : ''; ?>>Minute(s)</option>
                    <option value="hours" <?php echo $package_details['duration_unit'] == 'hours' ? 'selected' : ''; ?>>Hour(s)</option>
                    <option value="months" <?php echo $package_details['duration_unit'] == 'months' ? 'selected' : ''; ?>>Month(s)</option>
                    <option value="years" <?php echo $package_details['duration_unit'] == 'years' ? 'selected' : ''; ?>>Year(s)</option>
                </select>
            </div>

            <button type="button" class="btn btn-primary" onclick="checkRequiredFields()"><?php echo get_phrase("submit"); ?></button>
          </form>
        </div>
      </div> <!-- end card body-->
    </div> <!-- end card -->
  </div><!-- end col-->
</div>
