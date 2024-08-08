<h3 class="heading-style"><?=$this->translate("Invoices");?></h3>

<div class="box box-primary">
    <div class="box-body">
        <ul class="todo-list ui-sortable">
        <?php foreach ($this->items as $one):?>
        <li>
            <!-- <span class="">
            <i class="fa fa-ellipsis-v"></i>
            </span> -->
            <span class="text"><?=$one["trainer_first_name"]. " " . $one["trainer_last_name"]?></span>
            <span class="label label-success"><?=$this->formatInvoice($one["id"])?></span>
            <span class="label label-success"><?=$this->humanReadable($one["paid_on"])?></span>
            <span class="label label-success"><?=$one["name"]?></span>
            <span class="label label-success"><?=$this->formatPrice($one["price"])?></span>
            <span class="label label-success"><?=$one["client_first_name"]. " " . $one["client_last_name"]?></span>
            <small class="label label-danger"><i class="fa fa-clock-o"></i> <?=$this->humanReadable($one["created_on"])?></small>
            <div class="tools">
                <i class="fa fa-trash-o"></i>
            </div>
        </li>
        <?php endforeach;?>
        </ul>
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
