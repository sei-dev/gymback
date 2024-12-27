<h3 class="heading-style"><?=$this->translate("Trainings");?></h3>

<div class="box box-primary">
    <div class="box-body bgr-every-second">
    
    <div class="row" style="background-color: #d3d3d3; font-weight: bold;">
        <div class="col-md-2"><?=$this->translate("Trainer Name")?></div>
        <div class="col-md-2"><?=$this->translate("Gym")?></div>
        <div class="col-md-2"><?=$this->translate("Type")?></div>
        <div class="col-md-2"><?=$this->translate("Date")?></div>
        <div class="col-md-2"><?=$this->translate("Time")?></div>
        <div class="col-md-1"><?=$this->translate("Created At")?></div>
        <div class="col-md-1"><?=$this->translate("Actions")?></div>
    </div>

        <?php foreach ($this->items as $one):?>
			<div class="row">
            <div class="col-md-2"><?=$one["name"]?></div>
            <div class="col-md-2 label label-success"><?=$one["gym"]?></div>
            <div class="col-md-2"><?php if($one["is_group"]==0||$one["is_group"]=="0") echo $this->translate("Individual"); else echo $this->translate("Group");?></div>
            <div class="col-md-2"><?=$this->humanReadable($one["date"])?></div>
            <div class="col-md-2"><?=$one["time"]?></div>
            <div class="col-md-1 label label-danger"><i class="fa fa-clock-o"></i> <?=$this->humanReadable($one["created_at"])?></div>
            <div class="col-md-1 tools">
                <!-- <a href="/manager/edittraining?id=<?=$one["id"]?>"><i class="fa fa-edit"></i></a> -->
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