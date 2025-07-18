<?php
?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form action="" id="manage_student">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="row">
					<div class="col-md-6 border-right">
						<div class="form-group">
							<label for="" class="control-label">College</label>

							<select name="college_id" id="college-select" class="form-control form-control-sm select2">
								<option value=""></option>
								<?php
								$qry = $conn->query("SELECT * FROM college");
								while ($row = $qry->fetch_assoc()):
									?>
									<option value="<?php echo $row['college_id'] ?>" <?php echo (isset($college_id) && $college_id == $row['college_id']) ? 'selected' : '' ?>>
										<?php echo $row['collegeName'] ?>
									</option>

								<?php endwhile; ?>
							</select>
						</div>
						<div class="form-group">
							<label for="" class="control-label">Program</label>

							<select name="program_id" id="program-select" class="form-control form-control-sm select2">

							</select>
						</div>
						<div class="form-group">
							<label for="" class="control-label">School ID</label>
							<input type="text" name="school_id" class="form-control form-control-sm" required value="<?php echo isset($school_id) ? $school_id : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">First Name</label>
							<input type="text" name="firstname" class="form-control form-control-sm" required value="<?php echo isset($firstname) ? $firstname : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Last Name</label>
							<input type="text" name="lastname" class="form-control form-control-sm" required value="<?php echo isset($lastname) ? $lastname : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Class</label>
							<select name="class_id" id="class_id" class="form-control form-control-sm select2">
								<option value=""></option>
								<?php 
								$classes = $conn->query("SELECT *,sl.sec_id,concat(pl.programs,' - ',sl.sectionName) as class FROM section_list sl
								left join program pl on pl.dep_id = sl.program_id
								");
								while($row=$classes->fetch_assoc()):
								?>
								<option value="<?php echo $row['sec_id'] ?>" <?php echo isset($class_id) && $class_id == $row['sec_id'] ? "selected" : "" ?>><?php echo $row['class'] ?></option>
								<?php endwhile; ?>
							</select>
						</div>
					
					</div>
					<div class="col-md-6">
					<div class="form-group">
							<label for="" class="control-label">Profile</label>
							<div class="custom-file">
		                      <input type="file" class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
		                      <label class="custom-file-label" for="customFile">Choose file</label>
		                    </div>
						</div>
						<div class="form-group d-flex justify-content-center align-items-center">
							<img src="<?php echo isset($avatar) ? 'assets/uploads/'.$avatar :'' ?>" alt="Avatar" id="cimg" class="img-fluid img-thumbnail ">
						</div>
						<div class="form-group">
							<label class="control-label">Email</label>
							<input type="email" class="form-control form-control-sm" name="email" required value="<?php echo isset($email) ? $email : '' ?>">
							<small id="#msg"></small>
						</div>
						<div class="form-group">
							<label class="control-label">Password</label>
							<input type="password" class="form-control form-control-sm" name="password" <?php echo !isset($id) ? "required":'' ?>>
							<small><i><?php echo isset($id) ? "Leave this blank if you dont want to change you password":'' ?></i></small>
						</div>
						<div class="form-group">
							<label class="label control-label">Confirm Password</label>
							<input type="password" class="form-control form-control-sm" name="cpass" <?php echo !isset($id) ? 'required' : '' ?>>
							<small id="pass_match" data-status=''></small>
						</div>
					</div>
				</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button class="btn btn-primary mr-2">Save</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = 'index.php?page=student_list'">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
<script>
	$('[name="password"],[name="cpass"]').keyup(function(){
		var pass = $('[name="password"]').val()
		var cpass = $('[name="cpass"]').val()
		if(cpass == '' ||pass == ''){
			$('#pass_match').attr('data-status','')
		}else{
			if(cpass == pass){
				$('#pass_match').attr('data-status','1').html('<i class="text-success">Password Matched.</i>')
			}else{
				$('#pass_match').attr('data-status','2').html('<i class="text-danger">Password does not match.</i>')
			}
		}
	})
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$('#manage_student').submit(function(e){
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		$('#msg').html('')
		if($('[name="password"]').val() != '' && $('[name="cpass"]').val() != ''){
			if($('#pass_match').attr('data-status') != 1){
				if($("[name='password']").val() !=''){
					$('[name="password"],[name="cpass"]').addClass("border-danger")
					end_load()
					return false;
				}
			}
		}
		$.ajax({
			url:'ajax.php?action=save_student',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved.',"success");
					setTimeout(function(){
						location.replace('index.php?page=student_list')
					},750)
				}else if(resp == 2){
					$('#msg').html("<div class='alert alert-danger'>Email already exist.</div>");
					$('[name="email"]').addClass("border-danger")
					end_load()
				}
			}
		})
	})
</script>
<script>
	$(document).ready(function () {
		function populatePrograms(collegeId, selectedProgramId = null) {
			$.ajax({
				url: 'ajax.php?action=fetch_programs',
				type: 'POST',
				data: { college_id: collegeId },
				success: function (data) {
					$('#program-select').html(data);
					if (selectedProgramId) {
						$('#program-select').val(selectedProgramId).trigger('change');
					}
				}
			});
		}

		// On college select change
		$('#college-select').change(function () {
			var collegeId = $(this).val();
			populatePrograms(collegeId);
		});

		// Initial population based on pre-selected college_id and program_id
		var initialCollegeId = '<?php echo isset($college_id) ? $college_id : ''; ?>';
		var initialProgramId = '<?php echo isset($program_id) ? $program_id : ''; ?>';


		if (initialCollegeId) {
			populatePrograms(initialCollegeId, initialProgramId);
		}
	});

</script>