<h3 class="heading-style"><?=$this->translate("Invoices");?></h3>

<div class="box box-primary">
    <div class="box-body bgr-every-second">
        <?php foreach ($this->items as $one):?>
            <!-- <span class="">
            <i class="fa fa-ellipsis-v"></i>
            </span> -->
            <div class="row">
            <div class="col-md-2"><?=$one["trainer_first_name"]. " " . $one["trainer_last_name"]?></div>
            <div class="col-md-2"><?=$this->formatInvoice($one["id"])?></div>
            <div class="col-md-2"><?=$this->humanReadable($one["paid_on"])?></div>
            <div class="col-md-2"><?=$one["name"]?></div>
            <div class="col-md-1 label label-success"><?=$this->formatPrice($one["price"])?></div>
            <div class="col-md-1 label label-success"><?=$one["client_first_name"]. " " . $one["client_last_name"]?></div>
            <div class="col-md-1 label label-danger"><i class="fa fa-clock-o"></i> <?=$this->humanReadable($one["created_on"])?></div>
            <div class="col-md-1 tools">
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
