<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('manage_level'); ?></h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<ul class="nav nav-tabs nav-bordered mb-3">
					<?php if(isset($edit_profile)):?>
						<li class="nav-item">
							<a href="#edit" data-toggle="tab" aria-expanded="true" class="nav-link active">
								<?php echo get_phrase('edit_phrase');?>
							</a>
						</li>
					<?php endif;?>
					<li class="nav-item">
						<a href="#list" data-toggle="tab" aria-expanded="false" class="nav-link <?php if(!isset($edit_profile))echo 'active';?>">
							<i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
							<span class="d-none d-lg-block"><?php echo get_phrase('level_list');?></span>
						</a>
					</li>
					<li class="nav-item">
						<a href="#add_levl" data-toggle="tab" aria-expanded="false" class="nav-link">
							<i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
							<span class="d-none d-lg-block"><?php echo get_phrase('add_level');?></span>
						</a>
					</li>
				</ul>

				<div class="tab-content">
					<!----PHRASE EDITING TAB STARTS-->
					<?php if (isset($edit_profile)):
						$current_editing_level	=	$edit_profile;
					?>
						<div class="tab-pane show active" id="edit" style="padding: 30px">
							<div class="row">
								<?php foreach (openJSONFile($edit_profile) as $key => $value): ?>
								<div class="col-xl-3 col-lg-6">
									<div class="card">
										<div class="card-header">
											<?php echo $key; ?>
										</div>
										<div class="card-body">
											<p>
												<input type="text" class="form-control" name="updated_phrase" value="<?php echo $value; ?>" id = "phrase-<?php echo $key; ?>">
											</p>
											<button type="button" class="btn btn-icon btn-primary" style="float: right;" id = "btn-<?php echo $key; ?>" onclick="updatePhrase('<?php echo $key; ?>')"> <i class = "mdi mdi-check-circle"></i> </button>
										</div>
									</div>
								</div>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif;?>
					<!----PHRASE EDITING TAB ENDS-->

					<!----TABLE LISTING STARTS-->
					<div class="tab-pane <?php if(!isset($edit_profile))echo 'show active';?>" id="list">

						<div class="table-responsive-sm">
							<table class="table table-bordered table-centered mb-0">
								<thead>
									<tr>
										<th><?php echo get_phrase('level');?></th>
										<th><?php echo get_phrase('option');?></th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach($levels as $level):?>
									<tr>
										<td><?php echo ucwords($level);?></td>
										<td>
											<!--<a href="<?php echo site_url('admin/manage_level/edit_phrase/'.$level);?>"
												class="btn btn-info">
												<?php echo get_phrase('edit_phrase');?>
											</a>-->
											<a href="javascript::" onclick="confirm_modal('<?php echo site_url('admin/manage_level/delete_level/'.$level);?>')" class="btn btn-danger">
												<?php echo get_phrase('delete_level');?>
											</a>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>

						</div>
					</div>
					<!----TABLE LISTING ENDS--->

					<!----PHRASE CREATION FORM STARTS---->
					<div class="tab-pane" id="add" style="padding: 30px">
						<div class="row">
							<div class="col-xl-6">
                <form class="" action="<?php echo site_url('admin/manage_level/add_phrase') ?>" method="post">
                  <div class="form-group mb-3">
                      <label for="simpleinput"><?php echo get_phrase('add_new_phrase'); ?></label>
                      <input type="text" id="phrase" name="phrase" class="form-control" placeholder="Eg. Contamination">
                  </div>
                  <button type="submit" class="btn btn-primary" name="button"><?php echo get_phrase('save'); ?></button>
                </form>
							</div>
						</div>
					</div>
					<!----PHRASE CREATION FORM ENDS--->

					<!----ADD NEW level---->
					<div class="tab-pane" id="add_levl" style="padding: 30px">
						<div class="row">
							<div class="col-xl-6">
								<form class="" action="<?php echo site_url('admin/manage_level/add_level'); ?>" method="post">
									<div class="form-group mb-3">
											<label for="level"><?php echo get_phrase('add_new_level'); ?></label>
											<input type="text" id="level" name="level" class="form-control" placeholder="<?php echo get_phrase('no_special_character_or_space_is_allowed').'. '.get_phrase('valid_examples').' : Basic, Itermidiate, Advance etc'; ?>">
									</div>
									<button type="submit" class="btn btn-primary" name="button"><?php echo get_phrase('save'); ?></button>
								</form>
							</div>
						</div>
					</div>
					<!----level ADDING FORM ENDS-->
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

function updatePhrase(key) {
	$('#btn-'+key).text('...');
	var updatedValue = $('#phrase-'+key).val();
	var currentEditingLevel = '<?php echo $current_editing_level; ?>';
	$.ajax({
		type : "POST",
		url  : "<?php echo site_url('admin/update_phrase_with_ajax'); ?>",
		data : {updatedValue : updatedValue, currentEditingLevel : currentEditingLevel, key : key},
		success : function(response) {
			$('#btn-'+key).html('<i class = "mdi mdi-check-circle"></i>');
			success_notify('<?php echo get_phrase('phrase_updated');?>');
		}
	});
}
</script>
