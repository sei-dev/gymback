<h3 class="heading-style"><?=$this->translate("Measurements");?></h3>

<div class="box box-primary">
    <div class="box-body bgr-every-second">
    <!-- Header Row -->
    <div class="row font-weight-bold">
        <div class="col-md-2"><?=$this->translate("Trainer Name")?></div>
        <div class="col-md-2"><?=$this->translate("Client Name")?></div>
        <div class="col-md-2"><?=$this->translate("Height (cm)")?></div>
        <div class="col-md-2"><?=$this->translate("Weight (cm)")?></div>
        <div class="col-md-2"><?=$this->translate("Waist (cm)")?></div>
        <div class="col-md-2"><?=$this->translate("Biceps (cm)")?></div>
        <div class="col-md-2"><?=$this->translate("Neck (cm)")?></div>
        <div class="col-md-2"><?=$this->translate("Chest (cm)")?></div>
        <div class="col-md-2"><?=$this->translate("Gluteus (cm)")?></div>
        <div class="col-md-2"><?=$this->translate("Lower Leg (cm)")?></div>
        <div class="col-md-1"><?=$this->translate("Measured At")?></div>
        <div class="col-md-1"><?=$this->translate("Actions")?></div>
    </div>

    <!-- Data Rows -->
    <?php foreach ($this->items as $one): ?>
        <div class="row">
            <div class="col-md-2"><?=$one["trainer_name"]?></div>
            <div class="col-md-2"><?=$one["client_name"]?></div>
            <div class="col-md-2"><?=$one["height"]?></div>
            <div class="col-md-2"><?=$one["weight"]?></div>
            <div class="col-md-2"><?=$one["waist"]?></div>
            <div class="col-md-2"><?=$one["biceps"]?></div>
            <div class="col-md-2"><?=$one["neck"]?></div>
            <div class="col-md-2"><?=$one["chest"]?></div>
            <div class="col-md-2"><?=$one["gluteus"]?></div>
            <div class="col-md-2"><?=$one["lower_leg"]?></div>
            <div class="col-md-1 label label-danger">
                <i class="fa fa-clock-o"></i> <?=$this->humanReadable($one["measured_at"])?>
            </div>
            <div class="col-md-1 tools">
                <!-- <a href="/manager/editmeasurements?id=<?=$one["id"]?>"><i class="fa fa-edit"></i></a> -->
                <i class="fa fa-trash-o"></i>
            </div>
        </div>
    <?php endforeach; ?>
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