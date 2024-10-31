<form class="req-forms" id="search_form" method="post" action="insertgym" enctype="multipart/form-data">
	<h3 class="heading-style"><?=$this->translate("Add gym");?></h3>
	<div class="box box-primary">
		<div class="box-body">
		
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
                		<label class="text-primary"><?=$this->translate("Name");?></label>
                		<input placeholder="<?=$this->translate("Name");?>" class="form-control" type="text" name="name" value=""/>
                	</div>
                </div>
                
			</div>
            <div class="row">
				<div class="col-md-12">
					<div class="form-group">
                		<label class="text-primary"><?=$this->translate("Address");?></label>
                		<input placeholder="<?=$this->translate("Address");?>" class="form-control" type="text" name="address" value=""/>
                	</div>
                </div>
                
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
                		<label class="text-primary"><?=$this->translate("City");?></label>
                		<select placeholder="<?=$this->translate("City");?>" class="form-control" type="text" name="city">
                		<?php foreach ($this->cities as $one):?>
                			<option value="<?=$one["id"]?>"><?=$one["city"]?></option>
                		<?php endforeach;?>
                		</select>
                	</div>
                </div>
                
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
                		<label class="text-primary"><?=$this->translate("Phone");?></label>
                		<input placeholder="<?=$this->translate("Name");?>" class="form-control" type="text" name="phone" value=""/>
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