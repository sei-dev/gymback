<h3 class="heading-style"><?=$this->translate("Measurements");?></h3>

<div class="box box-primary">
    <div class="box-body bgr-every-second">

    <div class="row" style="background-color: #d3d3d3; font-weight: bold;">
        <div class="col-md-2"><?=$this->translate("Trainer Name")?></div>
        <div class="col-md-2"><?=$this->translate("Client Name")?></div>
        <div class="col-md-2"><?=$this->translate("Height")?></div>
        <div class="col-md-2"><?=$this->translate("Weight")?></div>
        <div class="col-md-2"><?=$this->translate("Waist")?></div>
        <div class="col-md-2"><?=$this->translate("Biceps")?></div>
        <div class="col-md-2"><?=$this->translate("Neck")?></div>
        <div class="col-md-2"><?=$this->translate("Chest")?></div>
        <div class="col-md-2"><?=$this->translate("Gluteus")?></div>
        <div class="col-md-2"><?=$this->translate("Lower Leg")?></div>
        <div class="col-md-1"><?=$this->translate("Measured At")?></div>
        <div class="col-md-1"><?=$this->translate("")?></div>
    </div>


    <?php foreach ($this->items as $one): ?>
        <div class="row">
            <div class="col-md-2"><?=$one["trainer_name"]?></div>
            <div class="col-md-2"><?=$one["client_name"]?></div>
            <div class="col-md-2"><?=$one["height"] . " cm"?></div>
            <div class="col-md-2"><?=$one["weight"] . " cm"?></div>
            <div class="col-md-2"><?=$one["waist"] . " cm"?></div>
            <div class="col-md-2"><?=$one["biceps"] . " cm"?></div>
            <div class="col-md-2"><?=$one["neck"] . " cm"?></div>
            <div class="col-md-2"><?=$one["chest"] . " cm"?></div>
            <div class="col-md-2"><?=$one["gluteus"] . " cm"?></div>
            <div class="col-md-2"><?=$one["lower_leg"] . " cm"?></div>
            <div class="col-md-1 label label-danger">
                <i class="fa fa-clock-o"></i> <?=$this->humanReadable($one["measured_at"])?>
            </div>
            <div class="col-md-1 tools">
                <!-- <a href="/manager/editmeasurements?id=<?=$one["id"]?>"><i class="fa fa-edit"></i></a> -->
                <a href="/manager/removemeas?id=<?=$one["id"]?>"><i class="fa fa-trash-o"></i></a>
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