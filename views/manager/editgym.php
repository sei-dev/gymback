<form class="req-forms" id="search_form" method="post" action="/manager/updategym" enctype="multipart/form-data">
    <h3 class="heading-style"><?php echo $this->translate("Edit gym");?></h3>
    <?php if (!empty($this->messages)): ?>
        <div class="alert alert-danger">
            <?php foreach ($this->messages as $message): ?>
                <p><?php echo htmlspecialchars($message); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="text-primary"><?php echo $this->translate("Gym name");?></label>
                        <input placeholder="<?php echo $this->translate("Gym name");?>" class="form-control" type="text" name="name" value="<?php echo htmlspecialchars($this->gym['name'] ?? '');?>"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="text-primary"><?php echo $this->translate("Address");?></label>
                        <input placeholder="<?php echo $this->translate("Address");?>" class="form-control" type="text" name="address" value="<?php echo htmlspecialchars($this->gym['address'] ?? '');?>"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="text-primary"><?php echo $this->translate("Country");?></label>
                        <select placeholder="<?php echo $this->translate("Country");?>" class="form-control country-select" name="country">
                            <option value=""><?php echo $this->translate("Select Country");?></option>
                            <?php if (!empty($this->countries) && is_array($this->countries)): ?>
                                <?php foreach ($this->countries as $country): ?>
                                    <?php $countryName = isset($country['country']) ? $country['country'] : (isset($country['country']) ? $country['country'] : 'Unknown'); ?>
                                    <option value="<?php echo htmlspecialchars($country['id'] ?? '');?>" <?php echo ($country['id'] == ($this->gym['country_id'] ?? '')) ? 'selected' : '';?>>
                                        <?php echo htmlspecialchars($countryName);?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value=""><?php echo $this->translate("No countries available");?></option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="text-primary"><?php echo $this->translate("City");?></label>
                        <select placeholder="<?php echo $this->translate("City");?>" class="form-control city-select" name="city">
                            <option value=""><?php echo $this->translate("Select City");?></option>
                            <?php if (!empty($this->gym['city_id'])): ?>
                                <option value="<?php echo htmlspecialchars($this->gym['city_id']);?>" selected>
                                    <?php echo htmlspecialchars($this->gym['city_name'] ?? 'Current City');?>
                                </option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="text-primary"><?php echo $this->translate("Phone");?></label>
                        <input placeholder="<?php echo $this->translate("Phone");?>" class="form-control" type="text" name="phone" value="<?php echo htmlspecialchars($this->gym['phone'] ?? '');?>"/>
                    </div>
                </div>
            </div>
            <div style="display: none" class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="text-primary"></label>
                        <input placeholder="" class="form-control" type="text" id="id" name="id" value="<?php echo htmlspecialchars($this->gym['id'] ?? '');?>"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button name="submit" type="submit" class="btn btn-primary btn-block btn-flat"><?php echo $this->translate("Submit");?></button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Include jQuery and Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" integrity="sha256-ijZ5r2qP5a3zqO3eL4RhEN1X+ceQELIy3h6xp3i++Uc=" crossorigin="anonymous" />
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" integrity="sha256-9y1Zf2X8vG+PoQwGKQ1oTNZwQ0h3A+5S+2eB8z6SUK4=" crossorigin="anonymous"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof jQuery === 'undefined') {
        console.error('jQuery is not loaded. Please ensure the jQuery script is included correctly.');
        return;
    }

    jQuery('.country-select').select2({
        placeholder: "<?php echo $this->translate("Select Country");?>",
        allowClear: true,
        width: '100%'
    });

    jQuery('.city-select').select2({
        placeholder: "<?php echo $this->translate("Select City");?>",
        allowClear: true,
        width: '100%'
    });

    // Preload cities for the current country
    var initialCountryId = jQuery('.country-select').val();
    if (initialCountryId) {
        jQuery.ajax({
            url: '/manager/getCitiesByCountry',
            type: 'POST',
            data: { country_id: initialCountryId },
            dataType: 'json',
            success: function(data) {
                var $citySelect = jQuery('.city-select');
                $citySelect.empty().append('<option value=""><?php echo $this->translate("Select City");?></option>');
                if (Array.isArray(data) && data.length > 0) {
                    jQuery.each(data, function(index, city) {
                        var isSelected = (city.id == '<?php echo $this->gym['city_id'] ?? '';?>') ? 'selected' : '';
                        $citySelect.append('<option value="' + (city.id || '') + '" ' + isSelected + '>' + (city.city || 'Unknown') + '</option>');
                    });
                } else {
                    console.warn('No cities found for country ID: ' + initialCountryId);
                }
                $citySelect.trigger('change');
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' - ' + error);
                console.error('Response: ', xhr.responseText);
                alert('<?php echo $this->translate("Error loading cities");?>');
            }
        });
    }

    // Handle country change to dynamically load cities
    jQuery('.country-select').on('change', function() {
        var countryId = jQuery(this).val();
        var $citySelect = jQuery('.city-select');

        if (countryId) {
            jQuery.ajax({
                url: '/manager/getCitiesByCountry',
                type: 'POST',
                data: { country_id: countryId },
                dataType: 'json',
                success: function(data) {
                    $citySelect.empty().append('<option value=""><?php echo $this->translate("Select City");?></option>');
                    if (Array.isArray(data) && data.length > 0) {
                        jQuery.each(data, function(index, city) {
                            $citySelect.append('<option value="' + (city.id || '') + '">' + (city.city || 'Unknown') + '</option>');
                        });
                    } else {
                        console.warn('No cities found for country ID: ' + countryId);
                    }
                    $citySelect.trigger('change');
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + ' - ' + error);
                    console.error('Response: ', xhr.responseText);
                    alert('<?php echo $this->translate("Error loading cities");?>');
                    $citySelect.empty().append('<option value=""><?php echo $this->translate("Select City");?></option>');
                    $citySelect.trigger('change');
                }
            });
        } else {
            $citySelect.empty().append('<option value=""><?php echo $this->translate("Select City");?></option>');
            $citySelect.trigger('change');
        }
    });
});
</script>