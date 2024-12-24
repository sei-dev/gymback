<h3 class="heading-style"><?=$this->translate("Clients");?></h3>

<div class="box" style="padding: 10px; border-radius: 5px;">
<form class="req-forms" id="search_form" method="post" action="searchclient" enctype="multipart/form-data">
				<div class="row">
				<div class="col-md-10">
					<div>
                		<input placeholder="<?=$this->translate("Search");?>" class="form-control" type="text" name="param" value=""/>
                	</div>
                	</div>
                	<div class="col-md-2">
                		<button name="submit" type="submit" class="btn btn-primary btn-block btn-flat" style="border-radius: 5px;"><i class="fa fa-search"></i></button>
                	</div>
                </div>
</form>
</div>

<div class="box box-primary">
    <div class="box-body bgr-every-second">
    
    <div class="row" style="background-color: #d3d3d3; font-weight: bold;">
        <div class="col-md-1"><?=$this->translate("Profile Image")?></div>
        <div class="col-md-2"><?=$this->translate("Name")?></div>
        <div class="col-md-2"><?=$this->translate("Email")?></div>
        <div class="col-md-2"><?=$this->translate("Phone")?></div>
        <div class="col-md-1"><?=$this->translate("Location")?></div>
        <div class="col-md-1"><?=$this->translate("Role")?></div>
        <div class="col-md-2"><?=$this->translate("Created At")?></div>
        <div class="col-md-1"><?=$this->translate("Actions")?></div>
    </div>
        
        <?php foreach ($this->users as $one):?>
        <div class="row">
            <div class="col-md-1"><span class="circular--portrait"> <img src="<?= !empty($one["image"]) ? $one["image"] : '/images/ikonica.ico'; ?>" class="img-fluid" alt="User Image" /></span></div>
            <div class="col-md-2"><?=$one["first_name"]?> <?=$one["last_name"]?></div>
            <div class="col-md-2"><?=$one["email"]?></div>
            <div class="col-md-2 text "><?=$one["phone"]?></div>
            <div class="col-md-1 text "><?=$one["location"]?></div>
            <div class="col-md-1 label label-success"><?php if($one["is_trainer"]=="0") echo $this->translate("Client"); else echo $this->translate("Trainer");?></div>
            <div class="col-md-2 label label-danger"><i class="fa fa-clock-o"></i> <?=$this->humanReadable($one["created_on"])?></div>
            <div class="col-md-1 tools">
                <a href="/manager/edituser?id=<?=$one["id"]?>"><i class="fa fa-edit" title="Edit"></i></a>
               	<a href="/manager/usermeasurements?id=<?=$one["id"]?>"><i class="fa fa-file-archive-o" title="Measurements"></i></a>
                <i class="fa fa-ban"></i>
            </div>
        </div>
        <?php endforeach;?>
        
        
    </div>
    
    <div class="box-footer" style="">
        <i class="ion ion-clipboard">Total: <?=$this->count?></i>
        <div class="box-tools pull-right">
            <?php echo $this->pagination?>
        </div>
    </div>
    
    <!-- <div class="box-footer clearfix no-border">
    <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
    </div> -->
    
    
    
</div>




<script>

</script>