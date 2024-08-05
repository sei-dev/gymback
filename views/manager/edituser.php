<form class="req-forms" id="user_form" method="post" action="updateuser" enctype="multipart/form-data">
	<h3 class="heading-style">Edit user</h3>
	<div class="box box-primary">
		<div class="box-body">
		
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
                		<label class="text-primary"><?=$this->translate("First Name");?></label>
                		<input placeholder="<?=$this->translate("First Name");?>" class="form-control" type="text" id="first_name" name="first_name" value="<?=$this->user["first_name"];?>"/>
                	</div>
                </div>
                
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
                		<label class="text-primary"><?=$this->translate("Last Name");?></label>
                		<input placeholder="<?=$this->translate("Last Name");?>" class="form-control" type="text" id="last_name" name="last_name" value="<?=$this->user["last_name"];?>"/>
                	</div>
                </div>
            </div>
            
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
                		<label class="text-primary"><?=$this->translate("Email");?></label>
                		<input placeholder="<?=$this->translate("Email");?>" class="form-control" type="text" id="email" name="email" value="<?=$this->user["email"];?>"/>
                	</div>
                </div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
                		<label class="text-primary"><?=$this->translate("Phone");?></label>
                		<input placeholder="<?=$this->translate("Phone");?>" class="form-control" type="text" id="phone" name="phone" value="<?=$this->user["phone"];?>"/>
                	</div>
                </div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
                		<label class="text-primary"><?=$this->translate("Location");?></label>
                		<input placeholder="<?=$this->translate("Location");?>" class="form-control" type="text" id="location" name="location" value="<?=$this->user["location"];?>"/>
                	</div>
                </div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
                		<label class="text-primary"><?=$this->translate("Deadline");?></label>
                		<input placeholder="<?=$this->translate("Deadline");?>" class="form-control" type="text" id="deadline" name="deadline" value="<?=$this->user["deadline"];?>"/>
                	</div>
                </div>
			</div>
			
			<div style="display: none" class="row">
				<div class="col-md-12">
					<div class="form-group">
                		<label class="text-primary"></label>
                		<input placeholder="" class="form-control" type="text" id="id" name="id" value="<?=$this->user["id"];?>"/>
                	</div>
                </div>
			</div>
			
			
        <div class="row">
            <div class="col-md-12">
            	<button name="submit" type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
            </div>
        </div>
        
        
		</div>
	</div>
</form>			

<script>




</script>
