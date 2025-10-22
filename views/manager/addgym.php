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
                        <label class="text-primary"><?=$this->translate("Country");?></label>
                        <select placeholder="<?=$this->translate("Country");?>" class="form-control country-select" name="country">
                            <option value=""><?=$this->translate("Select Country");?></option>
                            <?php foreach ($this->countries as $country):?>
                                <option value="<?=$country["id"]?>"><?=$country["country"]?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="text-primary"><?=$this->translate("City");?></label>
                        <select placeholder="<?=$this->translate("City");?>" class="form-control city-select" name="city">
                            <option value=""><?=$this->translate("Select City");?></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="text-primary"><?=$this->translate("Phone");?></label>
                        <input placeholder="<?=$this->translate("Phone");?>" class="form-control" type="text" name="phone" value=""/>
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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize Select2 for country and city dropdowns
    $('.country-select').select2({
        placeholder: "<?=$this->translate("Select Country");?>",
        allowClear: true
    });

    $('.city-select').select2({
        placeholder: "<?=$this->translate("Select City");?>",
        allowClear: true
    });

    // Handle country change to dynamically load cities
    $('.country-select').on('change', function() {
        var countryId = $(this).val();
        if (countryId) {
            $.ajax({
                url: '/manager/getCitiesByCountry',
                type: 'POST',
                data: { country_id: countryId },
                dataType: 'json',
                success: function(data) {
                    $('.city-select').empty().append('<option value=""><?=$this->translate("Select City");?></option>');
                    $.each(data, function(index, city) {
                        $('.city-select').append('<option value="' + city.id + '">' + city.city + '</option>');
                    });
                    $('.city-select').trigger('change');
                },
                error: function() {
                    alert('Error loading cities');
                }
            });
        } else {
            $('.city-select').empty().append('<option value=""><?=$this->translate("Select City");?></option>');
            $('.city-select').trigger('change');
        }
    });
});
</script>