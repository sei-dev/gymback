<form class="req-forms" id="search_form" method="post" action="" enctype="multipart/form-data">
	<h3 class="heading-style">Edit Training</h3>
	<div class="box box-primary">
		<div class="box-body">
		
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
                		<label class="text-primary"><?=$this->translate("Trainer");?></label>
                		<input placeholder="<?=$this->translate("Trainer");?>" class="form-control" type="text" name="name" value="<?=$this->training["trainer_id"];?>"/>
                	</div>
                </div>
                
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
                		<label class="text-primary"><?=$this->translate("Gym");?></label>
                		<input placeholder="<?=$this->translate("Gym");?>" class="form-control" type="text" name="address" value="<?=$this->training["gym_id"];?>"/>
                	</div>
                </div>
            </div>
            
            <div class="row">
				<div class="col-md-12">
					<div class="form-group">
                		<label class="text-primary"><?=$this->translate("Is group");?></label>
                		<input placeholder="<?=$this->translate("Is group");?>" class="form-control" type="text" name="address" value="<?=$this->training["is_group"];?>"/>
                	</div>
                </div>
            </div>
            
            <div class="row">
				<div class="col-md-12">
					<div class="form-group">
                		<label class="text-primary"><?=$this->translate("Date");?></label>
                		<input placeholder="<?=$this->translate("Date");?>" class="form-control" type="text" name="address" value="<?=$this->training["date"];?>"/>
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