<h3 class="heading-style"><?=$this->translate("Invoices");?></h3>

<div class="box box-primary">
    <div class="box-body bgr-every-second">
    
    <div class="row" style="background-color: #d3d3d3; font-weight: bold;">
        <div class="col-md-3"><?=$this->translate("Subscription Type")?></div>
        <div class="col-md-4"><?=$this->translate("Name")?></div>
        <div class="col-md-2"><?=$this->translate("Paid On")?></div>
        <div class="col-md-2"><?=$this->translate("Valid Until")?></div>
        <div class="col-md-1"><?=$this->translate("Actions")?></div>
    </div>

        <?php foreach ($this->items as $one): ?>
            <div class="row">
                <div class="col-md-3">
                    <?php
                    if ($one['item_id'] == 1) {
                        echo $this->translate("Monthly subscription");
                    } elseif ($one['item_id'] == 2) {
                        echo $this->translate("Yearly subscription");
                    } else {
                        echo $this->translate("Unknown");
                    }
                    ?>
                </div>
                <div class="col-md-4"><?=$one["first_name"]. " " . $one['last_name']?></div>
                <div class="col-md-2 label label-success">
                    <i class="fa fa-clock-o"></i> <?=$this->humanReadable($one["paid_on"])?></div>
                <div class="col-md-2 label label-danger">
                    <i class="fa fa-clock-o"></i> <?=$this->humanReadable($one["valid_until"])?></div>
                <div class="col-md-1 tools">
                    <!-- <a href="/manager/edittraining?id=<?=$one["id"]?>"><i class="fa fa-edit"></i></a> -->
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
</div>

<script>

</script>
