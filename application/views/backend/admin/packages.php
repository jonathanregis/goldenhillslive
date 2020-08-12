<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> Packages
                    <a href="<?php echo site_url('admin/package_form/add_package'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-plus"></i>Add new package</a>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Package list</h4>

            <div class="table-responsive-sm mt-4">
                <?php if (count($packages) > 0): ?>
                    <table id="course-datatable" class="table table-striped dt-responsive nowrap" width="100%" data-page-length='25'>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('title'); ?></th>
                                <th><?php echo get_phrase('duration'); ?></th>
                                <th><?php echo get_phrase('price'); ?></th>
                                <th><?php echo get_phrase('actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($packages as $package):
                                
                            ?>
                                <tr>
                                    <td><?php echo $package['id']; ?></td>
                                    <td>
                                        <strong><a href="<?php echo site_url('admin/package_form/edit_package/'.$package['id']); ?>"><?php echo ellipsis($package['name']); ?></a></strong>
                                    </td>
                                    <td>
                                        <small class="text-muted"><?php echo $package['duration'] . " " .$package['duration_unit'];?></small>
                                    </td>
                                    <td>
                                        <span class="badge badge-dark-lighten"><?php echo currency($package['price']); ?></span>
                                    </td>
                                    <td>
                                        <div class="dropright dropright">
                                          <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <i class="mdi mdi-dots-vertical"></i>
                                          </button>
                                          <ul class="dropdown-menu">
                                              
                                              <li><a class="dropdown-item" href="<?php echo site_url('admin/package_form/edit_package/'.$package['id']); ?>">Edit package</a></li>
                                              <li><a class="dropdown-item" href="#" onclick="confirm_modal('<?php echo site_url('admin/packages/delete/'.$package['id']); ?>');"><?php echo get_phrase('delete'); ?></a></li>
                                          </ul>
                                      </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
                <?php if (count($packages) == 0): ?>
                    <div class="img-fluid w-100 text-center">
                      <img style="opacity: 1; width: 100px;" src="<?php echo base_url('assets/backend/images/file-search.svg'); ?>"><br>
                      <?php echo get_phrase('no_data_found'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</div>
