<h3 class="heading-style"><?=$this->translate("Measurements");?></h3>

<div class="box box-primary">
    <div class="box-body bgr-every-second">
        <?php foreach ($this->items as $one):?>

			<div class="row">
            <div class="col-md-2"><?=$one["trainer_name"]?></div>
            <div class="col-md-2 label label-success"><?=$this->translate("Client") . ": " . $one["client_name"]?></div>
            <div class="col-md-2"><?=$this->translate("Height") . ": " . $one["height"]." cm"?></div>
            <div class="col-md-2"><?=$this->translate("Weight") . ": " . $one["weight"]." cm"?></div>
            <div class="col-md-2"><?=$this->translate("Waist") . ": " . $one["waist"]." cm"?></div>
            <div class="col-md-2"><?=$this->translate("Biceps") . ": " . $one["biceps"]." cm"?></div>
            <div class="col-md-2"><?=$this->translate("Neck") . ": " . $one["neck"]." cm"?></div>
            <div class="col-md-2"><?=$this->translate("Chest") . ": " . $one["chest"]." cm"?></div>
            <div class="col-md-2"><?=$this->translate("Gluteus") . ": " . $one["gluteus"]." cm"?></div>
            <div class="col-md-2"><?=$this->translate("Lower leg") . ": " . $one["lower_leg"]." cm"?></div>
            <div class="col-md-1 label label-danger"><i class="fa fa-clock-o"></i> <?=$this->humanReadable($one["measured_at"])?></div>
            <div class="col-md-1 tools">
                <!-- <a href="/manager/editmeasurements?id=<?=$one["id"]?>"><i class="fa fa-edit"></i></a> -->
                <i class="fa fa-trash-o"></i>
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
