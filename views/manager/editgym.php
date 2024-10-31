<form class="req-forms" id="search_form" method="post" action="updategym" enctype="multipart/form-data">
	<h3 class="heading-style">Edit user</h3>
	<div class="box box-primary">
		<div class="box-body">
		
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
                		<label class="text-primary"><?=$this->translate("Gym name");?></label>
                		<input placeholder="<?=$this->translate("Gym name");?>" class="form-control" type="text" name="name" value="<?=$this->gym["name"];?>"/>
                	</div>
                </div>
                
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
                		<label class="text-primary"><?=$this->translate("Address");?></label>
                		<input placeholder="<?=$this->translate("Address");?>" class="form-control" type="text" name="address" value="<?=$this->gym["address"];?>"/>
                	</div>
                </div>
            </div>
            
            <div class="row">
				<div class="col-md-12">
					<div class="form-group">
                		<label class="text-primary"><?=$this->translate("City");?></label>
                		<select placeholder="<?=$this->translate("City");?>" class="form-control" type="text" name="city">
                		<?php foreach ($this->cities as $one):?>
                			<?php if($one['id']==$gym['city_id']){ ?>
								<option value="<?=$one["id"]?>" selected><?=$one["city"]?></option>
							<?php }else{ ?>
                				<option value="<?=$one["id"]?>"><?=$one["city"]?></option>
                			<?php } ?>
                		<?php endforeach;?>
                		</select>
                	</div>
                </div>
                
			</div>
            
            <div class="row">
				<div class="col-md-12">
					<div class="form-group">
                		<label class="text-primary"><?=$this->translate("Phone");?></label>
                		<input placeholder="<?=$this->translate("Phone");?>" class="form-control" type="text" name="phone" value="<?=$this->gym["phone"];?>"/>
                	</div>
                </div>
            </div>
            
            <div style="display: none" class="row">
				<div class="col-md-12">
					<div class="form-group">
                		<label class="text-primary"></label>
                		<input placeholder="" class="form-control" type="text" id="id" name="id" value="<?=$this->gym["id"];?>"/>
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